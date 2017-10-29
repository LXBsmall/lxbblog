<?php
/**
 * Created by PhpStorm.
 * User: lxb
 * Date: 2017/10/29
 * Time: 12:19
 */

login_auth('true');

function admin_header(){
global $lbopt;
global $lbquery;
$blogname = $lbopt->get('blogname');
?>

<!doctype html>
<html lang="ch-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?php
        if($lbquery->is_home()){
            $title = $blogname;
        }
        else{
            $title = '管理平台 - '.htmlspecialchars($blogname);
        }
        echo $title;
        ?>
    </title>
    <!--    <link rel="stylesheet" href="style/sass/style.css">-->
    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/themes/style/style.css">
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/pubsub.js"></script>
</head>

<body>
<div id="wrapper">
    <header id="heading">
        <div class="content">
            <div class="heading">
                <a href="/"><img src="/themes/images/me.JPG" alt="头像" width="100" class="avatar"></a>
                <h2 class="sitename"><?php echo $blogname; ?></h2>
                <p class="moto">多说多错, 不如沉默!</p>
                <form name="search_box" class="search" action="/search" onload="document.search_box.reset()">
                    <img src="/themes/images/search.svg" class="icon"style="height: 1em;"/><!--
                    --><input name="q" placeholder="Google Search" />
                </form>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="/">首页</a></li>
                    <a id="shuoshuo" href="shuoshuo.php"><li>发表说说</li></a>
                    <li><a href="/">发表文章</a></li>
                    <li><a href="/admin/login.php?do=logout">退出后台管理</a></li>
                </ul>
            </div>
        </div>
    </header>
<?php }




