<?php
session_start();

$session_login = $_SESSION['login'];
$session_id = $_SESSION['id'];
$session_username = $_SESSION['username'];
$session_password = $_SESSION['password'];

$cookie_login = isset($_COOKIE['login']);
$cookie_username = isset($_COOKIE['username']);
$cookie_password = isset($_COOKIE['password']);

$checkCookie = $cookie_login . "|" . $cookie_username . "|" . $cookie_password;
$checkSession = $session_login . "|" . $session_username . "|" . $session_password;
$checkCredentialSession = get_access_credential($session_username, $session_password, $dbConn);
$checkCredentialCookie = get_access_credential($cookie_username, $cookie_password, $dbConn);

if ($checkCookie != $checkCredentialCookie) {
    if ($checkSession != $checkCredentialSession) {
        header('location:logout.php');
    }
}

?>
