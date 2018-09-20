<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/22
 * Time: 下午5:57
 */

namespace App\Core\HttpServer;

use App\Core\Constants\ErrorCode;
use Swoft\Bean\Annotation\Bean;
use Swoft\Core\RequestContext;
use Swoft\Http\Message\Server\Response as HttpServerResponse;

/**
 * @Bean()
 * Class Response
 * @package App\Core\HttpServer
 */
class Response
{
    /**
     * 返回成功的数据
     * @param array $data
     * @return HttpServerResponse
     */
    public function success($data = []): HttpServerResponse
    {
        $response = RequestContext::getResponse();
        return $response->json([
            'code' => ErrorCode::SUCCESS,
            'data' => $data,
        ]);
    }

    /**
     * 返回失败的数据
     * @param $code
     * @param null $message
     * @return HttpServerResponse
     * @throws \ReflectionException
     * @throws \xiaolin\Enum\Exception\EnumException
     */
    public function fail($code, $message = null): HttpServerResponse
    {
        if (empty($message)) {
            $message = ErrorCode::getMessage($code);
        }
        $response = RequestContext::getResponse();
        return $response->json([
            'code' => $code,
            'message' => $message,
        ]);
    }
}