<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/15
 * Time: 14:40
 */

require_once ('header.php');
?>
<div id="content_wrap">
    <div id="shuoshuo">
        <?php

        $shuoshuo = $lbshuoshuo->get();
        if ($shuoshuo){
            echo "<ul class='shuoshuo'>$shuoshuo->content 
            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>";

            echo "</ul>";
        }
        ?>
    </div>

    <div id=""></div>
</div>

<?php
require_once ('footer.php');
