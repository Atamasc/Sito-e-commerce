<?php include('inc/autoloader.php'); ?>
<?php
$cl_id = (int)$_GET["cl_id"];

$querySql = "DELETE FROM cl_clienti WHERE cl_id = $cl_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=clienti-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=clienti-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
