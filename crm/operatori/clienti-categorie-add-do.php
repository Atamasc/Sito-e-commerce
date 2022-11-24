<?php include "inc/autoloader.php"; ?>
<?php
$ct_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_titolo'])));
$ct_timestamp = time();

$querySql =
    "INSERT INTO ct_categoria(ct_titolo, ct_timestamp, ct_stato) VALUES ('$ct_titolo', '$ct_timestamp', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-categorie-add.php?insert=true");
else header("Location: clienti-categorie-add.php?insert=false");

?>