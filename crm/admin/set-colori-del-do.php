<?php include 'inc/autoloader.php'; ?>

<?php
$get_cl_id = (int)$_GET['cl_id'];

$querySql = "DELETE FROM cl_colori WHERE cl_id = $get_cl_id";
$result = $dbConn->query($querySql);
$rowscat = $dbConn->affected_rows;

if($rowscat > 0) header("Location: set-colori-gst.php?delete=true");
else header("Location: set-colori-gst.php?delete=false");
?>