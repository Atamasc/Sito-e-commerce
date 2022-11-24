<?php include "inc/autoloader.php"; ?>
<?php
$dp_id = (int)$_POST['dp_id'];
$dp_pr_id = (int)$_POST['dp_pr_id'];
$dp_gi_id = (int)$_POST['dp_gi_id'];
$dp_quantita = (int)$_POST['dp_quantita'];

$querySql =
    "UPDATE dp_distribuzione_prodotti SET ".
    "dp_pr_id = '$dp_pr_id', dp_gi_id = '$dp_gi_id', dp_quantita = '$dp_quantita' ".
    "WHERE dp_id = '$dp_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: distribuzione-prodotti-mod.php?dp_id=$dp_id&update=true");
else header("Location: distribuzione-prodotti-mod.php?dp_id=$dp_id&update=false");
?>