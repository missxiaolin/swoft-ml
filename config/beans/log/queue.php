<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/10/14
 * Time: 下午2:17
 */

use App\Core\Logger\Handlers\FileHandler;

return [
    'queueLogger' => [
        'class' => \Swoft\Log\Logger::class,
        'name' => APP_NAME,
        'enable' => env('LOG_ENABLE', false),
        'flushInterval' => 1,
        'flushRequest' => true,
        'handlers' => [
            '${queueHandler}',
        ],
    ],
    'queueHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'queue',
        'formatter' => '${lineFormatter}',
        'levels' => [
            \Swoft\Log\Logger::INFO,
            \Swoft\Log\Logger::DEBUG,
            \Swoft\Log\Logger::NOTICE,
            \Swoft\Log\Logger::TRACE,
            \Swoft\Log\Logger::WARNING,
            \Swoft\Log\Logger::ERROR,
            \Swoft\Log\Logger::CRITICAL,
            \Swoft\Log\Logger::ALERT,
            \Swoft\Log\Logger::EMERGENCY,
        ],
    ],
];