<?php include "inc/autoloader.php"; ?>
<?php

$op_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['op_nome'])));
$op_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['op_cognome'])));
$op_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['op_codice'])));
$op_password = $dbConn->real_escape_string(stripslashes(trim($_POST['op_password'])));
$op_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['op_telefono'])));
$op_email = $dbConn->real_escape_string(stripslashes(trim($_POST['op_email'])));
$op_note = $dbConn->real_escape_string(stripslashes(trim($_POST['op_note'])));
$op_timestamp = time();

$querySql =
    "INSERT INTO op_operatori (".
    "op_nome, op_cognome, op_codice, op_password, op_telefono, op_email, op_note, ".
    "op_timestamp, op_stato) VALUES (".
    "'$op_nome', '$op_cognome', '$op_codice', '$op_password', '$op_telefono', '$op_email', '$op_note', ".
    "'$op_timestamp', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: operatori-add.php?insert=true");
else header("Location: operatori-add.php?insert=false");
?>