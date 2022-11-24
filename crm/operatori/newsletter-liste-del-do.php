<?php include('inc/autoloader.php'); ?>
<?php
$ns_id = (int)$_GET["ns_id"];

$querySql = "DELETE FROM ns_newsletter_liste WHERE ns_id = $ns_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
