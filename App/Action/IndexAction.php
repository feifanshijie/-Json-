<?php

/*
|--------------------------------------------------------------------------
| TODO:首页
|--------------------------------------------------------------------------
| @main      TODO:主页
| @explain   TODO:说明
|--------------------------------------------------------------------------
*/

namespace App\Action;

use App\Model\Member;
use Framework\Support\Action;

class IndexAction extends Action
{
    public function main() : string
    {
        return parent::view('test', [
            'title' => '文档',
            'list'  => Member::query()->find([1, 2, 3])
        ]);
    }

    public function explain() : string
    {
        return parent::view('explain', [
            'title' => '说明'
        ]);
    }
}