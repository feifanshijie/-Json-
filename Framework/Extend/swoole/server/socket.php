<?php
$table = new swoole_table(1024);
$table->column('fd', swoole_table::TYPE_INT);
$table->create();
$socket = new swoole_websocket_server('0.0.0.0',9502);
$socket->table = $table;

//连接
$socket->on('open', function ($socket,$request){
    $socket->table->set($request->fd, array('fd' => $request->fd));//获取客户端id插入table
    $socket->push($request->fd,'ok');
});
//接收
$socket->on('message', function($socket,$request){
    $get = json_decode($request->data);
    var_dump($get);
    switch ($get->type){
        case 'talk':
            //消息广播给所有客户端
            foreach ($socket->table as $u) {
                $socket->push($u['fd'], json_encode(array('type'=>'talk','name' => $get->name,'message' => $get->message,'time' => time())));
            }
            break;
        case 'login':
            $socket->push($request->fd, json_encode(array('type'=>'login','res' => true,'message' => '成功','time' => time())));
            break;
        case 'register':
            echo '2';
            break;
        default:
            echo 1;
    }


});
$socket->on('close',function ($socket,$fd){
    echo '用户：'.$fd.'退出';
});
echo '---------------------------------------------';
$socket->start();