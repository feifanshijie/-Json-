<?php
/**
 * TODO:TCP or UDP
 */
namespace Framework\BaseInterface;

interface ServerInterface
{
    public function status();
    public function error();
    public function message();
}