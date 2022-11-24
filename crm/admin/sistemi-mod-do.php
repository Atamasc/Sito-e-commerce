<?php include 'inc/autoloader.php'; ?>
<?php
$si_id = (int)$_POST['si_id'];
$si_sistema = $dbConn->real_escape_string(stripslashes(trim($_POST['si_sistema'])));
$si_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['si_codice'])));
$si_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['si_descrizione'])));
$si_title = $dbConn->real_escape_string(stripslashes(trim($_POST['si_title'])));
$si_meta_keywords = $dbConn->real_escape_string(stripslashes(trim($_POST['si_meta_keywords'])));
$si_meta_desc = $dbConn->real_escape_string(stripslashes(trim($_POST['si_meta_desc'])));

$si_timestamp = time();


//IMMAGINE
$querySql = "SELECT si_immagine FROM si_sistemi WHERE si_id = $si_id";
$result = $dbConn->query($querySql);
$si_immagine = $result->fetch_row()[0];
$result->close();

$si_immagine_tmp = $_FILES['si_immagine']['tmp_name'];
$si_immagine_name = $_FILES['si_immagine']['name'];
$si_immagine_error = $_FILES['si_immagine']['error'];

if(strlen($si_immagine_tmp) > 0) {

    if(is_file("$upload_path_dir_sistemi/$si_immagine")) unlink("$upload_path_dir_sistemi/$si_immagine");

    $si_immagine_ext = end(explode('.', $si_immagine_name));
    $si_immagine = "$si_timestamp.$si_immagine_ext";

    $destination_dir_si_immagine = "$upload_path_dir_sistemi/$si_immagine";

    if ($si_immagine_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($si_immagine_tmp)) {
            @move_uploaded_file($si_immagine_tmp, $destination_dir_si_immagine);
            //checkImageName($destination_dir_si_immagine, "$si_full_path", '800x600', "IMG-$si_timestamp-800x600.jpg");
        }
    }
}


//BANNER
$querySql = "SELECT si_banner FROM si_sistemi WHERE si_id = $si_id";
$result = $dbConn->query($querySql);
$si_banner = $result->fetch_row()[0];
$result->close();

$si_banner_tmp = $_FILES['si_banner']['tmp_name'];
$si_banner_name = $_FILES['si_banner']['name'];
$si_banner_error = $_FILES['si_banner']['error'];

if(strlen($si_banner_tmp) > 0) {

    if(is_file("$upload_path_dir_sistemi/$si_banner")) unlink("$upload_path_dir_sistemi/$si_banner");

    $si_banner_ext = end(explode('.', $si_banner_name));
    $si_banner = "$si_timestamp.$si_banner_ext";

    $destination_dir_si_banner = "$upload_path_dir_sistemi/$si_banner";

    if ($si_banner_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($si_banner_tmp)) {
            @move_uploaded_file($si_banner_tmp, $destination_dir_si_banner);
            //checkImageName($destination_dir_si_banner, "$si_full_path", '800x600', "IMG-$si_timestamp-800x600.jpg");
        }
    }
}


$querySql = "UPDATE si_sistemi SET si_sistema = '$si_sistema', si_codice = '$si_codice', si_immagine = '$si_immagine', si_banner = '$si_banner', si_title = '$si_title', si_meta_keywords = '$si_meta_keywords', si_meta_desc = '$si_meta_desc', si_descrizione = '$si_descrizione' WHERE si_id = $si_id";
$result = $dbConn->query($querySql);

header("Location: sistemi-mod.php?si_id=$si_id&update=true");
?>