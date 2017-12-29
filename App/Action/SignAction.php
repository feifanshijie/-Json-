<?php
/**
 * 文档首页
 */
namespace App\Action;

use App\Model\Member;
use Framework\Support\Action;

class SignAction extends Action
{
    //TODO:return view
    public function main()
    {
        dd(env('developer.name'));
        $data['list'] = Member::query()->find([1, 2, 3]);
        $data['title'] = '文档';

        return parent::view('test', $data);
    }
}