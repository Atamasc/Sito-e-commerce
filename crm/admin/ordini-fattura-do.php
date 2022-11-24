<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT or_fattura FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);

if (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_fattura = $row_data['or_fattura'];
    if ($or_fattura == 0) $or_fattura = 1; else $or_fattura = 0;

};

$result->close();

$querySql = "UPDATE or_ordini SET or_fattura = '$or_fattura' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>