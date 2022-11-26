<?php include 'inc/autoloader.php'; ?>

<?php
$get_ut_id = (int)$_GET['ut_id'];

$querySql = "DELETE FROM ut_colori WHERE ut_id = $get_ut_id";
$result = $dbConn->query($querySql);
$rowscat = $dbConn->affected_rows;

if($rowscat > 0) header("Location: set-colori-gst.php?delete=true");
else header("Location: set-colori-gst.php?delete=false");
?>