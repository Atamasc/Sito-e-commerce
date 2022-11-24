<?php include 'inc/autoloader.php'; ?>
<?php
$ba_numero = $dbConn->real_escape_string(stripslashes(trim($_POST['ba_numero'])));
$ba_orari = $dbConn->real_escape_string(stripslashes(trim($_POST['ba_orari'])));

$querySql = "INSERT INTO ba_beauty_assistant (ba_numero, ba_orari, ba_stato) VALUES ('$ba_numero', '$ba_orari', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: beauty-add.php?insert=$insert");
?>