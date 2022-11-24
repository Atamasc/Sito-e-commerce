<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_POST["or_codice"];
$or_tracking = $dbConn->real_escape_string(stripslashes(trim($_POST['or_tracking'])));

$querySql = "UPDATE or_ordini SET or_tracking = '$or_tracking' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
