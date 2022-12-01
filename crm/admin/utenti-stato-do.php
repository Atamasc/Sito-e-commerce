<?php include('inc/autoloader.php'); ?>
<?php
$ut_id = (int)$_GET["ut_id"];

$querySql = "SELECT ut_stato FROM ut_utenti WHERE ut_id = '$ut_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$ut_stato = $row_data['ut_stato'];

switch($ut_stato){
    case 0:
        $ut_stato = 1;
        break;
    case 1:
        $ut_stato = 0;
}

$result->close();

$querySql = "UPDATE ut_utenti SET ut_stato = '$ut_stato' WHERE ut_id = '$ut_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?ut_id=".$ut_id."&stato=true' />";

?>
