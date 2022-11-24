<?php include 'inc/autoloader.php'; ?>

<?php
$tg_tag = $dbConn->real_escape_string(stripslashes(trim($_POST['tg_tag'])));
$tg_note = $dbConn->real_escape_string(stripslashes(trim($_POST['tg_note'])));

$tg_timestamp = time();

$querySql = "INSERT INTO tg_tag(".
    " tg_tag, tg_note, tg_timestamp, tg_stato".
    ") VALUES (".
    " '$tg_tag', '$tg_note', '$tg_timestamp', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: tag-gst.php?insert=true");
else header("Location: tag-gst.php?insert=false");
?>