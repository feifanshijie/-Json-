<?php
class MySQLPool
{
    private $_server;

    private $pdo;

    public function __construct() {
        $this->_server = new swoole_server("0.0.0.0", 9501);
        $this->_server->set([
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 3,
            'debug_mode'=> 1 ,
            'task_worker_num' => 8
        ]);
        $this->_server->on('WorkerStart', [$this, 'onWorkerStart']);
        $this->_server->on('Connect', [$this, 'onConnect']);
        $this->_server->on('Receive', [$this, 'onReceive']);
        $this->_server->on('Close', [$this, 'onClose']);
        // bind callback
        $this->_server->on('Task', [$this, 'onTask']);
        $this->_server->on('Finish', [$this, 'onFinish']);
        $this->_server->start();
    }
    public function onWorkerStart( $serv , $worker_id) {
        echo "onWorkerStart\n";
        // 判定是否为Task Worker进程
        if( $worker_id >= $serv->setting['worker_num'] ) {
            $this->pdo = new PDO(
                "mysql:host=www.9977.link;port=3306;dbname=finx_blog",
                "root",
                "feifanshijie",
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8';",
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => true
                )
            );
        }
    }
    public function onConnect( $serv, $fd, $from_id ) {
        echo "Client {$fd} connect\n";
    }
    public function onReceive( swoole_server $serv, $fd, $from_id, $data ) {
        $sql = ['sql'=>'Insert into Test values( pid = ?, name = ?)','param'=>[0 , "'name'"],'fd'=>$fd];
        $serv->task(json_encode($sql));
    }
    public function onClose( $serv, $fd, $from_id ) {
        echo "Client {$fd} close connection\n";
    }
    public function onTask($serv, $task_id, $from_id, $data) {
        try{
            $sql = json_decode($data,true);

            $statement = $this->pdo->prepare($sql['sql']);
            $statement->execute($sql['param']);
            $serv->send( $sql['fd'],"Insert");
            return true;
        } catch( PDOException $e ) {
            var_dump( $e );
            return false;
        }
    }
    public function onFinish($serv,$task_id, $data) {
    }
}
new MySQLPool();