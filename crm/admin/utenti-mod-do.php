<?php include "inc/autoloader.php"; ?>
<?php
$ut_id = (int)$_POST['ut_id'];

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

$querySql =
    "UPDATE ut_utenti SET " .
    "ut_codice = '$ut_codice', ut_nome = '$ut_nome', ut_cognome = '$ut_cognome', ut_indirizzo = '$ut_indirizzo', ut_cap = '$ut_cap', ut_citta = '$ut_citta', " .
    "ut_provincia = '$ut_provincia', ut_telefono = '$ut_telefono', ut_email = '$ut_email', ut_password = '$ut_password', " .
    "ut_note = '$ut_note' " .
    "WHERE ut_id = '$ut_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($rows > 0) header("Location: utenti-mod.php?ut_id=$ut_id&update=true");
else header("Location: utenti-mod.php?ut_id=$ut_id&update=false");

?>