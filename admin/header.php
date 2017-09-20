<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/8/13
 * Time: 12:37
 */

login_auth(true);

function admin_header(){
    global $lbopt;
    $blogname = $lbopt->get('blogname');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理 - <?php echo htmlspecialchars($blogname); ?></title>
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/pubsub.js"></script>
    <script src="js/admin.js"></script>
</head>
<body>
    <header id="nav">
        <nav class="left">
            <ul>
                <a href="/"><li>首页</li></a>
                <a id="shuoshuo" href="shuoshuo.php"><li>发表说说</li></a>
                <a href="/admin/login.php?do=logout"><li>退出</li></a>
            </ul>
        </nav>
    </header>
<?php
}