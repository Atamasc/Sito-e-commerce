<?php include 'inc/autoloader.php'; ?>

<?php
$get_sl_id = (int)$_GET['sl_id'];

$querySql = "SELECT sl_immagine FROM sl_slide WHERE sl_id = $get_sl_id";
$result = $dbConn->query($querySql);
$result->close();

if(is_file("$upload_path_dir_slide/$sl_immagine")) unlink("$upload_path_dir_slide/$sl_immagine");

$querySql = "DELETE FROM sl_slide WHERE sl_id = $get_sl_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: slide-gst.php?sl_id=$get_sl_id&delete=$delete");
?>