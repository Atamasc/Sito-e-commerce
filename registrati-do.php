<?php include "inc/autoloader.php"; ?>
<?php
if ($_POST['codice_num_hidden'] != $_POST['codice_num']) exit;

$ut_nome = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_nome"])));
$ut_cognome = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_cognome"])));
$ut_provincia = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_provincia"])));
$ut_citta = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_citta"])));
$ut_cap = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_cap"])));
$ut_indirizzo = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_indirizzo"])));
$ut_telefono = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_telefono"])));
$ut_email = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_email"])));
$ut_password = $dbConn->real_escape_string(trim(stripslashes($_POST["ut_password"])));

$py_checkbox_privacy = isset($_POST['py_checkbox_privacy']) ? 1 : 0;
$py_checkbox_marketing = isset($_POST['py_checkbox_marketing']) ? 1 : 0;
$py_checkbox_cessione = isset($_POST['py_checkbox_cessione']) ? 1 : 0;

$userip = getUserIP();

$serial_date = time();
$datetime = date("d/m/Y - H:i:s", $serial_date);

$querySql = "SELECT COUNT(ut_id) FROM ut_utenti WHERE ut_email = '$ut_email' ";
$result = $dbConn->query($querySql);
$checkEmail = (int)$result->fetch_array()[0];
$result->close();

if ($checkEmail > 0) {
    echo "<meta http-equiv='refresh' content='0;url=registrati?exist=true&email=$ut_email' />";
} else {

    $ut_nominativo = "$ut_nome $ut_cognome";
    $py_dati =
        "Nominativo : $ut_nominativo\n" .
        "Email : $ut_email\n" .
        "Password : $ut_password\n" .
        "Telefono : $ut_telefono\n" .
        "Provincia : $ut_provincia\n" .
        "Comune : $ut_citta\n" .
        "Indirizzo : $ut_indirizzo\n" .
        "CAP : $ut_cap\n" .
        "Data e ora: $datetime\n" .
        "Codice numerico: " . $_POST['codice_num'];

    //addLogPrivacy("$ut_nominativo", "$ut_email", "$py_dati", "registrati", "Inserimento", "Registrazione", "$py_checkbox_privacy", "$py_checkbox_marketing", "$py_checkbox_cessione", $dbConn);

    $querySql =
        "INSERT INTO ut_utenti(ut_codice, ut_nome, ut_cognome, ut_email, ut_provincia, ut_citta, ut_cap, " .
        "ut_indirizzo, ut_telefono, ut_password, ut_data, ut_stato, ut_rapido" .
        ") VALUES (" .
        "'$serial_date', '$ut_nome','$ut_cognome','$ut_email','$ut_provincia','$ut_citta','$ut_cap', '$ut_indirizzo','$ut_telefono', " .
        "'$ut_password', '$serial_date', 1, 0)";


    if (0 == 0) {

        $email_titolo = "Benvenuto su Cybek.it";

        $email_testo =
            "
                    <strong>Ecco i dati di accesso che hai inserito:</strong><br>
                    Email : " . $ut_email . "<br>
                    Password : " . $ut_password . "<br><br>
                  
                    <strong>I tuoi dati personali:</strong><br>
                    Nome : " . $ut_nome . " " . $ut_cognome . "<br>
                    E-mail : " . $ut_email . "<br>
                    Telefono : " . $ut_telefono . "<br>
                    Provincia : " . $ut_provincia . "<br>
                    Citt� : " . $ut_citta . "<br>
                    CAP : " . $ut_cap . "<br>
                    
                    <a href='$rootBasePath_http/login'>Clicca qui per accedere allo store</a>. <br><br>
            ";

        include "inc/mail.php";

        include("crm/class/class.phpmailer.php");
        $mittente = "info@cybek.it";
        $nomemittente = "Cybek.it";
        $destinatario = $ut_email;

        $mail = new PHPMailer;
        // utilizza la classe SMTP invece del comando mail() di php
        $mail->IsSMTP();
        $mail->SMTPKeepAlive = "true";

        // autenticazione server SMTP di invio mail
        $mail->Host = "webmailsmtp.register.it";
        $mail->Port = 25;
        $mail->Username = "info@cybek.it";      // utente server SMTP autenticato
        $mail->Password = "emaildominio";    // password server SMTP autenticato
        // abilito il messaggio in HTML
        $mail->IsHTML(true);
        $mail->SMTPSecure = false;
        $mail->SMTPAuth = true;

        //intestazioni e corpo dell'email
        $mail->From = $mittente;
        $mail->FromName = $nomemittente;
        $mail->AddAddress($destinatario);
        //$mail->AddBCC($rootBaseEmail);
        $mail->Subject = "Cybek.it - Conferma registrazione " . $datetime;

        $mail->Body = "sss";
        $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

        $mail->SMTPDebug = 1;
        $mail->Send();

        echo "si";

        //header("Location:login-do?ut_email=$ut_email&ut_password=$ut_password");

    } else
        //echo "<meta http-equiv='refresh' content='0;url=registrati?insert=false' />";
        header("Location:registrati?insert=false");
}
?>