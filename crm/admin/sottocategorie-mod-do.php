<?php include 'inc/autoloader.php'; ?>

<?php
$ct_id = (int)$_POST['ct_id'];
$st_id = (int)$_POST['st_id'];
$st_sottocategoria = $dbConn->real_escape_string(stripslashes(trim($_POST['st_sottocategoria'])));
$st_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['st_descrizione'])));
$st_title = $dbConn->real_escape_string(stripslashes(trim($_POST['st_title'])));
$st_meta_keywords = $dbConn->real_escape_string(stripslashes(trim($_POST['st_meta_keywords'])));
$st_meta_desc = $dbConn->real_escape_string(stripslashes(trim($_POST['st_meta_desc'])));
$st_h1 = $dbConn->real_escape_string(stripslashes(trim($_POST['st_h1'])));
$st_h2 = $dbConn->real_escape_string(stripslashes(trim($_POST['st_h2'])));

$st_timestamp = time();


$querySql = "SELECT st_immagine, st_img_fb_1200_628 FROM st_sottocategorie WHERE st_id = '$st_id' ";
$result = $dbConn->query($querySql);
list($st_immagine, $st_immagine_fb) = $result->fetch_array();
$result->close();


//Recupero valori del file immagine
$tmp_st_immagine = $_FILES["st_immagine"]["tmp_name"];
$st_immagine_name = $_FILES["st_immagine"]["name"];
$st_immagine_size = $_FILES["st_immagine"]["size"];

if (strlen($tmp_st_immagine) > 0){

    if(strlen($st_immagine) > 0) unlink("$upload_path_dir_sottocategorie/$st_immagine");

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

//Recupero valori del file immagine
$tmp_st_immagine_fb = $_FILES["st_immagine_fb"]["tmp_name"];
$st_immagine_fb_name = $_FILES["st_immagine_fb"]["name"];
$st_immagine_fb_size = $_FILES["st_immagine_fb"]["size"];

if (strlen($tmp_st_immagine_fb) > 0){

    if(strlen($st_immagine_fb) > 0) unlink("$upload_path_dir_sottocategorie/$st_immagine_fb");

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

$querySql = "UPDATE st_sottocategorie SET 
             st_sottocategoria = '$st_sottocategoria',
             st_immagine = '$st_immagine',
             st_img_fb_1200_628 = '$st_immagine_fb',     
             st_title = '$st_title',
             st_meta_keywords = '$st_meta_keywords',
             st_meta_desc = '$st_meta_desc',
             st_h1 = '$st_h1',
             st_h2 = '$st_h2',              
             st_descrizione = '$st_descrizione' 
             WHERE st_id = $st_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=true");
else header("Location: sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=false");
?>