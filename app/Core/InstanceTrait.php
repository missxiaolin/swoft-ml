<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/19
 * Time: 下午3:44
 */

namespace App\Core;

use Swoft\Core\RequestContext;

trait InstanceTrait
{
    /**
     * @param string $child
     * @param array $params
     * @param bool $refresh
     * @return mixed|static
     */
    public static function instance($child = 'default', $params = [], $refresh = false)
    {
        $key = get_called_class();
        $instance = RequestContext::getContextDataByChildKey($key, $child);
        if ($refresh || is_null($instance) || !$instance instanceof static) {
            $instance = new static(...$params);
            RequestContext::setContextDataByChildKey($key, $child, $instance);
        }

        return $instance;
    }
}