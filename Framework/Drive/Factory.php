<?php
/**
 * --------------------------------------------------
 *  描述  帮助类工厂【业务逻辑】
 *  作者  Eric:2652525544@qq.com
 *  版本  1.0.0
 *  时间  2017-08-21
 * --------------------------------------------------
 *
 * --------------------------------------------------
 */
namespace Framework\Drive;

class Factory
{
    private static $path = '\\Framework\\Factory\\';

    public static function create($object)
    {
        $class = self::$path.$object;
        return $self = new $class;
    }

    public static function show()
    {
        return self::class;
    }

    public static function path($object)
    {

    }
}