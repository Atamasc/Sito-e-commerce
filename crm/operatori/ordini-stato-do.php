<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = (int)$_GET["or_codice"];

$querySql =
    "SELECT or_pr_quantita, or_gi_id FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while ($row_data = $result->fetch_assoc()) {

    $or_gi_id = $row_data['or_gi_id'];
    $or_pr_quantita = $row_data['or_pr_quantita'];

    $querySql_up = "UPDATE gi_giacenze SET gi_quantita = gi_quantita - $or_pr_quantita WHERE gi_id = '$or_gi_id' ";
    $result_up = $dbConn->query($querySql_up);

    createLogGiacenze($or_gi_id, "Scarico da ordine", "-$or_pr_quantita", $or_codice);

}
$result->close();

$querySql = "UPDATE or_ordini SET or_stato_spedizione = '3' WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql = "UPDATE or_ordini SET or_stato = 1 - or_stato WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
