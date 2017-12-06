<?php
/**
 * =================================================
 * TODO:RedisHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class RedisHelp
{
    public static $_link;
    private function __construct(){}
    private function __clone(){}

    /**
     * ====================================
     * TODO:获取一个连接对象
     * ====================================
     * @return object
     * ====================================
     */
    public static function Connect()
    {
        if(self::$_link === null)
        {
            self::$_link = new \Redis();
            self::$_link->connect(C_REDIS['host'], C_REDIS['port']);
        }
        return self::$_link;
    }

    /**
     * ========================================================================
     * TODO:设置新的到期时间
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_auth(string $password = null)
    {
        return self::Connect()->auth($password);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_getOption(string $password = null)
    {
        return self::Connect()->getOption(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_flushAll(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_flushDb(string $password = null)
    {
        return self::Connect()->flushDb(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_bgRewriteAOF()
    {
        return self::Connect()->bgRewriteAOF();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_bgSave()
    {
        return self::Connect()->bgSave();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_config()
    {
        return self::Connect()->config();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_dbSize()
    {
        return self::Connect()->dbSize();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_info()
    {
        return self::Connect()->info();
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_lastSave()
    {
        return self::Connect()->lastSave();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_resetStat()
    {
        return self::Connect()->resetStat();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_save()
    {
        return self::Connect()->save();
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_slaveOf(string $password = null)
    {
        return self::Connect()->slaveOf('10.0.1.7', 6379);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_time()
    {
        return self::Connect()->time();
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_slowLog()
    {
        return self::Connect()->slowLog();
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_get(string $key = null)
    {
        return self::Connect()->get($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  string  $value
     * @param  array  $item
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_set(string $key = null, string $value = null, array $item)
    {
        return self::Connect()->set($key, $value, $item);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_setEx(string $password = null)
    {
        return self::Connect()->setEx(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_pSetEx(string $password = null)
    {
        return self::Connect()->pSetEx(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  string  $value
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_setNx(string $key = null, string $value = null)
    {
        return self::Connect()->flushAll($key, $value);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  mixed   $key
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_delete(mixed $key = null)
    {
        return self::Connect()->delete($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_exists(string $key = null)
    {
        return self::Connect()->exists($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_incr(string $key = null)
    {
        return self::Connect()->incr($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $value
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_incrBy(string $key = null, int $value = 0)
    {
        return self::Connect()->incrBy($key, $value);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  float   $value
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_incrByFloat(string $key = null, float $value = null)
    {
        return self::Connect()->incrByFloat($key, $value);
    }


    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_decr(string $key = null)
    {
        return self::Connect()->decr($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $value
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_decrBy(string $key = null, int $value = null)
    {
        return self::Connect()->decrBy($key, $value);
    }
    /**
     * ========================================================================
     * TODO:获取多个key
     * ------------------------------------------------------------------------
     * @param  array  $keys
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function R_mGet(array $keys = null)
    {
        return self::Connect()->mGet($keys);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  string  $value
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function R_getSet(string $key = null, string $value)
    {
        return self::Connect()->getSet($key, $value);
    }


    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_randomKey()
    {
        return self::Connect()->randomKey();
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $server_key
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_move(string $key = null, int $server_key)
    {
        return self::Connect()->flushAll($key, $server_key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $srckey
     * @param  string  $dstkey
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_rename(string $srckey = null, string $dstkey = null)
    {
        return self::Connect()->flushAll($srckey, $dstkey);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $expiration
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_setTimeout(string $key = null, int $expiration = null)
    {
        return self::Connect()->setTimeout($key, $expiration);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $time
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_expireAt(string $key = null, int $time = null)
    {
        return self::Connect()->flushAll($key, $time);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_keys(string $key = null)
    {
        return self::Connect()->keys($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_scan(string $password = null)
    {
        return self::Connect()->scan(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function R_object(string $key = null)
    {
        return self::Connect()->object($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return string
     * ------------------------------------------------------------------------
     */
    public static function R_type(string $key = null)
    {
        return self::Connect()->type($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  string  $value
     * @return integer
     * ------------------------------------------------------------------------
     */
    public static function R_append(string $key = null, string $value = null)
    {
        return self::Connect()->append($key, $value);
    }
    /**
     * ========================================================================
     * TODO:获取一个字符串
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $start
     * @param  int     $end
     * @return string
     * ------------------------------------------------------------------------
     */
    public static function R_getRange(string $key = null, int $start = null, int $end = null)
    {
        return self::Connect()->getRange($key, $start, $end);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  int     $offset
     * @param  string  $value
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_setRange(string $key = null, int $offset = 0, string $value = null)
    {
        return self::Connect()->setRange($key, $offset, $value);
    }

    /**
     * ========================================================================
     * TODO:获取key长度
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return integer
     * ------------------------------------------------------------------------
     */
    public static function R_strlen(string $key = null)
    {
        return self::Connect()->strlen($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_getBit(string $key = null)
    {
        return self::Connect()->getBit($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_setBit(string $password = null)
    {
        return self::Connect()->setBit(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_sAdd(string $password = null)
    {
        return self::Connect()->sAdd(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function R_ttl(string $key = null)
    {
        return self::Connect()->ttl($key);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  array  $item
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_mSet(array $item = null)
    {
        return self::Connect()->mSet($item);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_dump(string $key = null)
    {
        return self::Connect()->dump($key);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_restore(string $password = null)
    {
        return self::Connect()->restore(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_migrate(string $password = null)
    {
        return self::Connect()->migrate(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hSet(string $password = null)
    {
        return self::Connect()->hSet(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hSetNx(string $password = null)
    {
        return self::Connect()->hSetNx(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hLen(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hKeys(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }

    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hGetAll(string $password = null)
    {
        return self::Connect()->hGetAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hExists(string $password = null)
    {
        return self::Connect()->hExists(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hIncrBy(string $password = null)
    {
        return self::Connect()->hIncrBy(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hIncrByFloat(string $password = null)
    {
        return self::Connect()->hIncrByFloat(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hMSet(string $password = null)
    {
        return self::Connect()->hMSet(Redis::OPT_SERIALIZER);
    }/**
 * ========================================================================
 * TODO:获取
 * ------------------------------------------------------------------------
 * @param  string  $password
 * @return ???
 * ------------------------------------------------------------------------
 */
    public static function R_hMGet(string $password = null)
    {
        return self::Connect()->hMGet(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hScan(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hKeys12(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hKe2ys(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_hKe3ys(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_4hKeys(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    /**
     * ========================================================================
     * TODO:获取
     * ------------------------------------------------------------------------
     * @param  string  $password
     * @return ???
     * ------------------------------------------------------------------------
     */
    public static function R_h5Keys(string $password = null)
    {
        return self::Connect()->flushAll(Redis::OPT_SERIALIZER);
    }
    
    /**
     * ====================================================
     * TODO:根据一个KEY获取一个值   get a value
     * ====================================================
     * @param string  $k key
     * @return mixed
     * ====================================================
     */
    public static function GetVal($k)
    {
        return self::Connect()->get($k);
    }

    /**
     * ====================================================
     * TODO:设置key和value      set a value
     * ====================================================
     * @param string  $k key
     * @param string  $v value
     * @param integer $t time
     * @return boolean
     * ====================================================
     */
    public static function SetVal(string $k, string $v, $t = C_REDIS['life'])
    {
        return self::Connect()->set($k, $v, $t);
    }

    /**
     * ====================================================
     * TODO:删除指定的键      delete a key and value
     * ====================================================
     * @param string  $k key
     * @return boolean
     * ====================================================
     */
    public static function DelVal(string $k)
    {
        return self::Connect()->delete($k);
    }

    /**
     * ====================================================
     * TODO:如果不存在该键，设置键值 存在不覆盖
     * ====================================================
     * @param string  $k key
     * @param string  $v value
     * @return boolean
     * ====================================================
     */
    public static function ExitSet($k, $v)
    {
        return self::Connect()->setnx($k, $v);
    }

    /**
     * ====================================================
     * TODO:验证指定的键是否存在
     * ====================================================
     * @param string  $k key
     * @return boolean
     * ====================================================
     */
    public static function ExitKey($k)
    {
        return self::Connect()->exists($k);
    }

    /**
     * ====================================================
     * TODO:自增一个键的值+1
     * ====================================================
     * @param string  $k key
     * @return boolean
     * ====================================================
     */
    public static function SelfIncr($k)
    {
        return self::Connect()->incr($k);
    }

    /**
     * ====================================================
     * TODO:自减一个键的值-1
     * ====================================================
     * @param string  $k key
     * @return boolean
     * ====================================================
     */
    public static function SelfDecr($k)
    {
        return self::Connect()->decr($k);
    }

    /**
     * ====================================================
     * TODO:取得所有指定键的值。如果一个或多个键不存在，该数组中该键的值为假
     * ====================================================
     * @param string  $k key
     * @return boolean
     * ====================================================
     */
    public static function GetMany(array $key = [])
    {
        return self::Connect()->getMultiple($key);
    }

    /**
     * ====================================
     * TODO:由列表头部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
     * ====================================
     * @param string  $k key
     * @param string  $v value
     * @return boolean
     * ====================================
     */
    public static function LeftPush($k, $v)
    {
        return self::Connect()->lpush($k, $v);
    }

    /**
     * ====================================
     * TODO:由列表头部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
     * ====================================
     * @param string  $k key
     * @param string  $v value
     * @return boolean
     * ====================================
     */
    public static function RightPush($k, $v)
    {
        return self::Connect()->rpush($k, $v);
    }

    /**
     * ====================================
     * TODO:返回和移除列表的第一个元素
     * ====================================
     * @param string  $k key
     * @return boolean
     * ====================================
     */
    public static function LeftPop($k)
    {
        return self::Connect()->lpop($k);
    }


    /**
     * ====================================
     * TODO:GET LIST
     * ====================================
     * @param string  $k key
     * @param string  $s start index
     * @param integer $e end   index
     * @return boolean
     * ====================================
     */
    public static function GetList($k, $s, $e)
    {
        return self::Connect()->lrange($k, $s, $e);
    }

    /**
     * ====================================
     * TODO:返回指定键存储在列表中指定的元素。 0第一个元素，1第二个… -1最后一个元素，-2的倒数第二…错误的索引或键不指向列表则返回FALSE。
     * ====================================
     * @param string  $k key
     * @param string  $s start index
     * @param integer $e end   index
     * @return boolean
     * ====================================
     */
    public static function ListGet($k, $s)
    {
        return self::Connect()->lget($k, $s);
    }

    /**
     * ====================================
     * TODO:为列表指定的索引赋新的值,若不存在该索引返回false.
     * ====================================
     * @param string  $k key
     * @param string  $s start index
     * @param integer $e end   index
     * @return boolean
     * ====================================
     */
    public static function ListSet($k, $s, $v)
    {
        return self::Connect()->lget($k, $s, $v);
    }
}