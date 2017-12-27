<?php
/**
 * 文档首页
 */
namespace App\Action;

use App\Model\Member;
use Framework\Support\Action;

class IndexAction extends Action
{
    //TODO:return view
    public function index()
    {
        $data['list'] = Member::query()->find([1, 2, 3]);
        $data['title'] = '测试';
        $data['test'] = 'hello world';

        return $this->view('test', $data);
    }

    //TODO:return json
    public function xmlTest() : string
    {
        return self::xml(['code' => 222, 'msg' => 'ok']);
    }

    //TODO:return html
    public function jsonTest() : string
    {
        return parent::json(['code' => 222, 'msg' => 'ok']);
    }

    public function viewTest()
    {
        $data['title'] = '哈哈';

        return parent::view('test',$data);
    }

}