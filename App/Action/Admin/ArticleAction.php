<?php
/**
 * TODO 博文相关
 */
namespace App\Action\Admin;

use Framework\Support\Action;

class ArticleAction extends Action
{
    //TODO:博文列表
    public function list()
    {
        $data['title'] = '博文列表';
        $data['type'] = 1;

        return $this->view('Admin/articleList', $data);
    }


}