<?php include "inc/autoloader.php"; ?>
<?php
$op_id = (int)$_POST['op_id'];

$op_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['op_nome'])));
$op_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['op_cognome'])));
$op_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['op_codice'])));
$op_password = $dbConn->real_escape_string(stripslashes(trim($_POST['op_password'])));
$op_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['op_telefono'])));
$op_email = $dbConn->real_escape_string(stripslashes(trim($_POST['op_email'])));
$op_note = $dbConn->real_escape_string(stripslashes(trim($_POST['op_note'])));

$querySql =
    "UPDATE op_operatori SET ".
    "op_nome = '$op_nome', op_cognome = '$op_cognome', op_codice = '$op_codice', op_password = '$op_password', op_telefono = '$op_telefono', ".
    "op_email = '$op_email', op_note = '$op_note' ".
    "WHERE op_id = '$op_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: operatori-mod.php?op_id=$op_id&update=true");
else header("Location: operatori-mod.php?op_id=$op_id&update=false");

?>