<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/28
 * Time: 下午5:03
 */

namespace Swoft\Test;

use PHPUnit\Framework\TestCase;
use Swoft\HttpClient\Client;

/**
 * Class HttpTestCase
 * @package Swoft\Test\Cases
 */
class HttpTestCase extends TestCase
{
    protected $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $port = env('HTTP_PORT', 8080);
        $this->client = new Client([
            'base_uri' => sprintf('http://127.0.0.1:%s', $port),
            'adapter' => 'curl',
        ]);
    }
}