<?php
/**
 * ============================================================
 * Class Date TODO:  数据库操作
 * ============================================================
 */
namespace Framework\Support;

use Framework\Drive\MySqlDrive;

abstract class Data extends MySqlDrive
{
    protected static $link;

    public static function page(string $table = '', array $where = [])
    {
        return self::paging($table, $where);
    }
}