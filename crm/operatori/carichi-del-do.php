<?php include('inc/autoloader.php'); ?>
<?php
$cr_id = (int)$_GET["cr_id"];

$querySql = "DELETE FROM cr_carichi WHERE cr_id = $cr_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=carichi-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=carichi-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
