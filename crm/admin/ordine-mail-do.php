<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = $_GET["or_codice"];

$querySql =
    "SELECT or_ut_codice, or_pagamento, or_spedizione, or_coupon, or_coupon_tipo, or_coupon_valore FROM or_ordini WHERE or_codice = '$or_codice' LIMIT 0,1 ";
$result = $dbConn->query($querySql);
list($or_ut_codice, $or_pagamento, $or_spedizione, $or_coupon, $or_coupon_tipo, $or_coupon_valore) = $result->fetch_array();
$result->close();

$querySql =
    "SELECT * FROM pr_prodotti " .
    "INNER JOIN or_ordini ON or_pr_codice = pr_codice " .
    "WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->num_rows;

$or_totale = 0;
//$or_sconto_coupon = 0;

while ($row_data = $result->fetch_assoc()) {

    $or_id = $row_data['or_id'];
    $pr_id = $row_data['pr_id'];
    $pr_codice = $row_data['pr_codice'];
    $or_ut_codice = $row_data['or_ut_codice'];
    $or_pr_codice = $row_data['or_pr_codice'];
    $or_pr_quantita = $row_data['or_pr_quantita'];
    //$or_pagamento = $row_data['or_pagamento'];
    $or_spedizione = $row_data['or_spedizione'];
    $or_tipo_spedizione = $row_data['or_tipo_spedizione'];
    $or_tracking = $row_data['or_tracking'];
    /*$or_coupon_valore = $row_data['or_coupon_valore'];
    $or_coupon_tipo = $row_data['or_coupon_tipo'];
    $or_coupon = $row_data['or_coupon'];*/

    $pr_prezzo = $row_data['or_pr_prezzo'];

    $pr_titolo = $row_data['pr_titolo'];

    $pr_ct_id = $row_data['pr_ct_id'];
    $pr_st_id = $row_data['pr_st_id'];

    $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);
    $pr_st_id_sottocategoria = getSottocategoria($pr_st_id, $dbConn);

    $or_totale = $or_totale + ($pr_prezzo * $or_pr_quantita);
    $pr_totale = formatPrice($pr_prezzo * $or_pr_quantita);

    /*$ut_email = getEmailClienteByCodice($or_ut_codice, $dbConn);
    $ut_nominativo = getNominativoClienteByCodice($or_ut_codice, $dbConn);*/

    /*if(strlen($or_coupon) > 0)
        $or_sconto_coupon = $or_coupon_tipo == "importo"
            ? (float)$or_coupon_valore
            : ($or_totale / 100) * $or_coupon_valore;*/

    $body_mail_pr .=
        "<tr>" .
        "<td align='center'>$or_pr_codice</td>" .
        "<td>
                <span style='font-size: 12px; font-style: italic;'>" . $pr_ct_id_categoria . " / " . $pr_st_id_sottocategoria . "</span><br>
                $pr_titolo
            </td>" .
        "<td align='center'>$or_pr_quantita</td>" .
        "<td align='right'>" . formatPrice($pr_prezzo) . "</td>" .
        "<td align='right'>$pr_totale</td>" .
        "</tr>";

}

$result->close();

if (strlen($or_coupon) > 0)
    $or_sconto_coupon = $or_coupon_tipo == "importo"
        ? (float)$or_coupon_valore
        : ($or_totale / 100) * $or_coupon_valore;
else
    $or_sconto_coupon = 0;

$or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
$or_spedizione_prezzo = $or_spedizione;

$or_imponibile = $or_totale / 1.22;
$or_iva = $or_totale - $or_imponibile;

$or_totale = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;


if ($or_pagamento == 'Paypal') {

    $importo_totale_ordine_paypal = number_format($or_totale, 2, '.', '');

    //$return_link = "$rootBasePath_http/confirmPayPal.php?or_codice=$or_codice";
    $cancel_link = "$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice&insert=false";

    $code_64 = base64_encode("$or_codice|$or_ut_codice|$rootBasePath_http/confirmPayPal.php?or_codice=$or_codice");
    $return_link = "$rootBasePath_http/fast-login/$code_64";

    $link_pagamento = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=$emailPaypal&item_name=Order_Code&item_number=$or_codice&amount=$importo_totale_ordine_paypal&invoice=$or_codice&currency_code=EUR&return=$return_link&cancel_return=$cancel_link";
    $link_pagamento = base64_encode($link_pagamento);

} else if ($or_pagamento == 'Stripe') {

    $link_pagamento = generateStripeMailOrder($or_codice, $or_totale, $or_ut_codice);
    $link_pagamento = base64_encode($link_pagamento);

} else $link_pagamento = "";

$ut_email = getEmailClienteByCodice($or_ut_codice, $dbConn);
$ut_nominativo = getNominativoClienteByCodice($or_ut_codice, $dbConn);

$email_titolo = "Paga il tuo ordine!";

$email_testo =
    "
            <p>
                Gentile $ut_nominativo. Ti ricordiamo che il tuo ordine non risulta ancora pagato secondo le modalità di pagamento scelte. <br>
                Procedi a completare l'ordine e se hai problemi con il metodo di pagamento scelto contattaci. <br><br>
                
                <a href='$rootBasePath_http/login'>Clicca qui</a> per accedere alla tua area riservata o segui le istruzioni in basso per completare l'ordine.<br><br>
                
            </p>

            <p><strong>Di seguito i dettagli del tuo ordine:</strong></p>
            <p>Codice ordine: <strong>$or_codice del " . date('d/m/Y - H:i', substr($or_codice, 9)) . "</strong></p>
            <p>Email: <strong>" . getNominativoClienteByCodice($or_ut_codice, $dbConn) . "&nbsp;(" . $or_ut_codice . ")</strong></p>
            <p>Indirizzo di spedizione: <strong>" . getIndirizzoClienteByCodice($or_ut_codice, $dbConn) . "</strong></p>
            <p>Tipo di spedizione: <strong>Spedizione con corriere</strong></p>
            <p>Metodo di pagamento: <strong>$or_pagamento</strong></p>


        ";

