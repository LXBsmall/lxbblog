<?php

/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/19
 * Time: 16:37
 */
class LB_Shuoshuo
{
    /*
     * 获取近期说说
     * @parm    (int) $n 最近说说条数
     * @return  成功返回说说对象的数组, 失败返回false
     */
    public function get_recent_shuoshuos($n=10){
        global $lbdb;
        $sql = "SELECT * FROM shuoshuo where is_show=1 ORDER BY date DESC LIMIT $n";
        $row = $lbdb->query($sql);
        if (!$row){
            return false;
        }
        $r = [];
        while ($obj = $row->fetch_object())
            $r[] = $obj;
        return $r;
    }


    public function get_id(){
        global $lbdb;
        $sql = "SELECT id FROM shuoshuo ORDER BY id DESC LIMIT 1";
        $row = $lbdb->query($sql);
        if(!$row){
            return false;
        }
        return $row->fetch_object()->id;
    }

    public function get_shuoshuo_by_id($id){
        global $lbdb;
        $sql = "SELECT * FROM shuoshuo WHERE id=$id";
        $row = $lbdb->query($sql);
        if(!$row){
            return false;
        }
        return $row->fetch_object();
    }

    public function delete_shuoshuo_by_id($id){
        global $lbdb;
        if(!isset($id) || $id<=0){
            return false;
        }

        $sql = "UPDATE shuoshuo SET is_show=0 where id=$id";
        $row = $lbdb->query($sql);
        if($row){
            return $lbdb->affected_rows;
        }

        else{
            return false;
        }
    }

}