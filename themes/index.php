<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/15
 * Time: 14:40
 */

require_once ('header.php');
?>
<section id="rct-shuoshuo">
    <div class="content">
        <h3>近期说说</h3>
        <?php
        $shuoshuos = null;
        $shuoshuos = $lbshuoshuo->get_recent_shuoshuos(); ?>
        <script src="themes/js/shuoshuo.js"></script>
        <ul id="shuoshuo-list">
            <div id="shuoshuo-comment">
                <form action="" method="post">
                    <input type="text" name="id" value='' hidden>
                    <input type="text" name="visitor" placeholder="你叫啥子">
                    <input type="email" name="email" placeholder="邮箱多少" required><br>
                    <textarea name="comment" id="" rows="5"
                              placeholder="你想说啥子" required></textarea>
                    <input type="submit" value="发表">
                </form>
            </div><?php
            if (isset($shuoshuos)) {
                foreach ($shuoshuos as $shuoshuo){?>
                    <li data-shuoshuo-id=<?php echo $shuoshuo->id ?> >
                        <?php echo $shuoshuo->source ?>
                        <i class="fa fa-commenting"></i>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    <script src="/themes/js/shuoshuo.js"></script>
    </div>
</section>
<section id="rcmd-article">
    <div class="content">
        <h3 style="display: none;">推荐文章</h3>
    </div>
</section>
<section id="rct-article">
    <div class="content">
        <h3>近期文章</h3>
        <?php
        $posts = null;
        $posts = $lbpost->get_recent_articles_by_tag(10,''); ?>
        <ul class="shuoshuo-list"><?php
            if (isset($posts)) {
                foreach ($posts as $post){?>
                    <li data-article-id=<?php echo $post->id ?>>
                        <a href="#"><?php echo $post->title; ?></a>
                        <span style="float: right; font-size: 0.8em;">
                            <?php echo "发布于".$post->date;  ?></span>
                    </li>
                <?php } ?>
        <?php } ?>
        </ul>
    </div>
</section>

<?php
require_once ('footer.php');