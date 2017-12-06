<?php
/**
 * Class IndexAction Date: 2017/2/23 0023 Time: 下午 9:29
 */
namespace App\Action;

use App\Model\Album;
use Framework\Support\Action;
use Illuminate\Support\Facades\DB;


class IndexAction extends Action
{
    //TODO:return xml
    public function index()
    {
//        //TODO:工厂创建对象
////        Factory::create('Hello')->test();
//        Factory::show();
//        Factory::create('Hello');
//        //断掉迭代调试
////        fw_iterator(C['name']);
//        $arr = ['code' => 200, 'msg' => 'ok'];
//        fw_http_param();
//        fw_iterator($arr);

//        $res = Member::content()->Join('')->Join('');

//        $res = Member::content()
//            ->select('id,name,time')
//            ->where(['id' => 1,'name' => 'xiaoxming']);

//            ->order('id', 'DESC')
//            ->group('name')
//            ->show_sql();
//        $res = Member::content()->select()->where()->order();\

//        $results = Manager::select('select * from test where id = ?', array(1));
        $data['title'] = '测试';
        $data['test'] = 'hello world';

        return $this->view('admin/index2', $data);
//        $results = Member::find([1, 2, 3]);;
//        var_dump($results);

//        var_dump(CONFIG('app')['name']);exit;
        //读取配置文件
//        echo CONFIG('app')['name'];

//        $this->xml(['code' => 400, 'msg' => 'NO'], 405);
    }

    //TODO:return json
    public function xmlTest()
    {
        self::json(['code' => 222, 'msg' => 'ok']);
    }

    //TODO:return html
    public function test2()
    {
        parent::json(['code' => 222, 'msg' => 'ok']);
    }

    public function test3()
    {
        $data = Album::all();

//        return ['code' => 200, 'msg' => 'ok', 'data' => $data];
    }

}