<?php include 'inc/autoloader.php'; ?>

<?php
$get_si_id = (int)$_GET['si_id'];

$querySql = "SELECT si_immagine FROM si_sistemi WHERE si_id = $get_si_id";
$result = $dbConn->query($querySql);
list($si_immagine, $get_pr_id) = $result->fetch_row();
$result->close();

if(is_file("$upload_path_dir_sistemi/$si_immagine")) unlink("$upload_path_dir_sistemi/$si_immagine");

$querySql = "DELETE FROM si_sistemi WHERE si_id = $get_si_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: sistemi-gst.php?si_id=$get_si_id&delete=$delete");
?>