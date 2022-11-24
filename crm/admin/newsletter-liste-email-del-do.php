<?php include('inc/autoloader.php'); ?>
<?php
$ne_id = (int)$_GET["ne_id"];
$ne_ns_id = (int)$_GET["ne_ns_id"];

$querySql = "DELETE FROM ne_newsletter_email WHERE ne_id = $ne_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
