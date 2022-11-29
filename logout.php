<?php
include "inc/db-conn.php";
include "inc/config.php";

session_start();
session_unset();
session_destroy();

setcookie('ut_login', null);
setcookie('ut_codice', null);
setcookie('ut_tipo', null);

header("Location:$rootBasePath_http");
?>