<?php include "inc/autoloader.php"; ?>
<?php
$lt_cr_id = (int)$_POST["lt_cr_id"];
$lt_pr_id = (int)$_POST["lt_pr_id"];
$lt_codice = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_codice"])));
$lt_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_descrizione"])));
$lt_quantita = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_quantita"])));
$lt_refuso = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_refuso"])));
$lt_prezzo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST["lt_prezzo"]))));
$lt_note = $dbConn->real_escape_string(stripslashes(trim($_POST["lt_note"])));
$lt_timestamp = time();

$querySql =
    "INSERT INTO lt_lotti(".
    "lt_cr_id, lt_pr_id, lt_codice, lt_descrizione, lt_quantita, lt_refuso, lt_prezzo, lt_timestamp, lt_note, lt_stato".
    ") VALUES (".
    "'$lt_cr_id', '$lt_pr_id', '$lt_codice', '$lt_descrizione', '$lt_quantita', '$lt_refuso', '$lt_prezzo', '$lt_timestamp', '$lt_note', 1) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$lt_id = $dbConn->insert_id;

$querySql =
    "INSERT INTO gi_giacenze (".
    "gi_pr_id, gi_lt_id, gi_quantita, gi_timestamp, gi_stato".
    ") VALUES (".
    "'$lt_pr_id', '$lt_id', '$lt_quantita', '$lt_timestamp', 1) ";
$result = $dbConn->query($querySql);

if($rows > 0) header("Location: lotti-add.php?cr_id=$lt_cr_id&insert=true");
else header("Location: lotti-add.php?cr_id=$lt_cr_id&insert=false");
?>