<?php include 'inc/autoloader.php'; ?>
<?php
$ci_id = (int)$_POST['ci_id'];
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

$querySql = "UPDATE ci_corrieri SET ci_titolo = '$ci_titolo', ci_descrizione = '$ci_descrizione', ci_costo_standard = '$ci_costo_standard', ci_costo_espressa = '$ci_costo_espressa', ".
    "ci_costo_estera = '$ci_costo_estera', ci_ordine_minimo = '$ci_ordine_minimo', ci_tempi_standard = '$ci_tempi_standard', ci_tempi_espressa = '$ci_tempi_espressa', ci_spedizione_estera = '$ci_spedizione_estera', ci_timestamp = '$timestamp' WHERE ci_id = $ci_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$update = $rows > 0 ? 'true' : 'false';

header("Location: spedizionieri-mod.php?ci_id=$ci_id&update=$update");
?>