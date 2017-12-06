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

    }

    public function html()
    {
        $data['title'] = '测试';

        return $this->view('index',$data);
    }
}