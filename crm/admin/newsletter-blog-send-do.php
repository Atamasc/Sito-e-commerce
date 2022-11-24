<?php include "inc/autoloader.php"; ?>

<?php
    @$get_send = 0;
    
    $get_nb_id = isset($_GET["nb_id"]) ? (int)$_GET["nb_id"] : 0;
    $get_ns_id = isset($_GET["ns_id"]) ? (int)$_GET["ns_id"] : 0;
    
    $time = isset($_GET['time']) ? (int)$_GET['time'] : time();
    
    $querySql_nl = "SELECT * FROM nb_newsletter_blog WHERE nb_id = $get_nb_id ";
    $result_nl = $dbConn->query($querySql_nl);
    $row_data_nl = $result_nl->fetch_assoc();
    
    $nb_id = $row_data_nl["nb_id"];
    $nb_tipo = $row_data_nl["nb_tipo"];
    $nb_ns_id = $get_ns_id;
    
    $queryCountSql = "SELECT COUNT(ne_id) FROM ne_newsletter_email WHERE ne_ns_id = '$get_ns_id' ";
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
    $nomemittente = "PepinoShop.com";
    $destinatario = "info@lucasweb.it";
    //$destinatario = "info@lucasweb.it";
    $dataFullNow = strftime("%A %d %B %Y", time());
    
    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPKeepAlive = "true";
    $mail->Mailer = "smtp";
    
    include_once "../class/class.controllo-mail.php";
    $checkmail = new ControlloMail($dbConn);
    
    //SMTP NUVOLASMTP.IT
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
    //$mail->AddBCC("info@lucasweb.it");
    //$mail->AddBCC("info@lucasweb.it");
    $mail->Subject = "News dal blog";
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';
    
    if($nb_tipo == "ibrida") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/ibrido.php?nb_id=$nb_id";
    else if($nb_tipo == "lista") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/lista-blog.php?nb_id=$nb_id";
    else if($nb_tipo == "singola") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/post-singolo.php?nb_id=$get_nb_id";
    $body_mail = file_get_contents($url);
    
    //if($mailstart == 0) $mail->Send();
    $mail->ClearAllRecipients(); //clear address
    
    //Alimento la lista email per la newsletter
    $querySql_ne = "SELECT * FROM ne_newsletter_email WHERE ne_ns_id = '$nb_ns_id' ORDER BY ne_id LIMIT $mailstart, $mailnumber";
    $result_ne = $dbConn->query($querySql_ne);
    $rows_ne = $dbConn->affected_rows;
    
    $i = $mailstart;
    while (($row_data_ne = $result_ne->fetch_assoc()) !== NULL) {
    
        $ne_id = $row_data_ne['ne_id'];
        $ne_email = $row_data_ne['ne_email'];
    
        $tracker = "<img src='$rootBasePath_http/crm/tracker.php?cod=$time&email=$ne_email' width='1' height='1'>";
    
        $mail->Body = convertLink($body_mail, $rootBasePath_http, $time, $ne_email).$tracker;
    
        //$mail->AddBCC($nb_email);
        $mail->AddAddress($ne_email);
    
        if($mail->Send()) {
            $get_send = true;
            $no_stato_invio = "Successo";
        } else {
            $get_send = false;
            $get_error_info = $mail->ErrorInfo;
            $no_stato_invio = $get_error_info;
    
            $mail->smtpReset();
        }
    
        $querySql_no =
            "INSERT INTO no_newsletter_log(no_nb_id, no_ns_id, no_timestamp, no_timestamp_fine, no_stato, no_email, no_stato_invio, no_stato_lettura, no_click) ".
            "VALUES ('$nb_id', '$nb_ns_id', '$time', ".time().", 1, '$ne_email', '$no_stato_invio', 0, 0) ";
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
    
    if ($mailcount > $mailstop) header("Location: newsletter-blog-send-do.php?nb_id=$get_nb_id&ns_id=$get_ns_id&mailstart=$mailstop&time=$time;");
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Tipo newsletter: <?php echo $nb_tipo; ?></h6>
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
