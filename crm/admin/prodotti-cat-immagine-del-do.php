<?php include "inc/autoloader.php"; ?>
<?php
$ct_id = (int)$_GET['ct_id'];

$querySql = "SELECT ct_immagine FROM ct_categorie WHERE ct_id = $ct_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $ct_immagine = $row_data['ct_immagine'];

    if (strlen($ct_immagine) > 0) {
        unlink("$upload_path_dir_categorie/$ct_immagine");

    }
}

$result->close();

$querySql = "UPDATE ct_categorie SET ct_immagine = '' WHERE ct_id = '$ct_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($rows > 0) header("Location:categoria-mod.php?ct_id=$ct_id&update=true");
else header("Location:categoria-mod.php?ct_id=$ct_id&update=false");

?>