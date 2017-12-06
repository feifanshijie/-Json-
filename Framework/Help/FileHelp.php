<?php
/**
 * =================================================
 * TODO:FileHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class FileHelp
{

    public function __construct()
    {

    }

    //TODO:获取文件最后修改时间
    public static function F_filemtime(string $path = '')
    {
        if(file_exists($path))
        {
            return filemtime($path);
        }
        return 0;
    }

    public static function F_unlink(string $path = '')
    {
        if(unlink($path)){
            return 1;
        }
        return 0;
    }
    public static function F_stat($path)
    {
        if(file_exists($path))
        {
            return stat($path);
        }
    }
    public static function F()
    {
        var_dump(date('Y-m-d H:i:s',filemtime("index.php")));exit;
    }
    public static function F34()
    {
        var_dump(date('Y-m-d H:i:s',filemtime("index.php")));exit;
    }
}