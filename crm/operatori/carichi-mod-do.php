<?php include "inc/autoloader.php"; ?>
<?php
$cr_id = (int)$_POST["cr_id"];
$cr_fr_id = (int)$_POST["cr_fr_id"];
$cr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_codice"])));
$cr_note = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_note"])));
$cr_timestamp = time();

//Recupero valori del file allegato
$tmp_cr_allegato = $_FILES["cr_allegato"]["tmp_name"];
$cr_allegato_name = $_FILES["cr_allegato"]["name"];
$cr_allegato_size = $_FILES["cr_allegato"]["size"];

$querySql = "SELECT cr_allegato FROM cr_carichi WHERE cr_id = $cr_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$cr_allegato = $row_data['cr_allegato'];
$result->close();

if (strlen($tmp_cr_allegato) > 0){

    if(strlen($cr_allegato) > 0) if(is_file("$upload_path_dir_carichi/$cr_allegato")) unlink("$upload_path_dir_carichi/$cr_allegato");

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
    "UPDATE cr_carichi SET ".
    "cr_fr_id = '$cr_fr_id', cr_codice = '$cr_codice', cr_allegato = '$cr_allegato', cr_note = '$cr_note' ".
    "WHERE cr_id = $cr_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: carichi-mod.php?cr_id=$cr_id&update=true");
else header("Location: carichi-mod.php?cr_id=$cr_id&update=false");
?>