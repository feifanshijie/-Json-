<?php
/*-------------------------------------
 * 异步Mysql
 *
 *------------------------------------*/

$db = new swoole_mysql;
$server = array(
    'host' => '192.168.56.102',
    'user' => 'test',
    'password' => 'test',
    'database' => 'test',
);

$db->connect($server, function ($db, $r) {
    if ($r === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die;
    }
    $sql = 'show tables';
    $db->query($sql, function(swoole_mysql $db, $r) {
        global $s;
        if ($r === false) {
            var_dump($db->error, $db->errno);
        } elseif ($r === true ) {
            var_dump($db->affected_rows, $db->insert_id);
        }
        var_dump($r);
        $db->close();
    });
});