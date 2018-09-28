<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/28
 * Time: 下午4:46
 */

namespace App\Exception;

use Swoft\Http\Server\Exception\HttpException;

/**
 * Class NoContentException
 * @package App\Exception
 */
class NoContentException extends HttpException
{
    protected $code = 204;
}