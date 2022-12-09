<?php include "inc/autoloader.php"; ?>
<?php
$pr_ct_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_ct_id'])));
$pr_mr_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_mr_id'])));
$pr_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_titolo'])));
$pr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice'])));
$pr_prezzo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo']))));
$pr_prezzo_scontato = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_scontato']))));
$pr_sconto = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_sconto'])));
$pr_peso = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_peso'])));
$pr_giacenza = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_giacenza'])));
$pr_abstract = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_abstract'])));
$pr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_descrizione'])));
$pr_note = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_note'])));
$pr_timestamp = time();

//Recupero valori del file immagine

$tmp_pr_immagine = $_FILES["pr_immagine"]["tmp_name"];
$pr_immagine_name = $_FILES["pr_immagine"]["name"];
$pr_immagine_size = $_FILES["pr_immagine"]["size"];

$pr_immagine = "";
if (strlen($tmp_pr_immagine) > 0) {

    $pr_immagine_part = explode(".", $pr_immagine_name);
    $pr_immagine_ext = end($pr_immagine_part);
    $pr_immagine = "$pr_timestamp.$pr_immagine_ext";
    $destination_dir_pr_immagine = "$upload_path_dir_prodotti/$pr_immagine";

    if ($_FILES['pr_immagine']['error'] == UPLOAD_ERR_OK) {
        if (is_uploaded_file($tmp_pr_immagine)) {
            move_uploaded_file($tmp_pr_immagine, $destination_dir_pr_immagine);
        };
    };

}


//Recupero valori del file immagine
$tmp_pr_allegato = $_FILES["pr_allegato"]["tmp_name"];
$pr_allegato_name = $_FILES["pr_allegato"]["name"];
$pr_allegato_size = $_FILES["pr_allegato"]["size"];

$pr_allegato = "";
if (strlen($tmp_pr_allegato) > 0) {

    $pr_allegato_part = explode(".", $pr_allegato_name);
    $pr_allegato_ext = end($pr_allegato_part);
    $pr_allegato = "AL-" . "$pr_timestamp.$pr_allegato_ext";
    $destination_dir_pr_allegato = "$upload_path_dir_prodotti/$pr_allegato";

    if ($_FILES['pr_allegato']['error'] == UPLOAD_ERR_OK) {
        if (is_uploaded_file($tmp_pr_allegato)) {
            move_uploaded_file($tmp_pr_allegato, $destination_dir_pr_allegato);
        };
    };

}

$querySql =
    "INSERT INTO pr_prodotti (" .
    "pr_ct_id, pr_mr_id, pr_codice, pr_titolo, pr_abstract, pr_descrizione, pr_prezzo, " .
    "pr_prezzo_scontato, pr_sconto, pr_peso, pr_giacenza, pr_allegato, pr_immagine, pr_note, pr_timestamp, pr_stato" .
    ") VALUES (" .
    "'$pr_ct_id', '$pr_mr_id', '$pr_codice', '$pr_titolo', '$pr_abstract', '$pr_descrizione', '$pr_prezzo', " .
    "'$pr_prezzo_scontato', '$pr_sconto', '$pr_peso', '$pr_giacenza', '$pr_allegato', '$pr_immagine', '$pr_note', '$pr_timestamp', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$pr_id = $dbConn->insert_id;

$querySql =
    "UPDATE pr_prodotti SET pr_capofila = '$pr_id' WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($rows > 0) header("Location: prodotti-mod.php?pr_id=$pr_id&insert=true");
else header("Location: prodotti-add.php?insert=false");
?>