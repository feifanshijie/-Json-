<?php
/**
 * 结构体
 */
class Di{
    private $_factory;

    public function set($id, $value)
    {
        $this->_factory[$id] = $value;
    }

    public function get($id)
    {
        $value = $this->_factory[$id];
        return $value();
    }
}
class User{
    private $_username;

    function __construct($username = "")
    {
        $this->_username = $username;
    }

    function getUserName(){
        return $this->_username;
    }
}

//从这里开始看
$di = new Di();
$di->set("zhangsan",function(){
    return new User('张三');
});
$di->set("lisi",function(){
    return new User("李四");
});
echo $di->get("zhangsan")->getUserName();
echo $di->get("lisi")->getUserName();