<?php
include "inc/db-conn.php";
include "inc/config.php";
include "bin/function.php";

$cod = isset($_GET['cod']) ? (int)$_GET['cod'] : 0;
$url = isset($_GET['url']) ? $_GET['url'] : $rootBasePath_http;
$email = isset($_GET['email']) ? stripslashes($_GET['email']) : "";

if(is_base64_encoded($url)) $url = base64_decode($url);

if($cod != 0) {
    $querySql_no = "UPDATE ol_ordini_log SET ol_stato_lettura = 1, ol_click = ol_click + 1 WHERE ol_timestamp = '$cod' AND ol_email = '$email' ";
    $result_no = $dbConn->query($querySql_no);
}

echo "<meta http-equiv='refresh' content='0;url=$url' />";
?>