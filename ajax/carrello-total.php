<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$querySql =
    "SELECT * FROM pr_prodotti " .
    "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice " .
    "WHERE cr_ut_codice = '$session_cl_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->num_rows;

$cr_totale = 0;
while ($row_data = $result->fetch_assoc()) {

    $cr_pr_quantita = $row_data['cr_pr_quantita'];
    $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
    $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
}
$result->close();

//$cr_iva = $cr_totale * 0.22;
//$cr_imponibile = $cr_totale - $cr_iva;

$cr_imponibile = $cr_totale / 1.22;
$cr_iva = $cr_totale - $cr_imponibile;
?>
    <div class="total-shipping">
        <h5>Importi carrello</h5>
        <ul>
            <li>Imponibile <span>&euro;<?php echo formatPrice($cr_imponibile); ?></span></li>
            <li>Iva <span>&euro;<?php echo formatPrice($cr_iva); ?></span></li>
        </ul>
    </div>


    <h4 class="grand-totall-title">Totale carrello<span>&euro;<?php echo formatPrice($cr_totale); ?></span></h4>
<?php include "../inc/db-close.php"; ?>