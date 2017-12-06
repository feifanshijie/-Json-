<?php

/**
 * ============================================================
 * TODO: 数据库配置 [Return Memcached Config 2017/2/8 V0.1]
 * ============================================================
 * 数据库设置多库切换
 * ============================================================
 */
return [
//    'blog' => [
//        'db_host' => 'qdm169302374.my3w.com',
//        'db_user' => 'qdm169302374',
//        'db_pass' => 'feifanshijie',
//        'db_port' => 3306,
//        'db_name' => 'qdm169302374_db',
//        'db_pfix' => ''
//    ]
//    'blog' => [
//        'db_host' => 'lab.hzhui.com',
//        'db_user' => 'lab_hzhui',
//        'db_pass' => 'feifanshijie',
//        'db_port' => 3306,
//        'db_name' => 'lab_hzhui',
//        'db_pfix' => 'hzh_'
//    ]
    'blog' => [
        'driver'    => 'mysql',
        'host'      => 'lab.hzhui.com',
        'database'  => 'lab_hzhui',
        'username'  => 'lab_hzhui',
        'password'  => 'Tobetcmno1',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'hzh_',
    ]
];