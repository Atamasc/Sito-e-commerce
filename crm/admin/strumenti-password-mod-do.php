<?php include "inc/autoloader.php"; ?>
<?php
$password_old = $dbConn->real_escape_string(stripslashes(trim($_POST['password_old'])));
$am_password = $dbConn->real_escape_string(stripslashes(trim($_POST['am_password'])));

$querySql = "SELECT * FROM am_amministratore WHERE am_password = '$password_old' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) {

    $querySql = "UPDATE am_amministratore SET am_password = '$am_password' WHERE am_id = '1' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    header("Location: strumenti-password-mod.php?update=true");

}
else header("Location: strumenti-password-mod.php?update=false");

?>