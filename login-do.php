<?php include("inc/db-conn.php"); ?>
<?php include("inc/config.php"); ?>
<?php include("bin/function.php"); ?>
<?php
$ut_email = $dbConn->real_escape_string(stripslashes(trim($_REQUEST['ut_email'])));
$ut_password = $dbConn->real_escape_string(stripslashes(trim($_REQUEST['ut_password'])));

//LOGIN TRAMITE EMAIL INVIATA DA CRM carrello-mail-do
$link = $dbConn->real_escape_string(stripslashes(trim($_REQUEST['ut_codice'])));

$ut_id = substr($link, strpos($link, "=") + 1);
$ut_codice = strtok($link, '?');

if (strlen($ut_codice) > 0 && strlen($ut_id) > 0) {

    $querySql = "SELECT ut_email, ut_password FROM ut_utenti WHERE ut_codice = '$ut_codice' AND ut_id = '$ut_id' ";
    $result = @$dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $ut_email = $row_data['ut_email'];
    $ut_password = $row_data['ut_password'];
    $result->close();

}
//FINE LOGIN TRAMITE MAIL

$querySql = "SELECT * FROM ut_utenti WHERE ut_email = '$ut_email' AND ut_password = '$ut_password' AND ut_stato = 1 ";
$result = @$dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$ut_codice = $row_data['ut_codice'];
$result->close();

if ($rows > 0) {

    session_start();
    $_SESSION['cl_login'] = "1";
    $_SESSION['cl_codice'] = $ut_codice;

    $querySql = "UPDATE cr_carrello SET cr_ut_codice = '$ut_codice' WHERE cr_ut_codice = '" . session_id() . "' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $querySql = "SELECT * FROM cr_carrello WHERE cr_ut_codice = '$ut_codice' ";
    $result = @$dbConn->query($querySql);
    $rows_carrello = $dbConn->affected_rows;

    if ($rows_carrello > 0) {
        header("Location:carrello");
    } else {
        header("Location:my-account?login=true");
    }

} else
    header("Location:login?login=false");

$dbConn->close();
?>
