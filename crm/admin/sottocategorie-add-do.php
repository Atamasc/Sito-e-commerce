<?php include 'inc/autoloader.php'; ?>

<?php
$ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_id'])));
$st_sottocategoria = $dbConn->real_escape_string(stripslashes(trim($_POST['st_sottocategoria'])));
$st_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['st_descrizione'])));
$st_title = $dbConn->real_escape_string(stripslashes(trim($_POST['st_title'])));
$st_meta_keywords = $dbConn->real_escape_string(stripslashes(trim($_POST['st_meta_keywords'])));
$st_meta_desc = $dbConn->real_escape_string(stripslashes(trim($_POST['st_meta_desc'])));
$st_h1 = $dbConn->real_escape_string(stripslashes(trim($_POST['st_h1'])));
$st_h2 = $dbConn->real_escape_string(stripslashes(trim($_POST['st_h2'])));
$st_timestamp = time();

//Recupero valori del file immagine

$tmp_st_immagine = $_FILES["st_immagine"]["tmp_name"];
$st_immagine_name = $_FILES["st_immagine"]["name"];
$st_immagine_size = $_FILES["st_immagine"]["size"];

$st_immagine = "";
if (strlen($tmp_st_immagine) > 0){

    $st_immagine_part = explode(".", $st_immagine_name);
    $st_immagine_ext = end($st_immagine_part);
    $st_immagine = "$st_timestamp.$st_immagine_ext";
    $destination_dir_st_immagine = "$upload_path_dir_sottocategorie/$st_immagine";

    if ($_FILES['st_immagine']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_st_immagine)) {
            move_uploaded_file($tmp_st_immagine, $destination_dir_st_immagine);
        };
    };

}

$tmp_st_immagine_fb = $_FILES["st_immagine_fb"]["tmp_name"];
$st_immagine_fb_name = $_FILES["st_immagine_fb"]["name"];
$st_immagine_fb_size = $_FILES["st_immagine_fb"]["size"];

$st_immagine_fb = "";
if (strlen($tmp_st_immagine_fb) > 0){

    $st_immagine_fb_part = explode(".", $st_immagine_fb_name);
    $st_immagine_fb_ext = end($st_immagine_fb_part);
    $st_immagine_fb = "$st_timestamp.$st_immagine_fb_ext";
    $destination_dir_st_immagine_fb = "$upload_path_dir_sottocategorie/$st_immagine_fb";

    if ($_FILES['st_immagine_fb']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_st_immagine_fb)) {
            move_uploaded_file($tmp_st_immagine_fb, $destination_dir_st_immagine_fb);
        };
    };

}


$querySql =
    "INSERT INTO st_sottocategorie (" .
    "st_ct_id, st_sottocategoria, st_immagine, st_img_fb_1200_628, st_title, st_meta_keywords, st_meta_desc, st_h1, st_h2, st_descrizione, st_timestamp, st_stato) VALUES (" .
    "'$ct_id', '$st_sottocategoria', '$st_immagine', '$st_immagine_fb', '$st_title', '$st_meta_keywords', '$st_meta_desc', '$st_h1', '$st_h2', '$st_descrizione', '$st_timestamp', 1) ";

$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;


if($rows > 0) header("Location: sottocategorie-add.php?ct_id=$ct_id&insert=true");
else header("Location: sottocategorie-add.php?ct_id=$ct_id&insert=false");
?>