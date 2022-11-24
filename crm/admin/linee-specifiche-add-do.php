<?php include 'inc/autoloader.php'; ?>
<?php
$ln_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_codice'])));
$ln_video = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_video'])));
$ln_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_descrizione'])));

$ln_timestamp = time();

$ln_banner_tmp = $_FILES['ln_banner']['tmp_name'];
$ln_banner_name = $_FILES['ln_banner']['name'];
$ln_banner_error = $_FILES['ln_banner']['error'];

if (strlen($ln_banner_tmp) > 0){

    $ln_banner_ext = end(explode('.', $ln_banner_name));
    $ln_banner = "$ln_timestamp.$ln_banner_ext";

    $destination_dir_ln_banner = "$upload_path_dir_linee/$ln_banner";

    if($ln_banner_error == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($ln_banner_tmp)) {
            @move_uploaded_file($ln_banner_tmp, $destination_dir_ln_banner);
            //checkImageName($destination_dir_ln_immagine, "$upload_path_dir_progetti/$ln_path/immagini/$ln_timestamp", '800x600', "IMG-800x600.jpg");
        }
    }
    
};

$querySql = "INSERT INTO ln_linee(ln_codice, ln_video, ln_descrizione, ln_banner) VALUES ('$ln_codice','$ln_video','$ln_descrizione','$ln_banner')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: linee-specifiche.php?insert=$insert&pr_codice_linea=$ln_codice");
?>