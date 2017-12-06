<?php
/**
 * websocket
 */
class WebSocket
{
    private $_ws;

    public function __construct()
    {
        define('R',require '../App/Router.php');

        $table = new \swoole_table(1024);
        $table->column('id', \swoole_table::TYPE_INT);
        $table->column('ip', \swoole_table::TYPE_STRING,20);
        $table->column('time', \swoole_table::TYPE_STRING,20);
        $table->create();
        $this->_ws = new \Swoole\Websocket\Server("0.0.0.0", 9502);
        $this->_ws->table = $table;
        echo "初始化成功\n";
    }

    //TODO:
    public function Run()
    {
//        $this->_ws->set(array(
//            'worker_num'      => 8,
//            'daemonize'       => false,
//            'max_request'     => 10000,
//            'dispatch_mode'   => 2,
//            'debug_mode'      => 1,
//            'task_worker_num' => 8
//        ));
        $this->_ws->on('Open', function(swoole_websocket_server $ws, $request) {
            $this->OnOpen($ws, $request);
        });

        $this->_ws->on('Message', function(swoole_websocket_server $ws, $request) {
            $this->OnMessage($ws, $request);
        });
//        $this->_ws->on('Task',[$this, 'OnTask']);
//        $this->_ws->on('Finish',[$this, 'OnFinish']);
        $this->_ws->on('Close', function(swoole_websocket_server $ws, $fd) {
            $this->OnClose($ws, $fd);
        });
        $this->_ws->start();
    }
    public function OnOpen($ws, $request)
    {
        $data = [
            'id'   => $request->fd,
            'ip'   => $request->server['remote_addr'],
            'time' => $request->server['request_time']
        ];
        $ws->table->set($request->fd, $data);
    }

    public function OnMessage($ws, $request)
    {
        $data = json_decode($request->data, true);
        switch ($data['code'])
        {
            case 100:
                $this->PushOne($request->fd,json_encode(['code'=>100,'fd'=>$request->fd]));

                $user_list = [];
                foreach ($this->_ws->table as $v) {
                    array_push($user_list, $v['id']);
                }
                if(!empty($user_list))
                {
                    var_dump($user_list);
                    $this->PushList(json_encode(['code' => 200,'data'=>$user_list]), 0);
                }
                break;
            case 20001:
                $this->PushList(json_encode(['code' => 20001,'fd'=>$request->fd]), $request->fd);
                break;
            case 20002:
                $this->PushList(json_encode(['code' => 20002,'fd'=>$request->fd]), $request->fd);
                break;
            case 20003:
                $this->PushList(json_encode(['code' => 20003,'fd'=>$request->fd]), $request->fd);
                break;
            case 20004:
                $this->PushList(json_encode(['code' => 20004,'fd'=>$request->fd]), $request->fd);
                break;
            case 30001:
                $this->PushList(json_encode(['code' => 30001,'fd'=>$request->fd]), $request->fd);
                break;
            case 30002:
                $this->PushList(json_encode(['code' => 30002,'fd'=>$request->fd]), $request->fd);
                break;
            case 30003:
                $this->PushList(json_encode(['code' => 30003,'fd'=>$request->fd]), $request->fd);
                break;
            case 30004:
                $this->PushList(json_encode(['code' => 30004,'fd'=>$request->fd]), $request->fd);
                break;
        }
//        $this->PushOne($request->fd,json_encode(['code' => 200]));
//        $this->_ws->task('asdadasdasd');
    }
    public function OnTask(swoole_server $serv, $task_id, $data)
    {
        var_dump($data);
//        $this->PushOne();
//        if(array_key_exists((string)$data['code'], R)){
//            spl_autoload_register(function ($class) {
//                echo "加载\n{$class}";
//                require_once str_replace('\\','/', '../'.$class . '.php');
//            });
//            $code = $data['code'];
//            $class = '\App\Server'.R[$code][0];
//            $func = R[$code][1];
//            $run = new $class();
//            $res = $run->$func();
////            $this->PushOne($request->fd, $res);
//        }else{
////            $this->PushOne($request->fd,'there is noting');
//        }
    }

    public function OnFinish($serv,$task_id, $data)
    {
        echo '完成';
        var_dump($data);
    }
    public function OnClose($ws,$fd)
    {
        $ws->table->del($fd);
        $this->PushList(json_encode(['code' => 300,'fd'=>$fd]), $fd);
    }

    public function PushOne($fd, $data)
    {
        $this->_ws->push($fd, $data);
    }

    public function PushList($json,$fd)
    {
        foreach ($this->_ws->table as $v) {
            if($fd != $v['id'])
            {
                $this->_ws->push($v['id'], $json);
            }
        }
    }
    public function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}
$ws = new WebSocket();
$ws->Run();

