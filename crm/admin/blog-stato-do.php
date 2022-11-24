<?php include('inc/autoloader.php'); ?>
<?php
$bl_id = (int)$_GET["bl_id"];

$querySql = "SELECT bl_stato FROM bl_blog WHERE bl_id = '$bl_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$bl_stato = $row_data['bl_stato'];

switch($bl_stato){
    case 0:
        $bl_stato = 1;
        break;
    case 1:
        $bl_stato = 0;
}

$result->close();

$querySql = "UPDATE bl_blog SET bl_stato = '$bl_stato' WHERE bl_id = '$bl_id'";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?bl_id=".$bl_id."&stato=true' />";

?>
