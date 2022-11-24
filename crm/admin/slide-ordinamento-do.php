<?php include 'inc/autoloader.php'; ?>

<?php
$get_sl_id = (int)$_GET['sl_id'];
$sl_posizione = (int)$_GET['sl_posizione'];

$querySql = "UPDATE sl_slide SET sl_posizione = '$sl_posizione' WHERE sl_id = '$get_sl_id'";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$update = $rows > 0 ? 'true' : 'false';
header("Location: slide-gst.php?update=$update");
?>