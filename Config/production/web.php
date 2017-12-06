<?php
/**
 * ============================================================================
 * TODO: website base config 网站基础配置 [Return Web Config 2017/2/8 V0.1]
 * ============================================================================
 * debug            turn on/off debug             是否开启调试模式
 * name             website name                  网站名称
 * webUrl           website url                   网站url
 * action           Controller name               控制器名称
 * view             turn on/off view              是否开启视图模式(此模式会加载视图相关方法)
 * curl             Curl                          Curl模式(中间件模式)
 * memcached        turn on/off memcached         是否开启memcached
 * redis            turn on/off redis             是否开启redis
 * mongodb          turn on/off mongodb           是否开启mongodb
 * session          turn on/off session           是否开启session
 * cookie           turn on/off  cookie           是否开启cookie
 * token
 * crypt
 * accessLog        turn on/off  access log       是否开启记录访问日志
 * ============================================================================
 */

return [
    'debug'         => true,
    'webName'       => '9977',
    'webUrl'        => 'http://192.168.99.100:8080',
    'resUrl'        => 'http://192.168.99.100:8081',
    'action'        => 'Action',
    'status'        => 'Status',
    'param'        => 'Param',
    'view'          => 1,
    'curl'          => 1,
    'memcached'     => 1,
    'redis'         => 1,
    'mongodb'       => 0,
    'session'       => 1,
    'cookie'        => 1,
    'token'         => '',
    'crypt'         => '',
    'accessLog'     => 1,
];
