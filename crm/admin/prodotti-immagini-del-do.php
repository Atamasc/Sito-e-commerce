<?php include 'inc/autoloader.php'; ?>

<?php
$get_pi_id = (int)$_GET['pi_id'];
$get_pr_id = (int)$_GET['pr_id'];

$querySql = "SELECT pi_immagine, pi_pr_id FROM pi_prodotti_immagini WHERE pi_id = $get_pi_id";
$result = $dbConn->query($querySql);
list($pi_immagine, $get_pr_id) = $result->fetch_row();
$result->close();

if(is_file("$upload_path_dir_prodotti_img/$pi_immagine")) unlink("$upload_path_dir_prodotti_img/$pi_immagine");

$querySql = "DELETE FROM pi_prodotti_immagini WHERE pi_id = $get_pi_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: prodotti-immagini-add.php?pr_id=$get_pr_id&delete=$delete");
?>
