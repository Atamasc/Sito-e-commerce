<?php include('inc/autoloader.php'); ?>
<?php
$st_id = (int)$_GET["st_id"];

$querySql = "DELETE FROM st_sottocategorie WHERE st_id = $st_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=sottocategorie-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=sottocategorie-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
