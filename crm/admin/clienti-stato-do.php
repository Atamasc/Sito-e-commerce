<?php include('inc/autoloader.php'); ?>
<?php
$cl_id = (int)$_GET["cl_id"];

$querySql = "SELECT cl_stato FROM cl_clienti WHERE cl_id = '$cl_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$cl_stato = $row_data['cl_stato'];

switch($cl_stato){
    case 0:
        $cl_stato = 1;
        break;
    case 1:
        $cl_stato = 0;
}

$result->close();

$querySql = "UPDATE cl_clienti SET cl_stato = '$cl_stato' WHERE cl_id = '$cl_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?cl_id=".$cl_id."&stato=true' />";

?>
