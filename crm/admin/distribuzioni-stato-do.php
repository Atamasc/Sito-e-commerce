<?php include('inc/autoloader.php'); ?>
<?php
$di_id = (int)$_GET["di_id"];

$querySql = "UPDATE di_distribuzione SET di_uscita = 1 - di_uscita WHERE di_id = '$di_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