if (strlen($link_pagamento) > 0) {

    $email_testo .=
        "<br>
<table width='100%' cellspacing='0' cellpadding='0' style='text-align: center;'>
  <tr>
      <td>
          <table cellspacing='0' cellpadding='0'>
              <tr>
                  <td style='border-radius: 2px;' bgcolor='#ED2939'>
    <a href='$link_pagamento' target='_blank' style='padding: 8px 12px; border: 1px solid #d34b4e; border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 14px; color: #ffffff;text-decoration: none;font-weight:bold; display: inline-block;'>Clicca qui per pagare</a>
                  </td>
              </tr>
          </table>
      </td>
  </tr>
</table><br>";

}

if ($or_pagamento == 'Contrassegno') {

    $email_testo .=
        "<br><p style='font-weight: bold;'>Hai scelto di pagare in contrassegno al momento della consegna.</p><br>";

} else if ($or_pagamento == 'Bonifico') {

    $email_testo .=
        "<table>
             <tr>
                    <td>Intestatario bonifico:</td> 
                       <td colspan='6'><strong>" . $bonifico["int_conto"] . "</strong></td>
                </tr>
                <tr>
                    <td>Banca:</td> 
                    <td colspan='6'><strong>" . $bonifico["banca_bonifico"] . "</strong></td>
                </tr>
                <tr>
                    <td>IBAN:</td> 
                    <td colspan='6'><strong>" . $bonifico["iban_bonifico"] . "</strong></td>
                </tr>
                <tr>
                    <td>Bic/swift:</td> 
                    <td colspan='6'><strong>" . $bonifico["bic_bonifico"] . "</strong></td>
                </tr>
                <tr>
                    <td>Causale:</td> 
                    <td colspan='6'><strong>Acquisto moncaffe.it N° ordine $or_codice</strong></td>
                </tr>
            </table>";

}


if (strlen($or_coupon) > 0) {
    $sconto_email = " <tr>
                    <td  colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Sconto (&euro;)</td>
                    <td >-" . formatPrice($or_sconto_coupon) . " &euro;</td>
                </tr>";
}

$email_testo .=
    "
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
                    <td >" . formatPrice($or_imponibile) . " &euro;</td>
                </tr>
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">IVA (&euro;)</td>
                    <td >" . formatPrice($or_iva) . " &euro;</td>
                </tr>
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Commissioni (&euro;)</td>
                    <td >" . formatPrice($or_pagamento_prezzo) . " &euro;</td>
                </tr>	
                <tr>
                    <td  colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Costi di spedizione (&euro;)</td>
                    <td >" . formatPrice($or_spedizione_prezzo) . " &euro;</td>
                </tr>	
                    $sconto_email	
                <tr>
                    <td colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Totale (&euro;)</td>
                    <td >" . formatPrice($or_totale) . " &euro;</td>
                </tr>									
            </tfoot>
        </table>
        <br><br>
        
        ";

include "../../inc/mail.php";

include("../class/class.phpmailer.php");
$mittente = "noreply@moncaffe.it";
$nomemittente = "Moncaffe.it";
$destinatario = $ut_email;
$dataFullNow = strftime("%A %d %B %Y", time());

$mail = new PHPMailer;
// utilizza la classe SMTP invece del comando mail() di php
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = "true";

// autenticazione server SMTP di invio mail
$mail->Host = $SMTP['host'];
$mail->Username = $SMTP['user'];      // utente server SMTP autenticato
$mail->Password = $SMTP['pass'];    // password server SMTP autenticato

// abilito il messaggio in HTML
$mail->IsHTML(true);

//intestazioni e corpo dell'email
$mail->From = $mittente;
$mail->FromName = $nomemittente;
$mail->AddAddress($ut_email);
$mail->AddBCC($rootBaseEmail);
$mail->Subject = "Moncaffe.it - Paga il tuo ordine - " . date("d/m/Y", time());

$time = time();
$tracker = "<img src='$rootBasePath_http/crm/tracker-ordini.php?cod=$time&email=$ut_email' width='1' height='1'>";

$mail->Body = convertLinkOrdini($messaggio, $rootBasePath_http, $time, $ut_email) . $tracker;

//$mail->Body = $messaggio;
$mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

//percorso all'allegato
//$mail->AddAttachment('pdf/file.pdf');

if ($mail->Send()) {
    $get_send = true;
    $ol_stato_invio = "Successo";
} else {
    $get_send = false;
    $get_error_info = $mail->ErrorInfo;
    $ol_stato_invio = $get_error_info;
}

$querySql_ol =
    "INSERT INTO ol_ordini_log(ol_cr_id, ol_or_codice, ol_timestamp, ol_stato, ol_email, ol_stato_invio, ol_stato_lettura, ol_click) " .
    "VALUES (0, '$or_codice', '$time', 1, '$ut_email', '$ol_stato_invio', 0, 0) ";
$result_ol = $dbConn->query($querySql_ol);

//echo "<script>window.location=document.referrer;</script>";
header("Location: ordini-gst.php?mail=true");
?>
