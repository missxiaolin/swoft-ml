<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/19
 * Time: 下午3:12
 */

namespace App\Commands;

use App\Core\Queue\Queue;
use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;

/**
 * Class QueueCommand
 * @package App\Commands
 */
class QueueCommand
{
    /**
     *
     * @Usage {command}
     * @Example {command}
     * @param Input  $input
     * @param Output $output
     * @return int
     * @throws \Lin\Swoole\Queue\QueueException
     */
    public function handle(Input $input, Output $output): int
    {
        $queue = Queue::instance();
        $queue->run();
        return 0;
    }
}