<?php
/**
 * Created by PhpStorm.
 * User: ming
 * Date: 2017/7/29
 * Time: 上午11:00
 */
abstract class View
{
    public $cache = false;
    public $static = false;
    public $type = 'complied';
    public $tag_start = '@';
    public $tag_end = '';

    public function __construct()
    {
        file_put_contents('example.txt', 'The quick brown fox jumped over the lazy dog.');

        echo hash_file('md5', 'example.txt');

        $md5file = file_get_contents("md5file.txt");
        if (md5_file("test.txt") == $md5file)
        {
            echo "OK";
        }
        else
        {
            echo "ERROR";
        }
    }

    /**
     * TODO:输出视图 output view
     * @param $filename
     * @return void
     */
    public function fm_show($filename)
    {
        if($this->type == 'complied' && md5_file($filename) == hash_file('md5', $filename))
        {
            require_once $filename;
        }
        else
        {
            die($filename);
        }
    }


    /**
     * TODO:替换文件 replace view string
     * @param $string
     * @return mixed
     */
    public function fm_replace_file($string)
    {
        $pattern = array(
            "/{$this->tag_start}\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*)\s*{$this->tag_end}/",
            "/{$this->tag_start}\s*(loop|foreach)\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*)\s*{$this->tag_end}/",
            "/{$this->tag_start}\s*(loop|foreach)\s*\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*)\s+as\s+\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*){$this->tag_end}/",
            "/{$this->tag_start}\s*\/(loop|foreach|if)\s*{$this->tag_end}/",
            "/{$this->tag_start}\s*if(.*?)\s*$this->tag_end/",
            "/{$this->tag_start}\s*(else if|elseif)(.*?)\s*{$this->tag_end}/",
            "/{$this->tag_start}\s*else\s*{$this->tag_end}/",
            "/{$this->tag_start}\s*([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\xf7-\xff]*)\s*$this->tag_end/"
        );

        $replace = array(
            "<?php echo \$\\1; ?>",
            "<?php foreach((array)\$\\2 as \$K=>\$V) { ?>",
            "<?php foreach((array)\$\\2 as &\$\\3) { ?>",
            "<?php } ?>",
            "<?php if(\\1) { ?>",
            "<?php } elseif(\\2) { ?>",
            "<?php } else { ?>",
            "<?php echo \$\\1; ?>"
        );

        return preg_replace($pattern, $replace, $string);
    }

    public function fm()
    {
        file_put_contents('example.txt', 'The quick brown fox jumped over the lazy dog.');

        echo hash_file('md5', 'example.txt');

        $md5file = file_get_contents("md5file.txt");
        if (md5_file("test.txt") == $md5file)
        {
            echo "OK";
        }
        else
        {
            echo "ERROR";
        }
    }
}