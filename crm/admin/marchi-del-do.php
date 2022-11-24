<?php include 'inc/autoloader.php'; ?>

<?php
$get_mr_id = (int)$_GET['mr_id'];

$querySql = "SELECT mr_immagine FROM mr_marchi WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
list($mr_immagine, $get_pr_id) = $result->fetch_row();
$result->close();

if(is_file("$upload_path_dir_marchi/$mr_immagine")) unlink("$upload_path_dir_marchi/$mr_immagine");

$querySql = "DELETE FROM mr_marchi WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: marchi-gst.php?mr_id=$get_mr_id&delete=$delete");
?>