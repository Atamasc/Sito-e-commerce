<?php include "inc/autoloader.php"; ?>
<?php
$gi_pr_id_refuso = (int)$_POST["gi_pr_id_refuso"];

$gi_pr_id = (int)$_POST["gi_pr_id"];
$gi_lt_id = (int)$_POST["gi_lt_id"];
$gi_id_refuso = (int)$_POST["gi_id_refuso"];
$gi_quantita = $dbConn->real_escape_string(stripslashes(trim($_POST["gi_quantita"])));
$gi_quantita_refuso = $dbConn->real_escape_string(stripslashes(trim($_POST["gi_quantita_refuso"])));
$gi_timestamp = time();

$querySql = "SELECT gi_id FROM gi_giacenze WHERE gi_pr_id = '$gi_pr_id' AND gi_lt_id = '$gi_lt_id' ";
$result = $dbConn->query($querySql);
$gi_id = (int)$result->fetch_array()[0];
$result->close();

if($gi_id > 0) {

    $querySql =
        "UPDATE gi_giacenze SET gi_quantita = gi_quantita + $gi_quantita WHERE gi_id = '$gi_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

} else {

    $querySql =
        "INSERT INTO gi_giacenze (".
        "gi_pr_id, gi_lt_id, gi_quantita, gi_timestamp, gi_stato".
        ") VALUES (".
        "'$gi_pr_id', '$gi_lt_id', '$gi_quantita', '$gi_timestamp', 1) ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $gi_id = $dbConn->insert_id;

}

$querySql =
    "UPDATE gi_giacenze SET gi_quantita = gi_quantita - $gi_quantita_refuso WHERE gi_id = '$gi_id_refuso' ";
$result = $dbConn->query($querySql);

createLogGiacenze($gi_id, "Carico da produzione", $gi_quantita, $gi_timestamp);
createLogGiacenze($gi_id_refuso, "Scarico da produzione", "-$gi_quantita_refuso", $gi_timestamp);

if($rows > 0) header("Location: magazzino-produzione-add.php?pr_id=$gi_pr_id_refuso&pr_id_prod=$gi_pr_id&insert=true");
else header("Location: magazzino-produzione-add.php?pr_id=$gi_pr_id_refuso&pr_id_prod=$gi_pr_id&insert=false");
?>