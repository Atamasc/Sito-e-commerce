<?php include('inc/autoloader.php'); ?>
<?php
$cv_id = (int)$_GET["cv_id"];

$querySql = "SELECT cv_stato FROM cv_convenzioni WHERE cv_id = '$cv_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$cv_stato = $row_data['cv_stato'];

switch($cv_stato){
    case 0:
        $cv_stato = 1;
        break;
    case 1:
        $cv_stato = 0;
}

$result->close();

$querySql = "UPDATE cv_convenzioni SET cv_stato = '$cv_stato' WHERE cv_id = '$cv_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

//echo $result;
?>
