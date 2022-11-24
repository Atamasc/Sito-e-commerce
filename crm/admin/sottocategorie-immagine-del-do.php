<?php include "inc/autoloader.php"; ?>
<?php
$st_id = (int)$_GET['st_id'];

$querySql = "SELECT st_immagine FROM st_sottocategorie WHERE st_id = $st_id ";
$result = $dbConn->query($querySql);
$st_immagine = $result->fetch_array()[0];
$result->close();

if (strlen($st_immagine) > 0) unlink("$upload_path_dir_sottocategorie/$st_immagine");

$querySql = "UPDATE st_sottocategorie SET st_immagine = '' WHERE st_id = '$st_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: sottocategorie-mod.php?st_id=$st_id&update=true");
else header("Location: sottocategorie-mod.php?st_id=$st_id&update=false");
?>