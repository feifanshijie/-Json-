<?php
/**
 * =================================================
 * TODO:ImageHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class ImageHelp
{
    public function __construct()
    {
        
    }

    /**
     * =================================================
     * TODO:设置水印
     * =================================================
     * @param $x
     * @param $y
     * @param $w
     * @param $h
     * @param $str
     * =================================================
     */
    public function set_watermark($x, $y, $w, $h, $str)
    {
        $dst_path = 'dst.jpg';

        //创建图片的实例
        $dst = imagecreatefromstring(file_get_contents($dst_path));
        //打上文字
        $font = './simsun.ttc';//字体
        $black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色
        imagefttext($dst, 13, 0, 20, 20, $black, $font, '快乐编程');
        //输出图片
        list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        switch ($dst_type) {
            case 1://GIF
                header('Content-Type: image/gif');
                imagegif($dst);
                break;
            case 2://JPG
                header('Content-Type: image/jpeg');
                imagejpeg($dst);
                break;
            case 3://PNG
                header('Content-Type: image/png');
                imagepng($dst);
                break;
            default:
                break;
        }
    }

    //TODO:Url 生成二维码
    public function urlToQrcode()
    {
        
    }

    //TODO:压缩图片
    public function compress()
    {

    }
}
