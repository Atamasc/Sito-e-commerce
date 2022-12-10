<?php include 'inc/autoloader.php'; ?>
<?php
$ci_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['ci_titolo'])));
$ci_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ci_descrizione'])));
$ci_costo_standard = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['ci_costo_standard']))));
$ci_costo_espressa = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['ci_costo_espressa']))));
$ci_costo_estera = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['ci_costo_estera']))));
$ci_ordine_minimo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['ci_ordine_minimo']))));
$ci_tempi_standard = $dbConn->real_escape_string(stripslashes(trim($_POST['ci_tempi_standard'])));
$ci_tempi_espressa = $dbConn->real_escape_string(stripslashes(trim($_POST['ci_tempi_espressa'])));
$ci_spedizione_estera = isset($_POST['ci_spedizione_estera']) ? 1 : 0;

$timestamp = time();

$querySql = "INSERT INTO ci_corrieri (ci_titolo, ci_descrizione, ci_costo_standard, ci_costo_espressa, ci_costo_estera, ci_ordine_minimo, ci_tempi_standard, ci_tempi_espressa, ci_spedizione_estera, ci_timestamp, ci_stato) " .
    "VALUES ('$ci_titolo', '$ci_descrizione', '$ci_costo_standard', '$ci_costo_espressa', '$ci_costo_estera', '$ci_ordine_minimo', '$ci_tempi_standard', '$ci_tempi_espressa', '$ci_spedizione_estera', '$timestamp', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';
header("Location: corrieri-add.php?insert=$insert");
?>