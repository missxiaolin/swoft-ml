<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/10/16
 * Time: 上午9:24
 */

namespace App\Core\HttpServer;

use Swoft\Http\Server\ServerDispatcher;

class Dispatcher extends ServerDispatcher
{
    protected function afterDispatch($response)
    {
        parent::afterDispatch($response);
    }
}
