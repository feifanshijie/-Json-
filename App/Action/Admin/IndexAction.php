<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23 0023
 * Time: 下午 9:29
 */
namespace App\Action\Admin;

use Framework\Support\Action;

class IndexAction extends Action
{
    public function __construct()
    {

    }

    public function index()
    {
        $data =[];
        $this->view('Admin/index', $data, ['title'=>'博客管理首页','nav' => 'index']);
    }
}