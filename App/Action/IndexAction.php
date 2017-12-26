<?php
/**
 * Class IndexAction Date: 2017/2/23 0023 Time: 下午 9:29
 */
namespace App\Action;

use App\Model\Album;
use App\Model\Member;
use Framework\Drive\Factory;
use Framework\Support\Action;
use Illuminate\Support\Facades\DB;


class IndexAction extends Action
{
    //TODO:return xml
    public function index()
    {
        //TODO:工厂创建对象
        Factory::create('Hello')->test();
//        Factory::show();
//        Factory::create('Hello');
//        //迭代调试
//        fw_iterator(C['name']);
//        $arr = ['code' => 200, 'msg' => 'ok'];
//        fw_http_param();
//        fw_iterator($arr);

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