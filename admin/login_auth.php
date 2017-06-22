<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/5
 * Time: 17:21
 */
require_once ('models/options.php');

$lbopt = new LB_Options();

function login_auth_password($arg = []){
    global $lbopt;
    $saved_user = $lbopt->get('user') ?? '';
    $saved_passwd = $lbopt->get('password') ?? '';

    if ($arg['user'] === $saved_user && $arg['password'] === $saved_passwd)
        return true;
    else
        return false;
}

function login_auth(){
    global $lbopt;
    $cookie_login = $_COOKIE['login'];
    $loggedin = $cookie_login && $cookie_login === login_gen_cooike();
    if (!$loggedin){
        $home = 'http://'.$lbopt->get('lxbhome');
        $url = $home.'/admin/login.php?url='.urlencode($_SERVER['REQUEST_URI']);
        header('HTTP/1.1 302 Login Required');
        header('Location: '.$url);
        die(0);
    }
    return true;
}

function login_gen_cooike(){
    global $lbopt;
    $saved_user = $lbopt->get('user') ?? '';
    $saved_passwd = $lbopt->get('passwd') ?? '';
    return $saved_user.','.$saved_passwd;
}
