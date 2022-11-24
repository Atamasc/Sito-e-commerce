<?php include "inc/autoloader.php"; ?>
<?php
$bl_titolo = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_titolo"])));
$bl_abstract = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_abstract"])));
$bl_descrizione = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_descrizione"])));
$bl_bc_id = (int)$_POST['bl_bc_id'];

$bl_data = time();
$bl_tag="";

$querySql = "INSERT INTO bl_blog SET  
             bl_bc_id = $bl_bc_id,
             bl_titolo = '$bl_titolo',
             bl_abstract = '$bl_abstract',
             bl_descrizione = '$bl_descrizione',
             bl_tag = '$bl_tag',
             bl_data = $bl_data,
             bl_stato = 1";

$result = $dbConn->query($querySql);

$bl_id = $dbConn->insert_id;
$bl_path = "BL-$bl_id";

//Recupero valori del file immagine
$tmp_bl_immagine = $_FILES["bl_immagine"]["tmp_name"];
$bl_immagine_name = $_FILES["bl_immagine"]["name"];
$bl_immagine_size = $_FILES["bl_immagine"]["size"];

$bl_immagine = "";
if (strlen($tmp_bl_immagine) > 0){

    $bl_immagine_part = explode(".",$bl_immagine_name);
    $bl_immagine_ext = end($bl_immagine_part);
    $bl_immagine = "IMG-$bl_data.$bl_immagine_ext";
    $destination_dir_bl_immagine = "$upload_path_dir_blog/$bl_immagine";

    if ($_FILES['bl_immagine']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($tmp_bl_immagine)) {
            @move_uploaded_file($tmp_bl_immagine, $destination_dir_bl_immagine);
        };
    };

    //checkImageName($destination_dir_bl_immagine, "$upload_path_dir_blog/$bl_path", "500x400", "IMG-500x400.jpg");

};

//Recupero valori del file allegato
$tmp_bl_allegato = $_FILES["bl_allegato"]["tmp_name"];
$bl_allegato_name = $_FILES["bl_allegato"]["name"];
$bl_allegato_size = $_FILES["bl_allegato"]["size"];

$bl_allegato = "";
if (strlen($tmp_bl_allegato) > 0){
    $bl_allegato_part = explode(".",$bl_allegato_name);
    $bl_allegato_ext = end($bl_allegato_part);
    $bl_allegato = "AL-$bl_data.$bl_allegato_ext";
    $destination_dir_bl_allegato = "$upload_path_dir_blog/$bl_allegato";

    if ($_FILES['bl_allegato']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["bl_allegato"]["tmp_name"])) {
            @move_uploaded_file($_FILES["bl_allegato"]["tmp_name"], $destination_dir_bl_allegato);
        };
    };
};

$querySql = "UPDATE bl_blog SET bl_path = '$bl_path'";
if(strlen($bl_immagine) > 0) $querySql .= ", bl_immagine = '$bl_immagine'";
if(strlen($bl_allegato) > 0) $querySql .= ", bl_allegato = '$bl_allegato'";
$querySql .= " WHERE bl_id = $bl_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;


foreach ($_POST["bl_tag"] as &$tg_id) {

    $tg_id = $dbConn->real_escape_string(stripslashes(trim($tg_id)));

    $querySql =
        "INSERT INTO tb_tag_blog (tb_bl_id, tb_tg_id) VALUES ('$bl_id', '$tg_id')";
    $result = $dbConn->query($querySql);

}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=blog-add.php?insert=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=blog-add.php?insert=false' />";
};
?>
