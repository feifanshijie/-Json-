<?php
/**
 * =================================================
 * TODO:MongoDBHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

use FunnyPHP\System\BaseInterface\CacheInterface;
use MongoDB;

class MongoDBHelp extends MongoDB implements CacheInterface
{
    public function __construct()
    {
        
    }
    public static function Connect()
    {
        $m  = new \MongoClient();    // 连接到mongodb
        $db = $m->test;            // 选择一个数据库
        $collection = $db->runoob; // 选择集合
        $document = array(
            "title" => "MongoDB",
            "description" => "database",
            "likes" => 100,
            "url" => "http://www.runoob.com/mongodb/",
            "by", "菜鸟教程"
        );
        $collection->insert($document);
        echo "数据插入成功";
    }

    /**
     * ====================================
     * TODO:根据一个KEY获取一个值 GET A VALUE
     * ====================================
     * @param string  $k key
     * @return boolean
     * ====================================
     */
    public function GetVal($k)
    {
        return 1;
    }

    /**
     * ====================================
     * TODO:SET A VALUE
     * ====================================
     * @param string  $k key
     * @param string  $v value
     * @param integer $t time
     * @return boolean
     * ====================================
     */
    public function SetVal($k, $v, $t)
    {
        return 1;
    }


}