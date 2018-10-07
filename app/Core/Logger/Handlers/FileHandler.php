<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/9/30
 * Time: 上午10:25
 */

namespace App\Core\Logger\Handlers;

use Swoft\App;
use Swoole\Coroutine;
use Swoft\Log\FileHandler as SwoftFileHandler;

/**
 * 按照日期分目录的日志Handler
 * Class FileHandler
 * @package App\Core\Logger\Handlers
 */
class FileHandler extends SwoftFileHandler
{
    protected $fileName = 'swoft';

    /**
     * @return string
     */
    protected function getLogFile()
    {
        $date = date('Ymd');
        $logFile = App::getAlias("@runtime/logs/{$date}/{$this->fileName}.log");
        $this->createDir($logFile);
        return $logFile;
    }

    /**
     * 创建目录
     */
    protected function createDir($file)
    {
        $dir = dirname($file);
        if ($dir !== null && !is_dir($dir)) {
            $status = mkdir($dir, 0777, true);
            if ($status === false) {
                throw new \UnexpectedValueException(sprintf('There is no existing directory at "%s" and its not buildable: ', $dir));
            }
        }
    }

    /**
     * @param array $records
     */
    protected function write(array $records)
    {
        $logFile = $this->getLogFile();
        $messageText = implode("\n", $records) . "\n";

        if (App::isCoContext()) {
            $this->coWrite($logFile, $messageText);
        } else {
            $this->syncWrite($logFile, $messageText);
        }
    }

    /**
     * 协程写文件
     *
     * @param string $logFile 日志路径
     * @param string $messageText 文本信息
     */
    protected function coWrite(string $logFile, string $messageText)
    {
        go(function () use ($logFile, $messageText) {
            $res = Coroutine::writeFile($logFile, $messageText, FILE_APPEND);
            if ($res === false) {
                throw new \InvalidArgumentException("Unable to append to log file: {$this->logFile}");
            }
        });
    }

    /**
     * 同步写文件
     *
     * @param string $logFile 日志路径
     * @param string $messageText 文本信息
     */
    protected function syncWrite(string $logFile, string $messageText)
    {
        $fp = fopen($logFile, 'a');
        if ($fp === false) {
            throw new \InvalidArgumentException("Unable to append to log file: {$this->logFile}");
        }
        flock($fp, LOCK_EX);
        fwrite($fp, $messageText);
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}
