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

abstract class ORM extends MySqlDrive
{
    protected $timestamp = false;

    protected $table = '';

    public $sql = '';

    public static $model = null;

    public static function content()
    {
        if(self::$model === null)
        {
            self::$model = parent::connect('blog');
        }

        return self::$model;
    }
}