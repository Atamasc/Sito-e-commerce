<?php include 'inc/autoloader.php'; ?>
<?php
$co_id = (int)$_POST['co_id'];
$co_coupon = $dbConn->real_escape_string(stripslashes(trim($_POST['co_coupon'])));
$co_mr_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['co_mr_codice'])));
$co_tipo = $dbConn->real_escape_string(stripslashes(trim($_POST['co_tipo'])));
$co_valore = $dbConn->real_escape_string(stripslashes(trim($_POST['co_valore'])));
$co_utilizzi = $dbConn->real_escape_string(stripslashes(trim($_POST['co_utilizzi'])));
$co_stato = $dbConn->real_escape_string(stripslashes(trim($_POST['co_stato'])));
$co_spedizione = isset($_POST['co_spedizione']) ? 1 : 0;

$querySql = "UPDATE co_coupon SET co_coupon = '$co_coupon', co_mr_codice = '$co_mr_codice', co_tipo = '$co_tipo', co_valore = '$co_valore', co_spedizione = '$co_spedizione', co_utilizzi = '$co_utilizzi', co_stato = '$co_stato' WHERE co_id = $co_id";
$result = $dbConn->query($querySql);

header("Location: coupon-mod.php?co_id=$co_id&update=true");
?>