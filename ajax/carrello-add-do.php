<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$cr_pr_quantita = isset($_GET['pr_quantita']) && $_GET['pr_quantita'] > 0 ? (int)$_GET['pr_quantita'] : 1;
$cr_pr_codice = isset($_GET['pr_codice']) ? $dbConn->real_escape_string(trim(stripslashes($_GET["pr_codice"]))) : "";

$querySql = "SELECT COUNT(cr_id) FROM cr_carrello WHERE cr_cl_codice = '$session_cl_codice' AND cr_pr_codice = '$cr_pr_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->fetch_array()[0];
$result->close();

if ($rows > 0) {

    $querySql =
        "UPDATE cr_carrello SET cr_pr_quantita = '$cr_pr_quantita' ".
        "WHERE cr_cl_codice = '$session_cl_codice' AND cr_pr_codice = '$cr_pr_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

} else {

    $serial_date = time();

    $querySql =
        "INSERT INTO cr_carrello (cr_cl_codice, cr_pr_codice, cr_pr_quantita, cr_timestamp) ".
        "VALUES ('$session_cl_codice', '$cr_pr_codice', '$cr_pr_quantita', '$serial_date')";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

?>
<?php include('../inc/db-close.php'); ?>
