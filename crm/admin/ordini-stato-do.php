<?php include('inc/autoloader.php');
$SMTP['host'] = "mail.moncaffe.it";
$SMTP['user'] = "noreply@moncaffe.it";
$SMTP['pass'] = "Vin@7888!";
?>
<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT or_stato FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$or_stato = $result->fetch_array()[0];
$result->close();

$querySql = "UPDATE or_ordini SET or_stato = 1 - or_stato WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($or_stato == 1) {

    $querySql = "SELECT or_ordini.*, ut_email FROM or_ordini INNER JOIN ut_utenti ON ut_codice = or_ut_codice WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();

    $or_ut_codice = $row_data["or_ut_codice"];
    $or_tracking = $row_data["or_tracking"];
    $ut_email = $row_data["ut_email"];

    $importo_totale_ordine = 0;

    $querySql = "SELECT * FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $or_totale = getTotaleOrdine($or_ut_codice);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_id = $row_data['or_id'];
        $or_ut_codice = $row_data['or_ut_codice'];
        $or_pr_codice = $row_data['or_pr_codice'];
        $or_pr_quantita = $row_data['or_pr_quantita'];
        $or_pagamento = $row_data['or_pagamento'];
        $or_tipo_spedizione = $row_data['or_tipo_spedizione'];
        $or_sconto = $row_data['or_sconto'];
        $or_spedizione = $row_data['or_spedizione'];

        $pr_ct_id = $row_data['pr_ct_id'];
        $pr_st_id = $row_data['pr_st_id'];

        $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);
        $pr_st_id_sottocategoria = getSottocategoria($pr_st_id, $dbConn);

        $pr_prezzo = strlen($row_data['pr_prezzo_scontato']) > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
        $pr_titolo = $row_data['pr_titolo'];

        $importo_prodotto = $pr_prezzo * $or_pr_quantita;

        $body_mail_pr .=
            "<tr>".
            "<td align='center'>$or_pr_codice</td>".
            "<td>
                <span style='font-size: 12px; font-style: italic;'>".$pr_ct_id_categoria." / ".$pr_st_id_sottocategoria."</span><br>
                $pr_titolo
            </td>".
            "<td align='center'>$or_pr_quantita</td>".
            "<td align='right'>".formatPrice($pr_prezzo)."</td>".
            "<td align='right'>".formatPrice($importo_prodotto)."</td>".
            "</tr>";

        $importo_totale_ordine += $importo_prodotto;
    }

    $result->close();

    $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $importo_totale_ordine);
    $or_tipo_spedizione_prezzo = $or_spedizione;

    $iva_ordine = $importo_totale_ordine * 0.22;
    $importo_parziale_ordine = $importo_totale_ordine - $iva_ordine;

    $importo_totale_ordine = $importo_totale_ordine - $or_sconto + $or_tipo_spedizione_prezzo + $or_pagamento_prezzo;

    $ut_email = getEmailClienteByCodice($or_ut_codice, $dbConn);

    $email_titolo = "Il tuo ordine è stato evaso!";

    $or_tracking = strlen($or_tracking) > 0 ? "Clicca sul link di seguito per seguire la spedizione: <a href='$or_tracking'>$or_tracking</a>" : "";

    if(strlen($or_sconto)>0){
        $sconto_email = "<tr>
                    <td  colspan=\"2\"> &nbsp; </td>
                    <td colspan=\"2\">Sconto (&euro;)</td>
                    <td >-".formatPrice($or_sconto)." &euro;</td>
                </tr>";
    }


    $email_testo =
        "
            <p>
                Questa e-mail automatica ti avvisa che l'ordine che segue, da te effettuato, è stato <b>evaso</b> e quindi la transazione si è conclusa positivamente, ti ricordiamo che
                per conoscere i dettagli dell'ordine puoi accedere alla tua area riservata sul sito <a href='$rootBasePath_http'>$rootBasePath_http</a><br />
                Nel ringraziarti per averci scelto ti ricordiamo che per informazioni puoi scrivere a <a href='mailto:$rootBaseEmail'>$rootBaseEmail</a><br />
                <br />
                $or_tracking
                <br><br>
                Questa e-mail è automatica, pertanto non c'è bisogno di rispondere.
            </p>

            <br>
            <br>
          
            <p>Codice ordine: $or_codice del ".date('d/m/Y - H:i', substr($or_codice,9))."</p>
            <p>Email: <strong>".getNominativoClienteByCodice($or_ut_codice, $dbConn)."&nbsp;(".$or_ut_codice.")</strong></p>
            <p>Indirizzo di spedizione: <strong>".getIndirizzoClienteByCodice($or_ut_codice, $dbConn)."</strong></p>
            <p>Tipo di spedizione: <strong>$or_tipo_spedizione</strong></p>
            <p>Metodo di pagamento: <strong>$or_pagamento</strong></p>

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
    $nomemittente = "Evasione ordine";
    $destinatario = $ut_email;
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
    $mail->AddAddress($ut_email);
    $mail->AddBCC($rootBaseEmail);
    $mail->AddBCC("notifica@lucasweb.it");
    $mail->AddBCC("moncaffe.it+0e2538ac9a@invite.trustpilot.com");
    $mail->Subject = "Smartex.it - Evasione ordine - ".date("d/m/Y", time());

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

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
