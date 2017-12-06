<?php
/**
 *
 */
namespace Framework\Support;
use MongoDB;

class MongDB
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