<?php include('inc/autoloader.php'); ?>
<?php
$at_id = (int)$_GET["at_id"];

$querySql = "SELECT at_stato FROM at_attivita WHERE at_id = '$at_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$at_stato = $row_data['at_stato'];

switch($at_stato){
    case 0:
        $at_stato = 1;
        break;
    case 1:
        $at_stato = 0;
}

$result->close();

$querySql = "UPDATE at_attivita SET at_stato = '$at_stato' WHERE at_id = '$at_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

//echo $result;
?>
