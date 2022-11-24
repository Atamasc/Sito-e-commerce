<?php include "inc/autoloader.php"; ?>
<?php
$cv_id = (int)$_POST["cv_id"];

$cv_codice = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_codice"])));
$cv_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_titolo"])));
$cv_abstract = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_abstract"])));
$cv_intestazione = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_intestazione"])));
$cv_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_descrizione"])));
$cv_specifiche_legali = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_specifiche_legali"])));
$cv_canone = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST["cv_canone"]))));
$cv_condizioni = $dbConn->real_escape_string(stripslashes(trim($_POST["cv_condizioni"])));
$cv_personalizzato = isset($_POST["cv_personalizzato"]) ? 1 : 0;

$querySql =
    "UPDATE cv_convenzioni SET cv_codice = '$cv_codice', cv_titolo = '$cv_titolo', cv_abstract = '$cv_abstract', ".
    "cv_intestazione = '$cv_intestazione', cv_descrizione = '$cv_descrizione', cv_specifiche_legali = '$cv_specifiche_legali', ".
    "cv_canone = '$cv_canone', cv_condizioni = '$cv_condizioni', cv_personalizzato = '$cv_personalizzato' ".
    "WHERE cv_id = $cv_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: convenzioni-mod.php?cv_id=$cv_id&update=true");
else header("Location: convenzioni-mod.php?cv_id=$cv_id&update=false");
?>