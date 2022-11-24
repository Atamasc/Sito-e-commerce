<?php include('inc/autoloader.php'); ?>
<?php
$nl_id = (int)$_GET["nl_id"];

$querySql = "DELETE FROM nl_newsletter WHERE nl_id = $nl_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
