<?php include "inc/autoloader.php"; ?>
<?php
$vr_id = (int)$_GET['vr_id'];

$querySql = "SELECT vr_immagine FROM vr_varianti WHERE vr_id = $vr_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $vr_immagine = $row_data['vr_immagine'];

    if(strlen($vr_immagine) > 0) {
        unlink("$upload_path_dir_prodotti/$vr_immagine");

    }
}

$result->close();

$querySql = "UPDATE vr_varianti SET vr_immagine = '' WHERE vr_id = '$vr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location:prodotti-varianti-mod.php?vr_id=$vr_id&update=true");
else header("Location:prodotti-varianti-mod.php?vr_id=$vr_id&update=false");

?>