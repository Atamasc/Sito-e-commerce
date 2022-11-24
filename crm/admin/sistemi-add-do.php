<?php include 'inc/autoloader.php'; ?>
<?php
$si_sistema = $dbConn->real_escape_string(stripslashes(trim($_POST['si_sistema'])));
$si_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['si_codice'])));
$si_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['si_descrizione'])));
$si_title = $dbConn->real_escape_string(stripslashes(trim($_POST['si_title'])));
$si_meta_keywords = $dbConn->real_escape_string(stripslashes(trim($_POST['si_meta_keywords'])));
$si_meta_desc = $dbConn->real_escape_string(stripslashes(trim($_POST['si_meta_desc'])));

$si_timestamp = time();

//IMMAGINE
$si_immagine_tmp = $_FILES['si_immagine']['tmp_name'];
$si_immagine_name = $_FILES['si_immagine']['name'];
$si_immagine_error = $_FILES['si_immagine']['error'];

$si_immagine = "";
if (strlen($si_immagine_tmp) > 0) {

    $si_immagine_ext = end(explode('.', $si_immagine_name));
    $si_immagine = "$si_timestamp.$si_immagine_ext";

    $destination_dir_si_immagine = "$upload_path_dir_sistemi/$si_immagine";

    if($si_immagine_error == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($si_immagine_tmp)) {
            @move_uploaded_file($si_immagine_tmp, $destination_dir_si_immagine);
            //checkImageName($destination_dir_si_immagine, "$upload_path_dir_progetti/$si_path/immagini/$si_timestamp", '800x600', "IMG-800x600.jpg");
        }
    }

}

//BANNER
$si_banner_tmp = $_FILES['si_banner']['tmp_name'];
$si_banner_name = $_FILES['si_banner']['name'];
$si_banner_error = $_FILES['si_banner']['error'];

$si_banner = "";
if (strlen($si_banner_tmp) > 0) {

    $si_banner_ext = end(explode('.', $si_banner_name));
    $si_banner = "$si_timestamp.$si_banner_ext";

    $destination_dir_si_banner = "$upload_path_dir_sistemi/$si_banner";

    if($si_banner_error == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($si_banner_tmp)) {
            @move_uploaded_file($si_banner_tmp, $destination_dir_si_banner);
            //checkImageName($destination_dir_si_banner, "$upload_path_dir_progetti/$si_path/immagini/$si_timestamp", '800x600', "IMG-800x600.jpg");
        }
    }

}


$querySql =
    "INSERT INTO si_sistemi(".
    "si_sistema, si_codice, si_immagine, si_banner, si_descrizione, si_title, si_meta_keywords, si_meta_desc, si_timestamp, si_stato".
    ") VALUES (".
    "'$si_sistema', '$si_codice', '$si_immagine', '$si_banner', '$si_descrizione', '$si_title', '$si_meta_keywords', '$si_meta_desc', '$si_timestamp', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: sistemi-add.php?insert=$insert");
?>