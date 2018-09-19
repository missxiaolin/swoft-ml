<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/19
 * Time: 下午3:10
 */

namespace App\Core\Queue;

use App\Core\InstanceTrait;
use Swoft\App;
use Lin\Swoole\Queue\Job;

/**
 * Class Queue
 * @package App\Core\Queue
 */
class Queue extends Job
{
    use InstanceTrait;

    public function __construct()
    {
        /** @var Config $config */
        $config = bean(Config::class);
        $this->maxProcesses = $config->getMaxProcesses();
        $this->processHandleMaxNumber = $config->getProcessHandleMaxNumber();
        $this->errorKey = $config->getErrorKey();
        $this->queueKey = $config->getQueueKey();
        $this->delayKey = $config->getDelayKey();


        $host = $config->getHost();
        $auth = $config->getAuth();
        $db = $config->getDb();
        $port = $config->getPort();

        $pidPath = alias('@runtime');

        $logger = App::getLogger();

        $this->setRedisConfig($host, $auth, $db, $port);
        $this->setPidPath($pidPath . '/queue.pid');
        $this->setLoggerHandler($logger);
    }
}