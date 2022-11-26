<?php include('inc/autoloader.php'); ?>
<?php
$ut_id = (int)$_GET["ut_id"];

$querySql = "DELETE FROM ut_utenti WHERE ut_id = '$ut_id' ";
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
