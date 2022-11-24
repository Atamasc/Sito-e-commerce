<?php include "inc/autoloader.php"; ?>
<?php
$nl_id = (int)$_POST["nl_id"];
$nl_ns_id = stripslashes($_POST["nl_ns_id"]);
$nl_titolo = stripslashes($_POST["nl_titolo"]);
$nl_descrizione = stripslashes($_POST["nl_descrizione"]);
$nl_testo = stripslashes($_POST["nl_testo"]);
$nl_link = stripslashes($_POST["nl_link"]);
$nl_mittente = stripslashes($_POST["nl_mittente"]);
$nl_oggetto = stripslashes($_POST["nl_oggetto"]);

$nl_ns_id = $dbConn->real_escape_string(trim($nl_ns_id));
$nl_titolo = $dbConn->real_escape_string(trim($nl_titolo));
$nl_descrizione = $dbConn->real_escape_string(trim($nl_descrizione));
$nl_testo = $dbConn->real_escape_string(trim($nl_testo));
$nl_link = $dbConn->real_escape_string(trim($nl_link));
$nl_mittente = $dbConn->real_escape_string(trim($nl_mittente));
$nl_oggetto = $dbConn->real_escape_string(trim($nl_oggetto));

$serial_date = time();

//Recupero valori del file img
$tmp_nl_immagine = $_FILES["nl_immagine"]["tmp_name"];
$nl_immagine_name = $_FILES["nl_immagine"]["name"];
$nl_immagine_size = $_FILES["nl_immagine"]["size"];

if (strlen($tmp_nl_immagine) > 0){

    $querySql = "SELECT * FROM nl_newsletter WHERE nl_id = $nl_id ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $nl_immagine = $row_data['nl_immagine'];
        if (strlen($nl_immagine) > 0) unlink("$upload_path_dir_newsletter/$nl_immagine");

    }

    $result->close();

    $nl_immagine_part = explode(".",$nl_immagine_name);
    $nl_immagine_ext = end($nl_immagine_part);
    $nl_immagine_serial_name = "$serial_date.$nl_immagine_ext";
    $destination_dir_nl_immagine = "$upload_path_dir_newsletter/$nl_immagine_serial_name";

    if ($_FILES['nl_immagine']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["nl_immagine"]["tmp_name"])) {
            @move_uploaded_file($_FILES["nl_immagine"]["tmp_name"], $destination_dir_nl_immagine);
        };
    };
};

//Recupero valori del file img
$tmp_nl_allegato = $_FILES["nl_allegato"]["tmp_name"];
$nl_allegato_name = $_FILES["nl_allegato"]["name"];
$nl_allegato_size = $_FILES["nl_allegato"]["size"];

if (strlen($tmp_nl_allegato) > 0){
    $querySql = "SELECT * FROM nl_newsletter WHERE nl_id = $nl_id ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $nl_allegato = $row_data['nl_allegato'];
        if (strlen($nl_allegato) > 0) @unlink("$upload_path_dir_newsletter/$nl_allegato");

    }

    $result->close();

    $nl_allegato_part = explode(".",$nl_allegato_name);
    $nl_allegato_ext = end($nl_allegato_part);
    $nl_allegato_serial_name = "AL1-$serial_date.$nl_allegato_ext";
    $destination_dir_nl_allegato = "$upload_path_dir_newsletter/$nl_allegato_serial_name";

    if ($_FILES['nl_allegato']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["nl_allegato"]["tmp_name"])) {
            @move_uploaded_file($_FILES["nl_allegato"]["tmp_name"], $destination_dir_nl_allegato);
        };
    };
};

//Recupero valori del file img
$tmp_nl_allegato_2 = $_FILES["nl_allegato_2"]["tmp_name"];
$nl_allegato_name_2 = $_FILES["nl_allegato_2"]["name"];
$nl_allegato_size_2 = $_FILES["nl_allegato_2"]["size"];

if (strlen($tmp_nl_allegato_2) > 0){
    $querySql = "SELECT * FROM nl_newsletter WHERE nl_id = $nl_id ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {
        $nl_allegato_2 = $row_data['nl_allegato_2'];
        if (strlen($nl_allegato_2) > 0) @unlink("$upload_path_dir_newsletter/$nl_allegato_2");
    };

    $result->close();

    $nl_allegato_part = explode(".",$nl_allegato_name_2);
    $nl_allegato_ext = end($nl_allegato_part);
    $nl_allegato_serial_name_2 = "AL2-$serial_date.$nl_allegato_ext";
    $destination_dir_nl_allegato = "$upload_path_dir_newsletter/$nl_allegato_serial_name_2";

    if ($_FILES['nl_allegato_2']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["nl_allegato_2"]["tmp_name"])) {
            @move_uploaded_file($_FILES["nl_allegato_2"]["tmp_name"], $destination_dir_nl_allegato);
        };
    };
};

$querySql = "UPDATE nl_newsletter SET ";
$querySql .= "nl_ns_id = $nl_ns_id,";
$querySql .= "nl_titolo = '$nl_titolo',";
$querySql .= "nl_descrizione = '$nl_descrizione',";
if (strlen($tmp_nl_immagine) > 0) {
    $querySql .= "nl_immagine = '$nl_immagine_serial_name',";
};
if (strlen($tmp_nl_allegato) > 0) {
    $querySql .= "nl_allegato = '$nl_allegato_serial_name',";
};
if (strlen($tmp_nl_allegato_2) > 0) {
    $querySql .= "nl_allegato_2 = '$nl_allegato_serial_name_2',";
};
$querySql .= "nl_mittente = '$nl_mittente', ";
$querySql .= "nl_oggetto = '$nl_oggetto', ";
$querySql .= "nl_testo = '$nl_testo', ";
$querySql .= "nl_link = '$nl_link' ";
$querySql .= "WHERE nl_id = $nl_id ";

$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-immagine-mod.php?update=true&nl_id=$nl_id' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-immagine-mod.php?update=false&nl_id=$nl_id' />";
};
?>
