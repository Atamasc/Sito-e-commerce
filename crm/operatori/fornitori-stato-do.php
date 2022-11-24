<?php include('inc/autoloader.php'); ?>
<?php
$fr_id = (int)$_GET["fr_id"];

$querySql = "SELECT fr_stato FROM fr_fornitori WHERE fr_id = '$fr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$fr_stato = $row_data['fr_stato'];

switch($fr_stato){
    case 0:
        $fr_stato = 1;
        break;
    case 1:
        $fr_stato = 0;
}

$result->close();

$querySql = "UPDATE fr_fornitori SET fr_stato = '$fr_stato' WHERE fr_id = '$fr_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?fr_id=".$fr_id."&stato=true' />";

?>