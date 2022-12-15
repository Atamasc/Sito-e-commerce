<?php include "inc/autoloader.php"; ?>
<?php
$ut_password_old = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_password_old'])));
$ut_password = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_password'])));

/*
$sql = "SELECT * FROM ut_clienti WHERE ut_codice = '$session_ut_codice' AND ut_password = '$ut_password_old' ";
$result = $dbConn->query($sql);
$rows = $dbConn->affected_rows;
*/

if ($ut_password_old == $ut_password) {

    $querySql =
        "UPDATE ut_utenti SET ut_password = '$ut_password' " .
        "WHERE ut_codice = '$session_cl_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/my-account?update=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/my-account?update=false_password' />";
}
?>