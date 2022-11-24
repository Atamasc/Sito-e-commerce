<?php include('inc/autoloader.php'); ?>
<?php
$ro_id = (int)$_GET["ro_id"];

$querySql = "DELETE FROM ro_richiesta_offerta WHERE ro_id = $ro_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<script>window.location=document.referrer;</script>";
} else {
    echo "<script>window.location=document.referrer;</script>";
};
?>
