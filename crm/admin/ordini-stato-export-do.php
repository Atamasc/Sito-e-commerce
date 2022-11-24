<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = $dbConn->real_escape_string(stripslashes(trim($_GET["or_codice"])));

$querySql = "UPDATE or_ordini SET or_stato_export = 1 - or_stato_export WHERE or_codice = '$or_codice'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?or_id=".$or_id."&stato=true' />";

?>
