<?php
/**
 *
 */
namespace App\Action;

use Framework\Support\Action;


class MainAction extends Action
{
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
}