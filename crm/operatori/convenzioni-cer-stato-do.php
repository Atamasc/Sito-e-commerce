<?php include('inc/autoloader.php'); ?>
<?php
$cr_id = (int)$_GET["cr_id"];

$querySql = "SELECT cr_stato FROM cr_convenzioni_cer WHERE cr_id = '$cr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$cr_stato = $row_data['cr_stato'];

switch($cr_stato){
    case 0:
        $cr_stato = 1;
        break;
    case 1:
        $cr_stato = 0;
}

$result->close();

$querySql = "UPDATE cr_convenzioni_cer SET cr_stato = '$cr_stato' WHERE cr_id = '$cr_id'";
$result = $dbConn->query($querySql);

$dbConn->close();
?>
