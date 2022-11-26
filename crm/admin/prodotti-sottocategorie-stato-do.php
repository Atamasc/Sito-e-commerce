<?php include('inc/autoloader.php'); ?>
<?php
$st_id = (int)$_GET["st_id"];

$querySql = "SELECT st_stato FROM st_sottocategorie WHERE st_id = '$st_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$st_stato = $row_data['st_stato'];

switch($st_stato){
    case 0:
        $st_stato = 1;
        break;
    case 1:
        $st_stato = 0;
}

$result->close();

$querySql = "UPDATE st_sottocategorie SET st_stato = '$st_stato' WHERE st_id = '$st_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?ut_id=".$ut_id."&stato=true' />";

?>