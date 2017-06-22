<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/22
 * Time: 17:15
 */

if ($_SERVER['REQUEST_METHOD'] === 'GET') :
    $do = $_GET['do'];
    if ($do === 'logout'){
        header('HTTP')
        setcookie('longin', '', time()-1,'/');

    }