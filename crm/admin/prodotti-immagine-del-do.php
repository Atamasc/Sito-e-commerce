<?php include "inc/autoloader.php"; ?>
<?php
$pr_id = (int)$_GET['pr_id'];

$querySql = "SELECT pr_immagine FROM pr_prodotti WHERE pr_id = $pr_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $pr_immagine = $row_data['pr_immagine'];

    if(strlen($pr_immagine) > 0) {
        unlink("$upload_path_dir_prodotti/$pr_immagine");

    }
}

$result->close();

$querySql = "UPDATE pr_prodotti SET pr_immagine = '' WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location:prodotti-mod.php?pr_id=$pr_id&update=true");
else header("Location:prodotti-mod.php?pr_id=$pr_id&update=false");

?>