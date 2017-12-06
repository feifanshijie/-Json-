<?php
/**
 * ============================================================
 * TODO:[Class Mongo 2017/07/26  V0.1]
 * ============================================================
 */
namespace Framework\Drive;

use Framework\BaseInterface\DBInterface;
use MongoDB;

class MongoDBDrive implements DBInterface
{
    public function __construct()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $document = ['_id' => new MongoDB\BSON\ObjectID, 'name' => '菜鸟教程'];
        $_id= $bulk->insert($document);
        var_dump($_id);
        $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
        $result = $manager->executeBulkWrite('test.runoob', $bulk, $writeConcern);
    }

    //TODO:初始化数据
    public static function connect($db_name)
    {

    }

    public function SimInsert()
    {

    }
    public function SimUpdate()
    {

    }
    public function SimInDel()
    {

    }
    public function SimInQuery()
    {

    }
}