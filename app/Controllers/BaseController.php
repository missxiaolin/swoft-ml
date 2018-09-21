<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/28
 * Time: 下午1:31
 */

namespace App\Controllers;

use App\Core\Logger\ThrowableLogger;
use App\Core\HttpServer\Response;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Bean\Annotation\Inject;
use Swoft\Bean\Annotation\Bean;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController
{
    /**
     * 注入自定义Response
     * @Inject()
     *
     * @var Response
     */
    protected $response;

    /**
     * 注入自定义日志
     * @Inject()
     *
     * @var ThrowableLogger
     */
    protected $logger;
}