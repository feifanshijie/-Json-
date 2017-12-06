<?php
/**
 * =================================================
 * TODO:redisAsynch by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class AsynchMysqlHelp
{
    public function __construct()
    {
        $db = new Swoole\MySQL;
        $server = array(
            'host' => '127.0.0.1',
            'user' => 'test',
            'password' => 'test',
            'database' => 'test',
        );

        $db->connect($server, function ($db, $result) {
            $db->query("show tables", function (Swoole\MySQL $db, $result) {
                if ($result === false) {
                    var_dump($db->error, $db->errno);
                } elseif ($result === true) {
                    var_dump($db->affected_rows, $db->insert_id);
                } else {
                    var_dump($result);
                    $db->close();
                }
            });
        });
    }
}