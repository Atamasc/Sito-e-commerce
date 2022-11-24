<?php include "inc/autoloader.php"; ?>
<?php
$pr_id = (int)$_POST['pr_id'];

$pr_codice_produzione = $dbConn->real_escape_string(stripslashes(trim($_POST['pr_codice_produzione'])));

$querySql =
    "UPDATE pr_prodotti SET ".
    "pr_codice_produzione = '$pr_codice_produzione' ".
    "WHERE pr_id = '$pr_id' ";

//echo $querySql; exit();
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-gst.php?update=true");
else header("Location: prodotti-gst.php?update=false");
?>