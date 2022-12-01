<?php include 'inc/autoloader.php'; ?>
<?php
$mr_id = (int)$_POST['mr_id'];
$mr_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_titolo'])));
$mr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_codice'])));
$mr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_descrizione'])));
$mr_timestamp = time();

$querySql = "SELECT mr_immagine FROM mr_marche WHERE mr_id = $mr_id";
$result = $dbConn->query($querySql);
$mr_immagine = $result->fetch_row()[0];
$result->close();

$mr_immagine_tmp = $_FILES['mr_immagine']['tmp_name'];
$mr_immagine_name = $_FILES['mr_immagine']['name'];
$mr_immagine_error = $_FILES['mr_immagine']['error'];

if (strlen($mr_immagine_tmp) > 0) {

    if (is_file("$upload_path_dir_marche/$mr_immagine")) unlink("$upload_path_dir_marche/$mr_immagine");

    $mr_immagine_ext = end(explode('.', $mr_immagine_name));
    $mr_immagine = "$mr_timestamp.$mr_immagine_ext";

    $destination_dir_mr_immagine = "$upload_path_dir_marche/$mr_immagine";

    if ($mr_immagine_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($mr_immagine_tmp)) {
            @move_uploaded_file($mr_immagine_tmp, $destination_dir_mr_immagine);
            //checkImageName($destination_dir_mr_immagine, "$mr_full_path", '800x600', "IMG-$mr_timestamp-800x600.jpg");
        }
    }
}

$querySql = "UPDATE mr_marche SET mr_titolo = '$mr_titolo', mr_codice = '$mr_codice', mr_immagine = '$mr_immagine', mr_descrizione = '$mr_descrizione' WHERE mr_id = $mr_id";
$result = $dbConn->query($querySql);

header("Location: marche-mod.php?mr_id=$mr_id&update=true");
?>