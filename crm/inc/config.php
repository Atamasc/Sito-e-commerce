<?php
//Windows Server - setting area
setlocale(LC_TIME, 'ita', 'it_IT');

//Linux Server - setting area
//setlocale(LC_TIME, 'it_IT');

//setlocale(LC_TIME, 'it_IT@euro');

//Path location root off-line
$rootBasePath_http = "https://sd01lucasweb.it/moncaffe.it";
$rootBasePath_https = "";
$rootBaseEmail = "claudio.iovino@lucasweb.it";
$emailPaypal = "info@lucasweb.it";

//Dati SMTP
$SMTP['host'] = "mail.moncaffe.it";
$SMTP['user'] = "noreply@moncaffe.it";
$SMTP['pass'] = "Vin@7888!";

//Path location root on-line
$root_path = "https://sd01lucasweb.it/moncaffe.it";
$root_base_path = "https://sd01lucasweb.it/moncaffe.it";
$root_site_path = "https://sd01lucasweb.it/moncaffe.it";
$root_base_email = "info@lucasweb.it";

$title_admin_header = "MonCaffè.it / Software CRM";

//Location path di upload file cartella generica
$upload_path_dir = "../upload";
$upload_view_dir = "../upload";

//Location path di upload file cartella promozioni
$upload_path_dir_newsletter = "../../upload/newsletter";
$upload_view_dir_newsletter = "../../upload/newsletter";

$upload_path_dir_categorie = "../../upload/categorie";
$upload_view_dir_categorie = "../../upload/categorie";

$upload_path_dir_blog_categorie = "../../upload/blog_categorie";
$upload_view_dir_blog_categorie = "../../upload/blog_categorie";

$upload_path_dir_sottocategorie = "../../upload/sottocategorie";
$upload_view_dir_sottocategorie = "../../upload/sottocategorie";

$upload_path_dir_prodotti = "../../upload/prodotti";
$upload_view_dir_prodotti = "../../upload/prodotti";

$upload_path_dir_prodotti_img = "../../upload/prodotti-immagini";
$upload_view_dir_prodotti_img = "../../upload/prodotti-immagini";

$upload_path_dir_varianti_img = "../../upload/varianti-immagini";
$upload_view_dir_varianti_img = "../../upload/varianti-immagini";

$upload_path_dir_marchi = "../../upload/marchi";
$upload_view_dir_marchi = "../../upload/marchi";

$upload_path_dir_sistemi = "../../upload/sistemi";
$upload_view_dir_sistemi = "../../upload/sistemi";

$upload_path_dir_linee = "../../upload/linee";
$upload_view_dir_linee = "../../upload/linee";

$upload_path_dir_slide = "../../upload/slide";
$upload_view_dir_slide = "../../upload/slide";

$upload_path_dir_box = "../../upload/box";
$upload_view_dir_box = "../../upload/box";

$upload_path_dir_blog = "../../upload/blog";
$upload_view_dir_blog = "../../upload/blog";

$upload_path_dir_allegati = "../../upload/allegati";
$upload_view_dir_allegati = "../../upload/allegati";

/*
$footer_mail = "
<tr>
    <td class='little' align='center'>
    Le email sono raccolte e inviate in base a quanto stabilito nel Decreto Legislativo n°196 del 30 giugno 2003.<br> 
    Se non desideri più ricevere comunicazioni via email da lucasweb.it puoi inoltrare questo messaggio a info@lucasweb.it dalla mail che desideri rimuovere con scritto nell'oggetto o nel corpo 'rimozione email newsletter' o cliccare sul link in basso.<br>
    </td>
</tr>
</tr>
    <td align='center'>
    <a href='$rootBasePath_http/crm/newsletter-conferma-del-email.php?ne_id=$ne_id&ne_email=$ne_email'>Cancellami dalla newsletter</a>
    </td>
</tr>

</tr>
    <td align='center'>
    QUESTA EMAIL TI ARRIVA NELLO SPAM ?<br>
    Se la mail ti finisce nella cartella \"spam\" del tuo provider per errore, ti chiediamo la gentilezza di spostarla nella \"posta in arrivo\", in questo modo ci aiuterai a migliorare l'invio ed eviterai di perdere notizie utili.<br>
    </td>
</tr>

<tr>
    <td align='center' class='copyright'>
        Email inviata con il servizio <br>NUVOLAMAIL.IT
    </td>
</tr>
";*/
?>
