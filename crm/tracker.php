<?php
include "inc/db-conn.php";

header("Content-Type: image/png");
readfile("pixel.png");

$cod = isset($_GET['cod']) ? (int)$_GET['cod'] : 0;
$email = isset($_GET['email']) ? stripslashes($_GET['email']) : "";

$querySql_no = "UPDATE no_newsletter_log SET no_stato_lettura = 1 WHERE no_timestamp = '$cod' AND no_email = '$email' ";
$result_no = $dbConn->query($querySql_no);
?>