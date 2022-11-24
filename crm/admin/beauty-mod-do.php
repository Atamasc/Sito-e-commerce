<?php include 'inc/autoloader.php'; ?>
<?php
$ba_id = (int)$_POST['ba_id'];
$ba_numero = $dbConn->real_escape_string(stripslashes(trim($_POST['ba_numero'])));
$ba_orari = $dbConn->real_escape_string(stripslashes(trim($_POST['ba_orari'])));
$ba_stato = $dbConn->real_escape_string(stripslashes(trim($_POST['ba_stato'])));

$querySql = "UPDATE ba_beauty_assistant SET ba_numero = '$ba_numero', ba_orari = '$ba_orari', ba_stato = '$ba_stato' WHERE ba_id = $ba_id";
$result = $dbConn->query($querySql);

header("Location: beauty-mod.php?ba_id=$ba_id&update=true");
?>