<?php include('inc/autoloader.php'); ?>
<?php
$lt_id = (int)$_GET["lt_id"];

$querySql = "UPDATE lt_lotti SET lt_stato = 1 - lt_stato WHERE lt_id = '$lt_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?lt_id=".$lt_id."&stato=true' />";

?>
