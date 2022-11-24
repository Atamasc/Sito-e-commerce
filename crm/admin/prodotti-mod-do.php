<?php include "inc/autoloader.php"; ?>
<?php
$pr_id = (int)$_POST['pr_id'];

$pr_ct_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_ct_id'])));
$pr_st_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_st_id'])));
$pr_mr_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_mr_id'])));
$pr_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_titolo'])));
$pr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice'])));
$pr_codice_rif = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice_rif'])));
$pr_codice_ean = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice_ean'])));
$pr_prezzo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo']))));
$pr_prezzo_scontato = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_scontato']))));
$pr_sconto = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_sconto'])));
$pr_prezzo_acquisto = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_acquisto']))));
$pr_peso = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_peso'])));
$pr_giacenza = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_giacenza'])));
$pr_si_id = (int)$dbConn->real_escape_string(stripslashes(trim($_POST['pr_si_id'])));
$pr_formato = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_formato'])));
$pr_abstract = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_abstract'])));
$pr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_descrizione'])));
$pr_stato = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_stato'])));
$pr_note = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_note'])));
$pr_timestamp = time();
$pr_best_seller = 0;
if(isset($_POST['best_seller'])){
    $pr_best_seller = 1;
}
//Recupero valori del file immagine

$tmp_pr_immagine = $_FILES["pr_immagine"]["tmp_name"];
$pr_immagine_name = $_FILES["pr_immagine"]["name"];
$pr_immagine_size = $_FILES["pr_immagine"]["size"];

$querySql = "SELECT pr_immagine FROM pr_prodotti WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$pr_immagine = $row_data['pr_immagine'];
$result->close();

if (strlen($tmp_pr_immagine) > 0){

    if(strlen($pr_immagine) > 0) unlink("$upload_path_dir_prodotti/$pr_immagine");

    $pr_immagine_part = explode(".", $pr_immagine_name);
    $pr_immagine_ext = end($pr_immagine_part);
    $pr_immagine = "$pr_timestamp.$pr_immagine_ext";
    $destination_dir_pr_immagine = "$upload_path_dir_prodotti/$pr_immagine";

    if ($_FILES['pr_immagine']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_pr_immagine)) {
            move_uploaded_file($tmp_pr_immagine, $destination_dir_pr_immagine);
        };
    };

}


//Recupero valori del file immagine
$tmp_pr_allegato = $_FILES["pr_allegato"]["tmp_name"];
$pr_allegato_name = $_FILES["pr_allegato"]["name"];
$pr_allegato_size = $_FILES["pr_allegato"]["size"];

$querySql = "SELECT pr_allegato FROM pr_prodotti WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$pr_allegato = $row_data['pr_allegato'];
$result->close();

if (strlen($tmp_pr_allegato) > 0){

    if(strlen($pr_allegato) > 0) unlink("$upload_path_dir_prodotti/$pr_allegato");

    $pr_allegato_part = explode(".", $pr_allegato_name);
    $pr_allegato_ext = end($pr_allegato_part);
    $pr_allegato = "$pr_timestamp.$pr_allegato_ext";
    $destination_dir_pr_allegato = "$upload_path_dir_prodotti/$pr_allegato";

    if ($_FILES['pr_allegato']['error'] == UPLOAD_ERR_OK) {
        if(is_uploaded_file($tmp_pr_allegato)) {
            move_uploaded_file($tmp_pr_allegato, $destination_dir_pr_allegato);
        };
    };

}


$esistenza_varianti = getEsistenzaVarianti($pr_id, $dbConn);
if ($esistenza_varianti > 0){

    $querySql2 =
        "UPDATE pr_prodotti SET ".
        "pr_ct_id = '$pr_ct_id', pr_st_id = '$pr_st_id', pr_mr_id = '$pr_mr_id', pr_codice_rif = '$pr_codice_rif', pr_si_id = '$pr_si_id' ".
        "WHERE pr_id != '$pr_id' AND pr_capofila = '$pr_id'  ";
    $result2 = $dbConn->query($querySql2);
}


$querySql =
    "UPDATE pr_prodotti SET ".
    "pr_ct_id = '$pr_ct_id', pr_st_id = '$pr_st_id', pr_mr_id = '$pr_mr_id', pr_titolo = '$pr_titolo', pr_codice = '$pr_codice', pr_codice_rif = '$pr_codice_rif', ".
    "pr_codice_ean = '$pr_codice_ean', pr_prezzo = '$pr_prezzo', pr_prezzo_scontato = '$pr_prezzo_scontato', pr_sconto = '$pr_sconto', pr_prezzo_acquisto = '$pr_prezzo_acquisto', ".
    "pr_peso = '$pr_peso', pr_giacenza = '$pr_giacenza', pr_si_id = '$pr_si_id', pr_formato = '$pr_formato', pr_immagine = '$pr_immagine', ".
    "pr_allegato = '$pr_allegato', pr_abstract = '$pr_abstract', pr_descrizione = '$pr_descrizione', pr_stato = '$pr_stato', pr_note = '$pr_note',pr_best_seller = $pr_best_seller ".
    "WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-mod.php?pr_id=$pr_id&update=true");
else header("Location: prodotti-mod.php?pr_id=$pr_id&update=false");
?>