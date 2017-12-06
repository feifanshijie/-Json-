<?php
/**
 * Class IndexAction Date: 2017/2/23 00:23
 */
namespace App\Action\PC;

use App\Model\Album;
use App\Model\Blog;
use Framework\Drive\Factory;
use Framework\Support\Action;

class IndexAction extends Action
{
    //TODO:首页
    public function viewIndex()
    {
        $data['title'] = '测试DEMO';
//        $data['list']  = Album::all();

//        Factory::create('Hello')->test(11213123);
//        Factory::path('Hello')->test();
        echo 111;
        return $this->view('index', $data);
    }

    //TODO:首页接口
    public function index_article()
    {
        $data = Blog::all();

        return self::json($data);
    }

    //TODO:首页推荐
    public function index_recommend()
    {
        $data=
        [
            'code'    => 200,
            'status'  => 0,
            'message' => 'ok',
            'data'    =>
            [
                'list' => Blog::all(),
                'has_next' => 1
            ]
        ];

        return self::json($data);
    }

    public function viewUi()
    {
        $data['title'] = 'UI预览';

        return $this->view('PC/index', $data);
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

}