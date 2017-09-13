<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/8/15
 * Time: 21:51
 */

require_once ('load.php');
require_once ('header.php');

admin_header();
$shuoshuos = $lbshuoshuo->get_recent_shuoshuos(10);

if ($_SERVER['REQUEST_METHOD'] === 'GET') :
    $id = $_GET['id'] ?? '';
    if(isset($id) && $id > 0){
        $cur_shuoshuo = $lbshuoshuo->get_shuoshuo_by_id($id);
        $cur_content  = $cur_shuoshuo->content;
        $cur_source   = $cur_shuoshuo->source;
        $cur_date     = $cur_shuoshuo->date;
        $cur_geolat   = $cur_shuoshuo->geo_lat;
        $cur_geolng   = $cur_shuoshuo->geo_lng;
        $cur_geoaddr  = $cur_shuoshuo->geo_addr;
    } else {
        $cur_shuoshuo = '';
        $cur_content  = '';
        $cur_source   = '';
        $cur_date     = '';
        $cur_geolat   = '';
        $cur_geolng   = '';
        $cur_geoaddr  = '';
    }
    ?>
<section id="main">
    <div id="post-shuoshuo">
        <h3>发表说说</h3>
        <form method="post">
            <input type="text" name="id" style="display: block;"
                   value="<?php echo ($id && $id>0)?$id:$lbshuoshuo->get_id()+1; ?>">
            <textarea name="content" id="" cols="30" rows="10" style="display: block;"
                      placeholder="说说内容"><?php echo $cur_content; ?></textarea>
            <lebal>时间:<input type="datetime" name="date" value="<?php echo $cur_date; ?>"></lebal>
            <lebal>经度:<input type="text" name="geolat" value="<?php echo $cur_geolat; ?>"></lebal>
            <lebal>纬度:<input type="text" name="geolng" value="<?php echo $cur_geolng; ?>"></lebal>
            <lebal>位置:<input type="text" name="geoaddr" value="<?php echo $cur_geoaddr; ?>"></lebal>
            <p class="geo">坐标:<?php echo $id>0 ? "经度:".$cur_geolat."纬度:".$cur_geolng :''; ?></p>
            <p>位置:
                <select name="location" id="location">
                    <option value="<?php echo $cur_geoaddr; ?>"><?php echo $cur_geoaddr; ?></option>
                </select>
            </p>
            <input type="button" value="更新坐标" onclick="getGeoLocation()">
            <input type="button" value="提交">
        </form>
    </div>
    <div class="loads">

    </div>

    <div id="wrapper">
        <h3>近期说说(20)</h3>
        <ul id="rct-shuoshuo">
            <?php
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
else :

endif;

require_once ('footer.php');