<?php
//Windows Server - setting area
setlocale(LC_TIME, 'ita', 'it_IT');

//Linux Server - setting area
//setlocale(LC_TIME, 'it_IT');

//setlocale(LC_TIME, 'it_IT@euro');

//Path location root off-line
//Path location root off-line
$rootBasePath_http = "http://localhost/Tesi";
$rootBasePath_https = "";
$rootBaseEmail = "info@lucasweb.it";
$emailPaypal = "info@lucasweb.it";

//Dati SMTP
$SMTP['host'] = "mail.moncaffe.it";
$SMTP['user'] = "noreply@moncaffe.it";
$SMTP['pass'] = "Vin@7888!";
//$SMTP['pass'] = "Befe@7986@";


//Path location root on-line
$root_path = "http://localhost/Tesi";
$root_base_path = "http://localhost/Tesi";
$root_site_path = "http://localhost/Tesi";
$root_base_email = "info@lucasweb.it";
$title_admin_header = "Cybek.it / Software CRM";

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

$upload_path_dir_marche = "../../upload/marche";
$upload_view_dir_marche = "../../upload/marche";

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

?>
