<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/22
 * Time: 16:30
 */
require_once ('load.php');
require_once('header.php');


$logined = login_auth(true);
if($logined){
    admin_header();
    require_once ('footer.php');
}
