<?php include "inc/autoloader.php"; ?>
<?php
$lt_id = (int)$_POST["lt_id"];
$lt_pr_id = (int)$_POST["lt_pr_id"];
$lt_codice = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_codice"])));
$lt_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_descrizione"])));
$lt_quantita = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_quantita"])));
$lt_refuso = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_refuso"])));
$lt_prezzo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST["lt_prezzo"]))));
$lt_note = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_note"])));
$lt_timestamp = time();

$querySql =
    "UPDATE lt_lotti SET ".
    "lt_pr_id = '$lt_pr_id', lt_codice = '$lt_codice', lt_descrizione = '$lt_descrizione', lt_quantita = '$lt_quantita', lt_refuso = '$lt_refuso', ".
    "lt_prezzo = '$lt_prezzo', lt_note = '$lt_note'".
    "WHERE lt_id = $lt_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: lotti-mod.php?lt_id=$lt_id&update=true");
else header("Location: lotti-mod.php?lt_id=$lt_id&update=false");
?>