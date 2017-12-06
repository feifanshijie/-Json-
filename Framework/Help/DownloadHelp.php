<?php
/**
 * =================================================
 * TODO:DownloadHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class DownloadHelp
{
    public function __construct()
    {
        
    }

    public function Simple_download($filePath)
    {
        header('Content-type: application/pdf');
        header("Content-Disposition: attachment; filename='{$filePath}'");
        readfile("$filePath");
        exit();
    }

    //TODO:文件下载
    public function down_file($filePath, $fileType)
    {
        $file=fopen('文件地址',"r");
        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize('文件地址'));
        header("Content-Disposition: attachment; filename=文件名称");
        echo fread($file,filesize('文件地址'));
        fclose($file);
    }

    //TODO:大文件下载
    public function down_big_file($filePath, $fileType)
    {
        $filename='asd';
        $file  =  fopen($filename, "rb");
        Header( "Content-type:  application/octet-stream ");
        Header( "Accept-Ranges:  bytes ");
        Header( "Content-Disposition:  attachment;  filename= 4.doc");
        $contents = "";
        while (!feof($file)) {
            $contents .= fread($file, 8192);
        }
        echo $contents;
        fclose($file);
    }

    public function test1($filePath)
    {
        header('Content-Description: File Transfer');

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
    }


}