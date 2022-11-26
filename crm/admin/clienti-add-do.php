<?php include "inc/autoloader.php"; ?>
<?php

$ut_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_codice'])));
$ut_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_nome'])));
$ut_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cognome'])));
$ut_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_indirizzo'])));
$ut_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cap'])));
$ut_citta = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_citta'])));
$ut_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_provincia'])));
$ut_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_telefono'])));
$ut_email = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_email'])));
$ut_password = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_password'])));
$ut_note = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_note'])));
$ut_data = time();

$querySql = "INSERT INTO ut_utenti (".
    "ut_codice, ut_nome, ut_cognome, ut_indirizzo, ut_cap, ut_citta, ut_provincia, ut_email, ut_password, ut_note, ut_data, ut_stato ".
    ") VALUES (".
    "'$ut_codice', '$ut_nome', '$ut_cognome', '$ut_indirizzo', '$ut_cap', '$ut_citta', '$ut_provincia', '$ut_email', '$ut_password', '$ut_note', '$ut_data', 1 )";
    "$ut_password', '$ut_note', '$ut_data', '1', ".
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-add.php?insert=true");
else header("Location: clienti-add.php?insert=false");
?>