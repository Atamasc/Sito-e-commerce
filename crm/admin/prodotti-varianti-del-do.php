<?php include 'inc/autoloader.php'; ?>

<?php
$get_pr_id = (int)$_GET['pr_id'];
$get_vr_id = (int)$_GET['vr_id'];

$querySql = "SELECT vr_immagine FROM vr_varianti WHERE vr_id = $get_vr_id";
$result = $dbConn->query($querySql);
list($vr_immagine, $get_vr_id) = $result->fetch_row();
$result->close();

if(is_file("$upload_path_dir_prodotti/$vr_immagine")) unlink("$upload_path_dir_prodotti/$vr_immagine");

$querySql = "DELETE FROM vr_varianti WHERE vr_id = $get_vr_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: prodotti-varianti-add.php?pr_id=$get_pr_id&delete=$delete");
?>
