<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_POST["or_codice"];
$or_note_admin = $dbConn->real_escape_string(stripslashes(trim($_POST['or_note_admin'])));

$querySql = "UPDATE or_ordini SET or_note_admin = '$or_note_admin' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>