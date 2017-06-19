<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/15
 * Time: 14:40
 */

require_once ('header.php');
?>
<div id="shuoshuo">
    <?php
        $shuoshuo = $lbshuoshuo->get();
        echo "<ul class='shuoshuo'>$shuoshuo->content";

        echo "</ul>"
    ?>
</div>
<?php
require_once ('footer.php');
