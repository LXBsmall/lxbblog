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
        if (is_object($shuoshuo)) {
            ?>
            <p class="shuoshuo">
                <?php echo $shuoshuo->source; ?>
                <i class="fa fa-edit comment-edit"></i>
            </p>
            <ul class="shuoshuo">

            </ul>
            <?php
        }
    ?>
    <script src="/themes/js/shuoshuo.js"></script>
</div>
<?php
require_once ('footer.php');
