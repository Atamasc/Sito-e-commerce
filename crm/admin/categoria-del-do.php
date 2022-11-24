<?php include 'inc/autoloader.php'; ?>

<?php
$get_ct_id = (int)$_GET['ct_id'];

$querySql = "SELECT ct_immagine FROM ct_categorie WHERE ct_id = ".$get_ct_id." ";
$result = $dbConn->query($querySql);
$result->close();

if(is_file("$upload_path_dir_categorie/$ct_immagine")) unlink("$upload_path_dir_categorie/$ct_immagine");

$querySql = "DELETE FROM ct_categorie WHERE ct_id = ".$get_ct_id." ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: categoria-gst.php?delete=$delete");
?>