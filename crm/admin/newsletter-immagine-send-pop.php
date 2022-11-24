<?php include "inc/autoloader.php"; ?>

<?php
    @$get_send = 0;
    
    $get_nl_id = isset($_GET["nl_id"]) ? (int)$_GET["nl_id"] : 0;
    
    $time = isset($_GET['time']) ? (int)$_GET['time'] : time();
    
    $querySql_nl = "SELECT * FROM nl_newsletter WHERE nl_id = $get_nl_id ";
    $result_nl = $dbConn->query($querySql_nl);
    $row_data_nl = $result_nl->fetch_assoc();
    
    $nl_id = $row_data_nl["nl_id"];
    $nl_ns_id = $row_data_nl["nl_ns_id"];
    $nl_titolo = $row_data_nl["nl_titolo"];
    
    $nl_testo = $row_data_nl["nl_testo"];
    $nl_testo = str_replace("\r\n" , "<br>" , $nl_testo);
    
    $nl_immagine = $row_data_nl["nl_immagine"];
    $nl_allegato = $row_data_nl["nl_allegato"];
    $nl_allegato_2 = $row_data_nl["nl_allegato_2"];
    $nl_link = $row_data_nl["nl_link"];
    $nl_oggetto = $row_data_nl["nl_oggetto"];
    $nl_mittente = $row_data_nl["nl_mittente"];
    
    $queryCountSql = "SELECT COUNT(ne_id) FROM ne_newsletter_email WHERE ne_ns_id = '$nl_ns_id' ";
    $result = $dbConn->query($queryCountSql);
    $row = $result->fetch_row();
    
    // numero totale del count
    $row_cnt_email_att = $row[0];
    
    $result->close();
    
    $mailstart = isset($_GET["mailstart"]) ? (int)$_GET["mailstart"] : 0;
    $mailnumber = 50;
    $mailstop = 0;
    $mailstatus = 0;
    $mailcount = $row_cnt_email_att;
    
    $result_nl->close();
    
    include("../class/class.phpmailer.php");
    $mittente = $SMTP['user'];
    $nomemittente = $nl_mittente;
    $destinatario = "info@moncaffe.it";
    //$destinatario = "info@pepinoshop.com";
    $dataFullNow = strftime("%A %d %B %Y", time());
    
    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPKeepAlive = "true";
    $mail->Mailer = "smtp";
    
    
    include_once "../class/class.controllo-mail.php";
    $checkmail = new ControlloMail($dbConn);
    
    //SMTP NUVOLASMTP
    $mail->Host  = "vm01.nuvolasmtp.it"; //$SMTP['host'];
    $mail->Port = 25;  // SMTP Port
    $mail->Username   = "moncaffe.it@vu000628.arubabiz.net"; //$SMTP['user']; // utente server SMTP autenticato
    $mail->Password   = "qlU33%5z"; //$SMTP['pass']; // password server SMTP autenticato
    
    //SMTP MONCAFFE.IT
    //$mail->Host  = $SMTP['host'];
    //$mail->Port = 25;  // SMTP Port
    //$mail->Username   = $SMTP['user']; // utente server SMTP autenticato
    //$mail->Password   = $SMTP['pass']; // password server SMTP autenticato
    
    // abilito il messaggio in HTML
    $mail->IsHTML(true);
    
    //intestazioni e corpo dell'email
    $mail->From   = $mittente;
    $mail->FromName = $nomemittente;
    $mail->AddAddress($destinatario);
    //$mail->AddBCC("info@pepinoshop.com");
    //$mail->AddBCC("info@pepinoshop.com");
    $mail->Subject = $nl_oggetto;
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';
    //percorso all'allegato
    //$mail->AddAttachment('pdf/file.pdf');
    
    if(strlen($nl_allegato) > 0) {
        $path = "$upload_path_dir_newsletter/$nl_allegato";
        $mail->AddAttachment($path);
    }
    
    if(strlen($nl_allegato_2) > 0) {
        $path = "$upload_path_dir_newsletter/$nl_allegato_2";
        $mail->AddAttachment($path);
    }
    
    if ($mailstart == 0) $mail->Send();
    $mail->ClearAllRecipients(); //clear address
    
    include_once "../class/class.controllo-mail.php";
    $checkmail = new ControlloMail($dbConn);
    
    //Alimento la lista email per la newsletter
    $querySql_ne = "SELECT * FROM ne_newsletter_email WHERE ne_ns_id = '$nl_ns_id' ORDER BY ne_id LIMIT $mailstart, $mailnumber";
    $result_ne = $dbConn->query($querySql_ne);
    $rows_ne = $dbConn->affected_rows;
    
    $i = $mailstart;
    while (($row_data_ne = $result_ne->fetch_assoc()) !== NULL) {
    
        $email_titolo = $nl_oggetto;
    
        $email_testo = "<p>";
        $email_testo .= str_replace("#nominativo#", $row_data_ne['ne_nominativo'], $nl_testo);
        $email_testo .= "</p>";
    
        if (strlen($nl_immagine) > 0) {
            if (strlen($nl_link) > 0) {
                $email_testo .=
                    "<p><a href='$nl_link' target='_blank'><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='530' /></a></p>";
            } else {
                $email_testo .= "<p><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='530' /></p>";
            };
        };
    
        $ne_id = $row_data_ne['ne_id'];
        $ne_email = $row_data_ne['ne_email'];
    
        //include "inc/mail/default.php";
        include "../../inc/mail.php";
    
        $tracker = "<img src='$rootBasePath_http/crm/tracker.php?cod=$time&email=$ne_email' width='1' height='1'>";
        $mail->Body = convertLink($messaggio, $rootBasePath_http, $time, $ne_email).$tracker;
    
        //$mail->AddBCC($nl_email);
        $mail->AddAddress($ne_email);
    
        if($mail->Send()) {
            $get_send = true;
            $no_stato_invio = "Successo";
        } else {
            $get_send = false;
            $get_error_info = $mail->ErrorInfo;
            $no_stato_invio = $get_error_info;
        }
    
        $querySql_no = "INSERT INTO no_newsletter_log(no_nl_id, no_ns_id, no_timestamp, no_timestamp_fine, no_stato, no_email, no_stato_invio, no_stato_lettura) ";
        $querySql_no .= "VALUES ('$nl_id', '$nl_ns_id', '$time', ".time().", 1, '$ne_email', '$no_stato_invio', 0) ";
        $result_no = $dbConn->query($querySql_no);
        $no_id = $dbConn->insert_id;
    
        $mail->ClearAddresses(); //clear TO address
        //$mail->ClearAllRecipients; //clear all recipients
    
        $i += 1;
    
        $checkmail->InvioMail();
    };
    
    $checkmail->AggiornaTabella();
    
    $mailstop = $i;
    $mailstart = $mailstop;
    
    $result_ne->close();
    
    $get_send = true;
    
    if ($mailcount > $mailstop) header("Location: newsletter-immagine-send-pop.php?nl_id=$get_nl_id&mailstart=$mailstop&time=$time;");
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Titolo newsletter: <?php echo $nl_titolo; ?></h6>
            <h2>NEWSLETTER INVIATA CORRETTAMENTE</h2>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body">

    <?php if ($get_send == true) { ?>
        <p>Inoltro newsletter eseguito</p>
        <p>La coda delle email per la newsletter e' stata inviata correttamente al server di posta per tutte le <strong><?php echo $mailstop ?></strong> email del database</p>
    <?php } elseif ($get_send == false) { ?>
        <p>Errore inoltro email</p>
        <p>Se è verificato il seguente errore: <?php echo $get_error_info; ?>, riprova o contatta il supporto tecnico.</p>
    <?php }; ?>

</div>

<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>
</div>
<?php include('../inc/db-close.php'); ?>
