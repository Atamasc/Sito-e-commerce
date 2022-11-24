<?php include "inc/autoloader.php"; ?>
<?php
$nl_ns_id = stripslashes($_POST["nl_ns_id"]);
$nl_titolo = stripslashes($_POST["nl_titolo"]);
$nl_descrizione = stripslashes($_POST["nl_descrizione"]);
$nl_testo = stripslashes($_POST["nl_testo"]);
$nl_link = stripslashes($_POST["nl_link"]);
$nl_mittente = stripslashes($_POST["nl_mittente"]);
$nl_oggetto = stripslashes($_POST["nl_oggetto"]);

$nl_data = time();

$nl_ns_id = $dbConn->real_escape_string(trim($nl_ns_id));
$nl_titolo = $dbConn->real_escape_string(trim($nl_titolo));
$nl_descrizione = $dbConn->real_escape_string(trim($nl_descrizione));
$nl_testo = $dbConn->real_escape_string(trim($nl_testo));
$nl_link = $dbConn->real_escape_string(trim($nl_link));
$nl_mittente = $dbConn->real_escape_string(trim($nl_mittente));
$nl_oggetto = $dbConn->real_escape_string(trim($nl_oggetto));

$serial_date = time();

//Recupero valori del file immagine
$tmp_nl_immagine = $_FILES["nl_immagine"]["tmp_name"];
$nl_immagine_name = $_FILES["nl_immagine"]["name"];
$nl_immagine_size = $_FILES["nl_immagine"]["size"];

$nl_immagine_serial_name = "";
if (strlen($tmp_nl_immagine) > 0){
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

//Recupero valori del file immagine
$tmp_nl_allegato = $_FILES["nl_allegato"]["tmp_name"];
$nl_allegato_name = $_FILES["nl_allegato"]["name"];
$nl_allegato_size = $_FILES["nl_allegato"]["size"];

$nl_allegato = "";
if (strlen($tmp_nl_allegato) > 0){
    $nl_allegato_part = explode(".",$nl_allegato_name);
    $nl_allegato_ext = end($nl_allegato_part);
    $nl_allegato = "AL1-$serial_date.$nl_allegato_ext";
    $destination_dir_nl_allegato = "$upload_path_dir_newsletter/$nl_allegato";

    if ($_FILES['nl_allegato']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["nl_allegato"]["tmp_name"])) {
            @move_uploaded_file($_FILES["nl_allegato"]["tmp_name"], $destination_dir_nl_allegato);
        };
    };
};

$tmp_nl_allegato = $_FILES["nl_allegato_2"]["tmp_name"];
$nl_allegato_name = $_FILES["nl_allegato_2"]["name"];
$nl_allegato_size = $_FILES["nl_allegato_2"]["size"];

$nl_allegato_2 = "";
if (strlen($tmp_nl_allegato) > 0){
    $nl_allegato_part = explode(".",$nl_allegato_name);
    $nl_allegato_ext = end($nl_allegato_part);
    $nl_allegato_2 = "AL2-$serial_date.$nl_allegato_ext";
    $destination_dir_nl_allegato = "$upload_path_dir_newsletter/$nl_allegato_2";

    if ($_FILES['nl_allegato_2']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($_FILES["nl_allegato_2"]["tmp_name"])) {
            @move_uploaded_file($_FILES["nl_allegato_2"]["tmp_name"], $destination_dir_nl_allegato);
        };
    };
};

$querySql = "INSERT INTO nl_newsletter (".
    "nl_ns_id, nl_titolo, nl_descrizione, nl_testo, nl_immagine, nl_allegato, nl_allegato_2, ".
    "nl_link, nl_data, nl_mittente, nl_oggetto".
    ") VALUES (".
    "$nl_ns_id, '$nl_titolo', '$nl_descrizione', '$nl_testo', '$nl_immagine_serial_name', '$nl_allegato', '$nl_allegato_2', ".
    "'$nl_link', '$serial_date', '$nl_mittente', '$nl_oggetto')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-immagine-add.php?insert=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-immagine-add.php?insert=false' />";
};
?>
