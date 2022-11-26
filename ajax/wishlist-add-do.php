<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$cr_pr_codice = isset($_GET['pr_codice']) ? $dbConn->real_escape_string(trim(stripslashes($_GET["pr_codice"]))) : "";

$querySql = "SELECT COUNT(ws_id) FROM ws_wishlist WHERE ws_cl_codice = '$session_cl_codice' AND ws_pr_codice = '$cr_pr_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->fetch_array()[0];
$result->close();

if ($rows == 0) {

    $serial_date = time();

    $querySql =
        "INSERT INTO ws_wishlist (ws_cl_codice, ws_pr_codice, ws_timestamp) ".
        "VALUES ('$session_cl_codice', '$cr_pr_codice', '$serial_date')";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
}

?>
<?php include('../inc/db-close.php'); ?>