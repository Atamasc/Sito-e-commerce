<?php
session_start();
session_unset();
session_destroy();

setcookie('login', null);
setcookie('username', null);
setcookie('password', null);

header('location:index.php');
?>