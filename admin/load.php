<?php

define('LB_VERSION', '1.0.1');

require_once('setup/config.php');
require_once ('models/base.php');

require_once ('utils/utils.php');
require_once ('utils/die.php');

//require_once('login/login_auth.php');
require_once ('query.php');

$lbquery = new LB_Query();
