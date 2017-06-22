<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/22
 * Time: 17:15
 */
require_once ('login_auth.php');

function html_login($url = ''){
    echo "login";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') :
    $do = $_GET['do'] ?? '';
    if ($do === 'logout'){
        header('HTTP/1.1 302 Logged Out');
        setcookie('longin', '', time()-1,'/');
        header('Location: login.php');
        die(0);
    } else{
        if (login_auth()){
            header('HTTP/1.1 302 Login Success');
            $url = $_GET['url'] ?? '/admin/';
            header('Location '.$url);
            die(0);
        } else {
            $url = $_GET['url'] ?? '';
            html_login($url);
        }
    }
else:
endif;