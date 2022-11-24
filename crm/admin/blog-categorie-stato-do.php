<?php include('inc/autoloader.php'); ?>
<?php
$bc_id = (int)$_GET["bc_id"];

$querySql = "SELECT bc_stato FROM bc_blog_categorie WHERE bc_id = $bc_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$bc_stato = $row_data['bc_stato'];

switch($bc_stato){
    case 0:
        $bc_stato = 1;
        break;
    case 1:
        $bc_stato = 0;
}

$result->close();

$querySql = "UPDATE bc_blog_categorie SET bc_stato = $bc_stato WHERE bc_id = $bc_id";
$result = $dbConn->query($querySql);

$querySql = "UPDATE bl_blog SET bl_stato = $bc_stato WHERE bl_bc_id = $bc_id";
$result = $dbConn->query($querySql);

$dbConn->close();

echo $result;
//echo "<meta http-equiv='refresh' content='0;url=anagrafiche-mod.php?bc_id=".$bc_id."&stato=true' />";

?>
