<?php include('inc/autoloader.php'); ?>
<?php
$sd_id = (int)$_GET["sd_id"];
$ut_id = (int)$_GET["ut_id"];

$querySql = "DELETE FROM sd_sedi WHERE sd_id = $sd_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=clienti-sedi.php?ut_id=$ut_id&delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=clienti-sedi.php?ut_id=$ut_id&delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
