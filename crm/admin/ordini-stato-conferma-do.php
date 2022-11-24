<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT * FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);

while ($row_data = $result->fetch_assoc()) {

    $or_stato_conferma = $row_data['or_stato_conferma'];
    if ($or_stato_conferma == 0) {

        $or_stato_conferma = 1;
        $pt_tipo = "Ordine confermato";
        $pt_operazione = "-";

    } else {

        $or_stato_conferma = 0;
        $pt_tipo = "Ordine annullato";
        $pt_operazione = "+";

    }

    //addMovimentoProdotto($row_data['pr_id'], $pt_tipo, $pt_operazione.$row_data['or_pr_quantita'], $dbConn);

}

$result->close();

$querySql = "UPDATE or_ordini SET or_stato_conferma = '$or_stato_conferma' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
