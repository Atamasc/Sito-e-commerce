<?php include 'inc/autoloader.php'; ?>

<?php
$ct_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_codice'])));
$ct_categoria = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_categoria'])));
$ct_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_descrizione'])));
$ct_title = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_title'])));
$ct_meta_keywords = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_meta_keywords'])));
$ct_meta_desc = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_meta_desc'])));
$ct_h1 = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_h1'])));
$ct_h2 = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_h2'])));

if (isset($_POST['ct_stato'])) $ct_stato=1; else $ct_stato=0;

$ct_timestamp = time();

//Recupero valori del file immagine

$tmp_ct_immagine = $_FILES["ct_immagine"]["tmp_name"];
$ct_immagine_name = $_FILES["ct_immagine"]["name"];
$ct_immagine_size = $_FILES["ct_immagine"]["size"];

$ct_immagine = "";
if (strlen($tmp_ct_immagine) > 0){

    $ct_immagine_part = explode(".", $ct_immagine_name);
    $ct_immagine_ext = end($ct_immagine_part);
    $ct_immagine = "$ct_timestamp.$ct_immagine_ext";
    $destination_dir_ct_immagine = "$upload_path_dir_categorie/$ct_immagine";

    if ($_FILES['ct_immagine']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_ct_immagine)) {
            move_uploaded_file($tmp_ct_immagine, $destination_dir_ct_immagine);
        };
    };

}

$tmp_ct_immagine = $_FILES["ct_img_fb_1200_628"]["tmp_name"];
$ct_immagine_name = $_FILES["ct_img_fb_1200_628"]["name"];
$ct_immagine_size = $_FILES["ct_img_fb_1200_628"]["size"];

$ct_img_fb_1200_628 = "";
if (strlen($tmp_ct_img_fb_1200_628) > 0){

    $ct_img_fb_1200_628_part = explode(".", $ct_img_fb_1200_628_name);
    $ct_img_fb_1200_628_ext = end($ct_img_fb_1200_628_part);
    $ct_img_fb_1200_628 = "$ct_timestamp.$ct_img_fb_1200_628_ext";
    $destination_dir_ct_img_fb_1200_628 = "$upload_path_dir_categorie/$ct_img_fb_1200_628";

    if ($_FILES['ct_img_fb_1200_628']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_ct_img_fb_1200_628)) {
            move_uploaded_file($tmp_ct_img_fb_1200_628, $destination_dir_ct_img_fb_1200_628);
        };
    };

}


$querySql = "INSERT INTO ct_categorie SET 
             ct_codice = '$ct_codice',
             ct_categoria = '$ct_categoria',
             ct_descrizione = '$ct_descrizione', 
             ct_immagine = '$ct_immagine', 
             ct_img_fb_1200_628 = '$ct_img_fb_1200_628', 
             ct_timestamp = '$ct_timestamp',
             ct_title = '$ct_title',
             ct_meta_keywords = '$ct_meta_keywords',
             ct_meta_desc = '$ct_meta_desc',
             ct_h1 = '$ct_h1',
             ct_h2 = '$ct_h2',
             ct_stato = '$ct_stato'";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: categoria-add.php?insert=true");
else header("Location: categoria-add.php?insert=false");
?>