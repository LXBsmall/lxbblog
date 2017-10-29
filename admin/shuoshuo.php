<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/8/15
 * Time: 21:51
 */

require_once ('load.php');
require_once('header.php');

function shuoshuo_main(){
    global $lbshuoshuo;
    $id = $_GET['id'] ?? 0;
    $isdelete = $_GET['delete'] ?? 0;

    if ($isdelete == 1 && $id>0){
        echo delete_shuoshuo($id);
        return;
    }

    if ($id > 0){
        echo edit_shuoshuo($id);
        return;
    }

    admin_header();
    ?>
    <script src="js/shuoshuo.js"></script>
    <section id="main">
        <div id="post-shuoshuo">
            <h3>发表说说</h3>
            <form method="post">
<!--                <input type="text" name="id" data-bind-shuoshuo="id" style="display: block;"-->
<!--                       value="--><?php //echo ($id && $id>0)?$id:$lbshuoshuo->get_id()+1; ?><!--">-->
                <textarea name="content" id="post-content" data-bind-shuoshuo="content" cols="30" rows="10" style="display: block;"
                          placeholder="说说内容" required><?php /*echo $cur_content; */?></textarea>
                <lebal>时间:<input type="datetime" name="date" data-bind-shuoshuo="date" ></lebal>
                <lebal>经度:<input type="text" name="geolat" data-bind-shuoshuo="geolat"></lebal>
                <lebal>纬度:<input type="text" name="geolng" data-bind-shuoshuo="geolng"></lebal>
                <lebal>位置:<input type="text" name="geoaddr" data-bind-shuoshuo="geoaddr"></lebal>
                <div class="geo">
                    <p>维度：<span data-bind-shuoshuo="geolat" class="geolat"></span></p>
                    <p>经度：<span data-bind-shuoshuo="geolng" class="geolng"></span></p>
                    <p>位置:
                        <select name="location" class="geoaddr" data-bind-shuoshuo="geoaddr">
                            <option value="<?php /*echo $cur_geoaddr; */?>"><?php /*echo $cur_geoaddr; */?></option>
                        </select>
                    </p>
                    <p class="error"></p>
                </div>
                <input type="button" value="更新坐标" onclick="getGeoLocation()">
                <input type="submit" id="submit-shuoshuo"  onclick="return false;" value="提交">
            </form>
    </div>
    <div class="loads">

    </div>

    <div id="wrapper">
        <h3>近期说说(20)</h3>
        <ul id="rct-shuoshuo">
            <?php
            $shuoshuos = $lbshuoshuo->get_recent_shuoshuos(10);
            foreach($shuoshuos as $s){
                $id = $s->id;
                $source = $s->source;
                $date = $s->date;
                echo "<li data-id='$id'>$source <span class='date'>-$date</span>
                            <input type='button' value='编辑'class='edit'> 
                            <input type='button' value='删除'class='delete'> 
                            </li>";
            }
            ?>
        </ul>
    </div>
    </section>

<?php
    require_once ('footer.php');
}

function edit_shuoshuo($id){
    global $lbshuoshuo;
    $dbss = $lbshuoshuo->get_shuoshuo_by_id($id);
    $shuoshuo = json_encode($dbss);
    //$shuoshuo = str_replace(['\\', '\''],['\\\\', '\\\''], $shuoshuo);
    //var_dump($shuoshuo);
    return $shuoshuo;
}

function delete_shuoshuo($id){
    global $lbshuoshuo;
    global $lbdb;
    $shuoshuo_rep = [];
    if ($ret = $lbshuoshuo->delete_shuoshuo_by_id($id)){
        $shuoshuo_rep['repCode'] = 0;
        $shuoshuo_rep['repInfo'] = '删除说说成功';
    }
    else{
        if($ret == 0){
            $shuoshuo_rep['repInfo'] = '删除说说失败(说说id不存在)';
        }
        $shuoshuo_rep['repCode'] = -1;
        $shuoshuo_rep['repInfo'] = '删除说说失败(['.$lbdb->errno.']'.$lbdb->error.']';
    }
    return json_encode($shuoshuo_rep);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') :
    shuoshuo_main();
    ?>

<?php
else : //POST

    if (isset($_POST['id']) && $_POST['id']>0){
        $ret = $lbshuoshuo->update_shuoshuo_by_id($_POST);
        if ($ret == true){
            $rep['repCode'] = 0;
            $rep['repInfo'] = '修改说说成功';
        } else{
            $rep['repCode'] = -1;
            $rep['repInfo'] = '修改说说失败(['.$lbdb->errno.']'.$lbdb->error.']';
        }
        echo json_encode($rep);
    } else if (!isset($_POST['id'])){
        $ret = $lbshuoshuo->insert_shuoshuo($_POST);
        if($ret){
            $rep['repCode'] = 0;
            $rep['repInfo'] = '发表说说成功';
        } else {
            $rep['repCode'] = $lbdb->errno;
            $rep['repInfo'] = $lbdb->error;
        }
        echo json_encode($rep);
    }


endif;

