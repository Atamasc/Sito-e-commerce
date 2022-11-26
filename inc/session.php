<?php
session_start();
session_id();

$session_cl_login = isset($_SESSION['cl_login']) ? (int)$_SESSION['cl_login'] : 0;
$session_cl_codice = isset($_SESSION['cl_codice']) ? $_SESSION['cl_codice'] : session_id();
?>