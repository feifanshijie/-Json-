<?php

/*
|--------------------------------------------------------------------------
| TODO:首页
|--------------------------------------------------------------------------
| @main      return view
| @explain   return view
|--------------------------------------------------------------------------
*/

namespace App\Action;

use App\Model\Member;
use Framework\Support\Action;

class IndexAction extends Action
{
    public function main() : string
    {
        $data['list'] = Member::query()->find([1, 2, 3]);
        $data['title'] = '文档';
        return parent::view('test', $data);
    }

    public function explain() : string
    {
        $data['detail'] = [];
        $data['title'] = '说明';
        return parent::view('explain', $data);
    }
}