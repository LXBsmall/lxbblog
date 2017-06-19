<?php

/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/19
 * Time: 16:37
 */
class LB_Shuoshuo
{
    public function get(){
        global $lbdb;
        $sql = "SELECT * FROM shuoshuo GROUP BY date";
        $row = $lbdb->query($sql);
        if (!$row){
            return false;
        }
        return $row->fetch_object();
    }
}