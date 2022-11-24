<?php include('inc/autoloader.php'); ?>
<?php
$rc_id = (int)$_GET["rc_id"];

$querySql = "SELECT rc_stato FROM rc_recensioni WHERE rc_id = '$rc_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$rc_stato = $row_data['rc_stato'];

switch($rc_stato){
    case 0:
        $rc_stato = 1;
        break;
    case 1:
        $rc_stato = 0;
}

$result->close();

$querySql = "UPDATE rc_recensioni SET rc_stato = $rc_stato WHERE rc_id = '$rc_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?rc__id=".$rc__id."&stato=true' />";

?>