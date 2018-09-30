<?php
/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Core\Logger\Handlers\FileHandler;
use \Monolog\Formatter\LineFormatter;
use \Swoft\Log\Logger;

return [
    'debugHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'debug',
        'logFile' => '@runtime/logs/debug.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            Logger::INFO,
            Logger::DEBUG,
            Logger::TRACE,
        ],
    ],
    'traceHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'trace',
        'logFile' => '@runtime/logs/trace.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            Logger::TRACE,
        ],
    ],
    'noticeHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'notice',
        'logFile' => '@runtime/logs/notice.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            Logger::NOTICE,
        ],
    ],
    'applicationHandler' => [
        'class' => FileHandler::class,
        'fileName' => 'error',
        'logFile' => '@runtime/logs/error.log',
        'formatter' => '${lineFormatter}',
        'levels' => [
            Logger::WARNING,
            Logger::ERROR,
            Logger::CRITICAL,
            Logger::ALERT,
            Logger::EMERGENCY,
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
    'lineFormatter' => [
        'class' => LineFormatter::class,
        'allowInlineLineBreaks' => true,
    ],
];
