<?php
/**
 *
 */
namespace Framework\Help;

class CryptHelp
{
    private static $_iv = '1234567897777777';
    private static $_key = '1234567897777777';
    /**
     * ========================================
     * TODO:加密
     * ----------------------------------------
     *
     * ----------------------------------------
     * @param array $content
     * @return string
     * ----------------------------------------
     */
    public static function encrypt(array $content = [])
    {
        $content = 101100110;
//        $ciphertext = openssl_encrypt($content, 'AES-128-CBC', self::$_key, OPENSSL_RAW_DATA, self::$_iv);
//        var_dump(openssl_encrypt($content, 'AES-128-CBC', self::$_key, OPENSSL_ZERO_PADDING, self::$_iv));
        exit;
    }

    //TODO:解密
    public static function decrypt(string $content = '')
    {
        $encryptedData = base64_decode($content);
        $res = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, self::$_key, $encryptedData, MCRYPT_MODE_CBC, self::$_iv);
        $res = openssl_decrypt($content, 'rijndael-128', self::$_key, 'CBC', self::$_iv);
        return base64_decode($res);
    }

    //TODO:字符串转为16进制
    public function strToHex(string $string = null)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $hex .= dechex(ord($string[$i]));
        }
        $hex = strtoupper($hex);
        return $hex;
    }

    //TODO:16转为2进制
    public function hex2ToBin($hex2)
    {
        return pack("H*", $hex2);
    }
    /**
     * 将数组转换为JSON字符串（in gbk2312-gbk-utf-8）
     * -------------------------------------------------
     * @param    array $array 要转换的数组
     * @return   string        转换得到的json字符串
     * @return   json to string in array
     * -------------------------------------------------
     */
    public static function setJson(array $array = null)
    {
        self::arrJson($array, true);
        $json = json_encode($array);
        return urldecode($json);
    }

    /**
     * =================================================
     * TODO:对数组元素做处理
     * -------------------------------------------------
     * @param $array
     * @param bool $apply_to_keys_also
     * -------------------------------------------------
     */
    public static function arrJson(&$array, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                static::arrJson($array[$key], $apply_to_keys_also);
            } else {
                $array[$key] = urlencode($value);
            }

            if ($apply_to_keys_also && is_string($key))
            {
                $new_key = urlencode($key);
                if ($new_key != $key)
                {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }
}