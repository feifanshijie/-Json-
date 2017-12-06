<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23 0023
 * Time: 下午 9:29
 */
namespace App\Action\Admin;

use Framework\Support\Action;

class LoginAction extends Action
{
    public function __construct()
    {

    }

    public function login()
    {
        $data['title'] = '登录';
        $this->view('', $data);
    }
}