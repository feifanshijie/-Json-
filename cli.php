<?php

/**
 * 描述  命令行工具
 *
 */
class Cli
{

    const AUTHOR = 'default';
    const EMAIL = 'default@default.com';

    public function __construct()
    {

    }

    //TODO:初始化
    public static function init()
    {
        return new self();
    }

    public function run()
    {

    }

    public function __destruct()
    {

    }
}

Cli::init()->run();
