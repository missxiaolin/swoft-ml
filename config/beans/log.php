<?php
/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Core\Logger\Handlers\FileHandler;

return [
    'debugHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'debug',
        'logFile' => '@runtime/logs/debug.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            \Swoft\Log\Logger::INFO,
            \Swoft\Log\Logger::DEBUG,
        ],
    ],
    'traceHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'trace',
        'logFile' => '@runtime/logs/trace.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            \Swoft\Log\Logger::TRACE,
        ],
    ],
    'noticeHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'notice',
        'logFile' => '@runtime/logs/notice.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            \Swoft\Log\Logger::NOTICE,
        ],
    ],
    'applicationHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'error',
        'logFile' => '@runtime/logs/error.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            \Swoft\Log\Logger::WARNING,
            \Swoft\Log\Logger::ERROR,
            \Swoft\Log\Logger::CRITICAL,
            \Swoft\Log\Logger::ALERT,
            \Swoft\Log\Logger::EMERGENCY,
        ],
    ],
    'logger' => [
        'name' => APP_NAME,
        'enable' => env('LOG_ENABLE', false),
        'flushInterval' => 100,
        'flushRequest' => true,
        'handlers' => [
            '${noticeHandler}',
            '${applicationHandler}',
            '${debugHandler}',
            '${traceHandler}',
        ],
    ],
    'customLogger' => [
        'class' => \Swoft\Log\Logger::class,
        'name' => APP_NAME,
        'enable' => env('LOG_ENABLE', false),
        'flushInterval' => 1,
        'flushRequest' => true,
        'handlers' => [
            '${customHandler}',
        ],
    ],
    'customHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'custom',
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
    'lineFormatter' => [
        'class' => \Monolog\Formatter\LineFormatter::class,
        'allowInlineLineBreaks' => true,
    ],
];
