<?php
/**
 * This file is part of Swoft.
 *
 * @link https://swoft.org
 * @document https://doc.swoft.org
 * @contact group@swoft.org
 * @license https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Controllers;

use App\Core\Constants\ErrorCode;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;
use App\Exception\HttpServerException;


/**
 * Class IndexController
 * @Controller
 */
class IndexController extends BaseController
{

    /**
     * @RequestMapping(route="/", method={RequestMethod::GET,RequestMethod::POST})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $data = config('message');
        if ($request->getMethod() === 'POST') {
            return $this->response->success($data);
        }
        return view('index/index', $data);
    }

    /**
     * @RequestMapping(route="/error", method={RequestMethod::GET,RequestMethod::POST})
     * @param Request $request
     * @return Response
     * @throws \ReflectionException
     * @throws \xiaolin\Enum\Exception\EnumException
     */
    public function error(Request $request): Response
    {
        throw new HttpServerException(ErrorCode::$ENUM_PARAMS_ERROR);
    }
}
