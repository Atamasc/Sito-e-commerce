<?php include 'inc/autoloader.php'; ?>
<?php
$ln_id = (int)$_POST['ln_id'];
$ln_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_codice'])));
$ln_video = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_video'])));
$ln_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ln_descrizione'])));

$ln_timestamp = time();

$querySql = "SELECT ln_banner FROM ln_linee WHERE ln_codice = $ln_codice";
$result = $dbConn->query($querySql);
$ln_banner = $result->fetch_row()[0];
$result->close();

$ln_banner_tmp = $_FILES['ln_banner']['tmp_name'];
$ln_banner_name = $_FILES['ln_banner']['name'];
$ln_banner_error = $_FILES['ln_banner']['error'];

if(strlen($ln_banner_tmp) > 0) {

    if(is_file("$upload_path_dir_linee/$ln_banner")) unlink("$upload_path_dir_linee/$ln_banner");

    $ln_banner_ext = end(explode('.', $ln_banner_name));
    $ln_banner = "$ln_timestamp.$ln_banner_ext";

    $destination_dir_ln_banner = "$upload_path_dir_linee/$ln_banner";

    if ($ln_banner_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($ln_banner_tmp)) {
            @move_uploaded_file($ln_banner_tmp, $destination_dir_ln_banner);
            //checkImageName($destination_dir_ln_banner, "$ln_full_path", '800x600', "IMG-$ln_timestamp-800x600.jpg");
        }
    }
}

$querySql = "UPDATE ln_linee SET ln_video = '$ln_video', ln_descrizione = '$ln_descrizione', ln_banner = '$ln_banner' WHERE ln_id = $ln_id";
$result = $dbConn->query($querySql);

header("Location: linee-specifiche.php?&pr_codice_linea=$ln_codice&update=true");
?>