<?php include "inc/db-conn.php"; ?>
<?php
session_start();

include "bin/api.ebay.php";
$ebay_api = new Ebay($dbConn);

$return_link = $_SESSION['return_link'];
header("Location: $return_link");
?>