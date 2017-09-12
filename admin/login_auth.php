<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/5
 * Time: 17:21
 */

require_once ('models/options.php');
//$lbopt = new LB_Options();

function login_auth_password($arg = []){
    global $lbopt;
    $saved_user = $lbopt->get('user');
    $saved_passwd = $lbopt->get('password');

    if ($arg['user'] === $saved_user && $arg['password'] === $saved_passwd){
        setcookie('login',$saved_user.','.$saved_passwd, time()+24*60*60,'/');
        return true;
    }

    else
        return false;
}

function login_auth($redirect = false){
    global $lbopt;
    $cookie_login = $_COOKIE['login'] ?? '';
    $loggedin = $cookie_login && $cookie_login === login_gen_cooike();
    if (!$loggedin){
        if ($redirect){
            $home = 'http://'.$lbopt->get('lxbhome');
            $url = $home.'/admin/login.php?url='.urlencode($_SERVER['REQUEST_URI']);
            header('HTTP/1.1 302 Login Required');
            header('Location: '.$url);
            die(0);
        }
        return false;
    }
    return true;
}

function login_gen_cooike(){
    global $lbopt;
    $user = $lbopt->get('user');
    $password = $lbopt->get('password');
    return $user.','.$password;
}
