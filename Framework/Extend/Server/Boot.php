<?php
/**
 * ============================================================
 * TODO: Boot 2017-02-08 V0.1 By Gym  暂时弃用
 * ============================================================
 * 0、AcceptRequest    [接收一个请求]
 * 1、MatchingRouting  [匹配路由]
 *    1.1 => NO  return json error
 *    1.2 => YES to 2
 * 2、Init config      [初始化配置]
 * 3、Analytic routing [异步路由请求]
 * 4、Run flow         [流程运行]
 * 5、Return by type [1]Json[2]Xml[3]View [返回执行结果]
 * ============================================================
 */
namespace App;

class Boot
{
    private $_routing;
    private $_result;
    private $_type;

    public function __construct()
    {

    }

    public function OnContent()
    {
        
    }
    
    public function AcceptRequest()
    {
        
    }

    public function MatchingRouting()
    {
        
    }

    public function InitConfig()
    {
        
    }

    public function AnalyticRouting()
    {
        
    }

    public function Run()
    {
        $a = new $this->routing($this->result);
        $this->_result = 1;
    }

    public function __destruct()
    {

    }
}