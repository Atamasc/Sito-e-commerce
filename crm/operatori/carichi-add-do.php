<?php include "inc/autoloader.php"; ?>
<?php
$cr_fr_id = (int)$_POST["cr_fr_id"];
$cr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_codice"])));
$cr_note = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_note"])));
$cr_timestamp = time();

//Recupero valori del file allegato
$tmp_cr_allegato = $_FILES["cr_allegato"]["tmp_name"];
$cr_allegato_name = $_FILES["cr_allegato"]["name"];
$cr_allegato_size = $_FILES["cr_allegato"]["size"];

$cr_allegato = "";
if (strlen($tmp_cr_allegato) > 0){
    $cr_allegato_part = explode(".",$cr_allegato_name);
    $cr_allegato_ext = end($cr_allegato_part);
    $cr_allegato = "AL-$cr_timestamp.$cr_allegato_ext";
    $destination_dir_cr_allegato = "$upload_path_dir_carichi/$cr_allegato";

    if ($_FILES['cr_allegato']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["cr_allegato"]["tmp_name"])) {
            @move_uploaded_file($_FILES["cr_allegato"]["tmp_name"], $destination_dir_cr_allegato);
        };
    };
};

$querySql =
    "INSERT INTO cr_carichi (".
    "cr_fr_id, cr_codice, cr_allegato, ".
    "cr_timestamp, cr_note, cr_stato) VALUES (".
    "'$cr_fr_id', '$cr_codice', '$cr_allegato', ".
    "'$cr_timestamp', '$cr_note', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: carichi-add.php?insert=true");
else header("Location: carichi-add.php?insert=false");
?>