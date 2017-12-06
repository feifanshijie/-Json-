<?php
/**
 * =================================================
 * TODO:EmailHelp by GYM 2017/03/12
 * =================================================
 */
namespace Framework\Help;

class EmailHelp
{
    private $_template = null;
    
    public function __construct()
    {
        
    }

    //TODO:设置内容模板
    public function set_template($template)
    {
        $this->_template = $template;
    }

    //TODO:简单发送邮件
    public function simple_send()
    {
        
    }

    //TODO:列表发送
    public function list_send()
    {
        
    }
    
    
}