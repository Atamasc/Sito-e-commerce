<?php include('inc/autoloader.php');
$SMTP['host'] = "mail.moncaffe.it";
$SMTP['user'] = "noreply@moncaffe.it";
$SMTP['pass'] = "Vin@7888!";
?>
<?php
$or_codice = $_GET["or_codice"];

// Gestione Stato Spedizione
$querySql = "SELECT or_stato_spedizione FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);

if (($row_data = @$result->fetch_assoc()) !== NULL) {

    $or_stato_spedizione = $row_data['or_stato_spedizione'];
    if ($or_stato_spedizione == 0) $or_stato_spedizione = 1; else $or_stato_spedizione = 0;

};

$result->close();

$querySql = "UPDATE or_ordini SET or_stato_spedizione = '$or_stato_spedizione' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($or_stato_spedizione == 1) {

    $querySql = "SELECT or_ordini.*, cl_email FROM or_ordini INNER JOIN cl_clienti ON cl_codice = or_cl_codice WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();

    $or_cl_codice = $row_data["or_cl_codice"];
    $or_tracking = $row_data["or_tracking"];
    $cl_email = $row_data["cl_email"];

    $importo_totale_ordine = 0;

    $querySql = "SELECT * FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $or_totale = getTotaleOrdine($or_cl_codice);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_id = $row_data['or_id'];
        $or_cl_codice = $row_data['or_cl_codice'];
        $or_pr_codice = $row_data['or_pr_codice'];
        $or_pr_quantita = $row_data['or_pr_quantita'];
        $or_pagamento = $row_data['or_pagamento'];
        $or_tipo_spedizione = $row_data['or_tipo_spedizione'];
        $or_sconto = $row_data['or_sconto'];
        $or_coupon = $row_data['or_coupon'];
        $or_coupon_tipo = $row_data['or_coupon_tipo'];
        $or_coupon_valore = $row_data['or_coupon_valore'];
        $or_spedizione = $row_data['or_spedizione'];
        $or_pr_prezzo = $row_data['or_pr_prezzo'];

        $pr_ct_id = $row_data['pr_ct_id'];
        $pr_st_id = $row_data['pr_st_id'];

        $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);
        $pr_st_id_sottocategoria = getSottocategoria($pr_st_id, $dbConn);

        //$pr_prezzo = strlen($row_data['pr_prezzo_scontato']) > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
        $pr_titolo = $row_data['pr_titolo'];

        $importo_prodotto = $or_pr_prezzo * $or_pr_quantita;

        $body_mail_pr .=
            "<tr>".
            "<td align='center'>$or_pr_codice</td>".
            "<td>
                <span style='font-size: 12px; font-style: italic;'>".$pr_ct_id_categoria." / ".$pr_st_id_sottocategoria."</span><br>
                $pr_titolo
            </td>".
            "<td align='center'>$or_pr_quantita</td>".
            "<td align='right'>".formatPrice($or_pr_prezzo)."</td>".
            "<td align='right'>".formatPrice($importo_prodotto)."</td>".
            "</tr>";

        $importo_totale_ordine += $importo_prodotto;

        $or_sconto_coupon = 0;
        if (strlen($or_coupon) > 0) {
            $value_coupon = "<p>Coupon sconto: <strong>$or_coupon</strong></p>";

            $or_sconto_coupon = $or_coupon_tipo == 'importo'
                ? formatPriceForDB($or_coupon_valore)
                : ($importo_totale_ordine / 100) * $or_coupon_valore;
        }
    }

    $result->close();

    $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $importo_totale_ordine);
    $or_tipo_spedizione_prezzo = $or_spedizione;

    $iva_ordine = $importo_totale_ordine * 0.22;
    $importo_parziale_ordine = $importo_totale_ordine - $iva_ordine;

    $importo_totale_ordine = $importo_totale_ordine - $or_sconto_coupon + $or_tipo_spedizione_prezzo + $or_pagamento_prezzo;
    
    $cl_cliente_nominativo = getNominativoClienteByCodice($or_cl_codice, $dbConn);
    $cl_email = getEmailClienteByCodice($or_cl_codice, $dbConn);

    $email_titolo = "Il tuo ordine è stato spedito!";

    $or_tracking = strlen($or_tracking) > 0 ? "Clicca sul link di seguito per seguire la spedizione: <a href='$or_tracking'>$or_tracking</a>" : "Il tuo ordine è stato affidato al corriere, a breve riceverai una mail con il codice tracking per monitorare la spedizione";

    if(strlen($or_coupon)>0){
        $sconto_email = "<tr>
                    <td  colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Sconto (&euro;)</td>
                    <td >-".formatPrice($or_sconto_coupon)." &euro;</td>
                </tr>";
    }

    $email_testo =
        "
        <p>
            Il tuo ordine è stato spedito. Riceverai la merce secondo <a href='https://www.moncaffe.it/spedizioni'>i tempi di spedizione</a> che trovi sul nostro sito.
            Per i dettagli dell'ordine <a href='https://www.moncaffe.it/login'>accedi alla tua area riservata</a> sul sito<br />
        </p>
        <br>
        
        <p>$or_tracking</p><br>
        
        <p>Codice ordine: $or_codice del ".date('d/m/Y - H:i', substr($or_codice,9))."</p>
        <p>Email: <strong>".getNominativoClienteByCodice($or_cl_codice, $dbConn)."&nbsp;(".$or_cl_codice.")</strong></p>
        <p>Indirizzo di spedizione: <strong>".getIndirizzoClienteByCodice($or_cl_codice, $dbConn)."</strong></p>
        <p>Tipo di spedizione: <strong>$or_tipo_spedizione</strong></p>
        <p>Metodo di pagamento: <strong>$or_pagamento</strong></p>
        $value_coupon

        <table class=\"carrello\" style=\"width:100%;\">
            <thead>
            <tr>
                <td>Codice prodotto</td>
                <td>Categoria / Sottocategoria <br>
                Prodotto</td>
                <td>Quantità</td>
                <td>Prezzo per unità (&euro;)</td>
                <td>Totale (&euro;)</td>
            </tr>
            </thead>
            
            <tbody>
                $body_mail_pr
            </tbody>
            
            <tfoot style=\"border-top:2px #a59043  solid;\">
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Imponibile (&euro;)</td>
                    <td >".formatPrice($importo_parziale_ordine)." &euro;</td>
                </tr>
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">IVA (&euro;)</td>
                    <td >".formatPrice($iva_ordine)." &euro;</td>
                </tr>
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Commissioni (&euro;)</td>
                    <td >".formatPrice($or_pagamento_prezzo)." &euro;</td>
                </tr>	
                <tr>
                    <td  colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Costi di spedizione (&euro;)</td>
                    <td >".formatPrice($or_tipo_spedizione_prezzo)." &euro;</td>
                </tr>	
            	$sconto_email
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Totale (&euro;)</td>
                    <td >".formatPrice($importo_totale_ordine)." &euro;</td>
                </tr>									
            </tfoot>
        </table>
        <br><br>
        
        ";

    include "../../inc/mail.php";

    include("../class/class.phpmailer.php");
    $mittente = $SMTP['user'];
    $nomemittente = "Spedizione ordine";
    $destinatario = $cl_email;
    $dataFullNow = strftime("%A %d %B %Y", time());

    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPKeepAlive = "true";

    // autenticazione server SMTP di invio mail
    $mail->Host  = $SMTP['host'];
    $mail->Username   = $SMTP['user'];      // utente server SMTP autenticato
    $mail->Password   = $SMTP['pass'];    // password server SMTP autenticato

    // abilito il messaggio in HTML
    $mail->IsHTML(true);

    //intestazioni e corpo dell'email
    $mail->From   = $mittente;
    $mail->FromName = $nomemittente;
    $mail->AddAddress($cl_email);
    $mail->AddBCC("info@moncaffe.it");
    $mail->AddBCC("notifica@lucasweb.it");
    $mail->AddBCC("moncaffe.it+0e2538ac9a@invite.trustpilot.com");
    $mail->Subject = "Spedizione ordine | ".$or_codice." | ".$cl_cliente_nominativo."" ;

    $mail->Body = $messaggio;
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

    //percorso all'allegato
    //$mail->AddAttachment('pdf/file.pdf');

    if($mail->Send()) {
        $get_send = true;
    } else {
        $get_send = false;
        $get_error_info = $mail->ErrorInfo;
    }

}


echo "<script>window.location=document.referrer;</script>";
?>
