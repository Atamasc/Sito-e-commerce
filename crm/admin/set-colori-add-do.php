<?php include 'inc/autoloader.php'; ?>

<?php
$ut_colore = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_colore'])));
$ut_rgb = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_rgb'])));

$querySql = "INSERT INTO ut_colori(ut_colore, ut_rgb) VALUE ('$ut_colore', '$ut_rgb')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: set-colori-gst.php?insert=true");
else header("Location: set-colori-gst.php?insert=false");
?>