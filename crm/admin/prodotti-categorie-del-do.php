<?php include 'inc/autoloader.php'; ?>

<?php
$get_ct_id = (int)$_GET['ct_id'];

$querySql = "SELECT ct_immagine FROM ct_categorie WHERE ct_id = '$get_ct_id' ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $ct_immagine = $row_data['ct_immagine'];

    if(strlen($ct_immagine) > 0) {
        unlink("$upload_path_dir_categorie/$ct_immagine");
    }
}

$result->close();

$querySql = "SELECT st_immagine FROM st_sottocategorie WHERE st_ct_id = '$get_ct_id' ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $st_immagine = $row_data['st_immagine'];

    if(strlen($st_immagine) > 0) {
        unlink("$upload_path_dir_sottocategorie/$st_immagine");
    }
}

$result->close();


$querySql = "DELETE FROM ct_categorie WHERE ct_id = $get_ct_id";
$result = $dbConn->query($querySql);
$rowscat = $dbConn->affected_rows;

$querySql = "DELETE FROM st_sottocategorie WHERE st_ct_id = $get_ct_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rowscat > 0) header("Location: prodotti-categorie-gst.php?delete=true");
else header("Location: prodotti-categorie-gst.php?delete=false");
?>