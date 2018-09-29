<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Commands;

use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;

/**
 * This is a example command class
 * @Command(coroutine=false)
 * @package App\Commands
 */
class InitCommand
{
    /**
     * this is a example command
     * @Usage {command} [arguments ...] [--options ...]
     * @Arguments
     *   first STRING        The first argument value
     *   second STRING       The second argument value
     * @Options
     *   --opt STRING        This is a long option
     *   -s BOOL             This is a short option(<comment>use color</comment>)
     * @Example {command} FIRST SECOND --opt VALUE -s
     * @param Input $input
     * @param Output $output
     * @return int
     */
    public function handle(Input $input, Output $output): int
    {
        // some logic ...
        $shell = "/sbin/ifconfig -a|grep inet|grep -v 127.0.0.1|grep -v inet6|awk '{print $2}'|tr -d 'addr:'|head -1";
        $ip = exec($shell);
        $output->colored('inet ip: ' . $ip);
        $root = alias('@root');
        $env = file_get_contents($root . '/.env');
        $env = preg_replace_callback('/CONSUL_REGISTER_SERVICE_ADDRESS=127\.0\.0\.1/', function ($matches) use ($ip) {
            return 'CONSUL_REGISTER_SERVICE_ADDRESS=' . $ip;
        }, $env);

        file_put_contents($root . '/.env', $env);
        $output->colored('init CONSUL_REGISTER_SERVICE_ADDRESS success');

        return 0;
    }
}
