<?php

/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'redis' => [
        'name' => 'redis',
        'uri' => [
            '127.0.0.1:6379',
            '127.0.0.1:6379',
        ],
        'minActive' => 5,
        'maxActive' => 10,
        'maxWait' => 20,
        'maxWaitTime' => 3,
        'maxIdleTime' => 60,
        'timeout' => 3,
        'db' => 0,
        'prefix' => '',
        'serialize' => 0,
    ],
];