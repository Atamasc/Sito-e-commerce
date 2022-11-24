<?php include 'inc/autoloader.php'; ?>

<?php
$sl_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_titolo'])));
$sl_link = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_link'])));
$sl_testo = $dbConn->real_escape_string(stripslashes(trim($_POST['sl_testo'])));
$sl_stato = isset($_POST['sl_stato']) ? 1 : 0;

$sl_timestamp = time();

//Recupero valori del file immagine
$tmp_sl_immagine = $_FILES["sl_immagine"]["tmp_name"];
$sl_immagine_name = $_FILES["sl_immagine"]["name"];
$sl_immagine_size = $_FILES["sl_immagine"]["size"];

$sl_immagine = "";
if (strlen($tmp_sl_immagine) > 0){

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

$querySql = "SELECT MAX(sl_posizione) FROM sl_slide ";
$result = $dbConn->query($querySql);
$sl_posizione = $result->fetch_array()[0] + 1;
$result->close();

$querySql = "INSERT INTO sl_slide (sl_titolo, sl_link, sl_testo, sl_immagine, sl_posizione, sl_timestamp, sl_stato".
    ") VALUES ('$sl_titolo', '$sl_link', '$sl_testo','$sl_immagine','$sl_posizione','$sl_timestamp', '$sl_stato')  ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: slide-gst.php?insert=true");
else header("Location: slide-gst.php?insert=false");
?>