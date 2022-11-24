<?php include('inc/autoloader.php'); ?>
<?php
$lt_id = (int)$_GET["lt_id"];

$querySql = "DELETE FROM lt_lotti WHERE lt_id = $lt_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=lotti-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=lotti-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
