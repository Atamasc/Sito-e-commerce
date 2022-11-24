<?php include('inc/autoloader.php'); ?>
<?php
$cr_id = (int)$_GET["cr_id"];
$cv_id = (int)$_GET["cv_id"];

$querySql = "DELETE FROM cr_convenzioni_cer WHERE cr_id = $cr_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=convenzioni-cer.php?cv_id=$cv_id&delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=convenzioni-cer.php?cv_id=$cv_id&delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
