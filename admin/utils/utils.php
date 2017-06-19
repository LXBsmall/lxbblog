<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/13
 * Time: 13:16
 */

function &parse_query_string($query, $dk=true, $dv=true){
    $qs = explode('&', $query);
    $r = [];
    foreach ($qs as $q) {
        $p = explode('=', $q);
        if (count($p)&&$p[0]){
            $k = $dk ? urldecode($p[0]) : $p[0];
            $v = isset($p[1]) ? ($dv ? urldecode($p[1]) : $p[1]) :'';
            $r[$k] = $v;
        }
    }
    return $r;
}