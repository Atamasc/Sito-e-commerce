<?php include "inc/autoloader.php"; ?>
<?php
$rc_testo = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_descrizione"])));
$rc_voto = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_voto"])));
$rc_pr_id = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_pr_id"])));
$rc_ut_codice = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_ut_codice"])));

$rc_pr_codice = getCodiceProdottoById($rc_pr_id, $dbConn);

$rc_nominativo = getNomeClienteByCOdice($rc_ut_codice, $dbConn);


    $rc_timestamp = time();

    $querySql =
        "INSERT INTO rc_recensioni(rc_ut_codice, rc_pr_codice, rc_nominativo, rc_testo, rc_voto, rc_timestamp, rc_pr_id, rc_stato) VALUES" .
        "('$rc_ut_codice', '$rc_pr_codice', '$rc_nominativo', '$rc_testo', '$rc_voto', '$rc_timestamp', '$rc_pr_id', 1)";

    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

if($rows > 0) header("Location: recensioni-add.php?insert=true");
else header("Location: recensioni-add.php?insert=false");

?>