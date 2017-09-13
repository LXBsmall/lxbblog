<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/8/13
 * Time: 14:11
 */
require_once ('load.php');

$type = $_GET['type'];
if (isset($type) && $type != ''){
    if($type == 'shuoshuo'){
        rep_shuoshuo();
    }
}

function rep_shuoshuo(){
    global $lbshuoshuo;
    ?>
    <div id="post-shuoshuo">
        <h2>发表说说</h2>
        <form action="">
            id=<?php echo $lbshuoshuo->get_new_id()+1; ?><br>
            <textarea name="content" id="" cols="30" rows="10" placeholder="说说内容"></textarea><br>
<!--            <lebal>时间:<input type="datetime"></lebal>-->
            <p class="geo">地理位置:</p>
            <select name="location" id="location" style="width: 200px;">
                <option value="选择位置" selected>选择位置</option>
            </select>
            <br><br>
            <input type="button" value="提交">
        </form>
    </div>
<?php
}