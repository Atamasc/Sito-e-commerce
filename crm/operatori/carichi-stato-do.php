<?php include('inc/autoloader.php'); ?>
<?php
$cr_id = (int)$_GET["cr_id"];

$querySql = "UPDATE cr_carichi SET cr_stato = 1 - cr_stato WHERE cr_id = '$cr_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?cr_id=".$cr_id."&stato=true' />";

?>
