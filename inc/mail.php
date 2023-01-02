<?php include_once "autoloader.php"; ?>
<?php
if (isset($ne_email) && strlen($ne_email) > 0) $mail_email = "$rootBasePath_http/unscribe/" . base64_encode($ne_email);
else if (isset($cl_email) && strlen($cl_email) > 0) $mail_email = "$rootBasePath_http/unscribe/" . base64_encode($cl_email);
else $mail_email = "mailto:info@cybek.it?subject=Non%20voglio%20piu%20ricevere%20aggiornamenti";

$messaggio =
    "
    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Cybek</title>
    <style type='text/css'>

        body {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin:0 !important;
            width: 100% !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            -webkit-font-smoothing: antialiased !important;
        }
        .tableContent img {
            border: 0 !important;
            display: inline-block !important;
            outline: none !important;
        }

        p, h1,h2,h3,ul,ol,li,div{
            margin:0;
            padding:0;
        }
        h1,h2{
            font-weight: normal;
            background:transparent !important;
            border:none !important;
        }

        td,table{
            vertical-align: top;
        }
        td.middle{
            vertical-align: middle;
        }

        a{
            text-decoration: none;
        }

        a.link1{
            font-size: 16px;
            color: #a5a5a5;
        }

        a.link2{
            font-size: 18px;
            font-weight: bold;
            color: #000000;
            text-decoration: underline;
        }

        a.link3{
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
            background-color: #253237;
            padding: 11px 15px!important;
            text-decoration: none;
            border-radius:5px;
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            text-align: center;
            display:inline-block;
            line-height:37px!important;
            border: 10px #253237 solid;
        }

        a.link4{
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
            background-color: #253237;
            padding: 11px 15px!important;
            text-decoration: none;
            border-radius:5px;
            -moz-border-radius:5px;
            -webkit-border-radius:5px;
            text-align: center;
            display:inline-block;
            line-height:37px!important;
            border: 10px #253237 solid;
        }

        .contentEditable li{

        }

        h1{
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            line-height: 150%;
        }


        h2{
            font-family:font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            font-weight: 500;
            color: #000000;
            line-height: 110%;
            height:60px;
        }

        p{
            font-size: 14px;
            color: #000000;
            line-height: 150%;
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
        }

        .bgItem{
            background: #ffffff;
        }

        .bgBody{
            background: #efefef;
        }

        #bettone{
            background-color: #005294!important;
            color:#ffffff!important;
            padding:5px 10px!important;
        }

        #bettino{
            background-color: #253237!important;
            color:#ffffff!important;
            padding:5px 10px!important;
        }
        
        table.carrello{
            border-collapse: collapse;
            font-size:12px;
        }
        
        table.carrello thead tr td{
            font-weight:bold;
            color:#fff;
            background-color: #253237;
        }
        
        table.carrello tr td{
            border: 1px #ccc solid;
            padding:10px;
        }
        
        table.carrello tfoot tr td{
            border: none;
            font-weight:bold;
            padding: 3px 10px;
        }
        
        table.carrello tfoot tr:first-child td{
            padding-top:20px;
        }
	
    </style>

    <script type='colorScheme' class='swatch active'>
{
    'name':'Default',
    'bgBody':'3f4040',
    'link':'555555',
    'color':'000000',
    'bgItem':'ffffff',
    'title':'000000'
}
</script>

</head>
<body paddingwidth='0' paddingheight='0' class='bgBody' style='padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>

<!-- Visually Hidden Preheader Text : BEGIN -->
<div style='display:none;font - size:1px;line - height:1px;max - height:0px;max - width:0px;opacity:0;overflow:hidden;mso - hide:all;font - family: sans - serif;'>
Benvenuto su Cybek.it
</div>
<!-- Visually Hidden Preheader Text : END -->


