<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/22
 * Time: 下午6:02
 */

namespace App\Exception;

use App\Core\Constants\ErrorCode;
use Swoft\Http\Server\Exception\HttpException;
use Throwable;

class HttpServerException extends HttpException implements ExceptionInterface
{
    /**
     * HttpServerException constructor.
     * @param int $code
     * @param null $message
     * @param Throwable|null $previous
     * @throws \ReflectionException
     * @throws \xiaolin\Enum\Exception\EnumException
     */
    public function __construct($code = 0, $message = null, Throwable $previous = null)
    {
        if (!isset($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code, $previous);
    }

    public function getErrorCode()
    {
        return $this->code;
    }
}