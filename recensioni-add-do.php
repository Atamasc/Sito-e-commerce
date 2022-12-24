<?php include "inc/autoloader.php"; ?>
<?php
$rc_testo = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_testo"])));
$rc_voto = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_voto"])));
$rc_pr_codice = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_pr_codice"])));
$rc_ut_codice = $dbConn->real_escape_string(stripcslashes(trim($_POST["rc_ut_codice"])));
$refer = $dbConn->real_escape_string(stripcslashes(trim($_POST["refer"])));

$rc_nominativo = getNomeClienteByCodice($rc_ut_codice, $dbConn);

if (strlen($rc_testo) > 0 && strlen($rc_nominativo) > 0 && strlen($rc_voto) > 0) {

    $rc_timestamp = time();

    $querySql =
        "INSERT INTO rc_recensioni(rc_ut_codice, rc_pr_codice, rc_nominativo, rc_testo, rc_voto, rc_timestamp, rc_stato) VALUES" .
        "('$rc_ut_codice', '$rc_pr_codice', '$rc_nominativo', '$rc_testo', '$rc_voto', $rc_timestamp, 1)";

    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $dbConn->close();

    if ($rows > 0) header("Location: $refer");
    else header("Location: $refer");

} else {
    header("Location: $refer");
}
