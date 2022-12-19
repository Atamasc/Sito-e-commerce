<?php include('inc/autoloader.php'); ?>
<?php
$or_timestamp = time();
$or_codice = "cybek_" . $or_timestamp;

$importo_totale_ordine = 0;

$querySql = "SELECT * FROM cr_carrello INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice WHERE cr_ut_codice = '$session_cl_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$cr_totale = getTotalecarrello($session_cl_codice);
$value_coupon = "";

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $cr_id = $row_data['cr_id'];
    $cr_ut_codice = $row_data['cr_ut_codice'];
    $cr_pr_codice = $row_data['cr_pr_codice'];
    $cr_pr_quantita = checkQnt($cr_pr_codice, $row_data['cr_pr_quantita']);
    $cr_pagamento = $row_data['cr_pagamento'];
    $cr_spedizione = $row_data['cr_spedizione'];
    $cr_indirizzo = $row_data['cr_indirizzo'];
    $cr_note = $row_data['cr_note'];
    $cr_coupon = $row_data['cr_coupon'];
    $cr_coupon_codice = $row_data['cr_coupon_codice'];
    $cr_coupon_tipo = $row_data['cr_coupon_tipo'];
    $cr_coupon_spedizione = $row_data['cr_coupon_spedizione'];

    $pr_ct_id = $row_data['pr_ct_id'];

    $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);

    $pr_id = $row_data['pr_id'];
    $pr_prezzo = strlen($row_data['pr_prezzo_scontato']) > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
    $pr_titolo = $row_data['pr_titolo'];

    $cr_note = $dbConn->real_escape_string(stripslashes(trim($cr_note)));
    $cr_pagamento_prezzo = formatPriceForDB(getPrezzoPagamento($cr_pagamento, $cr_totale));
    $cr_spedizione_prezzo = getPrezzoSpedizione($cr_spedizione, $cr_totale);

    if ($cr_coupon_spedizione == 1) {
        $cr_spedizione_prezzo = 0.00;
    }

    $cr_sconto_coupon = 0;
    if (strlen($cr_coupon) > 0) {
        $cr_sconto_coupon = $cr_coupon_tipo == 'importo'
            ? formatPriceForDB($cr_coupon)
            : ($cr_totale / 100) * $cr_coupon;
    }

    $querySql_up = "UPDATE pr_prodotti SET pr_giacenza = pr_giacenza - $cr_pr_quantita WHERE pr_codice = '$cr_pr_codice' ";
    $result_up = $dbConn->query($querySql_up);

    $querySql_insert =
        "INSERT INTO or_ordini (" .
        "or_codice, or_ut_codice, or_pr_codice, or_pr_prezzo, or_pr_quantita, or_pagamento, or_spedizione, or_tipo_spedizione, " .
        "or_note, or_stato_conferma, or_stato_pagamento, or_stato_spedizione, or_stato_reso, or_stato, or_timestamp, or_coupon_valore, or_coupon_tipo, or_coupon " .
        ") VALUES (" .
        "'$or_codice', '$session_cl_codice', '$cr_pr_codice', '$pr_prezzo', '$cr_pr_quantita', '$cr_pagamento', '$cr_spedizione_prezzo', '$cr_spedizione', " .
        "'$cr_note', '1', '0', '0', '0', '0', '$or_timestamp', '$cr_coupon', '$cr_coupon_tipo', '$cr_coupon_codice' " .
        ")";
    $result_insert = $dbConn->query($querySql_insert);
    $rows_insert = $dbConn->affected_rows;

    $importo_prodotto = $pr_prezzo * $cr_pr_quantita;

    $body_mail_pr .=
        "<tr>" .
        "<td align='center'>$cr_pr_codice</td>" .
        "<td>
                <span style='font-size: 12px; font-style: italic;'>" . $pr_ct_id_categoria . "</span><br>
                $pr_titolo
            </td>" .
        "<td align='center'>$cr_pr_quantita</td>" .
        "<td align='right'>" . formatPrice($pr_prezzo) . "</td>" .
        "<td align='right'>" . formatPrice($importo_prodotto) . "</td>" .
        "</tr>";

    $importo_totale_ordine += $importo_prodotto;
}

if (strlen($cr_coupon) > 0) {

    $querySql_insert = "INSERT INTO uc_utilizzo_coupon (";
    $querySql_insert .= "uc_ut_codice, uc_coupon, uc_ordine, uc_data ";
    $querySql_insert .= ") VALUES (";
    $querySql_insert .= "'" . $session_cl_codice . "','" . $cr_coupon_codice . "','" . $or_codice . "','" . time() . "'";
    $querySql_insert .= ")";
    $result_insert = $dbConn->query($querySql_insert);
    //$rows_insert = $dbConn->affected_rows;

    $value_coupon = "<p>Coupon sconto: <strong>$cr_coupon_codice</strong></p>";
}

$result->close();

