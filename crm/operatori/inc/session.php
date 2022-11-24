<?php
session_start();

$session_login = $_SESSION['login'];
$session_id = $_SESSION['id'];
$session_username = $_SESSION['username'];
$session_password = $_SESSION['password'];

$cookie_login = $_COOKIE['login'];
$cookie_id = $_COOKIE['id'];
$cookie_username = $_COOKIE['username'];
$cookie_password = $_COOKIE['password'];

$checkCookie = $cookie_login."|".$cookie_username."|".$cookie_password;
$checkSession = $session_login."|".$session_username."|".$session_password;
$checkCredentialSession = get_access_credential_op($session_username, $session_password, $dbConn);
$checkCredentialCookie = get_access_credential_op($cookie_username, $cookie_password, $dbConn);

if ($checkSession != $checkCredentialSession) {

    $session_login = $_COOKIE['login'];
    $session_id = $_COOKIE['id'];
    $session_username = $_COOKIE['username'];
    $session_password = $_COOKIE['password'];

    if ($checkCookie != $checkCredentialCookie) {
        header('location:logout.php');
    }
}

?>
