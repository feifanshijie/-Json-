<?php
/**
 * =================================================
 * TODO:redisAsynch by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class AsynchRedisHelp
{
    public function __construct()
    {
        $redis = new Swoole\Redis;
        $redis->connect('127.0.0.1', 6379, function ($redis, $result) {
            $redis->set('test_key', 'value', function ($redis, $result) {
                $redis->get('test_key', function ($redis, $result) {
                    var_dump($result);
                });
            });
        });

        $cli = new Swoole\Http\Client('127.0.0.1', 80);
        $cli->setHeaders(array('User-Agent' => 'swoole-http-client'));
        $cli->setCookies(array('test' => 'value'));

        $cli->post('/dump.php', array("test" => 'abc'), function ($cli) {
            var_dump($cli->body);
            $cli->get('/index.php', function ($cli) {
                var_dump($cli->cookies);
                var_dump($cli->headers);
            });
        });
    }
}