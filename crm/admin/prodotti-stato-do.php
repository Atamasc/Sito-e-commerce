<?php include('inc/autoloader.php'); ?>
<?php
$pr_id = (int)$_GET["pr_id"];

$querySql = "SELECT pr_stato FROM pr_prodotti WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$pr_stato = $row_data['pr_stato'];

switch($pr_stato){
    case 0:
        $pr_stato = 1;
        break;
    case 1:
        $pr_stato = 0;
}

$result->close();

$querySql = "UPDATE pr_prodotti SET pr_stato = '$pr_stato' WHERE pr_id = '$pr_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?ut_id=".$ut_id."&stato=true' />";

?>
