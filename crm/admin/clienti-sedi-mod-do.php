<?php include "inc/autoloader.php"; ?>
<?php
$sd_id = (int)$_POST["sd_id"];
$sd_ut_id = (int)$_POST["sd_ut_id"];
$sd_sede = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_sede"])));
$sd_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_indirizzo"])));
$sd_cap = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_cap"])));
$sd_citta = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_citta"])));
$sd_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_provincia"])));
$sd_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_telefono"])));
$sd_fax = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_fax"])));
$sd_email = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_email"])));
$sd_formulari = $dbConn->real_escape_string(stripslashes(trim($_POST["sd_formulari"])));

$querySql =
    "UPDATE sd_sedi SET sd_ut_id = '$sd_ut_id', sd_sede = '$sd_sede', sd_indirizzo = '$sd_indirizzo', sd_cap = '$sd_cap', ".
    "sd_citta = '$sd_citta', sd_provincia = '$sd_provincia', sd_telefono = '$sd_telefono', sd_fax = '$sd_fax', ".
    "sd_email = '$sd_email', sd_formulari = '$sd_formulari' ".
    "WHERE sd_id = $sd_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-sedi.php?sd_id=$sd_id&ut_id=$sd_ut_id&update=true");
else header("Location: clienti-sedi.php?sd_id=$sd_id&ut_id=$sd_ut_id&update=false");
?>