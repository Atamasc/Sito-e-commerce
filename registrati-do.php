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
        "ut_indirizzo, ut_telefono, ut_password, ut_data, ut_stato" .
        ") VALUES (" .
        "'$serial_date', '$ut_nome','$ut_cognome','$ut_email','$ut_provincia','$ut_citta','$ut_cap', '$ut_indirizzo','$ut_telefono', " .
        "'$ut_password', '$serial_date', 1)";

    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $dbConn->close();

    if ($rows > 0) {


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
                    Città : " . $ut_citta . "<br>
                    CAP : " . $ut_cap . "<br>
                    
                    <a href='$rootBasePath_http/login'>Clicca qui per accedere allo store</a>. <br><br>
            ";

        include "inc/mail.php";

        include("crm/class/class.phpmailer.php");
        $mittente = "info@cybek.it";
        $nomemittente = "Cybek.it";
        $destinatario = "$ut_email";

        $mail = new PHPMailer;

//intestazioni e corpo dell'email
        $mail->From = $mittente;
        $mail->FromName = $nomemittente;
        $mail->AddAddress($destinatario);
//$mail->AddBCC($rootBaseEmail);
        $mail->Subject = "Conferma registrazione " . $datetime;

        $mail->Body = $messaggio;
        $mail->AltBody = 'Messaggio visibile solo con client di posta compatibili con HTML';

        $mail->SMTPDebug = 1;

        if ($mail->Send()) {
            header("Location:login-do?ut_email=$ut_email&ut_password=$ut_password");
        } else {
            header("Location:registrati?insert=false");
        }

    } else
        //echo "<meta http-equiv='refresh' content='0;url=registrati?insert=false' />";
        header("Location:registrati?insert=false");
}

?>
