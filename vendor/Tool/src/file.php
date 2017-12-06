<?php
/**
 * file
 */
$md5file = file_get_contents("md5file.txt");

class MakeFile
{
    public $file_name = '';
    public $file_path = '';
    public $char_arr  = ['å','∫','ç','∂','´','ƒ','©','˙','∆','˚','¬','µ','ø','π','œ','®','ß','√','∑','≈','¥','Ω'];

    public function template()
    {

    }

    public function __construct()
    {

    }

    public function show()
    {
        if (md5_file($this->file_name) == $this->file_name)
        {
            echo "The file is ok.";
        }
        else
        {
            echo "The file has been changed.";
        }
    }

    public function make()
    {
        $class_name = '';
        $namespace = '';

        $template = <<<EOT
        namespace {$namespace};
        
        class {$class_name} extent Controller
        {
            public function __construct()
            {
            
            }
            
            public function index()
            {
            
            }
        }
EOT;


    }


}


















