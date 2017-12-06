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

    //TODO:初始化参数
    public function __construct($path)
    {
        $this->action = '\\App\\'.WEB['action'].'\\'.ROUTE[$path]['action'];
    }

    /**
     * Run application
     */
    public function run()
    {
        if($this->_capsule == null)
        {
            $capsule = new Capsule;
            $capsule->addConnection(DATABASE['blog']);
            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $this->_capsule = $capsule;
        }
        else
        {
            $capsule = $this->_capsule;
        }

        $class    = FW_STR($this->action, true);
        $function = FW_STR($this->action, false);

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
        echo '生命周期结束';
    }
}
