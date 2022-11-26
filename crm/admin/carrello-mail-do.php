<?php include('inc/autoloader.php'); ?>
<?php
    $ut_codice = (int)$_GET["ut_codice"];
    $cr_id = (int)$_GET["cr_id"];
    
    $ut_email = getEmailClienteByCodice($ut_codice, $dbConn);
    $ut_nominativo = getNominativoClienteByCodice($ut_codice, $dbConn);
    $ut_id = getIDClienteByCodice($ut_codice, $dbConn);
    
    $querySql =
        "SELECT * FROM pr_prodotti ".
        "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice ".
        "WHERE cr_id = '$cr_id' ";
    $result = $dbConn->query($querySql);
    $rows = $result->num_rows;
    
    $cr_totale = 0;
    while ($row_data = $result->fetch_assoc()) {
    
        $cr_id = $row_data['cr_id'];
        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $cr_pr_codice = $row_data['cr_pr_codice'];
        $cr_pr_quantita = $row_data['cr_pr_quantita'];
        $cr_pagamento = $row_data['cr_pagamento'];
        $cr_spedizione = $row_data['cr_spedizione'];
    
        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && file_exists("upload/prodotti/".$row_data['pr_immagine'])
            ? "upload/prodotti/".$row_data['pr_immagine']
            : "assets/images/prodotto-dummy.jpg";
    
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
    
        $pr_titolo = $row_data['pr_titolo'];
        //$pr_link = generateProductLink($pr_id);
    
        $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
        $pr_totale = formatPrice($pr_prezzo * $cr_pr_quantita);
    
        $body_mail_pr .=
            "<tr>".
            "<td align='center'>$cr_pr_codice</td>".
            "<td>$pr_titolo</td>".
            "<td align='center'>$cr_pr_quantita</td>".
            "<td align='right'>".formatPrice($pr_prezzo)."</td>".
            "<td align='right'>$pr_totale</td>".
            "</tr>";
    
    }
    
    $result->close();
    
    $email_titolo = "Completa il tuo ordine!";
    
    $cr_pagamento_prezzo = getPrezzoPagamento($cr_pagamento, $cr_totale);
    $cr_spedizione_prezzo = getPrezzoSpedizione($cr_spedizione, $cr_totale);
    
    $cr_iva = $cr_totale * 0.22;
    $cr_imponibile = $cr_totale - $cr_iva;
    
    $cr_totale = $cr_totale + $cr_pagamento_prezzo + $cr_spedizione_prezzo;
    
    $email_testo =
        "
                <p>
                    Ciao $ut_nominativo.<br>
                    Hai lasciato dei prodotti in sospeso nel carrello. <a href='$rootBasePath_http/login-do?ut_codice=$ut_codice?ut_id=$ut_id'>Clicca qua</a> per completare il tuo acquisto.
                    <br><br>
                    Questa e-mail è automatica, pertanto non c'è bisogno di rispondere.
                </p>
    
            <br><br>
            
            ";
    
    $email_testo .=
        "
            <table class=\"carrello\" style=\"width:100%;\">
                <thead>
                <tr>
                    <td>Codice prodotto</td>
                    <td>Prodotto</td>
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
                        <td >".formatPrice($cr_imponibile)." &euro;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">IVA (&euro;)</td>
                        <td >".formatPrice($cr_iva)." &euro;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Commissioni (&euro;)</td>
                        <td >".formatPrice($cr_pagamento_prezzo)." &euro;</td>
                    </tr>
                    <tr>
                        <td  colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Costi di spedizione (&euro;)</td>
                        <td >".formatPrice($cr_spedizione_prezzo)." &euro;</td>
                    </tr>
                    <tr>
                        <td colspan=\"2\"> &nbsp; </td>
                        <td colspan=\"2\">Totale (&euro;)</td>
                        <td >".formatPrice($cr_totale)." &euro;</td>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            
            ";
    
    include "../../inc/mail.php";
    
    include("../class/class.phpmailer.php");
    $mittente = "noreply@moncaffe.it";
    $nomemittente = "MonCaffè";
    $destinatario = $ut_email;
    $dataFullNow = strftime("%A %d %B %Y", time());
    
    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPKeepAlive = "true";
    
    // autenticazione server SMTP di invio mail
    $mail->Host  = "mail.moncaffe.it";
    $mail->Username   = "noreply@moncaffe.it";      // utente server SMTP autenticato
    $mail->Password   = "Vin@7888!";    // password server SMTP autenticato
    
    // abilito il messaggio in HTML
    $mail->IsHTML(true);
    
    //intestazioni e corpo dell'email
    $mail->From   = $mittente;
    $mail->FromName = $nomemittente;
    $mail->AddAddress($ut_email);
    $mail->AddBCC($rootBaseEmail);
    $mail->AddBCC("notifica@lucasweb.it");
    $mail->Subject = "Smartex.it - Completa il tuo ordine - ".date("d/m/Y", time());
    
    $time = time();
    $tracker = "<img src='$rootBasePath_http/crm/tracker-ordini.php?cod=$time&email=$ut_email' width='1' height='1'>";
    
    $mail->Body = convertLinkOrdini($messaggio, $rootBasePath_http, $time, $ut_email).$tracker;
    
    //$mail->Body = $messaggio;
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';
    
    //percorso all'allegato
    //$mail->AddAttachment('pdf/file.pdf');
    
    if($mail->Send()) {
        $get_send = true;
        $ol_stato_invio = "Successo";
    } else {
        $get_send = false;
        $get_error_info = $mail->ErrorInfo;
        $ol_stato_invio = $get_error_info;
    }
    
    $querySql_ol =
        "INSERT INTO ol_ordini_log(ol_cr_id, ol_or_codice, ol_timestamp, ol_stato, ol_email, ol_stato_invio, ol_stato_lettura, ol_click) ".
        "VALUES ('$cr_id', 0, '$time', 1, '$ut_email', '$ol_stato_invio', 0, 0) ";
    $result_ol = $dbConn->query($querySql_ol);
    
    //echo "<script>window.location=document.referrer;</script>";
    header("Location: carrelli-gst.php?mail=true");
?>
