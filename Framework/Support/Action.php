<?php
/**
 * ==================================================================
 * Class Base Action  -- if you want edit action,extent this class --
 * ==================================================================
 * TODO: 基础控制器类  -- 如需修改继承此类 --
 * ==================================================================
 * TODO-model:   获取一个数据模型
 * TODO-view:    加载视图文件
 * TODO-json:    返回JSON
 * ==================================================================
 */

/*
|--------------------------------------------------------------------------
| TODO:基础控制器类 (如需修改继承此类)
|--------------------------------------------------------------------------
| @model     return result
| @view      return view
| @rd        return
|--------------------------------------------------------------------------
*/

namespace Framework\Support;

use Framework\BaseInterface\ReturnInterFace;
use Framework\Help\RedisHelp;

abstract class Action extends Base implements ReturnInterFace
{
    public function model(string $model, string $method)
    {
        return $model::$method();
    }

    /**
     * TODO:判断缓存是否存在
     * @param string $k
     * @param string $type 缓存类型
     * @return mixed
     */
    public function get_cache(string $k = '', string $type = 'redis')
    {
        if($type == 'redis')
        {
            return unserialize(RedisHelp::GetVal(md5($k)));
        }
    }

    /**
     * TODO:判断缓存是否存在
     * @param string $k
     * @param string $v
     * @param int $t
     * @param string $type 缓存类型
     * @return mixed
     */
    public function set_cache($k,$v = '',int $t = 100 ,string $type = 'redis')
    {
        if($type == 'redis')
        {
            return RedisHelp::SetVal(md5($k), serialize($v), $t);
        }
    }

    /**
     * TODO:跳转地址
     * @param string $url  跳转地址
     * @param int    $time 秒
     */
    public function rd(string $url, integer $time)
    {
        header("Location:{$url}");
    }

    public static function api(int $code = 200, string $msg = 'ok', int $count = 0, array $list = [])
    {
        if(!empty($data))
        {
            $data['list'] = $list;
            $data['count'] = $count;
        }

        $return['code'] = $code;
        $return['msg'] = $msg;
        return $return;
    }

    //TODO:成功
    public static function success(int $code = 200)
    {
        return self::json(['msg' => 'success'], $code);
    }

    //TODO:失败
    public static function fail(int $code = 400)
    {
        return self::json(['msg' => 'fail'], $code);
    }
}
