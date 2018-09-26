<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/19
 * Time: 下午3:10
 */

namespace App\Core\Queue;

use Lin\Swoole\Queue\JobInterface;
use Swoft\Redis\Exception\RedisException;
use Swoft\Redis\Pool\Config\RedisPoolConfig;
use Swoft\Redis\Pool\RedisPool;
use App\Core\InstanceTrait;
use Lin\Swoole\Queue\Job;
use Swoft\Redis\Redis;
use Swoft\App;

/**
 * Class Queue
 * @package App\Core\Queue
 */
class Queue extends Job
{
    use InstanceTrait;

    /**
     * Queue constructor.
     * @throws RedisException
     */
    public function __construct()
    {
        /** @var Config $config */
        $config = bean(Config::class);
        $this->maxProcesses = $config->getMaxProcesses();
        $this->processHandleMaxNumber = $config->getProcessHandleMaxNumber();
        $this->errorKey = $config->getErrorKey();
        $this->queueKey = $config->getQueueKey();
        $this->delayKey = $config->getDelayKey();

        list($host, $port, $auth, $db) = $this->getRedisConfig();

        $pidPath = alias('@runtime');

        $logger = App::getLogger();

        $this->setRedisConfig($host, $auth, $db, $port);
        $this->setPidPath($pidPath . '/queue.pid');
        $this->setLoggerHandler($logger);
    }

    public function countCurrentJobs()
    {
        $redis = $this->getRedisChildClient();
        return $redis->lLen($this->queueKey);
    }

    /**
     * @return array
     * @throws RedisException
     */
    protected function getRedisConfig(): array
    {
        $pool = bean(RedisPool::class);
        $uri = $pool->getConnectionAddress();
        /** @var RedisPoolConfig $config */
        $config = $pool->getPoolConfig();
        $parseAry = parse_url($uri);
        if (!isset($parseAry['host']) || !isset($parseAry['port'])) {
            $error = sprintf('Redis Connection format is incorrect uri=%s, eg:tcp://127.0.0.1:6379/1?auth=password', $uri);
            throw new RedisException($error);
        }

        $query = $parseAry['query'] ?? '';
        parse_str($query, $options);
        $configs = array_merge($parseAry, $options);

        $host = $configs['host'];
        $port = $configs['port'];
        $auth = $configs['auth'] ?? null;
        $db = $config->getDb();

        return [$host, $port, $auth, $db];
    }

    /**
     * @param JobInterface $job
     * @return int
     */
    public function push(JobInterface $job)
    {
        $redis = bean(Redis::class);
        $packer = $this->getPacker();
        return $redis->lpush($this->queueKey, $packer->pack($job));
    }

    /**
     * @param JobInterface $job
     * @param int $time
     * @return int
     */
    public function delay(JobInterface $job, $time = 0)
    {
        if (empty($time)) {
            return $this->push($job);
        }

        $redis = bean(Redis::class);
        $packer = $this->getPacker();
        return $redis->zAdd($this->delayKey, time() + $time, $packer->pack($job));
    }
}