<?php
include "inc/db-conn.php";

header("Content-Type: image/png");
readfile("pixel.png");

$cod = isset($_GET['cod']) ? (int)$_GET['cod'] : 0;
$email = isset($_GET['email']) ? stripslashes($_GET['email']) : "";

$querySql_no = "UPDATE ol_ordini_log SET ol_stato_lettura = 1 WHERE ol_timestamp = '$cod' AND ol_email = '$email' ";
$result_no = $dbConn->query($querySql_no);
?>