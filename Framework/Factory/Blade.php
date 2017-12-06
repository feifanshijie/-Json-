<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2017/9/1
 * Time: 上午11:34
 */
namespace Framework\Factory;

use duncan3dc\Laravel\BladeInstance;

class Blade extends BladeInstance
{
    public function __construct()
    {
        $path = 'App/Front/view';
        $cache = 'App/Front/cache';
        parent::__construct($path, $cache);
    }

    public function render($view, array $param = [])
    {
        echo parent::render($view, $param);
        exit;
    }
}