<?php include "inc/autoloader.php"; ?>
<?php
$fr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_codice'])));
$fr_ragione_sociale = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_ragione_sociale'])));
$fr_cod_fiscale = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_cod_fiscale'])));
$fr_partita_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_partita_iva'])));
$fr_sdi = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_sdi'])));
$fr_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_telefono'])));
$fr_cellulare = $dbConn->real_escape_string(stripcslashes(trim($_POST['fr_cellulare'])));
$fr_email = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_email'])));
$fr_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_indirizzo'])));
$fr_comune = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_comune'])));
$fr_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_provincia'])));
$fr_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_cap'])));
$fr_note = $dbConn->real_escape_string(stripslashes(trim($_POST['fr_note'])));
$fr_timestamp = time();

$querySql =
    "INSERT INTO fr_fornitori (".
    "fr_codice, fr_ragione_sociale, fr_cod_fiscale, fr_partita_iva, fr_sdi, fr_telefono, fr_email, ".
    "fr_indirizzo, fr_comune, fr_provincia, fr_cap, fr_note, ".
    "fr_cellulare,".
    "fr_timestamp, fr_stato) VALUES (".
    "'$fr_codice', '$fr_ragione_sociale', '$fr_cod_fiscale', '$fr_partita_iva', '$fr_sdi', '$fr_telefono', '$fr_email', ".
    "'$fr_indirizzo', '$fr_comune', '$fr_provincia', '$fr_cap', '$fr_note', '$fr_cellulare', ".
    "'$fr_timestamp', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;


if($rows > 0) header("Location: fornitori-add.php?insert=true");
else header("Location: fornitori-add.php?insert=false");
?>