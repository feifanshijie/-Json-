<?php

/*
|--------------------------------------------------------------------------
| TODO:Base
|--------------------------------------------------------------------------
| @main      return view
| @explain   return view
|--------------------------------------------------------------------------
*/

namespace Framework\Support;

use duncan3dc\Laravel\BladeInstance;

abstract class Base
{
    private $_base;

    private $_header;

    /**
     * --------------------------------------------------------------------------
     * 初始化
     * --------------------------------------------------------------------------
     */
    public function __construct()
    {

    }

    final public function httpCode($code)
    {
        return [
            '200' =>'HTTP/1.1 200 OK',                                        // ok 正常访问
            '404' =>'HTTP/1.1 404 Not Found',                                 //通知浏览器 页面不存在
            '301' =>'HTTP/1.1 301 Moved Permanently',                         //设置地址被永久的重定向 301
        ];
    }

    /**
     * ==============================================================================
     * TODO: Common header
     * ------------------------------------------------------------------------------
     */
    final public function Header($code)
    {
        $header_list = [
            '200' =>'HTTP/1.1 200 OK',                                        // ok 正常访问
            '404' =>'HTTP/1.1 404 Not Found',                                 //通知浏览器 页面不存在
            '301' =>'HTTP/1.1 301 Moved Permanently',                         //设置地址被永久的重定向 301
            'localtion' =>'Location: http://www.ruonu.com/',                        //跳转到一个新的地址
            'refresh' =>'Refresh: 10; url=http://www.ruonu.com/',                 //延迟转向 也就是隔几秒跳转
            '' =>'X-Powered-By: PHP/6.0.0',                                //修改 X-Powered-By信息
            '' =>'Content-language: en',                                   //文档语言
            '' =>'Content-Length: 1234',                                   //设置内容长度
            '' =>'Last-Modified: '.gmdate('D, d M Y H:i:s', time()).' GMT', //告诉浏览器最后一次修改时间
            '' =>'HTTP/1.1 304 Not Modified',                              //告诉浏览器文档内容没有发生改变

            ###内容类型###
            '' =>'Content-Type: text/html; charset=utf-8',                 //网页编码
            '' =>'Content-Type: text/plain',                               //纯文本格式
            '' =>'Content-Type: image/jpeg',                               //JPG、JPEG
            '' =>'Content-Type: application/zip',                          //ZIP文件
            '' =>'Content-Type: application/pdf',                          //PDF文件
            '' =>'Content-Type: audio/mpeg',                               //音频文件
            '' =>'Content-type: text/css',                                 //css文件
            '' =>'Content-type: text/javascript',                          //js文件
            '' =>'Content-type: application/json',                         //json
            '' =>'Content-type: application/pdf',                          //pdf
            '' =>'Content-type: text/xml',                                 //xml
            '' =>'Content-Type: application/x-shockw**e-flash',            //Flash动画

            //#########声明一个下载的文件###
            '' =>'Content-Type: application/octet-stream',
            '' =>'Content-Disposition: attachment; filename="ITblog.zip"',
            '' =>'Content-Transfer-Encoding: binary',
            readfile('test.zip'),

            #########对当前文档禁用缓存###
            'nocache' =>'Cache-Control: no-cache, no-store, max-age=0, must-revalidate',
            '' =>'Expires: Mon, 26 Jul 1997 05:00:00 GMT',

            #########显示一个需要验证的登陆对话框###
            '' =>'HTTP/1.1 401 Unauthorized',
            '' =>'WWW-Authenticate: Basic realm="Top Secret"',

            #########声明一个需要下载的xls文件###
            '' =>'Content-Disposition: attachment; filename=ithhc.xlsx',
            '' =>'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            '' =>'Content-Length: '.filesize('./test.xls'),
            '' =>'Content-Transfer-Encoding: binary',
            '' =>'Cache-Control: must-revalidate',
            '' =>'Pragma: public',
        ];

        return $header_list[$code];
    }
    final public function setHeaderCode($code)
    {
        $code_list =
        [
            100 => 'Continue',
            101 => 'Switching Protocol',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            412 => 'Precondition Failed',
            413 => 'Payload Too Large',
            414 => 'URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Range Not Satisfiable',
            417 => 'Expectation Failed',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            451 => 'Unavailable For Legal Reasons',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            511 => 'Network Authentication Required',
        ];

        return $code_list[$code];
    }

    final public function view($view, $data)
    {
        $path = '../App/Front/view';
        $cache = '../App/Front/cache';
        return (new BladeInstance($path, $cache))->render($view, $data);
    }

    /**
     * TODO:输出JSON
     * @param  array $data
     * @param  int   $http_code
     * @return string
     */
    final public static function json(array $data = [], int $http_code = 200) : string
    {
        header("Content-type: application/json", true, $http_code);
        header('HTTP/1.1 ' . $http_code . self::setHeaderCode($http_code));
        return json_encode($data);
    }

    /**
     * TODO:输出XML
     * @param  array $data
     * @param  int   $http_code
     * @return mixed
     */
    final public static function xml(array $data = [], int $http_code = 200) : string
    {
        header("Content-type: text/xml", true, $http_code);

        function arrayToXml($arr)
        {
            $xml = "<root>";
            foreach ($arr as $key=>$val)
            {
                if(is_array($val))
                {
                    $xml.="<".$key.">".arrayToXml($val)."</".$key.">";
                }
                else
                {
                    $xml.="<".$key.">".$val."</".$key.">";
                }
            }
            $xml.="</root>";
            return $xml;
        }

        return arrayToXml($data);
    }

//    /**
//     * TODO:输出视图文件
//     * @param string $view_name
//     * @param array $data
//     * @param array $html
//     */
//    final public function view(string $view_name, array $data = [], array $html = [])
//    {
//        header("Content-type:text/html;");
//        require $view_name.'.php';
//    }
}
