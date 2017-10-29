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


    //获取最后说说的id
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

    public function update_shuoshuo_by_id($post){
        global $lbdb;
        $id = $post['id'];
        $content = $post['content'];
        $date = $post['date'];
        $geo_lat = $post['geolat'];
        $geo_lng = $post['geolng'];
        $geo_addr = $post['geoaddr'];
        $source = strip_tags($content);
        $sql = "SELECT id FROM shuoshuo WHERE id=$id";
        $row = $lbdb->query($sql);
        if ($row && $row->num_rows==1 ){
            $sql = "UPDATE shuoshuo SET content='$content', date='$date', geo_lat='$geo_lat', geo_lng='$geo_lng',
              geo_addr='$geo_addr', source='$source' WHERE id=$id";
            $row = $lbdb->query($sql);
            if($row){
                return true;
            }
        }
        return false;
    }

    public function insert_shuoshuo($post){
        global $lbdb;
        global $lbmysqltime;
        global $lblog;

        $lblog->log($post);
        $content = $post['content'];
        //echo 'date'.$post['date'];
        //$date = $post['date'] ?? $lbmysqltime->mysql_now_time();
        $date = ($post['date'] != '' && isset($post['date']))? $post['date'] : $lbmysqltime->mysql_now_time();
        $ret = $lblog->log('当时时间：'.$lbmysqltime->mysql_now_time());
        //echo $lbmysqltime->mysql_now_time();
        //echo 'geolat'.$post['geolat'];
        $geo_lat = $post['geolat'] != '' ? $post['geolat'] : 0;
        $geo_lng = $post['geolng'] != '' ? $post['geolat'] : 0;
        $geo_addr = $post['geoaddr'] ?? '';
        $source = strip_tags($content);
        $log = 'date:'.$date.',geo_lat:'.$geo_lat.',geo_lng:'.$geo_lng.',geo_addr:'.$geo_addr;
        $lblog->log($log);
        $sql = "INSERT INTO shuoshuo (content, date, geo_lat, geo_lng, geo_addr, source, is_show) 
          VALUES ('$content', '$date', '$geo_lat', '$geo_lng', '$geo_addr', '$source', DEFAULT )";
        $row = $lbdb->query($sql);
        if($row){
            return true;
        } else {
            return false;
        }
    }

}