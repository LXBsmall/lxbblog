<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/22
 * Time: 17:15
 */
require_once ('load.php');

function html_login($url = ''){?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style/style.css">
        <title>登录</title>
    </head>
    <body>
    <div class="outer"></div>
    <div class="login-dialog">
        <div class="login">
            <form action="" method="post" class="login-form">
                <h1 class="title">后台管理</h1>
                <div class="input-wrapper">
                    <input type="text" name="user" placeholder="用户名" required/><br>
                    <input type="password" name="password" placeholder="密码" required/><br>
                    <input type="submit"  value="登   录" />
                    <input type="button"  value="取   消" onclick="location.href='/'; "/>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
<?php
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') :
    $do = $_GET['do'] ?? '';
    if ($do === 'logout'){
        header('HTTP/1.1 302 Logged Out Success');
        setcookie('login', '', time()-1,'/');
        header('Location: login.php');
        die(0);
    } else {
        if(login_auth()){
            header('HTTP/1.1 302 Login Success');
            $url = $_GET['url'] ?? '/admin/';
            header('Location:'.$url);
            die(0);
        } else {
            $url = $_SERVER['REQUEST_URI'] ?? '';
            html_login($url);
            die(0);
        }

    }

else ://POST
    $logined = login_auth_password($_POST);
    if($logined){
        header('HTTP/1.1 302 Login Success');
        $url = $_SERVER['REQUEST_URI'] ?? '/admin/';
        header('Location:'.$url);
        die(0);
    } else {
        echo "<script>alert('用户名或密码错, 请重新登录!')</script>";
        html_login();
        die(0);
    }

endif;