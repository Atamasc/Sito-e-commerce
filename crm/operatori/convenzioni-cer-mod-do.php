<?php include "inc/autoloader.php"; ?>
<?php
$cr_id = (int)$_POST["cr_id"];
$cr_cv_id = (int)$_POST["cr_cv_id"];
$cr_cc_id = (int)$_POST["cr_cc_id"];

$cr_prezzo_kg = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST["cr_prezzo_kg"]))));
$cr_note = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_note"])));

$querySql =
    "UPDATE cr_convenzioni_cer SET cr_cc_id = '$cr_cc_id', cr_prezzo_kg = '$cr_prezzo_kg', cr_note = '$cr_note' WHERE cr_id = '$cr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: convenzioni-cer.php?cr_id=$cr_id&cv_id=$cr_cv_id&update=true");
else header("Location: convenzioni-cer.php?cr_id=$cr_id&cv_id=$cr_cv_id&update=false");
?>