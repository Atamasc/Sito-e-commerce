<?php include "inc/autoloader.php"; ?>
<?php
$mg_gi_id = (int)$_GET["mg_gi_id"];
$mg_quantita = $dbConn->real_escape_string(stripslashes(trim($_GET["mg_quantita"])));

$querySql = "SELECT mg_id FROM mg_mercato_giacenze WHERE mg_gi_id = '$mg_gi_id' ";
$result = $dbConn->query($querySql);
$mg_id = (int)$result->fetch_array()[0];
$result->close();

if($mg_id > 0) {

    $querySql =
        "UPDATE mg_mercato_giacenze SET mg_quantita = mg_quantita + $mg_quantita WHERE mg_id = '$mg_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

} else {

    $querySql =
        "INSERT INTO mg_mercato_giacenze (".
        "mg_gi_id, mg_quantita".
        ") VALUES (".
        "'$mg_gi_id', '$mg_quantita') ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $mg_id = $dbConn->insert_id;

}

$querySql =
    "UPDATE gi_giacenze SET gi_quantita = gi_quantita - $mg_quantita WHERE gi_id = '$mg_gi_id' ";
$result = $dbConn->query($querySql);

createLogGiacenze($mg_gi_id, "Scarico dal mercato", "-$mg_quantita", time());

if($rows > 0) header("Location: mercato-add.php?insert=true");
else header("Location: mercato-add.php?insert=false");
?>