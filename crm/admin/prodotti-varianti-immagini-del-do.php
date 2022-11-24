<?php include 'inc/autoloader.php'; ?>

<?php
$get_pv_id = (int)$_GET['pv_id'];
$get_pr_id = (int)$_GET['pr_id'];

$querySql = "SELECT pv_immagine, pv_pr_id FROM pv_prodotti_varianti_immagini WHERE pv_id = $get_pv_id";
$result = $dbConn->query($querySql);
list($pv_immagine, $get_pr_id) = $result->fetch_row();
$result->close();

if(is_file("$upload_path_dir_varianti_img/$pv_immagine")) unlink("$upload_path_dir_varianti_img/$pv_immagine");

$querySql = "DELETE FROM pv_prodotti_varianti_immagini WHERE pv_id = $get_pv_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: prodotti-varianti-immagini-add.php?pr_id=$get_pr_id&delete=$delete");
?>
