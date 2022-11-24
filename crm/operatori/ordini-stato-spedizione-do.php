<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = (int)$_GET["or_codice"];

// Gestione Stato Spedizione
$querySql = "SELECT or_stato_spedizione FROM or_ordini WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$row_data = @$result->fetch_assoc();
$result->close();

$or_stato_spedizione = $row_data['or_stato_spedizione'] + 1;
if ($or_stato_spedizione > 2) $or_stato_spedizione = 0;

$querySql = "UPDATE or_ordini SET or_stato_spedizione = '$or_stato_spedizione' WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

echo "<script>window.location=document.referrer;</script>";
?>
