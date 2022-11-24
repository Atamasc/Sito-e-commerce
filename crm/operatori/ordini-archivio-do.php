<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = (int)$_GET["or_codice"];

$querySql = "SELECT or_archivio FROM or_ordini WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);

if (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_archivio = $row_data['or_archivio'];
    if ($or_archivio == 0) $or_archivio = 1; else $or_archivio = 0;

};

$result->close();

$querySql = "UPDATE or_ordini SET or_archivio = '$or_archivio' WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
