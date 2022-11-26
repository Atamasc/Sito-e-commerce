<?php include "inc/autoloader.php"; ?>
<?php
$list = array (
    array(
        'NOMINATIVO',
        'NUMERO ORDINE',
        'DATA ORDINE',
        'METODO PAGAMENTO',
        'IMPORTO',
        'IVA',
        'TOTALE IVATO'
    ),

);

/*
Nome e Cognome
Numero di ordine
Data di ordine
Metodo di pagamento
Importo
Iva
Totale ivato
*/

$querySql = "SELECT *, CONCAT(ut_nome, ' ', ut_cognome) AS ut_nominativo, SUM(or_pr_prezzo * or_pr_quantita) As or_totale FROM or_ordini INNER JOIN ut_utenti ON ut_codice = or_ut_codice WHERE or_stato_corrispettivi > 0 GROUP BY or_codice ORDER BY or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_totale = $row_data['or_totale'];
    $or_pagamento_prezzo = getPrezzoPagamento($row_data['or_pagamento'], $or_totale);
    $or_spedizione_prezzo = getPrezzoSpedizione($row_data['or_tipo_spedizione'], $or_totale);

    if(strlen($row_data['or_coupon'])>0)
        $or_sconto_coupon = $row_data['or_coupon_tipo'] == "importo"
            ? (float)$row_data['or_coupon_valore'] : ($or_totale / 100) * $row_data['or_coupon_valore'];
    else $or_sconto_coupon = 0;

    $or_totale = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;
    $or_totale = number_format($or_totale, 2, ".", "");


    $or_imponibile = number_format($or_totale / 1.22, 2, ".", "");
    $or_iva = number_format($or_totale - $or_imponibile, 2, ".", "");

    $list[] = array(
        $row_data['ut_nominativo'],
        $row_data['or_codice'],
        date("d/m/Y", $row_data['or_timestamp']),
        $row_data['or_pagamento'],
        $or_imponibile,
        $or_iva,
        $or_totale,

    );
    //$list[] = $result->fetch_assoc();

}

$result->close();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export_ordini_corrispettivi_'.date("d_m_y_h_i").'.csv"');


$fp = fopen('php://output',
    'wb');
foreach ($list as $fields) {
    fputcsv($fp, $fields, ";");
}

fclose($fp);
?>