<table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, sans-serif;'>


    <tr>
        <td align='center' class='movableContentContainer'>
            <!-- =============== START HEADER =============== -->
            <div class='movableContent'>
                <table width='600' border='0' cellspacing='0' cellpadding='0' align='center'>
                    <tr><td height='20'></td></tr> 
                    <tr>
                        <td width='400' align='left'>
                            <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable'>
                                    <img src='$rootBasePath_http/assets/images/logo/logo.jpg' alt='Logo' width='300' height='60' data-default='placeholder' data-max-width='326' data-max-height='60'>
                                </div>
                            </div>
                        </td>
                        <td width='20'></td>
                        <td width='180' align='right' valign='bottom' style='vertical-align: bottom;'>
                            <div class='contentEditableContainer contentTextEditable'>
                                <div class='contentEditable'>

                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>



            <!-- =============== END HEADER =============== -->
            <!-- =============== START BODY =============== -->
            <div class='movableContent'>
                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                    <tr><td height='0'></td></tr>
                    <tr>
                        <td>
                            <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='bgItem' style='border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;'>
                                <tr><td colspan='5' height='30'></td></tr>
                                <tr>
                                    <td width='20'>&nbsp;</td>

                                    <td width='530'>
                                        <div class='contentEditableContainer contentTextEditable'>
                                            <div class='contentEditable'>
                                                <h2 style='line-height:28px;'>$email_titolo</h2>
                                                <br/>
                                                <p>$email_testo</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td width='20'>&nbsp;</td>
                                </tr>
                                <tr><td colspan='5' height='30'></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- =============== END BODY =============== -->
            <!-- =============== START FOOTER =============== -->

            <div class='movableContent'>
                <table width='600' border='0' cellspacing='0' cellpadding='0'><tr><td height='0'></td></tr></table>
                <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='bgItem'>
                    <tr><td height='10' bgcolor='253237'></td></tr>
                    <tr>
                        <td>
                            <table  width='600' border='0' cellspacing='0' cellpadding='0' align='center' >
                                <tr><td height='30'></td></tr>
                                <tr>
                                    <td align='center'>
                                        <table width='204' border='0' cellspacing='0' cellpadding='0' align='center'>
                                            <tr>
                                                <td width='102' align='center'>
                                                    <div class='contentEditableContainer contentFacebookEditable'>
                                                        <div class='contentEditable'>
                                                            <a href='https://www.facebook.com/cybek.it' target='_blank'><img src='$rootBasePath_http/assets/images/facebook.png' alt='Facebook' data-default='placeholder' width='50' height='50'  data-max-width='50' data-customIcon='true' ></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width='102' align='center'>
                                                    <div class='contentEditableContainer contentTwitterEditable'>
                                                        <div class='contentEditable'>
                                                            <a href='https://www.instagram.com/cybek.it/' target='_blank'><img src='$rootBasePath_http/assets/images/instagram.png' alt='Instagram' data-default='placeholder' width='50' height='50' data-max-width='50' data-customIcon='true' ></a>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div class='movableContent'>
                <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='bgItem'>
                    <tr>
                        <td>
                            <table  width='600' border='0' cellspacing='0' cellpadding='0' align='center' >
                                <tr><td height='20'></td></tr>
                                <tr>
                                    <td align='center'>
                                        <div class='contentEditableContainer contentTextEditable'>
                                            <div class='contentEditable' >
                                                 <p style=\"color:#a5a5a5;text-align:center; font-size:11px; line-height:19px; margin:0 30px; padding: 0 10px;\">

                                                    Per qualunque dubbio, necessit&aacute; o richiesta, non esitare a contattarci. <br> Riceverai una risposta nel minor tempo possibile.
                                                    <br>
                                                    <img src='$rootBasePath_http/assets/images/logo/logo.jpg' alt='Logo' width='300' height='60' data-default='placeholder' data-max-width='326' data-max-height='60' style='margin: 30px 0px;'>
                                                    <br>
                                                    <!--Indirizzo : Via S. Francesco D'Assisi, 5 - 80034 Marigliano (NA)<br>-->
                                                    Email : <a href='mailto:info@cybek.it'>info@cybek.it</a>
                                                </p>
                                                    <hr>
                                                <p style=\"color:#a5a5a5;text-align:center; font-size:11px; line-height:19px; margin:0 30px; padding: 0 10px;\">

                                                <a target='_blank' href='$mail_email' style='color:#a5a5a5;'>Non voglio pi&ugrave; ricevere mail </a>
                                                    <br>
                                                    <br>
                                                    Le informazioni contenute nella presente comunicazione e i relativi allegati possono essere riservate e sono, comunque, destinate esclusivamente alle persone o alla Societ&agrave; sopraindicati. La diffusione, distribuzione e/o copia del documento trasmesso da parte di qualsiasi soggetto diverso dal destinatario &egrave; proibita, ai sensi del GDPR - Regolamento (UE) 2016/679 DEL PARLAMENTO EUROPEO E DEL CONSIGLIO del 27 aprile 2016 . Se avete ricevuto questo messaggio per errore, vi preghiamo di distruggerlo e di informarci immediatamente per telefono ai recapiti indicati nella firma o inviando un messaggio all'indirizzo del mittente.
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td height='20'></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- =============== END FOOTER =============== -->

        </td>
    </tr>
</table>


</body>
</html>
    ";

?>