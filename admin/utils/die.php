<?php
/**
 * Created by PhpStorm.
 * User: lgw
 * Date: 2017/6/9
 * Time: 14:54
 */

function lb_die($code, $err){
    $status = [
        200 => 'HTTP/1.1 200 OK',
        403 => 'HTTP/1.1 403 Forbidden',
        400 => 'HTTP/1.1 400 Bad Request',
        503 => 'HTTP/1.1 503 Service Unavailable',
    ];
    header($status[$code]);

    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LXBblog</title>
</head>
<body>
    <?php echo '<center>'.$err.'</center>'; ?>
</body>
</html>

<?php die(-1);
}