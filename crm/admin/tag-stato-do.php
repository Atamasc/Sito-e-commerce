<?php include('inc/autoloader.php'); ?>
<?php
$tg_id = (int)$_GET["tg_id"];

$querySql = "SELECT tg_stato FROM tg_tag WHERE tg_id = '$tg_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$tg_stato = $row_data['tg_stato'];

switch($tg_stato){
    case 0:
        $tg_stato = 1;
        break;
    case 1:
        $tg_stato = 0;
}

$result->close();

$querySql = "UPDATE tg_tag SET tg_stato = '$tg_stato' WHERE tg_id = '$tg_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?cl_id=".$cl_id."&stato=true' />";

?>