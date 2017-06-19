<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/15
 * Time: 15:08
 */

$blogname = $lbopt->get('blogname');
?>

<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php
        if($lbquery->is_home()){

        }
        echo $blogname;
        ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//blog-10005538.file.myqcloud.com/jquery.min.js"></script>
</head>

<body>
<div id="wrapper"></div>
    <header>
        <div class="content">
            <h2 class="sitename"><?php echo $blogname; ?></h2>
            <p class="moto">多说多错, 不如沉默!</p>
            <form name="search_box" class="search" action="/search" onload="document.search_box.reset()">
                <img src="/themes/images/search.svg" class="icon"style="height: 1em;"/><!--
                    --><input name="q" placeholder="Google Search" />
            </form>
            <div class="nav">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="/">文章归档</a></li>
                    <li><a href="/">说说</a></li>
                    <li><a href="/">建议反馈</a></li>
                </ul>
            </div>
        </div>
    </header>
</div>


