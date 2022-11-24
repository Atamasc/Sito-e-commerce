<?php include('inc/autoloader.php'); ?>
<?php
$ct_id = (int)$_GET["ct_id"];

$querySql = "UPDATE ct_categoria SET ct_stato = 1 - ct_stato WHERE ct_id = '$ct_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?ct_id=".$ct_id."&stato=true' />";

?>
