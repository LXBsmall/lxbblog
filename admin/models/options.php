<?php

/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/19
 * Time: 15:59
 */

require_once ('base.php');

class LB_Options
{
    public function get($name, $def=''){
        global $lbdb;
        $sql = "SELECT value FROM options WHERE name='$name' LIMIT 1";
        $row = $lbdb->query($sql);
        if (!$row){
            return $def;
        }
        return $row->fetch_object()->value;
    }
}