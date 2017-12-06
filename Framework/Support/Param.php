<?php
/**
 * ============================================================
 * Class Date TODO:  数据库操作
 * ============================================================
 */

namespace Framework\Support;

abstract class Param extends Base
{
    public function __construct()
    {

    }

    /**
     * =======================================
     * TODO:验证POST 参数
     * ---------------------------------------
     * @param  string $param
     * @param  string $method
     * @param  string $notice
     * @return int
     * ---------------------------------------
     */
    public function input_post(string $param, string $method = 'json', string $notice = '缺少参数')
    {
        if (isset($_POST[$param]) && !empty($_POST[$param])) {
            return $_POST[$param];
        } else {
            switch ($method) {
                case 'json':
                    ;
                    break;
            }
            return 0;
        }
    }

    /**
     * =======================================
     * TODO:验证GET 请求参数
     * ---------------------------------------
     * @param   string $param
     * @param   string $method
     * @param   mixed $notice
     * @return mixed ---------------------------------------
     * ---------------------------------------
     */
    public function input_get(string $param, string $method = 'json', string $notice = null)
    {
        if (isset($_GET[$param]) && !empty($_GET[$param])) {
            return $_GET[$param];
        }
        return 0;
    }

    /**
     * =======================================
     * TODO:根据获取分页参数
     * ---------------------------------------
     * @param int $page
     * @param int $num
     * @return array
     * ---------------------------------------
     */
    public function input_page(int $page = 1, int $num = 15)
    {
        $page = $page < 1 ? 1 : $page;
        return ['limit' => [($page - 1) * $num, $page * $num]];
    }

    /**
     *
     */
    public function flow()
    {
        file_get_contents('input://');
    }

    /**
     * =======================================
     * TODO:判断是否为纯数字
     * ---------------------------------------
     * @param mixed $param
     * @return boolean
     * ---------------------------------------
     */
    public function is_numeric($param)
    {
        if (preg_match('/^\d+$/i', $param)) {
            return 1;
        };
        return 0;
    }

    //TODO:验证手机号
    public function is_phone($mobile)
    {
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }

    //TODO:身份证号验证
    public function is_id_card($card)
    {
        if(strlen($card)!=18){
            return false;
        }
        $card_base = substr($card, 0, 17);
        $verify_code = substr($card, 17, 1);
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        $verify_code_list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $total = 0;
        for($i=0; $i<17; $i++){
            $total += substr($card_base, $i, 1)*$factor[$i];
        }
        $mod = $total % 11;
        if($verify_code == $verify_code_list[$mod]){
            return true;
        }
        return false;
    }
}