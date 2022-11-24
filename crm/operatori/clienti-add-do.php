<?php include "inc/autoloader.php"; ?>
<?php

$cl_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_codice'])));
$cl_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_ragione_sociale'])));
$cl_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_nome'])));
$cl_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cognome'])));
$cl_cod_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cod_fiscale'])));
$cl_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_partita_iva'])));
$cl_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_sdi'])));
$cl_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_telefono'])));
$cl_cellulare = $dbConn->real_escape_string(stripcslashes(trim($_POST['cl_cellulare'])));
$cl_email = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_email'])));
$cl_pec = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_pec'])));
$cl_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_indirizzo'])));
$cl_comune = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_comune'])));
$cl_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_provincia'])));
$cl_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_cap'])));
$cl_note = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_note'])));
$cl_timestamp = time();

//$cc_ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['cc_ct_id'])));

$querySql =
    "INSERT INTO cl_clienti (".
    "cl_codice, cl_ragione_sociale, cl_nome, cl_cognome, cl_cod_fiscale, cl_partita_iva, cl_sdi, cl_telefono, cl_email, cl_pec, ".
    "cl_indirizzo, cl_comune, cl_provincia, cl_cap, cl_note, ".
    "cl_cellulare,".
    "cl_timestamp, cl_stato) VALUES (".
    "'$cl_codice', '$cl_ragione_sociale', '$cl_nome', '$cl_cognome', '$cl_cod_fiscale', '$cl_partita_iva', '$cl_sdi', '$cl_telefono', '$cl_email', '$cl_pec', ".
    "'$cl_indirizzo', '$cl_comune', '$cl_provincia', '$cl_cap', '$cl_note', '$cl_cellulare', ".
    "'$cl_timestamp', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

/*
if (strlen($cc_ct_id) > 0) {

    $querySql =
        "INSERT INTO cc_clienti_categorie(cc_cl_codice, cc_ct_id) VALUES ('$cl_codice', '$cc_ct_id')";
    $result = $dbConn->query($querySql);

}
*/

if($rows > 0) header("Location: clienti-add.php?insert=true");
else header("Location: clienti-add.php?insert=false");
?>