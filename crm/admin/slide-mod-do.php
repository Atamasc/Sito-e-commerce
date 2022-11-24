<?php include 'inc/autoloader.php'; ?>
<?php
$sl_id = (int)$_POST['sl_id'];

$sl_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_titolo'])));
$sl_link = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_link'])));
$sl_testo = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_testo'])));
$sl_tipologia = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_tipologia'])));
$sl_stato = isset($_POST['sl_stato']) ? 1 : 0;

$sl_timestamp = time();


$querySql = "SELECT sl_immagine FROM sl_slide WHERE sl_id = '$sl_id' ";
$result = $dbConn->query($querySql);
list($sl_immagine) = $result->fetch_array();
$result->close();

//Recupero valori del file immagine
$tmp_sl_immagine = $_FILES["sl_immagine"]["tmp_name"];
$sl_immagine_name = $_FILES["sl_immagine"]["name"];
$sl_immagine_size = $_FILES["sl_immagine"]["size"];

if (strlen($tmp_sl_immagine) > 0){

    if(strlen($sl_immagine) > 0) unlink("$upload_path_dir_slide/$sl_immagine");

    $sl_immagine_part = explode(".", $sl_immagine_name);
    $sl_immagine_ext = end($sl_immagine_part);
    $sl_immagine = "$sl_timestamp.$sl_immagine_ext";
    $destination_dir_sl_immagine = "$upload_path_dir_slide/$sl_immagine";

    if ($_FILES['sl_immagine']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_sl_immagine)) {
            move_uploaded_file($tmp_sl_immagine, $destination_dir_sl_immagine);
        };
    };

}

$querySql =
    "UPDATE sl_slide SET ".
    "sl_titolo = '$sl_titolo', sl_link = '$sl_link', sl_testo = '$sl_testo', sl_immagine = '$sl_immagine',".
    "sl_stato = '$sl_stato' ".
    "WHERE sl_id = '$sl_id'  ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: slide-gst.php?sl_id=$sl_id&update=true");
else header("Location: slide-gst.php?sl_id=$sl_id&update=false");
?>