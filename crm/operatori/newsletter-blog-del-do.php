<?php include('inc/autoloader.php'); ?>
<?php
$nb_id = (int)$_GET["nb_id"];

$querySql = "DELETE FROM nb_newsletter_blog WHERE nb_id = $nb_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-blog-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-blog-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
