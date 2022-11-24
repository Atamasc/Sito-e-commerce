<?php include('inc/autoloader.php'); ?>
<?php
$cv_id = (int)$_GET["cv_id"];

$querySql = "DELETE FROM cv_convenzioni WHERE cv_id = $cv_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=convenzioni-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=convenzioni-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
