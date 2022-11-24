<?php include "inc/autoloader.php"; ?>
<?php

$rows = 0;
foreach ($_POST['dp_array'] as $dp_nome => $dp_valore) {

    $dp_nome = $dbConn->real_escape_string(stripslashes(trim($dp_nome)));
    $dp_valore = $dbConn->real_escape_string(stripslashes(trim($dp_valore)));

    $querySql = "SELECT COUNT(dp_id) FROM dp_dati_pagamenti WHERE dp_nome = '$dp_nome' ";
    $result = $dbConn->query($querySql);
    $count = $result->fetch_array()[0];
    $result->close();
    
    if ($count > 0) $querySql = "UPDATE dp_dati_pagamenti SET dp_valore = '$dp_valore' WHERE dp_nome = '$dp_nome' ";
    else $querySql = "INSERT INTO dp_dati_pagamenti (dp_nome, dp_valore) VALUES ('$dp_nome', '$dp_valore') ";
    $result = $dbConn->query($querySql);
    if($dbConn->affected_rows > 0) $rows = 1;

}

if($rows > 0) header("Location: strumenti-pagamenti.php?update=true");
else header("Location: strumenti-pagamenti.php?update=false");

?>