<?php include "inc/autoloader.php"; ?>

<?php
$time = time();
$get_nl_id = isset($_GET["nl_id"]) ? (int)$_GET["nl_id"] : 0;

$querySql_nl = "SELECT * FROM nl_newsletter WHERE nl_id = $get_nl_id ";
$result_nl = $dbConn->query($querySql_nl);
$row_data_nl = $result_nl->fetch_assoc();

$nl_id = $row_data_nl["nl_id"];
$nl_titolo = $row_data_nl["nl_titolo"];

$nl_testo = $row_data_nl["nl_testo"];
$nl_testo = str_replace("\r\n" , "<br>" , $nl_testo);

$nl_immagine = $row_data_nl["nl_immagine"];
$nl_allegato = $row_data_nl["nl_allegato"];
$nl_link = $row_data_nl["nl_link"];
$nl_oggetto = $row_data_nl["nl_oggetto"];
$nl_mittente = $row_data_nl["nl_mittente"];

$corpo_newsletter = "<p>$nl_testo</p>";

if (strlen($nl_immagine) > 0) {
    if (strlen($nl_link) > 0) {
        $corpo_newsletter .=
            "<p><a href='$nl_link' target='_blank'><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='600' /></a></p>";
    } else {
        $corpo_newsletter .= "<p><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='600' /></p>";
    };
};

$result_nl->close();

include "inc/mail/default.php";

include("../class/class.phpmailer.php");
$mittente = $SMTP['user'];
$nomemittente = $nl_mittente;
$destinatario = $rootBaseEmail;
$ServerSMTP = "smtp1.nuvolamail.it";
$dataFullNow = strftime("%A %d %B %Y", time());

$mail = new PHPMailer;
// utilizza la classe SMTP invece del comando mail() di php
$mail->IsSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPKeepAlive = "true";
$mail->Mailer = "smtp";

$mail->Host  = $SMTP['host'];
$mail->Port = 25;  // SMTP Port
$mail->Username   = $SMTP['user']; // utente server SMTP autenticato
$mail->Password   = $SMTP['pass']; // password server SMTP autenticato

// abilito il messaggio in HTML
$mail->IsHTML(true);

//intestazioni e corpo dell'email
$mail->From   = $mittente;
$mail->FromName = $nomemittente;
$mail->AddAddress($destinatario);
//$mail->AddBCC("info@lucasweb.it");
//$mail->AddBCC("email del cliente");
$mail->Subject = $nl_oggetto;

$mail->Body = convertLink($body_mail, $rootBasePath_http, 0, "");

$mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';
//percorso all'allegato
//$mail->AddAttachment('pdf/file.pdf');

$get_send = true;

if($mail->Send()) {
    $get_send = true;
    //echo "messaggio inviato correttamente";
} else {
    $get_send = false;
    $get_error_info = $mail->ErrorInfo;
    //echo "Errore nella spedizione: ".$mail->ErrorInfo;
}
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Titolo newsletter: <?php echo $nl_titolo; ?></h6>
            <h2>INVIO TEST NEWSLETTER</h2>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body">

    <?php if ($get_send == true) { ?>
            <p>Inoltro newsletter test eseguito</p>
            <p>L'inoltro del test della newsletter e' stato eseguito, riceverai una email su <strong><?php echo $rootBaseEmail; ?></strong></p>
    <?php } elseif ($get_send == false) { ?>
            <p>Errore inoltro email</p>
            <p>Se è verificato il seguente errore: <?php echo $get_error_info; ?>, riprova o contatta il supporto tecnico.</p>
    <?php }; ?>

</div>

<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>
</div>

<?php include('../inc/db-close.php'); ?>
