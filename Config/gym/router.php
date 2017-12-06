<?php
/**
 * ============================================================
 * TODO   : 路由器 [Routing 2017/02/23  V0.1]
 * ============================================================
 */
return
[
    '/'=>
    [
        'method' => 'GET',
        'action' => 'PC\\IndexAction@viewIndex',
    ],
    //TODO:文档首页
    '/index'=>
    [
        'method' => 'GET',
        'action' => 'PC\\IndexAction@viewIndex',
    ],

    //TODO:文档内容
    '/main'=>
    [
        'method' => 'GET',
        'action' => 'PC\\IndexAction@viewIndex',
    ],
    //TODO:前端登录
    '/login'=>
    [
        'method' => 'GET',
        'action' => 'PC\\IndexAction@index_article',
    ],
    //TODO:前端注册
    '/register'=>
    [
        'method' => 'GET',
        'action' => 'PC\\IndexAction@index_recommend',
    ],
    //TODO:个人中心
    '/home'=>
    [
        'method' => 'GET',
        'status' => '',
        'param'  => '',
        'action' => 'PC\\IndexAction@xmlTest',
    ],
    //TODO:
    'json'=>
    [
        'method' => 'GET',
        'status' => 'is_login',
        'param'  => 'Example@index',
        'action' => 'Example@Action',
    ]
];
