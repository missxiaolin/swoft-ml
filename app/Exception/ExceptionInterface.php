<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/22
 * Time: 下午6:02
 */

namespace App\Exception;


interface ExceptionInterface
{
    public function getErrorCode();
}