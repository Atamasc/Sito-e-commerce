<?php include('inc/autoloader.php') ?>
<?php
$ut_email = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_email"])));

//Controllo esistenza email
$sql = "SELECT ut_password FROM ut_utenti WHERE ut_email = '$ut_email' ";
$result = $dbConn->query($sql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {

    $ut_password = $result->fetch_array()[0];

    $email_titolo = "Recupero password";

    $email_testo =
        "
        <p>
            <br>Hai richiesto il recupero password. Ecco i tuoi dati di accesso:<br>
            <br><strong>Email: </strong>".$ut_email."
            <br><strong>Password: </strong>".$ut_password."
        </p>
        ";

    include "inc/mail.php";

    include("crm/class/class.phpmailer.php");
    $mittente = $SMTP['user'];
    $nomemittente = "Cybek.it";
    $destinatario = $ut_email;

    $dataFullNow = strftime("%A %d %B %Y", time());

    $mail = new PHPMailer;
    // utilizza la classe SMTP invece del comando mail() di php
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPKeepAlive = "true";

    $mail->Host = $SMTP['host'];
    $mail->Username = $SMTP['user'];
    $mail->Password = $SMTP['pass'];

    // abilito il messaggio in HTML
    $mail->IsHTML(true);

    //intestazioni e corpo dell'email
    $mail->From = $mittente;
    $mail->FromName = $nomemittente;
    $mail->AddAddress($destinatario);
    $mail->Subject = "Richiesta recupero password - ".date("d/m/Y", time());

    $mail->Body = $messaggio;

    $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';


    if ($mail->Send()) {
        $get_send = true;
        $get_error_info = "null";
        echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/login?recover=true' />";
    } else {
        $get_send = false;
        $get_error_info = $mail->ErrorInfo;
        echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/login?recover=false' />";

    };

} else {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/login?recover=false' />";
}

?>