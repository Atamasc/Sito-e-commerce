<?php include "inc/autoloader.php"; ?>
<?php
$pr_id = (int)$_POST['pr_id'];

$pr_ct_id = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_ct_id'])));
$pr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice'])));
$pr_barcode = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_barcode'])));
$pr_iva = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_iva'])));
$pr_prezzo_acquisto = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_acquisto']))));
$pr_prezzo_vendita = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['pr_prezzo_vendita']))));
$pr_um = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_um'])));
$pr_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_descrizione'])));
$pr_tipologia = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_tipologia'])));
$pr_timestamp = time();

$querySql =
    "UPDATE pr_prodotti SET ".
    "pr_ct_id = '$pr_ct_id', pr_codice = '$pr_codice', pr_barcode = '$pr_barcode', pr_prezzo_acquisto = '$pr_prezzo_acquisto', pr_prezzo_vendita = '$pr_prezzo_vendita', ".
    "pr_um = '$pr_um', pr_iva = '$pr_iva', pr_descrizione = '$pr_descrizione', pr_tipologia = '$pr_tipologia' ".
    "WHERE pr_id = '$pr_id' ";

//echo $querySql; exit();
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-mod.php?pr_id=$pr_id&update=true");
else header("Location: prodotti-mod.php?pr_id=$pr_id&update=false");
?>