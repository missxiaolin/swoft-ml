<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/28
 * Time: 下午1:31
 */

namespace App\Controllers;

use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Bean\Annotation\Inject;

class BaseController
{
    /**
     * 注入自定义Response
     * @Inject()
     *
     * @var \App\Core\HttpServer\Response
     */
    protected $response;
}