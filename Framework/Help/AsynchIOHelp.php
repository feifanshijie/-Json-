<?php
/**
 * =================================================
 * TODO:IOAsynch by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class AsynchIOHelp
{
    public function __construct()
    {
        $fp = stream_socket_client("tcp://127.0.0.1:80", $code, $msg, 3);
        $http_request = "GET /index.html HTTP/1.1\r\n\r\n";
        fwrite($fp, $http_request);
        Swoole\Event::add($fp, function($fp){
            echo fread($fp, 8192);
            swoole_event_del($fp);
            fclose($fp);
        });
        Swoole\Timer::after(2000, function() {
            echo "2000ms timeout\n";
        });
        Swoole\Timer::tick(1000, function() {
            echo "1000ms interval\n";
        });
    }
}
