<?php
/**
 * --------------------------------------------------
 *  描述  Hello测试工厂类
 *  作者  Eric:2652525544@qq.com
 *  版本  1.0.0
 *  时间  2017-05-22
 * --------------------------------------------------
 */
namespace Framework\Factory;

class Hello
{
    public function __construct()
    {
        echo 'hello';
    }

    public function test($param = null)
    {
        echo $param;
    }
}