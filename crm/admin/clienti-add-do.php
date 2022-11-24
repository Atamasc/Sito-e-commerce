<?php include "inc/autoloader.php"; ?>
<?php

$cl_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice'])));
$cl_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_nome'])));
$cl_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cognome'])));
$cl_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo'])));
$cl_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap'])));
$cl_citta = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_citta'])));
$cl_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia'])));
$cl_indirizzo_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo_fatturazione'])));
$cl_cap_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap_fatturazione'])));
$cl_citta_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_citta_fatturazione'])));
$cl_provincia_fatturazione = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia_fatturazione'])));
$cl_tel = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_tel'])));
$cl_fax = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_fax'])));
$cl_email = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_email'])));
$cl_codice_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice_fiscale'])));
$cl_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_ragione_sociale'])));
$cl_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_partita_iva'])));
$cl_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_sdi'])));
$cl_pec = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_pec'])));
$cl_password = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_password'])));
$cl_note = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_note'])));
/* $cl_newsletter = isset($_POST['cl_newsletter']) ? 1 : 0;
$cl_tipo = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_tipo'])));
$cl_codice_tessera = $dbConn->real_escape_string(trim(stripslashes($_POST["cl_codice_tessera"])));
$cl_attivazione_tessera = strlen($_POST["cl_attivazione_tessera"]) > 0 ? dateToTimestamp($_POST["cl_attivazione_tessera"]) : 0;
$cl_stato_tessera = (int)$dbConn->real_escape_string(trim(stripslashes($_POST["cl_stato_tessera"])));
$cl_saldo_punti = (int)$dbConn->real_escape_string(trim(stripslashes($_POST["cl_saldo_punti"]))); */
$cl_data = time();

$querySql = "INSERT INTO cl_clienti (".
    "cl_codice, cl_nome, cl_cognome, cl_indirizzo, cl_cap, cl_comune, cl_provincia, cl_indirizzo_fatturazione, cl_ragione_sociale, ".
    "cl_cap_fatturazione, cl_comune_fatturazione, cl_provincia_fatturazione, cl_telefono, cl_fax, cl_email, ".
    "cl_codice_fiscale, cl_partita_iva, cl_password, cl_note, cl_data, cl_stato, ".
    "cl_sdi, cl_pec".
    ") VALUES (".
    "'$cl_codice', '$cl_nome', '$cl_cognome', '$cl_indirizzo', '$cl_cap', '$cl_citta', '$cl_provincia', '$cl_indirizzo_fatturazione', '$cl_ragione_sociale', ".
    "'$cl_cap_fatturazione', '$cl_citta_fatturazione', '$cl_provincia_fatturazione', '$cl_tel', '$cl_fax', '$cl_email', ".
    "'$cl_codice_fiscale', '$cl_partita_iva', '$cl_password', '$cl_note', '$cl_data', '1', ".
    "'$cl_sdi', '$cl_pec') ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-add.php?insert=true");
else header("Location: clienti-add.php?insert=false");
?>