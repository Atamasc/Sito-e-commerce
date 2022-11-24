<?php include('inc/autoloader.php'); ?>
<?php
$op_id = (int)$_GET["op_id"];

$querySql = "DELETE FROM op_operatori WHERE op_id = '$op_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=operatori-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=operatori-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>