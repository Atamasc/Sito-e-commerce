<?php include('inc/autoloader.php'); ?>
<?php
$ct_id = (int)$_GET["ct_id"];

$querySql = "DELETE FROM ct_categoria WHERE ct_id = $ct_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=clienti-categorie-add.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=clienti-categorie-add.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
