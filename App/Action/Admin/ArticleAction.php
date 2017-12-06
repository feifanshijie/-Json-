<?php
/**
 * ======================================
 * TODO 博文相关
 * ======================================
 */
namespace App\Action\Admin;

use App\Data\Admin\ArticleData;
use Framework\Support\Action;

class ArticleAction extends Action
{
    //TODO:博文列表
    public function list()
    {
        $html['title'] = '博文列表';
        $data['type'] = 1;

        $this->view('Admin/articleList', $data, $html);
    }
}