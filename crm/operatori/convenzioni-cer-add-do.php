<?php include "inc/autoloader.php"; ?>
<?php
$cr_cv_id = (int)$_POST["cr_cv_id"];
$cr_cc_id = (int)$_POST["cr_cc_id"];

$cr_prezzo_kg = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST["cr_prezzo_kg"]))));
$cr_note = $dbConn->real_escape_string(stripslashes(trim($_POST["cr_note"])));

$querySql =
    "INSERT INTO cr_convenzioni_cer (cr_cv_id, cr_cc_id, cr_prezzo_kg, cr_note, cr_stato".
    ") VALUES ('$cr_cv_id', '$cr_cc_id', '$cr_prezzo_kg', '$cr_note', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: convenzioni-cer.php?cv_id=$cr_cv_id&insert=true");
else header("Location: convenzioni-cer.php?cv_id=$cr_cv_id&insert=false");
?>