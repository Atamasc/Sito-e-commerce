<?php include 'inc/autoloader.php'; ?>
<?php
$pv_id = (int)$_POST['pv_id'];
$pv_pr_id = (int)$_POST['pv_pr_id'];
$pv_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pv_descrizione'])));
$pv_timestamp = time();

$querySql = "SELECT pv_immagine FROM pv_prodotti_varianti_immagini WHERE pv_id = $pv_id";
$result = $dbConn->query($querySql);
$pv_immagine = $result->fetch_row()[0];
$result->close();

$pv_immagine_tmp = $_FILES['pv_immagine']['tmp_name'];
$pv_immagine_name = $_FILES['pv_immagine']['name'];
$pv_immagine_error = $_FILES['pv_immagine']['error'];

if(strlen($pv_immagine_tmp) > 0) {

    if(is_file("$upload_path_dir_varianti_img/$pv_immagine")) unlink("$upload_path_dir_varianti_img/$pv_immagine");

    $pv_immagine_ext = end(explode('.', $pv_immagine_name));
    $pv_immagine = "$pv_timestamp.$pv_immagine_ext";

    $destination_dir_pv_immagine = "$upload_path_dir_varianti_img/$pv_immagine";

    if ($pv_immagine_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($pv_immagine_tmp)) {
            @move_uploaded_file($pv_immagine_tmp, $destination_dir_pv_immagine);
            //checkImageName($destination_dir_pv_immagine, "$pv_full_path", '800x600', "IMG-$pv_timestamp-800x600.jpg");
        }
    }
}

$querySql = "UPDATE pv_prodotti_varianti_immagini SET pv_pr_id = $pv_pr_id, pv_descrizione = '$pv_descrizione', pv_data = $pv_timestamp, pv_immagine = '$pv_immagine' WHERE pv_id = $pv_id";
$result = $dbConn->query($querySql);

header("Location: prodotti-varianti-immagini-add.php?pv_id=$pv_id&pr_id=$pv_pr_id&update=true");
?>
