<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/22
 * Time: 下午5:57
 */

namespace App\Core\Constants;

use xiaolin\Enum\Enum;

/**
 * Class ErrorCode
 * @package App\Constants
 */
class ErrorCode extends Enum
{
    const SERVER_ERROR = 500;

    const VALIDATE_FAIL = 600;

    /**
     * @Message('参数错误')
     */
    public static $ENUM_PARAMS_ERROR = 1000;
}