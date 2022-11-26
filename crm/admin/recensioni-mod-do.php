<?php include "inc/autoloader.php"; ?>
<?php
$rc_id = (int)$_POST['rc_id'];
$rc_pr_id = (int)$_POST['rc_pr_id'];

$rc_testo = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_descrizione"])));
$rc_voto = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_voto"])));
$rc_ut_codice = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_ut_codice"])));

$rc_pr_codice = getCodiceProdottoById($rc_pr_id, $dbConn);
$rc_nominativo = getNomeClienteByCOdice($rc_ut_codice, $dbConn);

$rc_timestamp = time();


$querySql = "UPDATE rc_recensioni SET ".
            "rc_testo = '$rc_testo', ".
            "rc_voto = '$rc_voto', ".
            "rc_timestamp = '$rc_timestamp', ".
            "rc_ut_codice = '$rc_ut_codice', ".
            "rc_pr_id = '$rc_pr_id', ".
            "rc_pr_codice = '$rc_pr_codice', ".
            "rc_nominativo = '$rc_nominativo' ".
            "WHERE rc_id = $rc_id";


$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: recensioni-mod.php?rc_id=$rc_id&update=true");
else header("Location: recensioni-mod.php?rc_id=$rc_id&&update=false");

?>