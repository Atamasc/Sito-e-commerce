<?php include "inc/autoloader.php"; ?>
<?php
$bl_id = (int)$_GET['bl_id'];

$querySql = "SELECT bl_path, bl_immagine FROM bl_blog WHERE bl_id = $bl_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $bl_path_immagini = $row_data['bl_path_immagini'];
    $bl_immagine = $row_data['bl_immagine'];

    if(strlen($bl_immagine) > 0) {

        $files = glob("$upload_path_dir_prodotti/$bl_path/IMG-*");
        foreach($files as $file) if(is_file($file)) unlink($file);

    }
}

$result->close();

$querySql = "UPDATE bl_blog SET bl_immagine = '' WHERE bl_id = '$bl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location:blog-mod.php?bl_id=$bl_id&update=true");
else header("Location:blog-mod.php?bl_id=$bl_id&update=false");

?>