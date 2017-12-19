<?php
/*
|--------------------------------------------------------------------------
| TODO:路由器 v1.0.0
|--------------------------------------------------------------------------
*/
return
[
    //TODO:文档
    ''         => ['method' => 'GET', 'action' => 'IndexAction@index'],
    'xml'      => ['method' => 'GET', 'action' => 'IndexAction@xmlTest'],
    'json'     => ['method' => 'GET', 'action' => 'IndexAction@jsonTest'],
    'view'     => ['method' => 'GET', 'action' => 'IndexAction@viewTest'],
    'main'     => ['method' => 'GET', 'action' => 'IndexAction@viewIndex'],
    'login'    => ['method' => 'GET', 'action' => 'IndexAction@index_article'],
    'register' => ['method' => 'GET', 'action' => 'IndexAction@index_recommend'],
    'home'     => ['method' => 'GET', 'action' => 'IndexAction@xmlTest'],
];
