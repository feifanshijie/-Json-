<?php
/**
 * ====================================================
 * TODO:CURL Function by GYM 2017/03/12 全局帮助函数
 * ====================================================
 */

/**
 * TODO:CURL POST
 * @param  string $url   url
 * @param  array  $data
 * @return mixed
 */
if(!function_exists('FW_CURL_POST'))
{
    function FW_CURL_POST(string $url = '', array $data = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
}

/**
 * TODO:CURL get
 * @param  string $url url
 * @return mixed
 */
if(!function_exists('FW_CURL_GET'))
{
    function FW_CURL_GET(string $url = '')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

/**
 * ====================================================
 * TODO:Debug Function by GYM 2017/03/12
 * ====================================================
 */

//TODO:断点
if(!function_exists('FW_PR'))
{
    function FW_PR($param)
    {
        print_r($param);exit;
    }
}

/**
 * TODO:debug printf
 */
if(!function_exists('FW_VD'))
{
    function FW_VD($param)
    {
        var_dump($param);exit;
    }
}

//TODO:debug printf
if(!function_exists('FW_PF'))
{
    function FW_PF($param)
    {
        printf($param);exit;
    }
}

//TODO:获取内存使用情况
if(!function_exists('FW_M'))
{
    function FW_M()
    {
        echo memory_get_usage();exit;
    }
}

/**
 * ====================================================
 * TODO:错误处理 Function by GYM 2017/03/12
 * ====================================================
 */
set_error_handler('errorHandler');
register_shutdown_function('fatalErrorHandler');
function errorHandler($errno,$errstr,$errfile,$errline){
    $arr = array('['.date('Y-m-d h-i-s').']：', $errstr, $errfile, 'line:'.$errline,);
    //格式 ：  时间 uri | 错误消息 文件位置 第几行
    error_log(implode(' ',$arr)."\r\n",3,'./test.txt','extra');
}

//捕获fatalError
function fatalErrorHandler(){
    $e = error_get_last();
    switch($e['type']){
        case E_ERROR:
        case E_PARSE:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
            errorHandler($e['type'],$e['message'],$e['file'],$e['line']);
            break;
    }
}

/**
 * =================================================
 * TODO: File related function by GYM 2017/03/12
 * =================================================
 */

/**
 * TODO:write a file 写入一个文件
 * @param  string  $filename
 * @return boolean
 */
if(!function_exists('FW_FILE_WRITE'))
{
    function FW_FILE_WRITE(string $filename)
    {
        return true;
    }
}



/**
 * TODO:make a file 创建一个文件
 * @param  string|null $path
 * @param  string|null $filename
 * @return bool
 */
if(!function_exists('FW_FILE_CREATE'))
{
    function FW_FILE_CREATE(string $path = null, string $filename = null)
    {
        return true;
    }
}


/**
 * TODO:delete 删除一个文件
 * @param string|null $file_path
 * @return bool
 */
if(!function_exists('FW_FILE_DELETE'))
{
    function FW_FILE_DELETE(string $file_path = null)
    {
        return true;
    }

}

/**
 * TODO:移动一个文件
 * @param  string|null $old_path
 * @param  string|null $new_path
 * @return bool
 */
if(!function_exists('FW_FILE_MOVE'))
{
    function FW_FILE_MOVE(string $old_path = null, string $new_path = null)
    {
        return true;
    }
}

/**
 * ====================================================
 * TODO: File Log function by GYM 2017/03/12
 * ====================================================
 */

/**
 * TODO:Write log
 * TODO:写日志
 * @param  string  $info
 * @return boolean
 */
if(!function_exists('FW_LOG_WRITE'))
{
    function FW_LOG_WRITE(string $info)
    {
        return boolval(1);
    }
}


/**
 * TODO:Move log
 * TODO:移动日志
 * @param  string $type
 * @param  string $file_name
 * @return boolean
 */
function FW_LOG_MOVE(string $type, string $file_name)
{
    return true;
}

/**
 * TODO:Delete log
 * TODO:删除日志
 * @param  string  $type
 * @param  string  $file_name
 * @return boolean
 */
if(!function_exists('FW_LOG_DELETE'))
{
    function FW_LOG_DELETE(string $type, string $file_name)
    {
        return true;
    }
}

/**
 * ====================================================
 * TODO: Relate to IP address by GYM 2017/07/26
 * ====================================================
 */

/**
 * TODO:Get client IP address code from discuz
 * TODO:获取IP地址  代码来自discuz
 * @return string
 */
if(!function_exists('FW_GET_IP'))
{
    function FW_GET_IP()
    {
        $ip='未知IP';
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            return FW_IS_IP($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            return FW_IS_IP($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
        }

        return FW_IS_IP($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
    }
}

/**
 * TODO:Check IP address is true or false
 * TODO:检查IP地址是否正确
 * @param  $ip_str
 * @return bool|int
 */
if(!function_exists('FW_IS_IP'))
{
    function FW_IS_IP($ip_str)
    {
        $ip=explode('.',$ip_str);
        for($i=0;$i<count($ip);$i++)
        {
            if($ip[$i]>255){
                return false;
            }
        }

        return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/',$ip_str);
    }
}


/**
 * TODO:遍历数组
 * @param  $arr
 * @return boolean
 */
if(!function_exists('FW_ITERATOR'))
{
    function FW_ITERATOR($arr)
    {
        echo '<style>body{margin:0;padding:0;line-height:30px;}</style>';
        echo '<div style="background-color:#000;color:greenyellow;font-size:20px;margin:0;padding:10px 20px;border:1px solid #ddd"><pre>';
        var_dump($arr);
        die ('</pre></div>');
    }
}


/**
 * TODO:读取配置
 * @param string $config_file_name
 * @param string $config_param_name
 * @return mixed
 */
if(!function_exists('env'))
{
    function env(string $config_param = null)
    {
        $config = explode('.', $config_param);

        $config_file_path = ENV_CONFIG_PATH."env.ini";
        $config_file_content = parse_ini_file($config_file_path,true);
        if(empty($config_param))
        {
            return $config_file_content;
        }

        $result = '';
        foreach ($config as $k => $v)
        {
            if(0 == $k && isset($config_file_content[$v]))
            {
                $result = $config_file_content[$v];
            }
            else if(isset($result[$v]))
            {
                $result = $result[$v];
            }
        }

        return $result;
    }
}

if(!function_exists('dd'))
{
    function dd($param)
    {
        echo '<style>*{margin:0}</style><pre><div style="color:rgba(57,195,64,1);background-color:rgba(35,37,37,1)">';
        var_dump($param);
        echo '</pre></div>';
    }
}

if(!function_exists('FW_KEY_VALUE'))
{
    function FW_KEY_VALUE(array $array = [])
    {
        return true;
    }
}

/**
 * TODO:Notice return json
 * @param int $code
 * @param string $msg
 */
if(!function_exists('FW_NOTICE'))
{
    function FW_NOTICE(int $code = 400, $msg = 'error')
    {
//        header('Content-type: application/json');
        return json_encode(['code' => $code, 'msg' => $msg]);
    }
}

/**
 * TODO:返回自定义信息
 */
if(!function_exists('FW_HTTP'))
{
    function FW_HTTP()
    {
        die('http');
    }
}


/**
 * TODO:获取HTTP请求参数
 * @param int $type 0 get and post and file
 * @return array
 */
if(!function_exists('fw_http_param'))
{
    function FW_http_param($type = 0)
    {
        if($type == 0)
        {
            return $_REQUEST;
        }
        else if($type == 1)
        {
            return $_GET;
        }
        else if($type == 2)
        {
            return $_POST;
        }
    }
}

/**
 * TODO:替字符串
 */
if(!function_exists('FW_STR'))
{
    function FW_STR($str, $type)
    {
        if($type == false)
        {
            return str_replace('@','',strstr($str, '@', $type));
        }
        return strstr($str, '@', $type);
    }
}

/**
 * TODO:get Millisecond
 * TODO:获取毫秒
 * @return integer
 */
if(!function_exists('FW_MILLISECOND'))
{
    return microtime(true);
    list($t1, $t2) = explode(' ', microtime());
    return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}


