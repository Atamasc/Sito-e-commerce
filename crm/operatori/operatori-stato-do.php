<?php include('inc/autoloader.php'); ?>
<?php
$op_id = (int)$_GET["op_id"];

$querySql = "SELECT op_stato FROM op_operatori WHERE op_id = '$op_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$op_stato = $row_data['op_stato'];

switch($op_stato){
    case 0:
        $op_stato = 1;
        break;
    case 1:
        $op_stato = 0;
}

$result->close();

$querySql = "UPDATE op_operatori SET op_stato = '$op_stato' WHERE op_id = '$op_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?op_id=".$op_id."&stato=true' />";

?>