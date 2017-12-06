<?php
/**
 * =================================================
 * TODO:MemcachedHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

use Memcached;
use FunnyPHP\System\BaseInterface\CacheInterface;

class MemcachedHelp extends Memcached implements CacheInterface
{
    private static $_link;

    /**
     * ========================================================================
     * TODO:获取一个memcached连接对象
     * ------------------------------------------------------------------------
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function Connect()
    {
        if(self::$_link === null)
        {
            self::$_link = new Memcached();
            self::$_link->addServer('192.168.99.100',11211);
            //配置存储不压缩，压缩value不利于递增递减
            self::$_link->setOption(Memcached::OPT_COMPRESSION, false);
            self::$_link->setOption(Memcached::OPT_LIBKETAMA_COMPATIBLE, true);
            //添加多台服务器分布式
            self::$_link->addServers([
                ['192.168.99.100', 11311, 20],
                ['192.168.99.100', 11411, 30]
            ]);
        }
        return self::$_link;
    }

    /**
     * ========================================================================
     * TODO:向一个新的key下面增加一个元素
     * 与set()类似，但是如果 key已经在服务端存在，此操作会失败
     * ------------------------------------------------------------------------
     * @param   string   $key
     * @param   mixed    $value
     * @param   int      $expiration 到期时间
     * @return  boolean
     * ------------------------------------------------------------------------
     */
    public static function M_add(string $key = '', mixed $value, int $expiration = 0)
    {
        return self::Connect()->add($key, $value, $expiration);
    }

    /**
     * ========================================================================
     * TODO: 在指定服务器上的一个新的key下增加一个元素
     * ------------------------------------------------------------------------
     * @param  string   $server
     * @param  string   $key
     * @param  mixed    $value
     * @param  integer  $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_addByKey(string $server = '', string $key = '', $value = 0, int $expiration = 0)
    {
        return self::Connect()->addByKey($server, $key, $value, $expiration);
    }

    public static function M_addServer(){}

    public static function M_addServers(){}

    /**
     * ========================================================================
     * TODO:向已存在元素后追加数据
     * ------------------------------------------------------------------------
     * Note:
     * 如果Memcached::OPT_COMPRESSION常量开启，这个操作会失败，并引发一个警告，
     * 因为向压缩数据后追加数据可能会导致解压不了。
     * ------------------------------------------------------------------------
     * @param string   $key
     * @param string   $value
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_append(string $key = '', string $value = '')
    {
        return self::Connect()->append($key, $value);
    }

    /**
     * ========================================================================
     * TODO:向指定服务器上已存在元素后追加数据
     * ====================================
     * @param  string  $server
     * @param  string  $key
     * @param  string  $value
     * @return object
     * ====================================
     */
    public static function M_appendByKey(string $server = '',string $key = '', string $value = '')
    {
        return self::Connect()->appendByKey($server, $key, $value);
    }

    /**
     * ========================================================================
     * TODO:比较并交换值*
     * ------------------------------------------------------------------------
     * @param  float    $cas_token
     * @param  string   $key
     * @param  mixed    $value
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_cas(float $cas_token = null, string $key, mixed $value, int $expiration = 0)
    {
        return self::Connect()->M_cas($cas_token, $key, $value, $expiration);
    }

    /**
     * ========================================================================
     * TODO:在指定服务器上比较并交换值*
     * ------------------------------------------------------------------------
     * @param  float    $cas_token
     * @param  string   $server_key
     * @param  string   $key
     * @param  mixed    $value
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_casByKey(float $cas_token, string $server_key = '',string $key, mixed $value)
    {
        return self::Connect()->casByKey($cas_token, $server_key, $key, $value);
    }

    /**
     * ========================================================================
     * TODO:减小数值元素的值
     * NOTE:减小一个数值元素的值，减小多少由参数offset决定如果元素的值不是数值，以0值
     * 对待。如果减小后的值小于0,则新的值被设置为0.如果元素不存在
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  int      $offset
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_decrement(string $key = null, int $offset = 1)
    {
        return self::Connect()->decrement($key, $offset);
    }

    /**
     * ========================================================================
     * TODO:在指定服务器上减小数值元素的值*
     * NOTE:同上
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  int      $offset
     * @param  int      $initial_value
     * @param  int      $expiry
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_decrementByKey(string $server_key = null, string $key = null, int $offset = 1,
                                            int $initial_value = 0, int $expiry = 0)
    {
        return self::Connect()->decrementByKey($server_key, $key, $offset, $initial_value, $expiry);
    }

    /**
     * ========================================================================
     * TODO:删除一个元素
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  int      $time
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_delete(string $key = '', int $time = 0)
    {
        return self::Connect()->delete($key, $time);
    }

    /**
     * ========================================================================
     * TODO:从指定的服务器删除一个元素
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  int      $time
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_deleteByKey(string $server_key, string $key = null, int $time = 0)
    {
        return self::Connect()->deleteByKey($server_key, $key, $time);
    }

    /**
     * ========================================================================
     * TODO:删除多个键
     * NOTE:memcached >= 2.0.0
     * ------------------------------------------------------------------------
     * @param  array    $key
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_deleteMulti(array $key = null, int $expiration = 0)
    {
        return self::Connect()->deleteMulti($key, $expiration);
    }

    /**
     * ========================================================================
     * TODO:抓取下一个结果
     * ------------------------------------------------------------------------
     * @return
     * ------------------------------------------------------------------------
     */
    public static function M_fetch()
    {
        return self::Connect()->fetch();
    }

    /**
     * ========================================================================
     * TODO:抓取所有剩余的结果
     * ------------------------------------------------------------------------
     * @return
     * ------------------------------------------------------------------------
     */
    public static function M_fetchAll()
    {
        return self::Connect()->fetchAll();
    }

    /**
     * ========================================================================
     * TODO:$delay秒后作废缓存中的所有元素
     * ------------------------------------------------------------------------
     * @param  int     $delay
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_flush(int $delay = 0)
    {
        return self::Connect()->flush($delay);
    }

    /**
     * ========================================================================
     * TODO:检索一个元素
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  callable   $cache_cb
     * @param  float   $cas_token
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_get(string $key = null, callback $cache_cb = null, float $cas_token = null)
    {
        return self::Connect()->get($key, $cache_cb, $cas_token);
    }

    /**
     * ========================================================================
     * TODO:获取全部key
     * ------------------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function M_getAllKeys()
    {
        return self::Connect()->getAllKeys();
    }

    /**
     * ========================================================================
     * TODO:从特定的服务器检索元素
     * ------------------------------------------------------------------------
     * @param  string    $server_key
     * @param  string    $key
     * @param  callable  $cache_cb
     * @param  float     $cas_token
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function M_getByKey(string $server_key = null, string $key = null,
                                      callable $cache_cb, float $cas_token)
    {
        return self::Connect()->getByKey($server_key, $key, $cache_cb, $cas_token);
    }

    /**
     * ========================================================================
     * TODO:请求多个元素
     * NOTE:可以通过参数value_cb指定一个result callback来替代明确的抓取结果
     * （fetch或fetchAll为明确抓取方式）
     * ------------------------------------------------------------------------
     * @param  array    $keys
     * @param  bool     $with_cas
     * @param  callback $value_cb
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_getDelayed(array $keys = null, bool $with_cas, callback $value_cb = null)
    {
        return self::Connect()->getDelayed($keys, $with_cas, $value_cb);
    }

    /**
     * ========================================================================
     * TODO:从指定的服务器上请求多个元素
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  array    $keys
     * @param  bool        $with_cas
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_getDelayedByKey(string $server_key = '', array $keys = null, $with_cas = null, callback $value_cb)
    {
        return self::Connect()->getDelayedByKey($server_key, $keys, $with_cas, $value_cb);
    }

    /**
     * ========================================================================
     * TODO:检索多个元素
     * ------------------------------------------------------------------------
     * @param  array   $keys
     * @param  array   $cas_tokens
     * @param  int     $flags
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_getMulti(array $keys = null, array $cas_tokens, int $flags)
    {
        return self::Connect()->getMulti($keys, $cas_tokens, $flags);
    }

    /**
     * ========================================================================
     * TODO:从特定服务器检索多个元素
     * ------------------------------------------------------------------------
     * @param  array   $keys
     * @param  array   $cas_tokens
     * @param  int     $flags
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_getMultiByKey(string $server_key, array $keys = null, array $cas_tokens, int $flags)
    {
        return self::Connect()->getMultiByKey($server_key, $keys, $cas_tokens, $flags);
    }

    /**
     * ========================================================================
     * TODO:获取Memcached的选项值
     * NOTE:http://php.net/manual/zh/memcached.constants.php
     * ------------------------------------------------------------------------
     * @param  int    $option
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function M_getOption(int $option)
    {
        return self::Connect()->getOption($option);
    }

    /**
     * ========================================================================
     * TODO:返回最后一次操作的结果代码
     * ====================================
     * @return object
     * ====================================
     */
    public static function M_getResultCode()
    {
        return self::Connect()->getResultCode();
    }

    /**
     * ========================================================================
     * TODO:返回最后一次操作的结果描述消息
     * ====================================
     * @return object
     * ====================================
     */
    public static function M_getResultMessage()
    {
        return self::Connect()->getResultMessage();
    }

    /**
     * ========================================================================
     * TODO:获取一个key所映射的服务器信息
     * ------------------------------------------------------------------------
     * @param  string $server_key
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_getServerByKey(string $server_key)
    {
        return self::Connect()->getServerByKey($server_key);
    }

    /**
     * ========================================================================
     * TODO:获取服务器池中的服务器列表
     * ------------------------------------------------------------------------
     * @return array
     * ------------------------------------------------------------------------
     */
    public static function M_getServerList()
    {
        return self::Connect()->getServerList();
    }

    /**
     * ========================================================================
     * TODO:获取服务器池的统计信息
     * NOTE:返回一个包含所有可用memcache服务器状态的数组. 返回的统计信息的详细描述参见
     * memcache protocol。 （译注：经实验，服务器池中有不可用服务器时，返回false）
     * ------------------------------------------------------------------------
     * @return mixed
     * ------------------------------------------------------------------------
     */
    public static function M_getStats()
    {
        return self::Connect()->getStats();
    }

    /**
     * ========================================================================
     * TODO:获取服务器池中所有服务器的版本信息
     * ------------------------------------------------------------------------
     * @return array
     * ------------------------------------------------------------------------
     */
    public static function M_getVersion()
    {
        return self::Connect()->getVersion();
    }

    /**
     * ========================================================================
     * TODO:增加数值元素的值
     * NOTE:将一个数值元素增加参数offset指定的大小。 如果元素的值不是数值类型，
     * 将其作为0处理。如果元素不存在Memcached::increment()失败
     * ------------------------------------------------------------------------
     * @param   string   $key
     * @param   int      $offset
     * @return  int
     * ------------------------------------------------------------------------
     */
    public static function M_increment(string $key = null, int $offset)
    {
        return self::Connect()->increment($key, $offset);
    }

    /**
     * ========================================================================
     * TODO:指定服务器 增加数值元素的值 如果元素的值不是数值类型，将其作为0处理
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  int      $offset
     * @param  int      $initial_value
     * @param  int      $expiry
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_incrementByKey(string $server_key = null, string $key = null, int $offset,
                                            int $initial_value = 0, int $expiry = 0)
    {
        return self::Connect()->incrementByKey($server_key, $key, $offset, $initial_value, $expiry);
    }

    /**
     * ========================================================================
     * TODO:判断当前连接是否是长连接
     * ------------------------------------------------------------------------
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_isPersistent()
    {
        return self::Connect()->isPersistent();
    }
    /**
     * ========================================================================
     * TODO:检查最近创建的实例
     * ------------------------------------------------------------------------
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_isPristine()
    {
        return self::Connect()->isPristine();
    }

    /**
     * ========================================================================
     * TODO:向一个已存在的元素前面追加数据
     * NOTE:value被强制转换成字符串类型主要是因为对于mix类型的追加没有很好的定义。
     * 如果Memcached::OPT_COMPRESSION常量开启，这个操作会失败，并引发一个警告，
     * 因为向压缩数据 后追加数据可能会导致解压不了。
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  string   $value
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_prepend(string $key = null, string $value = null)
    {
        return self::Connect()->prepend($key, $value);
    }

    /**
     * ========================================================================
     * TODO:使用server_key自由的将key映射到指定服务器 向一个已存在的元素前面追加数据
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  string   $value
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_prependByKey(string $server_key = null,string $key = null, string $value = null)
    {
        return self::Connect()->addByKey($server_key, $key, $value);
    }

    /**
     * ========================================================================
     * TODO:关闭所有memcache服务器的链接。
     * ------------------------------------------------------------------------
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_quit()
    {
        return self::Connect()->quit();
    }

    /**
     * ========================================================================
     * TODO:替换已存在key下的元素
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  mixed    $value
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_replace(string $key = null, mixed $value = null, int $expiration = 0)
    {
        return self::Connect()->replace($key, $value, $expiration);
    }

    /**
     * ========================================================================
     * TODO:但是如果 服务端不存在key， 操作将失败
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  mixed    $value
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_replaceByKey(string $server_key = '', string $key = null, mixed $value, int $expiration = 0)
    {
        return self::Connect()->replaceByKey($server_key, $key, $value, $expiration);
    }

    /**
     * ========================================================================
     * TODO:重置服务器池信息
     * ------------------------------------------------------------------------
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_resetServerList()
    {
        return self::Connect()->resetServerList();
    }

    /**
     * ========================================================================
     * TODO:存储一个元素
     * NOTE:值可以是任何有效的非资源型php类型， 因为资源类型不能被序列化存储。
     * 如果Memcached::OPT_COMPRESSION 选项开启， 序列化的值同样会被压缩存储。
     * ------------------------------------------------------------------------
     * @param  string  $key
     * @param  mixed   $value
     * @param  int     $expiration
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_set(string $key = null, mixed $value = null, int $expiration = 0)
    {
        return self::Connect()->set($key, $value, $expiration);
    }

    /**
     * ========================================================================
     * TODO:在指定服务器存储一个元素
     * ------------------------------------------------------------------------
     * @param    string    $server_key
     * @param    string    $key
     * @param    mixed     $value
     * @return   boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setByKey(string $server_key = null, string $key = null, mixed $value = null)
    {
        return self::Connect()->setByKey($server_key, $key, $value);
    }

    /**
     * ========================================================================
     * TODO:存储多个元素
     * ------------------------------------------------------------------------
     * @param  array $item
     * @param  int   $expiration
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setMulti(array $item = null, int $expiration = 0)
    {
        return self::Connect()->setMulti($item, $expiration);
    }

    /**
     * ========================================================================
     * TODO:在指定服务器存储多个元素
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  array    $item
     * @param  int      $expiration
     * @return boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setMultiByKey(string $server_key = '',array $item = null, int $expiration = 0)
    {
        return self::Connect()->setMultiByKey($server_key, $item, $expiration);
    }

    /**
     * ========================================================================
     * TODO:设置一个memcached选项
     * ------------------------------------------------------------------------
     * @param   int      $option
     * @param   mixed    $value
     * @return  boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setOption(int $option = null, mixed $value = null)
    {
        return self::Connect()->setOption($option, $value);
    }

    /**
     * ========================================================================
     * TODO:设置一组memcached选项
     * ------------------------------------------------------------------------
     * @param   array    $options
     * @return  boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setOptions(array $options)
    {
        return self::Connect()->setOption($options);
    }

    /**
     * ========================================================================
     * TODO:SASL认证数据集*
     * ------------------------------------------------------------------------
     * @param   string   $username
     * @param   string   $password
     * @return  boolean
     * ------------------------------------------------------------------------
     */
    public static function M_setSaslAuthData(string $username = null, string $password = null)
    {
        return self::Connect()->setSaslAuthData($username, $password);
    }

    /**
     * ========================================================================
     * TODO:设置新的到期时间
     * ------------------------------------------------------------------------
     * @param  string   $key
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_touch(string $key = null, int $expiration = null)
    {
        return self::Connect()->touch($key, $expiration);
    }

    /**
     * ========================================================================
     * TODO:设置一个memcached选项
     * ------------------------------------------------------------------------
     * @param  string   $server_key
     * @param  string   $key
     * @param  int      $expiration
     * @return object
     * ------------------------------------------------------------------------
     */
    public static function M_touchByKey(string $server_key, string $key = null, int $expiration = 0)
    {
        return self::Connect()->touchByKey($server_key, $key, $expiration);
    }
}