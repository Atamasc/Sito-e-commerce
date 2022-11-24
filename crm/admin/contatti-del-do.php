<?php include('inc/autoloader.php'); ?>
<?php
$co_id = (int)$_GET["co_id"];

$querySql = "DELETE FROM co_contatto WHERE co_id = $co_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=contatti-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=contatti-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
