<?php include "inc/autoloader.php"; ?>

<?php
$get_np_id = isset($_GET['np_id']) ? (int)$_GET['np_id'] : 0;

$querySql = "SELECT * FROM np_notifiche_prodotti INNER JOIN pr_prodotti ON pr_codice = np_pr_codice WHERE np_id = ".$get_np_id." ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($row_data = $result->fetch_assoc()) !== NULL) {
    $np_id = $row_data['np_id'];
    $np_pr_codice = $row_data['np_pr_codice'];
    $np_timestamp = $row_data['np_timestamp'];
    $np_link = $row_data['np_link'];
    $pr_titolo = $row_data['pr_titolo'];

    $np_email = $row_data['np_email'];
    $np_timestamp = date("d/m/Y - H:i:s", $np_timestamp);
}

$co_data = time();
$datetime = date("d/m/Y - H:i:s", $co_data);

if ($rows > 0) {

    $querySql =
        "UPDATE np_notifiche_prodotti SET np_notificato = '1' WHERE np_id = " . $get_np_id . " ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $dbConn->close();

    $co_messaggio = " 
            <html> 
                <head> 
                    <title>MonCaffè - Notifica automatica dal sito web</title> 
                    <style type='text/css'> 
                        body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; font-weight:normal; color:#000000;}
                        .table {background-color:#fff; border: 1px solid #ccc; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px;	color:#000; }
                        .little {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color:#666; }
                    </style> 
                </head> 
            
                <body> 
                    <table width='340'>
                        <tr>
                            <td class='table'><img src='$rootBasePath_http/assets/images/logo/logo.png' alt='' width='250' border='0'></td>
                        </tr>
                        <tr>
                            <td class='table' valign='top' width='470'>
                                <strong><u>Hai richiesto una notifica su questo prodotto</u></strong><br> 
                                Questo è un messaggio automatico che ti avvisa che il prodotto per il quale avevi richiesto una notifica è tornato disponibile.<br>
                                Puoi acquistarlo subito cliccando sul link in basso.
                            </td>
                        </tr>
                        <tr>
                            <td class='table' valign='top' width='470'>
                                <strong>Clicca sul link in basso per vedere il prodotto di tuo interesse</strong><br>
                                Nome prodotto : " . $pr_titolo . "<br>
                                <a href='".$np_link."'>Vai al prodotto</a><br>
                                Data e ora della tua richiesta: " . $np_timestamp . "<br><br>
                            </td>
                        </tr>
                    </table>
                </body> 
            </html> 
                    ";

    include("../class/class.phpmailer.php");
    $mittente = "noreply@moncaffe.it";
    $nomemittente = "Contatto web";
    $destinatario = $np_email;
    //$ServerSMTP = "mail.lucasweb.it";  //server SMTP autenticato Hosting Solutions
    $dataFullNow = strftime("%A %d %B %Y", $co_data);

    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = "true";

    // autenticazione server SMTP di invio mail
    $mail->Host = "mail.moncaffe.it";
    $mail->Username = "noreply@moncaffe.it";      // utente server SMTP autenticato
    $mail->Password = "Vin@7888!";    // password server SMTP autenticato

    // abilito il messaggio in HTML
    $mail->IsHTML(true);

    //intestazioni e corpo dell'email
    $mail->From = $mittente;
    $mail->FromName = $nomemittente;
    $mail->AddAddress($np_email);
    //$mail->AddBCC($rootBaseEmail);
    //$mail->AddBCC("info@lucasweb.it");
    $mail->Subject = "MonCaffè - Messaggio dal sito web - " . $datetime;

    $mail->Body = $co_messaggio;
    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

    if ($mail->Send()) {
        $get_send = true;
        echo "<meta http-equiv='refresh' content='0;url=notifiche-gst.php?insert=true' />";
    } else {
        $get_send = false;
        $get_error_info = $mail->ErrorInfo;
        echo "<meta http-equiv='refresh' content='0;url=notifiche-gst.php?insert=false' />";
    }
};