<?php include "inc/autoloader.php"; ?>
<?php
$ut_id = (int)$_POST['ut_id'];

$ut_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_codice'])));
$ut_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_ragione_sociale'])));
$ut_cod_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cod_fiscale'])));
$ut_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_partita_iva'])));
$ut_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_sdi'])));
$ut_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_telefono'])));
$ut_cellulare = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cellulare'])));
$ut_email = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_email'])));
$ut_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_indirizzo'])));
$ut_citta = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_citta'])));
$ut_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_provincia'])));
$ut_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cap'])));
$ut_note = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_note'])));

$cc_ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['cc_ct_id'])));

$querySql =
    "UPDATE ut_utenti SET " .
    "ut_codice = '$ut_codice', ut_ragione_sociale = '$ut_ragione_sociale', ut_cod_fiscale = '$ut_cod_fiscale', ut_partita_iva = '$ut_partita_iva', " .
    "ut_sdi = '$ut_sdi', ut_telefono = '$ut_telefono', ut_email = '$ut_email', " .
    "ut_indirizzo = '$ut_indirizzo', ut_citta = '$ut_citta', ut_provincia = '$ut_provincia', ut_cap = '$ut_cap', ut_note = '$ut_note', " .
    "ut_cellulare = '$ut_cellulare', " .
    "WHERE ut_id = '$ut_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql =
    "DELETE FROM cc_clienti_categorie WHERE cc_ut_codice = '$ut_codice' ";
$result = $dbConn->query($querySql);

if (strlen($cc_ct_id) > 0) {

    $querySql =
        "INSERT INTO cc_clienti_categorie(cc_ut_codice, cc_ct_id) VALUES ('$ut_codice', '$cc_ct_id')";
    $result = $dbConn->query($querySql);

}

if ($rows > 0) header("Location: clienti-mod.php?ut_id=$ut_id&update=true");
else header("Location: clienti-mod.php?ut_id=$ut_id&update=false");

?>