if ($rows_insert > 0) {

    $cr_pagamento_prezzo = getPrezzoPagamento($cr_pagamento, $importo_totale_ordine);
    $cr_spedizione_prezzo = getPrezzoSpedizione($cr_spedizione, $importo_totale_ordine);

    if ($cr_coupon_spedizione == 1) {
        $cr_spedizione_prezzo = 0.00;
    }

    $importo_parziale_ordine = $importo_totale_ordine / 1.22;
    $iva_ordine = $importo_totale_ordine - $importo_parziale_ordine;

    $importo_totale_ordine = $importo_totale_ordine - $cr_sconto_coupon + $cr_spedizione_prezzo + $cr_pagamento_prezzo;

    $ut_email = getEmailClienteByCodice($session_cl_codice, $dbConn);
    $ut_cliente_nominativo = getNominativoClienteByCodice($cr_ut_codice, $dbConn);
    $ut_indirizzo_spedizione = getIndirizzoClienteByCodice($cr_ut_codice, $dbConn);

    $email_titolo = "Grazie per aver acquistato su Moncaffe.it";

    $email_testo = "
                    <p>
                        Abbiamo acquisito il tuo ordine che sarà lavorato secondo i tempi indicati e successivamente spedito.
                        Riceverai una mail automatica con il codice tracking del corriere appena il tuo ordine sarà spedito. <br>
                        Per dettagli sui tempi di evasione puoi visitare la sezione <a href='https://www.moncaffe.it/spedizioni'>https://www.moncaffe.it/spedizioni</a> <br>
                    </p>
                    <br>
                    <p>Codice ordine: $or_codice del " . date('d/m/Y - H:i', substr($or_codice, 9)) . "</p>
                    <p>Cliente: <strong>" . $ut_cliente_nominativo . "&nbsp;(" . $cr_ut_codice . ")</strong></p>
                    <p>Email: $ut_email</p>
                    <p>Indirizzo di spedizione: <strong>" . $ut_indirizzo_spedizione . "</strong></p>
                    <p>Tipo di spedizione: <strong>$cr_spedizione</strong></p>
                    <p>Metodo di pagamento: <strong>$cr_pagamento</strong></p>
                    $value_coupon
                    <p>Note: <strong>$cr_note</strong></p>
                   ";

    if ($cr_pagamento == 'Bonifico') {

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
                        <td colspan='6'><strong>Acquisto moncaffe.it Ordine $or_codice</strong></td>
                    </tr>
                </table>";

    }

    if (strlen($cr_coupon) > 0) {
        $sconto_email = " <tr>
                        <td  colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Sconto (&euro;)</td>
                        <td >-" . formatPrice($cr_sconto_coupon) . " &euro;</td>
                    </tr>";
    }

    $email_testo .=
        "
            <table class=\"carrello\" style=\"width:100%;\">
                <thead>
                <tr>
                    <td>Codice prodotto</td>
                    <td>Categoria <br>
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
                        <td >" . formatPrice($importo_parziale_ordine) . " &euro;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">IVA (&euro;)</td>
                        <td >" . formatPrice($iva_ordine) . " &euro;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Commissioni (&euro;)</td>
                        <td >" . formatPrice($cr_pagamento_prezzo) . " &euro;</td>
                    </tr>
                    <tr>
                        <td  colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Costi di spedizione (&euro;)</td>
                        <td >" . formatPrice($cr_spedizione_prezzo) . " &euro;</td>
                    </tr>
                    $sconto_email
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Totale (&euro;)</td>
                        <td >" . formatPrice($importo_totale_ordine) . " &euro;</td>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            
            ";

    include "inc/mail.php";

    include("crm/class/class.phpmailer.php");
    $mittente = $SMTP['user'];
    $nomemittente = "Cybek.it";
    $destinatario = $ut_email;
    //$ServerSMTP = "mail.myservercloud.it";  //server SMTP autenticato Hosting Solutions
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
    $mail->Subject = "Ordine standard | " . $or_codice . " | " . $ut_cliente_nominativo . "";

    $mail->Body = $messaggio;
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

    if ($mail->Send()) {
        $get_send = true;
    } else {
        $get_send = false;
        $get_error_info = $mail->ErrorInfo;
    };

    $querySql_delete = "DELETE FROM cr_carrello WHERE cr_ut_codice = '$session_cl_codice'";
    $result_delete = $dbConn->query($querySql_delete);
    $delete_cart = $dbConn->affected_rows;

    if ($cr_pagamento == 'Stripe') {

        //$importo_totale_ordine = number_format($importo_totale_ordine , 2 , '.' , '');
        $stripe_redirect = generateStripeFastOrder($or_codice, $importo_totale_ordine);

        header("Location: $stripe_redirect");

    } else if ($cr_pagamento == 'Paypal') {

        $importo_totale_ordine_paypal = number_format($importo_totale_ordine, 2, '.', '');

        /*
        $_SESSION['or_codice'] = $or_codice;
        $_SESSION['importo_totale'] = $importo_totale_ordine_paypal;

        echo "<meta http-equiv='refresh' content='0;url=pagamento-paypal' />";
        */

        $return_link = "$rootBasePath_http/confirmPayPal.php?or_codice=$or_codice";
        $cancel_link = "$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice&insert=false";

        echo "<meta http-equiv='refresh' content='0;url=https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=$emailPaypal&item_name=Order Code&item_number=$or_codice&amount=$importo_totale_ordine_paypal&invoice=$or_codice&currency_code=EUR&return=$return_link&cancel_return=$cancel_link'>";

    } else {
        echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice&insert=true' />";
    }
} else {

    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/anteprima-ordine?insert=false' />";

}
?>
