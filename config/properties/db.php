<?php

/*
 * This file is part of Swoft.
 * (c) Swoft <group@swoft.org>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'master' => [
        'name' => 'default.master',
        'uri' => [
            '127.0.0.1:3306/test?user=root&password=&charset=utf8mb4',
        ],
        'minActive' => 5,
        'maxActive' => 10,
        'maxWait' => 20,
        'timeout' => 2,
        'maxIdleTime' => 60,
        'maxWaitTime' => 3,
    ],

    'slave' => [
        'name' => 'default.slave',
        'uri' => [
            '127.0.0.1:3306/test?user=root&password=&charset=utf8mb4',
        ],
        'minActive' => 5,
        'maxActive' => 10,
        'maxWait' => 20,
        'timeout' => 3,
        'maxIdleTime' => 60,
        'maxWaitTime' => 3,
    ],
];

