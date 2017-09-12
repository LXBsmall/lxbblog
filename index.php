<?php

if(!isset($_SERVER['HTTP_USER_AGENT'])) {
    header('HTTP/1.1 400 Bad Request');
    die(-1);
}

if(file_exists('MAINTENANCE')) {
    header('HTTP/1.1 503 In Maintenance');
    header('Content-Type: text/plain; charset=utf-8');
    header('Retry-After: 300');
    echo '网站维护中，请稍后再访问...';
    die(-1);
}
$start_time = microtime();
require_once('admin/load.php');
if (!$lbquery->query()){
    lb_die('400', '未定义查询');
}
if ($lbquery->is_home())    require_once('themes/index.php');
