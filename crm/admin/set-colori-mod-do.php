<?php include 'inc/autoloader.php'; ?>

<?php
$ut_id = (int)$_POST['ut_id'];
$ut_colore = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_colore'])));
$ut_rgb = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_rgb'])));

$querySql = "UPDATE ut_colori SET 
             ut_colore = '$ut_colore',
             ut_rgb = '$ut_rgb'
             WHERE ut_id = $ut_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: set-colori-gst.php?ut_id=$ut_id&update=true");
else header("Location: set-colori-gst.php?ut_id=$ut_id&update=false");
?>