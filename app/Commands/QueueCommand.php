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
     * 消费队列
     * @Usage {command}
     * @Example {command}
     * @param Input  $input
     * @param Output $output
     * @return int
     */
    public function handle(Input $input, Output $output): int
    {
        $queue = bean(Queue::class);
        $output->writeln($queue->sss);

        return 0;
    }
}