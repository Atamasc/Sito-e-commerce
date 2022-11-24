<?php include "inc/autoloader.php"; ?>
<?php
$dp_di_id = (int)$_POST['dp_di_id'];
$dp_pr_id = (int)$_POST['dp_pr_id'];
$dp_gi_id = (int)$_POST['dp_gi_id'];
$dp_quantita = (int)$_POST['dp_quantita'];

$querySql = "SELECT dp_id FROM dp_distribuzione_prodotti WHERE dp_di_id = '$dp_di_id' AND dp_gi_id = '$dp_gi_id' ";
$result = $dbConn->query($querySql);
$dp_id = (int)$result->fetch_array()[0];
$result->close();

if ($dp_id > 0) {

    $querySql =
        "UPDATE dp_distribuzione_prodotti SET dp_quantita = '$dp_quantita' ".
        "WHERE dp_id = '$dp_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

} else {

    $querySql =
        "INSERT INTO dp_distribuzione_prodotti (".
        "dp_di_id, dp_pr_id, dp_gi_id, dp_quantita".
        ") VALUES (".
        "'$dp_di_id', '$dp_pr_id', '$dp_gi_id', '$dp_quantita') ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

if($rows > 0) header("Location: distribuzione-prodotti-add.php?di_id=$dp_di_id&insert=true");
else header("Location: distribuzione-prodotti-add.php?di_id=$dp_di_id&insert=false");
?>