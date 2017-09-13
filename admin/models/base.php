<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/5
 * Time: 17:30
 */

$lbdb = @new mysqli(DB_HOST, DB_USER, DB_PSWD, DB_BASE);
if ($lbdb->connect_error){
    lb_die(503, '连接数据库失败:'.$lbdb->connect_error);
}
if (!$lbdb->set_charset('utf8')){
    lb_die(503, '设置字符集失败!');
}

