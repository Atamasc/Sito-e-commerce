<?php include 'inc/autoloader.php'; ?>
<?php
$co_coupon = $dbConn->real_escape_string(stripslashes(trim($_POST['co_coupon'])));
$co_tipo = $dbConn->real_escape_string(stripslashes(trim($_POST['co_tipo'])));
$co_valore = $dbConn->real_escape_string(stripslashes(trim($_POST['co_valore'])));
$co_utilizzi = $dbConn->real_escape_string(stripslashes(trim($_POST['co_utilizzi'])));
$co_mr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['co_mr_codice'])));
$co_spedizione = isset($_POST['co_spedizione']) ? 1 : 0;

$serial_date = time();

$querySql = "INSERT INTO co_coupon (co_mr_codice, co_coupon, co_tipo, co_valore, co_spedizione, co_utilizzi, co_timestamp, co_stato) VALUES ('$co_mr_codice', '$co_coupon', '$co_tipo', '$co_valore', '$co_spedizione', '$co_utilizzi', '$serial_date', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: coupon-add.php?insert=$insert");
?>