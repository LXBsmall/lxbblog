<?php

/**
 * Created by PhpStorm.
 * User: lxb
 * Date: 2017/10/11
 * Time: 21:00
 */

date_default_timezone_set("Asia/Shanghai");

class LB_Mysqltime
{
    public function mysql_now_time(){
        return date('Y-m-d G  :i:s');
    }
}