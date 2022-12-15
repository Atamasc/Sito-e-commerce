<?php include "inc/autoloader.php"; ?>
<?php
$ut_nome = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_nome'])));
$ut_cognome = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cognome'])));
$ut_indirizzo = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_indirizzo'])));
$ut_cap = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_cap'])));
$ut_citta = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_citta'])));
$ut_provincia = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_provincia'])));
$ut_telefono = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_telefono'])));
$ut_email = $dbConn->real_escape_string(stripslashes(trim($_POST['ut_email'])));


$querySql =
    "UPDATE ut_utenti SET " .
    "ut_nome = '$ut_nome', ut_cognome = '$ut_cognome', ut_indirizzo = '$ut_indirizzo', ut_cap = '$ut_cap', ut_citta = '$ut_citta', ut_provincia = '$ut_provincia'," .
    "ut_telefono = '$ut_telefono', ut_email = '$ut_email' " .
    "WHERE ut_codice = '$session_cl_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/my-account?update=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/my-account?update=false' />";
}
?>