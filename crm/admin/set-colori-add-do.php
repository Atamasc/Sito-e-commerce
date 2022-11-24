<?php include 'inc/autoloader.php'; ?>

<?php
$cl_colore = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_colore'])));
$cl_rgb = $dbConn->real_escape_string(stripslashes(trim($_POST['cl_rgb'])));

$querySql = "INSERT INTO cl_colori(cl_colore, cl_rgb) VALUE ('$cl_colore', '$cl_rgb')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: set-colori-gst.php?insert=true");
else header("Location: set-colori-gst.php?insert=false");
?>