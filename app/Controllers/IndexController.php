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

use Swoft\Bean\Annotation\Inject;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Message\Server\Response;


/**
 * Class IndexController
 * @Controller
 */
class IndexController
{

    /**
     * 注入自定义Response
     * @Inject()
     *
     * @var \App\Core\HttpServer\Response
     */
    private $response;

    /**
     * @RequestMapping(route="/")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request) : Response
    {
        $name = 'Swoft';
        $notes = [
            'New Generation of PHP Framework',
        ];
        $links = [
            [
                'name' => 'Home',
                'link' => 'http://www.swoft.org',
            ],
        ];
        $data = compact('name', 'notes', 'links');
        if ($request->getMethod() === 'POST') {
            return $this->response->success($data);
        }
        return view('index/index', $data);
    }
}
