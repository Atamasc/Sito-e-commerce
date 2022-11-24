<?php include "inc/autoloader.php"; ?>
<?php
$list = array (
    array(
        'VABPKB', //peso totale spedizione
        'VABNCL', //numero colli totale spedizione
        'VABVLB', //volume colli in metri cubi massimo 3 decimali(opzionale)
        'VABRSD', //ragione sociale destinatario lunga max 35 caratteri
        'VABRD2', //ragione sociale destinatario aggiuntiva lunga max 35 caratteri (opzionale)
        'VABIND', //indirizzo di destinazione lungo max 35 caratteri
        'VABPUD', //Pudo ID per il servizio Fermopoint
        'VABCAD', //cap di destinazione
        'VABLOD', //località di destinazione
        'VABPRD', //provincia di destinazione
        'VABNZD', //nazione (lasciare vuoto per l'italia)
        'VABNAS', //natura della merce (opzionale)
        'VABNOT', //note lunghe max 35 caratteri (opzionale)
        'VABNT2', //ulteriore campo note lungo max 35 caratteri (opzionale)
        'VABCCM', //CODICE CLIENTE BARTOLINI
        'VABTRC', //telefono (opzionale)
        'VABCTR', //CODICE TARIFFA (000 preferenziale 100 prodotto borse 099 EuroExpress300 DPD) TODO:mancante
        'VABCBO', //codice bolla (1=porto franco 2= porto ass.to 4=porto franco + contrassegno 6=porto assegnato+contrassegno) TODO:mancante
        'VABRMN', //numero di bolla (max 15 caratteri) TODO:mancante
        'VABRMA', //campo di testo presente su segnacollo (max 15 caratteri) (opzionale)
        'VABLNP', //FILIALE DI PARTENZA BRT
        'VABTSP', //tipo di servizio (C=corriere E=priority/espresso H=servizio 10,30)
        'VABTNO', //tipo di notifica (da usare con VABEMD e/o VABCEL) (0=nessuna notifica 1=e-mail 2=cellulare 3=e-mail+cellulare) (opzionale)
        'VABEMD', //e-mail (opzionale)
        'VABCEL', //cellulare (opzionale)
        'VABATB', //Network (vuoto=ITALIA D=DPD (monocollo) E=EUROEXPRESS F=FEDEX)
        'VABCAS', //contrassegno (opzionale)
        'VABTIC', //tipo di incasso (gestire solo se in contrassegno: campo vuoto=contanti BM=assegno bancario c/c intestato al mittente CM=assegno circolare intestato al mittente)
        'VABVCA', //valuta contrassegno (gestire solo se in contrassegno)
        'VABFFD', //fermo deposito (S=fermo deposito) (opzionale)
        'VABTC1', //particolarità (A=appuntamento P=consegne al piano) (opzionale)
        'VABIAS', //assicurazione (opzionale)
        'VABVAS'  //valuta assicurazione (gestire solo se assicurata)
    ),

);



$querySql = "SELECT *, COUNT(or_id) AS or_colli, CONCAT(cl_cognome, ' ', cl_nome) AS cl_nominativo, SUM(or_pr_prezzo * or_pr_quantita) As or_totale FROM or_ordini INNER JOIN cl_clienti ON cl_codice = or_cl_codice WHERE or_stato_export > 0 GROUP BY or_codice ORDER BY or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_totale = $row_data['or_totale'];
    $or_pagamento_prezzo = getPrezzoPagamento($row_data['or_pagamento'], $or_totale);
    $or_spedizione_prezzo = getPrezzoSpedizione($row_data['or_tipo_spedizione'], $or_totale);

    if(strlen($row_data['or_coupon'])>0) {
        $or_sconto_coupon = $row_data['or_coupon_tipo'] == "importo" ? (float)$row_data['or_coupon_valore'] : ($or_totale / 100) * $row_data['or_coupon_valore'];
    } else {
        $or_sconto_coupon = 0;
    }

    $or_totale = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;
    $or_totale = number_format($or_totale, 2, ".", "");

    $list[] = array(
        '1', //peso totale spedizione
        (int)$row_data['or_colli'], //numero colli totale spedizione
        '', //volume colli in metri cubi massimo 3 decimali(opzionale)
        $row_data['cl_nominativo'], //ragione sociale destinatario lunga max 35 caratteri
        $row_data['cl_ragione_sociale'], //ragione sociale destinatario aggiuntiva lunga max 35 caratteri (opzionale)
        $row_data['cl_indirizzo'], //indirizzo di destinazione lungo max 35 caratteri
        '', //Pudo ID per il servizio Fermopoint
        $row_data['cl_cap'], //cap di destinazione
        $row_data['cl_comune'], //località di destinazione
        $row_data['cl_provincia'], //provincia di destinazione
        '', //nazione (lasciare vuoto per l'italia)
        '', //natura della merce (opzionale)
        $row_data['or_note'], //note lunghe max 35 caratteri (opzionale)
        '', //ulteriore campo note lungo max 35 caratteri (opzionale)
        '', //CODICE CLIENTE BARTOLINI
        $row_data['cl_telefono'], //telefono (opzionale)
        '000', //CODICE TARIFFA (000 preferenziale 100 prodotto borse 099 EuroExpress300 DPD) TODO:mancante
        $row_data['or_pagamento'] == 'Contrassegno' ? "4" : '1', //codice bolla (1=porto franco 2= porto ass.to 4=porto franco + contrassegno 6=porto assegnato+contrassegno) TODO:mancante
        '', //numero di bolla (max 15 caratteri) TODO:mancante
        '', //campo di testo presente su segnacollo (max 15 caratteri) (opzionale)
        '', //FILIALE DI PARTENZA BRT
        'C', //tipo di servizio (C=corriere E=priority/espresso H=servizio 10,30)
        '3', //tipo di notifica (da usare con VABEMD e/o VABCEL) (0=nessuna notifica 1=e-mail 2=cellulare 3=e-mail+cellulare) (opzionale)
        $row_data['cl_email'], //e-mail (opzionale)
        $row_data['cl_telefono'], //cellulare (opzionale)
        '', //Network (vuoto=ITALIA D=DPD (monocollo) E=EUROEXPRESS F=FEDEX)
        $row_data['or_pagamento'] == 'Contrassegno' ? "$or_totale" : "", //contrassegno (opzionale)
        '', //tipo di incasso (gestire solo se in contrassegno: campo vuoto=contanti BM=assegno bancario c/c intestato al mittente CM=assegno circolare intestato al mittente)
        $row_data['or_pagamento'] == 'Contrassegno' ? 'eur' : '', //valuta contrassegno (gestire solo se in contrassegno)
        '', //fermo deposito (S=fermo deposito) (opzionale)
        '', //particolarità (A=appuntamento P=consegne al piano) (opzionale)
        '', //assicurazione (opzionale)
        ''  //valuta assicurazione (gestire solo se assicurata)
    );
    //$list[] = $result->fetch_assoc();

}

$result->close();

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="export_ordini_'.date("d_m_y_h_i").'.csv"');


$fp = fopen('php://output', 
'wb');
foreach ($list as $fields) {
    fputcsv($fp, $fields, ";");
}

fclose($fp);
?>