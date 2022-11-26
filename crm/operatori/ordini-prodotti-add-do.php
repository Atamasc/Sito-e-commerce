<?php include "inc/autoloader.php"; ?>
<?php
$or_ut_codice = $dbConn->real_escape_string(stripslashes(trim($_POST['or_ut_codice'])));
$or_gi_id = (int)$_POST['or_gi_id'];
$or_op_id = (int)$_POST['or_op_id'];
$or_quantita = (int)$_POST['or_quantita'];
$or_prezzo = formatPriceForDB($dbConn->real_escape_string(stripslashes(trim($_POST['or_prezzo']))));
$or_timestamp = (int)$_POST['or_timestamp'];
$or_tipo = $dbConn->real_escape_string(stripslashes(trim($_POST['or_tipo'])));

if ($or_tipo == "distribuzione") {

    $querySql_up = "UPDATE gi_giacenze SET gi_quantita = gi_quantita - $or_quantita WHERE gi_id = '$or_gi_id' ";
    $result_up = $dbConn->query($querySql_up);

    $querySql_up =
        "UPDATE dp_distribuzione_prodotti INNER JOIN di_distribuzione ON di_id = dp_di_id SET dp_quantita = dp_quantita - $or_quantita ".
        "WHERE dp_gi_id = '$or_gi_id' AND di_op_id = '$or_op_id' ";
    $result_up = $dbConn->query($querySql_up);

    createLogGiacenze($or_gi_id, "Scarico da ordine", "-$or_quantita", $or_timestamp);

    $querySql =
        "INSERT INTO or_ordini (".
        "or_gi_id, or_op_id, or_codice, or_ut_codice, or_pr_prezzo, or_pr_quantita, or_stato_conferma, or_stato_spedizione, or_stato, or_timestamp" .
        ") VALUES (".
        "'$or_gi_id', '$or_op_id', '$or_timestamp', '$or_ut_codice', '$or_prezzo', '$or_quantita', 1, 2, 1, '$or_timestamp') ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

} else {

    $querySql =
        "INSERT INTO or_ordini (".
        "or_gi_id, or_op_id, or_codice, or_ut_codice, or_pr_prezzo, or_pr_quantita, or_stato_conferma, or_timestamp" .
        ") VALUES (".
        "'$or_gi_id', '$or_op_id', '$or_timestamp', '$or_ut_codice', '$or_prezzo', '$or_quantita', 1, '$or_timestamp') ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

if($rows > 0) header("Location: ordini-prodotti-add.php?ut_codice=$or_ut_codice&or_timestamp=$or_timestamp&or_tipo=$or_tipo&insert=true");
else header("Location: ordini-prodotti-add.php?ut_codice=$or_ut_codice&or_timestamp=$or_timestamp&or_tipo=$or_tipo&insert=false");
?>