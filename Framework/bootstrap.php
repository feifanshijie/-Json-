<?php
/**
 * ------------------------------------------------------
 * Bootstrap
 * ------------------------------------------------------
 */
namespace Framework;
//TODO:加载框架全局函数
require_once "helps.php";
//require '../vendor/autoload.php';


ini_set('date.timezone', 'Asia/Shanghai');


define('ENVIRONMENT', 'localhost');
//TODO:加载系统应用的配置
define('BASE_PATH', '../'.dirname(__FILE__));
define('F', 'FactoryLib/');
define('ENV_PATH', '../Config/');
define('ENV_CONFIG_PATH', '../Config/'.ENVIRONMENT);
define('CONFIG', parse_ini_file(ENV_CONFIG_PATH.'/app.ini',true));
define('DATABASE', require_once ENV_CONFIG_PATH.'/db.php');
define('WEB', require_once ENV_CONFIG_PATH.'/web.php');
define('ROUTE', require_once ENV_CONFIG_PATH.'/router.php');

//TODO:是否开启DEBUG
if(CONFIG['debug'])
{
    error_reporting(E_ALL);
    ini_set('display_errors','On');
}
else
{
    error_reporting(0);
    ini_set('display_errors','Off');
}

//TODO:自动加载
spl_autoload_register(function ($class) {
    $file_path = str_replace("\\",'/', '../'.$class . '.php');
    include_once "{$file_path}";
});

set_error_handler(function ($error_no, $error_info, $error_file, $error_line){
    $log_file = '../Storage/log/error/'.date('Ymd').'.log';
    $template = '';
    switch ($error_no) {
        case E_USER_ERROR:
            $template .= "ERROR:编号[{$error_no}]{$error_info}位置文件{$error_file},第{$error_line}行\n";
            $log_file  = sprintf($log_file, 'error');
            break;
        case E_USER_WARNING:
            $template .= "WARNING:编号[$error_no]{$error_info}位置文件{$error_file},第{$error_line}行\n";
            $log_file  = sprintf($log_file, 'warning');
            break;
        case E_USER_NOTICE:
            $template .= "NOTICE:编号[$error_no]{$error_info}位置文件{$error_file},第{$error_line}行\n";
            $log_file  = sprintf($log_file, 'notice');
            break;
        default:
            $template .= "未知错误类型:编号[{$error_no}]{$error_info}位置文件{$error_file},第{$error_line}行\n";
            $log_file  = sprintf($log_file, 'unknown');
            break;
    }
    file_put_contents($log_file, $template, FILE_APPEND);
});

$rout = str_replace('?'.$_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']);

//CONFIG['accessLog'] && file_put_contents('../log/access/'.date('Ymd').'.log', 'Time:'. date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME'])." IP:{$_SERVER['REMOTE_ADDR']} Route:{$rout}\n", FILE_APPEND);

if(!empty(ROUTE[$rout]))
{

    $app = new Application($rout);
    echo $app->run();

    FW_NOTICE(405, 'Method not allow');
}

//FW_NOTICE(404, 'Not Found');
