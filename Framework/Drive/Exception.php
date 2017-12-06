<?php
/**
 * --------------------------------------------------
 *  描述  异常处理
 *  作者  Eric:2652525544@qq.com
 *  版本  1.0.0
 *  时间  2017-08-21
 * --------------------------------------------------
 *
 * --------------------------------------------------
 */
namespace Framework\Drive;

class Exception extends \Exception
{
    public function __construct($message, $code)
    {
        echo "<script>alert('{$code}:{$message}')</script>";

    }
    public function __toString() {
        return __CLASS__.':['.$this->code.']:'.$this->message.'\n';
    }

    public function customFunction() {
        echo '自定义错误类型';
    }

    //TODO:保存捕获日志
    public function push_log()
    {
        echo $this->file;
        echo $this->line;
    }
}