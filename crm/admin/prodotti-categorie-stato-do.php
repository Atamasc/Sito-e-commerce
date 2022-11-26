<?php include('inc/autoloader.php'); ?>
<?php
$ct_id = (int)$_GET["ct_id"];

$querySql = "SELECT ct_stato FROM ct_categorie WHERE ct_id = '$ct_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$ct_stato = $row_data['ct_stato'];

switch($ct_stato){
    case 0:
        $ct_stato = 1;
        break;
    case 1:
        $ct_stato = 0;
}

$result->close();

$querySql = "UPDATE ct_categorie SET ct_stato = '$ct_stato' WHERE ct_id = '$ct_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?ut_id=".$ut_id."&stato=true' />";

?>