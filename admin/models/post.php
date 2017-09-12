<?php

/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/8/3
 * Time: 22:15
 */
class LB_Post
{
    /*
     * 获取近期文章
     *
     */
    public function get_recent_articles_by_tag($n = 10, $tag){
        global $lbdb;
        $sql = "SELECT * FROM posts ORDER BY date DESC LIMIT $n";
        $row = $lbdb->query($sql);
        if (!$row){
            return false;
        }
        $r = [];
        while ($obj = $row->fetch_object())
            $r[] = $obj;
        return $r;
    }
}