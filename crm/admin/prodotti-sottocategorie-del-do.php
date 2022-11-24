<?php include 'inc/autoloader.php'; ?>

<?php
$ct_id = (int)$_GET["ct_id"];
$st_id = (int)$_GET["st_id"];

$querySql = "SELECT st_immagine FROM st_sottocategorie WHERE st_id = '$st_id' ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $st_immagine = $row_data['st_immagine'];

    if(strlen($st_immagine) > 0) {
        unlink("$upload_path_dir_sottocategorie/$st_immagine");
    }
}

$result->close();


$querySql = "DELETE FROM st_sottocategorie WHERE st_id = $st_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-sottocategorie-gst.php?delete=true");
else header("Location: prodotti-sottocategorie-gst.php?delete=false");
?>