<?php include "inc/autoloader.php"; ?>
<?php
$ro_id = (int)$_POST['ro_id'];
$ro_stato = $dbConn->real_escape_string(stripslashes(trim($_POST['ro_stato'])));
$ro_note = $dbConn->real_escape_string(stripslashes(trim($_POST['ro_note'])));
$ro_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ro_descrizione'])));

$querySql =
    "UPDATE ro_richiesta_offerta SET ro_stato = '$ro_stato', ro_note = '$ro_note', ".
    "ro_descrizione = '$ro_descrizione' WHERE ro_id = '$ro_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: richiesta-offerta-mod.php?ro_id=$ro_id&update=true");
else header("Location: richiesta-offerta-mod.php?ro_id=$ro_id&update=false");
?>