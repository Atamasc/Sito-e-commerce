<?php include "inc/autoloader.php"; ?>
<?php
$al_id = (int)$_POST["al_id"];
$al_tab_id = (int)$_POST["al_tab_id"];

$al_tipo = $dbConn->real_escape_string(stripslashes(trim($_POST["al_tipo"])));
$al_tab_id = $dbConn->real_escape_string(stripslashes(trim($_POST["al_tab_id"])));
$al_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST["al_titolo"])));
$al_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST["al_descrizione"])));
$al_timestamp = time();

if($al_id > 0) {

    $tmp_al_allegato = $_FILES["al_allegato"]["tmp_name"];
    $al_allegato_name = $_FILES["al_allegato"]["name"];
    $al_allegato_size = $_FILES["al_allegato"]["size"];

    $querySql = "SELECT al_allegato FROM al_allegati WHERE al_id = $al_id ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $al_allegato = $row_data['al_allegato'];
    $result->close();

    if (strlen($tmp_al_allegato) > 0){

        if(strlen($al_allegato) > 0) if(is_file("$upload_path_dir_allegati/$al_allegato")) unlink("$upload_path_dir_allegati/$al_allegato");

        $al_allegato_part = explode(".",$al_allegato_name);
        $al_allegato_ext = end($al_allegato_part);
        $al_allegato = "$al_tipo-$al_timestamp.$al_allegato_ext";
        $destination_dir_al_allegato = "$upload_path_dir_allegati/$al_allegato";

        if ($_FILES['al_allegato']['error'] == UPLOAD_ERR_OK) {
            if(@is_uploaded_file($_FILES["al_allegato"]["tmp_name"])) {
                @move_uploaded_file($_FILES["al_allegato"]["tmp_name"], $destination_dir_al_allegato);
            };
        };
    };

    $querySql =
        "UPDATE al_allegati SET al_titolo = '$al_titolo', al_descrizione = '$al_descrizione', al_allegato = '$al_allegato' WHERE al_id = '$al_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if($rows > 0) header("Location: allegati-gst.php?al_id=$al_id&al_tab_id=$al_tab_id&al_tipo=$al_tipo&update=true");
    else header("Location: allegati-gst.php?al_id=$al_id&al_tab_id=$al_tab_id&al_tipo=$al_tipo&update=false");

} else {

    $tmp_al_allegato = $_FILES["al_allegato"]["tmp_name"];
    $al_allegato_name = $_FILES["al_allegato"]["name"];
    $al_allegato_size = $_FILES["al_allegato"]["size"];

    if (strlen($tmp_al_allegato) > 0){

        $al_allegato_part = explode(".",$al_allegato_name);
        $al_allegato_ext = end($al_allegato_part);
        $al_allegato = "$al_tipo-$al_timestamp.$al_allegato_ext";
        $destination_dir_al_allegato = "$upload_path_dir_allegati/$al_allegato";

        if ($_FILES['al_allegato']['error'] == UPLOAD_ERR_OK) {
            if(@is_uploaded_file($_FILES["al_allegato"]["tmp_name"])) {
                @move_uploaded_file($_FILES["al_allegato"]["tmp_name"], $destination_dir_al_allegato);
            };
        };
    };

    $querySql =
        "INSERT INTO al_allegati(".
        "al_tipo, al_tab_id, al_titolo, al_descrizione, al_allegato, al_timestamp, al_stato".
        ") VALUES (".
        "'$al_tipo', '$al_tab_id', '$al_titolo', '$al_descrizione', '$al_allegato', '$al_timestamp', 1)";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if($rows > 0) header("Location: allegati-gst.php?al_tab_id=$al_tab_id&al_tipo=$al_tipo&insert=true");
    else header("Location: allegati-gst.php?al_tab_id=$al_tab_id&al_tipo=$al_tipo&insert=false");

}
?>