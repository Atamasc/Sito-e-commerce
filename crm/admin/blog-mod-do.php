<?php include "inc/autoloader.php"; ?>
<?php
$bl_id = (int)$_POST['bl_id'];
$bl_bc_id = (int)$_POST['bl_bc_id'];

$bl_titolo = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_titolo"])));
$bl_abstract = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_abstract"])));
$bl_descrizione = $dbConn->real_escape_string(trim(stripslashes($_POST["bl_descrizione"])));

$bl_data = time();

//Recupero valori del file immagine
$tmp_bl_immagine = $_FILES["bl_immagine"]["tmp_name"];
$bl_immagine_name = $_FILES["bl_immagine"]["name"];
$bl_immagine_size = $_FILES["bl_immagine"]["size"];

$querySql = "SELECT bl_immagine FROM bl_blog WHERE bl_id = $bl_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$bl_immagine = $row_data['bl_immagine'];
$result->close();

if (strlen($tmp_bl_immagine) > 0){

    if(strlen($bl_immagine) > 0) if(is_file("$upload_path_dir_blog/$bl_immagine")) unlink("$upload_path_dir_blog/$bl_immagine");

    $bl_immagine_part = explode(".",$bl_immagine_name);
    $bl_immagine_ext = end($bl_immagine_part);
    $bl_immagine = "IMG-$bl_data.$bl_immagine_ext";
    $destination_dir_bl_immagine = "$upload_path_dir_blog/$bl_immagine";

    if ($_FILES['bl_immagine']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["bl_immagine"]["tmp_name"])) {
            @move_uploaded_file($_FILES["bl_immagine"]["tmp_name"], $destination_dir_bl_immagine);
        };
    };

    //checkImageName($destination_dir_bl_immagine, "$upload_path_dir_blog/$bl_path", "500x400", "IMG-500x400.jpg");

};

//Recupero valori del file immagine
$tmp_bl_allegato = $_FILES["bl_allegato"]["tmp_name"];
$bl_allegato_name = $_FILES["bl_allegato"]["name"];
$bl_allegato_size = $_FILES["bl_allegato"]["size"];

$querySql = "SELECT bl_allegato FROM bl_blog WHERE bl_id = $bl_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$bl_allegato = $row_data['bl_allegato'];
$result->close();

if (strlen($tmp_bl_allegato) > 0){

    if(strlen($bl_allegato) > 0) if(is_file("$upload_path_dir_blog/$bl_allegato")) unlink("$upload_path_dir_blog/$bl_allegato");

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

//aggiorna tag nel campo bl_tag
$querySql =
    "UPDATE bl_blog SET bl_tag=' ' WHERE bl_id='$bl_id' ";
$result = $dbConn->query($querySql);

$bl_tag='';

foreach ($_POST["bl_tag"] as &$tg_tag) {

    $tag = $dbConn->real_escape_string(stripslashes(trim($tg_tag)));

    $querySql3 = "SELECT tg_tag FROM tg_tag WHERE tg_id = $tag";
    $result3 = $dbConn->query($querySql3);
    $rows = $dbConn->affected_rows;
    $row_data3 = $result3->fetch_assoc();
    $tag2=generateURLRewrite($row_data3['tg_tag']);
    $bl_tag.=$tag2.";";
}

//aggiorna dati
$querySql = "UPDATE bl_blog SET ";
if(strlen($bl_immagine) > 0) $querySql .= "bl_immagine = '$bl_immagine', ";
if(strlen($bl_allegato) > 0) $querySql .= "bl_allegato = '$bl_allegato', ";
$querySql .=
    "bl_titolo = '$bl_titolo', bl_abstract = '$bl_abstract', bl_descrizione = '$bl_descrizione', bl_tag = '$bl_tag', bl_bc_id = '$bl_bc_id' ".
    "WHERE bl_id = $bl_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

//aggiorna tag nella tabella tb_tag_blog
$querySql =
    "DELETE FROM tb_tag_blog WHERE tb_bl_id = '$bl_id' ";
$result = $dbConn->query($querySql);
$rows_del = $dbConn->affected_rows;

foreach ($_POST["bl_tag"] as &$tg_id) {

    $tg_id = $dbConn->real_escape_string(stripslashes(trim($tg_id)));

    $querySql =
        "INSERT INTO tb_tag_blog (tb_bl_id, tb_tg_id) VALUES ('$bl_id', '$tg_id')";
    $result = $dbConn->query($querySql);
    $rows_2 = $dbConn->affected_rows;

}

$dbConn->close();

if ($rows > 0 || $rows_2 > 0 || $rows_del > 0) {
    echo "<meta http-equiv='refresh' content='0;url=blog-mod.php?bl_id=$bl_id&update=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=blog-mod.php?bl_id=$bl_id&update=false' />";
};
?>
