<?php include 'inc/autoloader.php'; ?>

<?php
$cl_id = (int)$_POST['cl_id'];
$cl_colore = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_colore'])));
$cl_rgb = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_rgb'])));

$querySql = "UPDATE cl_colori SET 
             cl_colore = '$cl_colore',
             cl_rgb = '$cl_rgb'
             WHERE cl_id = $cl_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: set-colori-gst.php?cl_id=$cl_id&update=true");
else header("Location: set-colori-gst.php?cl_id=$cl_id&update=false");
?>