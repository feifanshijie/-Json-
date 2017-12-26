<?php
/**
 * --------------------------------------------------
 * TODO: Command Help Tool by GYM 2017/03/12
 * --------------------------------------------------
 * first you must config your develop info
 * --------------------------------------------------
 * Example
 * php Tool.php -cn {developerName}
 * php Tool.php -cn {developerEmail}
 * You can use php Tool.php -help get more
 * --------------------------------------------------
 */
include 'vendor/Tool/src/color.php';
define('DEVELOPER_NAME','爱你哦');
define('DEVELOPER_EMAIL','2652525544@qq.com');
define('FILE_NAME',substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')));
define('CODE_LINE',0);
define('WORK_LINE',0);
//常量模板
$constant = 'constant';
if($argc > 0)
{
    if(DEVELOPER_NAME == 'default' || DEVELOPER_EMAIL == 'default')
    {
        switch ($argv[1])
        {
            //TODO:修改开发者昵称
            case '-cn':
                config($argv[2], 1) == 1 ? showMessage('success') : showMessage('failed');
                break;
            //TODO:修改开发者邮箱
            case '-ce':
                config($argv[2], 0) == 1 ? showMessage('success') : showMessage('failed');
                break;
            case '-help':
                showMessage('help');
                break;
            default:
                if(DEVELOPER_NAME == 'default')
                {
                    die('Please Config your developer name');
                }
                die('Please Config your developer email');
                break;
        }
    }
    else
    {
        if(!isset($argv[1]) || empty($argv[1]))
        {
            die("I don't know what do you want!\nPlease tell me like ↓\nphp Tool.php -help");
        }

        switch ($argv[1])
        {
            //TODO:生成默认控制器【make action】
            case '-ma':

                break;
            //TODO:生成默认数据模型【make data】
            case '-md':

                break;
            //TODO:生成默认参数处理【make param】
            case '-mp':

                break;
            //TODO:清理redis缓存【clear redis】
            case '-cr':

                break;
            //TODO:清理memcached缓存【clear memcached】
            case '-cm':

                break;
            //TODO:清理mongodb缓存【clear mongodb】
            case '-cg':

                break;
            //TODO:清理模板缓存【clear template】
            case '-ct':

                break;
            //TODO:修改开发者昵称
            case '-cn':
                config($argv[2], 1) == 1 ? showMessage('success') : showMessage('failed');
                break;
            //TODO:修改开发者邮箱
            case '-ce':
                config($argv[2], 0) == 1 ? showMessage('success') : showMessage('failed');
                break;
            case 'rl':

                break;
            case '-sl':
                echo "开始前行数:{$constant('CODE_LINE')}";
                break;
            case '-ss':

                break;

            //TODO:显示帮助信息【show help info】
            case '-help':
                showMessage('help');
                break;
            default:
                break;
        }
    }

}

//TODO:配置开发者昵称
function config($name, $type)
{
    $FILE = file_get_contents(FILE_NAME);
    if($type == 1)
    {
        $old = 'define(\'DEVELOPER_NAME\',\''.DEVELOPER_NAME.'\')';
        $new = 'define(\'DEVELOPER_NAME\',\''.$name.'\')';
        $update = str_replace($old, $new, $FILE);
    }
    else
    {
        $old = 'define(\'DEVELOPER_EMAIL\',\''.DEVELOPER_EMAIL.'\')';
        $new = 'define(\'DEVELOPER_EMAIL\',\''.$name.'\')';
        $update = str_replace($old, $new, $FILE);
    }
    if(file_put_contents(FILE_NAME, $update))
    {
        return 1;
    }
    return 0;
}
function showMessage($type)
{
    switch ($type)
    {
        case 'success':
            die('Success!');
            break;
        case 'error':
            die('Error!');
            break;
        case 'failed':
            die('Failed!');
            break;
        case 'end':
            die('Noting to do!');
            break;
        case 'help':
            $message ='
-cn  developer_name                                                           配置开发者昵称          
-ce  developer_email     php tool.php -cn Eric                                配置开发者邮箱          
-ma  namespace           php tool.php -ce 2652525544@qq.com                   创建控制器            
-md  namespace           php tool.php -ma Admin\Index                         创建数据模型           
-mp  namespace           php tool.php -md Admin\Index                         创建参数处理           
-cr                      php tool.php -ma Admin\Index                         清空redis缓存        
-cm                      php tool.php -cr                                     清空memcached缓存    
-cg                      php tool.php -cm                                     清空mongodb缓存      
-ct                      php tool.php -cg                                     清空runtime缓存      
-rl                      php tool.php -ct                                     记录当前代码行数         
-sl                      php tool.php -rt                                     显示记录前至今开发行数
-ss  server name or all  hp tool.php -sl                                      启动swoole服务       
-help                    php tool.php -ss all  php tool.php -ss talk          显示帮助信息           
';
Colors::write($message, "yellow", "green");
            die();
            break;
    }
    die('Noting to do!');
}
function templateInfo($type, $namespace, $constant = 'constant')
{
    $name = str_replace('\\','',strrchr($namespace,'\\'));
    switch ($type)
    {
        case 'action':
            $template = "
<?php
/**
 * ======================================
 * TODO:
 * Author: {$constant('DEVELOPER_NAME')}
 * ======================================
 */
namespace {$namespace};

use FunnyPHP\\System\\Support\\Action;

class {$name}Action extends Action
{
    public function __construct()
    {

    }
}
"
;
            break;
        case 'data':
            $template = "
<?php
/**
 * ======================================
 * TODO:
 * Author: {$constant('DEVELOPER_NAME')}
 * ======================================
 */
namespace {$namespace};

use FunnyPHP\\System\\Support\\Data;

class {$name}Data extends Data
{
    public function __construct()
    {

    }
}
"
            ;
            break;
        case 'param':
            $template = "
<?php
/**
 * ======================================
 * TODO:
 * Author: {$constant('DEVELOPER_NAME')}
 * ======================================
 */
namespace {$namespace};

use FunnyPHP\\System\\Support\\Param;

class {$name}Param extends Param
{
    public function __construct()
    {

    }
}
"
            ;
            break;
        default:
            die('error');
            break;
    }
    if(file_put_contents($namespace,$template))
    {
        return 1;
    }
    return 0;
}
