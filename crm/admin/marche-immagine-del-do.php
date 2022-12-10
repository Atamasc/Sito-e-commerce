<?php include "inc/autoloader.php"; ?>
<?php
$mr_id = (int)$_GET['mr_id'];

$querySql = "SELECT mr_immagine FROM mr_marche WHERE mr_id = '$mr_id' ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $mr_immagine = $row_data['mr_immagine'];

    if (strlen($mr_immagine) > 0) {
        unlink("$upload_path_dir_marche/$mr_immagine");

    }
}

$result->close();

$querySql = "UPDATE mr_marche SET mr_immagine = '' WHERE mr_id = '$mr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($rows > 0) header("Location:marche-mod.php?mr_id=$mr_id&update=true");
else header("Location:marche-mod.php?mr_id=$mr_id&update=false");

?>