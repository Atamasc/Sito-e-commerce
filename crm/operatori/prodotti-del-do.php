<?php include('inc/autoloader.php'); ?>
<?php
$pr_id = (int)$_GET["pr_id"];

$querySql = "DELETE FROM pr_prodotti WHERE pr_id = $pr_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=prodotti-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=prodotti-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
