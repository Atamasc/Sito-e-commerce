<?php include "inc/autoloader.php"; ?>
<?php
$cl_id = (int)$_POST['cl_id'];

$cl_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice'])));
$cl_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_nome'])));
$cl_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cognome'])));
$cl_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo'])));
$cl_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap'])));
$cl_comune = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_comune'])));
$cl_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia'])));
$cl_indirizzo_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo_fatturazione'])));
$cl_cap_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap_fatturazione'])));
$cl_comune_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_comune_fatturazione'])));
$cl_provincia_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia_fatturazione'])));
$cl_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_telefono'])));
$cl_fax = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_fax'])));
$cl_email = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_email'])));
$cl_codice_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice_fiscale'])));
$cl_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_ragione_sociale'])));
$cl_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_partita_iva'])));
$cl_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_sdi'])));
$cl_pec = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_pec'])));
$cl_password = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_password'])));
$cl_note = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_note'])));
$cl_data = time();

$querySql =
    "UPDATE cl_clienti SET ".
    "cl_codice = '$cl_codice', cl_nome = '$cl_nome', cl_cognome = '$cl_cognome', cl_indirizzo = '$cl_indirizzo', cl_cap = '$cl_cap', cl_comune = '$cl_comune', ".
    "cl_indirizzo_fatturazione = '$cl_indirizzo_fatturazione', cl_cap_fatturazione = '$cl_cap_fatturazione', cl_comune_fatturazione = '$cl_comune_fatturazione', ".
    "cl_provincia_fatturazione = '$cl_provincia_fatturazione', cl_codice_fiscale = '$cl_codice_fiscale', cl_ragione_sociale = '$cl_ragione_sociale', ".
    "cl_partita_iva = '$cl_partita_iva', cl_sdi = '$cl_sdi', cl_pec = '$cl_pec', ".
    "cl_provincia = '$cl_provincia', cl_telefono = '$cl_telefono', cl_fax = '$cl_fax', cl_email = '$cl_email', cl_password = '$cl_password', ".
    "cl_note = '$cl_note' ".
    "WHERE cl_id = '$cl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-mod.php?cl_id=$cl_id&update=true");
else header("Location: clienti-mod.php?cl_id=$cl_id&update=false");

?>