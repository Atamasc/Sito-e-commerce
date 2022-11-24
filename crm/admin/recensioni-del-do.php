<?php include('inc/autoloader.php'); ?>
<?php
$rc_id = (int)$_GET["rc_id"];

$querySql = "DELETE FROM rc_recensioni WHERE rc_id = $rc_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=recensioni-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=recensioni-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
