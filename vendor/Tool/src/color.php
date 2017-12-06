<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2017/7/24
 * Time: 上午8:29
 */
class Colors {

    //TODO:font setting
    private static $foreground_colors =
    [
        'red'          => '0;31',
        'green'        => '0;32',
        'brown'        => '0;33',
        'blue'         => '0;34',
        'purple'       => '0;35',
        'cyan'         => '0;36',
        'light_gray'   => '0;37',
        'black'        => '1;30',
        'dark_gray'    => '1;30',
        'light_red'    => '1;31',
        'light_green'  => '1;32',
        'yellow'       => '1;33',
        'light_blue'   => '1;34',
        'light_purple' => '1;35',
        'light_cyan'   => '1;36',
        'white'        => '1;37',
    ];

    //TODO:background setting
    private static $background_colors =
    [
        'black'        => '40',
        'red'          => '41',
        'green'        => '42',
        'yellow'       => '43',
        'blue'         => '44',
        'magenta'      => '45',
        'cyan'         => '46',
        'light_gray'   => '47',
    ];

    /**
     * @param  string $text 输出文本
     * @param  string $ft   文本颜色
     * @param  string $bg   背景颜色
     * @return void         返回处理完毕字符串
     */
    public static function write($text = null, $ft = null, $bg = null)
    {
        $colored_string = "";

        // Check if given foreground color found
        if (isset(self::$foreground_colors[$ft])) {
            $colored_string .= "\033[" . self::$foreground_colors[$ft] . "m";
        }
        // Check if given background color found
        if (isset(self::$background_colors[$bg])) {
            $colored_string .= "\033[" . self::$background_colors[$bg] . "m";
        }
        $colored_string .=  $text . "\033[0m";

        echo $colored_string;
    }

    public function getForegroundColors()
    {
        return array_keys(self::$foreground_colors);
    }

    public function getBackgroundColors()
    {
        return array_keys(self::$background_colors);
    }
}

echo Colors::write("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", "test", "black"). "\n";


//$char_arr = ['å','∫','ç','∂','´','ƒ','©','˙','∆','˚','¬','µ','ø','π','œ','®','ß','√','∑','≈','¥','Ω'];
//
//$md5file = file_get_contents("md5file.txt");
//
//if (md5_file("md5file.txt") == $md5file)
//{
//    echo "The file is ok.";
//}
//else
//{
//    echo "The file has been changed.";
//}

