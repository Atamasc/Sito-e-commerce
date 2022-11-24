<?php include "inc/autoloader.php"; ?>
<?php
$ca_id = (int)$_POST["ca_id"];
$ca_cv_id = (int)$_POST["ca_cv_id"];
$ca_cl_id = (int)$_POST["ca_cl_id"];

$ca_timestamp_attivazione = $dbConn->real_escape_string(stripslashes(trim($_POST["ca_timestamp_attivazione"])));
$ca_timestamp_scadenza = $dbConn->real_escape_string(stripslashes(trim($_POST["ca_timestamp_scadenza"])));

list($day, $month, $year) = explode("/", $ca_timestamp_attivazione);
$ca_timestamp_attivazione = mktime(0, 0, 0, $month, $day, $year);

list($day, $month, $year) = explode("/", $ca_timestamp_scadenza);
$ca_timestamp_scadenza = mktime(0, 0, 0, $month, $day, $year);

if($ca_id > 0) {

    $querySql =
        "UPDATE ca_convenzioni_clienti SET ca_cl_id = '$ca_cl_id', ca_timestamp_attivazione = '$ca_timestamp_attivazione', ".
        "ca_timestamp_scadenza = '$ca_timestamp_scadenza' WHERE ca_id = '$ca_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if($rows > 0) header("Location: convenzioni-clienti.php?ca_id=$ca_id&cv_id=$ca_cv_id&update=true");
    else header("Location: convenzioni-clienti.php?ca_id=$ca_id&cv_id=$ca_cv_id&update=false");

} else {

    $querySql =
        "INSERT INTO ca_convenzioni_clienti (ca_cv_id, ca_cl_id, ca_timestamp_attivazione, ca_timestamp_scadenza, ca_stato".
        ") VALUES ('$ca_cv_id', '$ca_cl_id', '$ca_timestamp_attivazione', '$ca_timestamp_scadenza', 1)";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if($rows > 0) header("Location: convenzioni-clienti.php?cv_id=$ca_cv_id&insert=true");
    else header("Location: convenzioni-clienti.php?cv_id=$ca_cv_id&insert=false");

}
?>