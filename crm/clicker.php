<?php
include "inc/db-conn.php";
include "inc/config.php";
include "bin/function.php";

$cod = isset($_GET['cod']) ? (int)$_GET['cod'] : 0;
$url = isset($_GET['url']) ? $_GET['url'] : $rootBasePath_http;
$email = isset($_GET['email']) ? stripslashes($_GET['email']) : "";

if(is_base64_encoded($url)) $url = base64_decode($url);

if($cod != 0) {
    $querySql_no = "UPDATE no_newsletter_log SET no_stato_lettura = 1, no_click = no_click + 1 WHERE no_timestamp = '$cod' AND no_email = '$email' ";
    $result_no = $dbConn->query($querySql_no);
}

echo "<meta http-equiv='refresh' content='0;url=$url' />";
?>