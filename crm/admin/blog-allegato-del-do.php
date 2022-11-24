<?php include "inc/autoloader.php"; ?>
<?php
$bl_id = (int)$_GET['bl_id'];
$bl_path = "BL-$bl_id";

$querySql = "SELECT bl_allegato FROM bl_blog WHERE bl_id = $bl_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $bl_allegato = $row_data['bl_allegato'];
    if(strlen($bl_allegato) > 0) unlink("$upload_path_dir_blog/$bl_path/$bl_allegato");
}

$result->close();

$querySql = "UPDATE bl_blog SET bl_allegato = '' WHERE bl_id = '$bl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location:blog-mod.php?bl_id=$bl_id&update=true");
else header("Location:blog-mod.php?bl_id=$bl_id&update=false");

?>