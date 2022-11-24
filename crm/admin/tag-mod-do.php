<?php include 'inc/autoloader.php'; ?>

<?php
$tg_id = (int)$_POST['tg_id'];
$tg_tag = $dbConn->real_escape_string(stripslashes(trim($_POST['tg_tag'])));
$tg_note = $dbConn->real_escape_string(stripslashes(trim($_POST['tg_note'])));

$querySql =
    "UPDATE tg_tag SET ".
    "tg_tag = '$tg_tag', tg_note = '$tg_note' ".
    "WHERE tg_id = $tg_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: tag-gst.php?tg_id=$tg_id&update=true");
else header("Location: tag-gst.php?tg_id=$tg_id&update=false");
?>