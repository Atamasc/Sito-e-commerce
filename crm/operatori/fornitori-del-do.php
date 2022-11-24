<?php include('inc/autoloader.php'); ?>
<?php
$fr_id = (int)$_GET["fr_id"];

$querySql = "DELETE FROM fr_fornitori WHERE fr_id = $fr_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=fornitori-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=fornitori-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>