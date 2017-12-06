<?php
/**
 * ========================================
 * TODO:状态验证
 * ========================================
 */

namespace App\Status;

use Framework\Support\Status;

class LoginStatus extends Status
{
    /**
     * if return true  check is passed
     * if return false next run message
     */
    public function handle()
    {
        //TODO ......
        return 1;
        return false;
    }

    /**
     * if status() return false fail() return this message
     * @return array
     */
    public function message()
    {
        //TODO:.......
        return ['code' => 200, 'msg' => 'please login first'];
    }
}