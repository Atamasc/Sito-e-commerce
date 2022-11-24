<?php include 'inc/autoloader.php'; ?>
<?php
$mr_marchio = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_marchio'])));
$mr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_codice'])));
$mr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['mr_descrizione'])));

$mr_timestamp = time();

$mr_immagine_tmp = $_FILES['mr_immagine']['tmp_name'];
$mr_immagine_name = $_FILES['mr_immagine']['name'];
$mr_immagine_error = $_FILES['mr_immagine']['error'];

$mr_immagine = "";
if (strlen($mr_immagine_tmp) > 0) {

    $mr_immagine_ext = end(explode('.', $mr_immagine_name));
    $mr_immagine = "$mr_timestamp.$mr_immagine_ext";

    $destination_dir_mr_immagine = "$upload_path_dir_marchi/$mr_immagine";

    if($mr_immagine_error == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($mr_immagine_tmp)) {
            @move_uploaded_file($mr_immagine_tmp, $destination_dir_mr_immagine);
            //checkImageName($destination_dir_mr_immagine, "$upload_path_dir_progetti/$mr_path/immagini/$mr_timestamp", '800x600', "IMG-800x600.jpg");
        }
    }

}

$querySql =
    "INSERT INTO mr_marchi(".
    "mr_marchio, mr_codice, mr_immagine, mr_descrizione, mr_timestamp, mr_stato".
    ") VALUES (".
    "'$mr_marchio', '$mr_codice', '$mr_immagine', '$mr_descrizione', '$mr_timestamp', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: marchi-add.php?insert=$insert");
?>