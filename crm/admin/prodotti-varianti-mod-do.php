<?php include "inc/autoloader.php"; ?>
<?php
$vr_id = (int)$_POST['vr_id'];
$pr_id = (int)$_POST['pr_id'];

$vr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['vr_codice'])));
$vr_colore = $dbConn->real_escape_string(stripslashes(trim($_POST['vr_colore'])));
$vr_misura = $dbConn->real_escape_string(stripslashes(trim($_POST['vr_misura'])));
$vr_giacenza = $dbConn->real_escape_string(stripslashes(trim($_POST['vr_giacenza'])));
$vr_stato = $dbConn->real_escape_string(stripslashes(trim($_POST['vr_stato'])));
$vr_timestamp = time();

//Recupero valori del file immagine
$tmp_vr_immagine = $_FILES["vr_immagine"]["tmp_name"];
$vr_immagine_name = $_FILES["vr_immagine"]["name"];
$vr_immagine_size = $_FILES["vr_immagine"]["size"];

$querySql = "SELECT vr_immagine FROM vr_varianti WHERE vr_id = '$vr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$vr_immagine = $row_data['vr_immagine'];
$result->close();

if (strlen($tmp_vr_immagine) > 0){

    if(strlen($vr_immagine) > 0) unlink("$upload_path_dir_prodotti/$vr_immagine");

    $vr_immagine_part = explode(".", $vr_immagine_name);
    $vr_immagine_ext = end($vr_immagine_part);
    $vr_immagine = "vr-"."$vr_timestamp.$vr_immagine_ext";
    $destination_dir_vr_immagine = "$upload_path_dir_prodotti/$vr_immagine";

    if ($_FILES['vr_immagine']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_vr_immagine)) {
            move_uploaded_file($tmp_vr_immagine, $destination_dir_vr_immagine);
        };
    };

}

$querySql =
    "UPDATE vr_varianti SET ".
    "vr_codice = '$vr_codice', vr_colore = '$vr_colore', vr_misura = '$vr_misura', vr_giacenza = '$vr_giacenza', ".
    "vr_immagine = '$vr_immagine', vr_stato = '$vr_stato' ".
    "WHERE vr_id = '$vr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-varianti-mod.php?vr_id=$vr_id&pr_id=$pr_id&update=true");
else header("Location: prodotti-varianti-mod.php?vr_id=$vr_id&pr_id=$pr_id&update=false");
?>