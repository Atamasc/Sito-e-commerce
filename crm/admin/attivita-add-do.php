<?php include "inc/autoloader.php"; ?>
<?php
$at_cl_id = (int)$_POST["at_cl_id"];
$at_tipologia = $dbConn->real_escape_string(stripslashes(trim($_POST["at_tipologia"])));
$at_luogo = $dbConn->real_escape_string(stripslashes(trim($_POST["at_luogo"])));
$at_esito = $dbConn->real_escape_string(stripslashes(trim($_POST["at_esito"])));
$at_ora_attivita = $dbConn->real_escape_string(stripslashes(trim($_POST["at_ora_attivita"])));
$at_data_attivita = dateToTimestamp($dbConn->real_escape_string(stripslashes(trim($_POST["at_data_attivita"]))));
$at_note = $dbConn->real_escape_string(stripslashes(trim($_POST["at_note"])));
$at_data = time();

$querySql =
    "INSERT INTO at_attivita (".
    "at_cl_id, at_tipologia, at_luogo, at_esito, at_ora_attivita, at_data_attivita, at_note, at_data, at_stato".
    ") VALUES (".
    "'$at_cl_id', '$at_tipologia', '$at_luogo', '$at_esito', '$at_ora_attivita', '$at_data_attivita', '$at_note', '$at_data', 1)";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: attivita-add.php?insert=true");
else header("Location: attivita-add.php?insert=false");
?>