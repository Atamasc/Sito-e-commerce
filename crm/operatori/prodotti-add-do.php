<?php include "inc/autoloader.php"; ?>
<?php

$pr_ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_ct_id'])));
$pr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice'])));
$pr_barcode = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_barcode'])));
$pr_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_iva'])));
$pr_prezzo_acquisto = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_acquisto'])));
$pr_prezzo_vendita = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_vendita'])));
$pr_um = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_um'])));
$pr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_descrizione'])));
$pr_tipologia = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_tipologia'])));
$pr_timestamp = time();

$querySql =
        "INSERT INTO pr_prodotti (" .
        "pr_ct_id, pr_codice, pr_barcode, pr_iva, pr_prezzo_acquisto, pr_prezzo_vendita, pr_um, pr_descrizione, pr_tipologia, pr_timestamp, pr_stato) VALUES (" .
        "'$pr_ct_id', '$pr_codice', '$pr_barcode', '$pr_iva', '$pr_prezzo_acquisto', '$pr_prezzo_vendita', '$pr_um', '$pr_descrizione', '$pr_tipologia', '$pr_timestamp', 1) ";

$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-add.php?insert=true");
else header("Location: prodotti-add.php?insert=false");
?>