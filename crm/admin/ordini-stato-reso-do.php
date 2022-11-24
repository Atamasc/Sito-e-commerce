<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT or_stato_reso FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);

if (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_stato_reso = $row_data['or_stato_reso'];
    if ($or_stato_reso == 0) $or_stato_reso = 1; else $or_stato_reso = 0;

};

$result->close();

$querySql = "UPDATE or_ordini SET or_stato_reso = '$or_stato_reso' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>