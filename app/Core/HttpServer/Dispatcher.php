<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/10/16
 * Time: 上午9:24
 */

namespace App\Core\HttpServer;

use Swoft\Http\Server\ServerDispatcher;

/**
 * Class Dispatcher
 * @package App\Core\HttpServer
 */
class Dispatcher extends ServerDispatcher
{
    protected function afterDispatch($response)
    {
        parent::afterDispatch($response);
    }
}
