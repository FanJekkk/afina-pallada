<?php
session_start();
include("include/db_connect.php");
include("functions/functions.php");
include("include/auth_cookie.php");
unset($_SESSION['auth']);
setcookie('rememberme','',0,'/');
session_destroy();
header('location: /');
?>