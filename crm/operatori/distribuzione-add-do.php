<?php include "inc/autoloader.php"; ?>
<?php
$di_op_id = (int)$_GET['di_op_id'];
$di_targa = $dbConn->real_escape_string(stripslashes(trim($_GET["di_targa"])));
$di_timestamp = $dbConn->real_escape_string(stripslashes(trim($_GET["di_timestamp"])));

$querySql =
    "INSERT INTO di_distribuzione (di_op_id, di_targa, di_uscita, di_timestamp) VALUES ('$di_op_id', '$di_targa', 1, '$di_timestamp') ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$di_id = $dbConn->insert_id;

if($rows > 0) header("Location: distribuzione-gst.php?insert=true");
else header("Location: distribuzione-gst.php?insert=false");
?>