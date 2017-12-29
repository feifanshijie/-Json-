<?php

/*
|--------------------------------------------------------------------------
| TODO:路由器 v1.0.0
|--------------------------------------------------------------------------
*/

return
[
    ''         => 'GET|IndexAction|main',
    'login'    => 'GET|SignAction |sign',
    'json'     => 'GET|IndexAction|jsonTest',
    'view'     => 'GET|IndexAction|viewTest',
    'main'     => 'GET|IndexAction|viewIndex',
    'register' => 'GET|IndexAction|index_recommend',
    'home'     => 'GET|IndexAction|xmlTest',
];
