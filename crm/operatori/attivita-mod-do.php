<?php include "inc/autoloader.php"; ?>
<?php
$at_id = (int)$_POST["at_id"];
$at_ut_id = (int)$_POST["at_ut_id"];

$at_tipologia = $dbConn->real_escape_string(stripslashes(trim($_POST["at_tipologia"])));
$at_luogo = $dbConn->real_escape_string(stripslashes(trim($_POST["at_luogo"])));
$at_esito = $dbConn->real_escape_string(stripslashes(trim($_POST["at_esito"])));
$at_ora_attivita = $dbConn->real_escape_string(stripslashes(trim($_POST["at_ora_attivita"])));
$at_data_attivita = dateToTimestamp($dbConn->real_escape_string(stripslashes(trim($_POST["at_data_attivita"]))));
$at_note = $dbConn->real_escape_string(stripslashes(trim($_POST["at_note"])));

$querySql =
    "UPDATE at_attivita SET at_ut_id = '$at_ut_id', at_tipologia = '$at_tipologia', at_luogo = '$at_luogo', ".
    "at_esito = '$at_esito', at_ora_attivita = '$at_ora_attivita', at_data_attivita = '$at_data_attivita', ".
    "at_note = '$at_note' WHERE at_id = $at_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: attivita-mod.php?at_id=$at_id&update=true");
else header("Location: attivita-mod.php?at_id=$at_id&update=false");
?>