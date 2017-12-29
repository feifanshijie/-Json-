<?php
/**
 * Run application
 */
namespace Framework;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Application
{
    private $action = null;
    private $_capsule = null;
    private $start_time = 0;
    private $method = null;

    /**
     * 初始化参数
     */
    public function __construct(string $config = '')
    {
        $this->start_time = microtime(true);
        $config = explode('|', $config);

        $this->action = '\\App\\'.WEB['action'].'\\'.$config[1];
        $this->method = $config[2];
    }

    /**
     * 运行应用
     */
    public function run()
    {
        if($this->_capsule == null)
        {
            $capsule = new Capsule();
            $capsule->addConnection(DB['blog']);
            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $this->_capsule = $capsule;
        }

        $class    = $this->action;
        $function = $this->method;

        $action = new $class();
        return $action->$function();
    }

    /**
     * --------------------------------------------------
     * TODO:记录日志等等
     * --------------------------------------------------
     */
    public function __destruct()
    {
        if(1==1)
        {
//            echo '生命周期结束';
        }
//        echo (microtime(true) - $this->start_time)*1000;
    }
}
