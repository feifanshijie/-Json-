<?php
/**
 * User: ming
 * Date: 2017/8/31
 * Time: 上午10:26
 */

namespace App\Action;

use App\Model\Member;
use Framework\Support\Action;

class ExampleAction extends Action
{
    /**
     * used laravel orm Eloquent
     */
    public function db()
    {
        $result = Member::all();
        fw_iterator($result);exit;
    }

    /**
     * custom class as this
     */
    public function custom_class()
    {
        //TODO:工厂创建对象
//        Factory::create('Hello')->test();
//        Factory::show();
//        Factory::create('Hello');
//        //迭代调试
//        fw_iterator(C['name']);
//        $arr = ['code' => 200, 'msg' => 'ok'];
//        fw_http_param();
//        fw_iterator($arr);
    }

    public function html()
    {
        $data['title'] = '测试';
        return $this->view('index', $data);
    }

    //TODO:return view
    public function main()
    {
        $data['list'] = Member::query()->find([1, 2, 3]);
        $data['title'] = '文档';

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