<?php
/**
 * =================================================
 * TODO:redisAsynch by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class AsynchHttpHelp
{
    public function __construct()
    {
        $serv = new Swoole\Server("127.0.0.1", 9502);
        $serv->set(array('task_worker_num' => 4));
        $serv->on('Receive', function($serv, $fd, $from_id, $data) {
            $task_id = $serv->task("Async");
            echo "Dispath AsyncTask: id=$task_id\n";
        });
        $serv->on('Task', function ($serv, $task_id, $from_id, $data) {
            echo "New AsyncTask[id=$task_id]".PHP_EOL;
            $serv->finish("$data -> OK");
        });
        $serv->on('Finish', function ($serv, $task_id, $data) {
            echo "AsyncTask[$task_id] Finish: $data".PHP_EOL;
        });
        $serv->start();
    }
}