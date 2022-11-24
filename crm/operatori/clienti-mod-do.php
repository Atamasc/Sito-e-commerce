<?php include "inc/autoloader.php"; ?>
<?php
$cl_id = (int)$_POST['cl_id'];

$cl_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice'])));
$cl_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_ragione_sociale'])));
$cl_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_nome'])));
$cl_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cognome'])));
$cl_cod_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cod_fiscale'])));
$cl_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_partita_iva'])));
$cl_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_sdi'])));
$cl_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_telefono'])));
$cl_cellulare = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cellulare'])));
$cl_email = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_email'])));
$cl_pec = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_pec'])));
$cl_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo'])));
$cl_comune = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_comune'])));
$cl_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia'])));
$cl_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap'])));
$cl_note = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_note'])));

//$cc_ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['cc_ct_id'])));

$querySql =
    "UPDATE cl_clienti SET ".
    "cl_codice = '$cl_codice', cl_ragione_sociale = '$cl_ragione_sociale', cl_nome = '$cl_nome', cl_cognome = '$cl_cognome', cl_cod_fiscale = '$cl_cod_fiscale', cl_partita_iva = '$cl_partita_iva', ".
    "cl_sdi = '$cl_sdi', cl_telefono = '$cl_telefono', cl_email = '$cl_email', ".
    "cl_indirizzo = '$cl_indirizzo', cl_comune = '$cl_comune', cl_provincia = '$cl_provincia', cl_cap = '$cl_cap', cl_note = '$cl_note', ".
    "cl_cellulare = '$cl_cellulare', ".
    "WHERE cl_id = '$cl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

/*
$querySql =
    "DELETE FROM cc_clienti_categorie WHERE cc_cl_codice = '$cl_codice' ";
$result = $dbConn->query($querySql);

if (strlen($cc_ct_id) > 0) {

    $querySql =
        "INSERT INTO cc_clienti_categorie(cc_cl_codice, cc_ct_id) VALUES ('$cl_codice', '$cc_ct_id')";
    $result = $dbConn->query($querySql);

}
*/

if($rows > 0) header("Location: clienti-mod.php?cl_id=$cl_id&update=true");
else header("Location: clienti-mod.php?cl_id=$cl_id&update=false");

?>