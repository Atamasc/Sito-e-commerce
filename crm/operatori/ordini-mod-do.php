<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = (int)$_POST["or_codice"];
$or_op_id = $dbConn->real_escape_string(stripslashes(trim($_POST['or_op_id'])));

$querySql = "UPDATE or_ordini SET or_op_id = '$or_op_id' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
