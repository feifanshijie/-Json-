<?php
/**
 * check status intercept
 */
namespace Framework\Support;


use Framework\BaseInterface\StatusInterface;

abstract class Status implements StatusInterface
{
    public function status()
    {
        //TODO:.......
        return true;
    }
//
//    /**
//     * if status() return false fail() return this message
//     * @return array
//     */
//    public function message()
//    {
//        //TODO:.......
//        return ['code'=>200,'msg'=>'please log on first'];
//    }
//
//    /**
//     * if status() return false application is run this function and return message()
//     * @return array
//     */
//    public function fail()
//    {
//        return ['msg' => 'status error'];
//    }
}