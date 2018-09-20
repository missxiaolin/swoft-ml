<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/20
 * Time: 下午4:46
 */

namespace App\Core\Logger;

use Swoft\App;
use Swoft\Log\Logger;
use Throwable;
use Swoft\Bean\Annotation\Bean;
use Swoft\Bean\Annotation\Inject;

/**
 * Class Logger
 * @Bean
 * @package App\Core\Logger
 */
class ThrowableLogger
{
    /**
     * @Inject("logger")
     * @var Logger
     */
    protected $logger;

    /**
     * 格式化 $throwable
     * @author limx
     * @param Throwable $throwable
     * @return string
     */
    protected function format(Throwable $throwable): string
    {
        return sprintf(
            "%s:%s(%s) in %s:%s\nStack trace:\n%s",
            get_class($throwable),
            $throwable->getMessage(),
            $throwable->getCode(),
            $throwable->getFile(),
            $throwable->getLine(),
            $throwable->getTraceAsString()
        );
    }

    public function __call($name, $arguments)
    {
        if (isset($arguments[0]) && $arguments[0] instanceof Throwable) {
            $this->logger->$name($this->format($arguments[0]));
        }
    }
}