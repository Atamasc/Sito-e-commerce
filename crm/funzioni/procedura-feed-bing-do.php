<?php include "../inc/db-conn.php"; ?>
<?php include "../../bin/url-rewrite.php"; ?>
<?php include "../../bin/function.php"; ?>
<?php
// #### Tracciato di esempio con documentazione ####
// #### https://www.facebook.com/business/help/120325381656392?id=725943027795860 ####

/*
id
title
brand
link
price
description
image_link
mpn
gtin
availability
condition
product_type
product_category
bingads_grouping
bingads_label
custom_label_0
custom_label_1
custom_label_2
custom_label_3
custom_label_4
bingads_redirect
sale_price
sale_price_effective_date

1064
Cuisinart Chef's 7-Piece Cookware Set
Cuisinart
http://merchant.com/product1.html
19.99
Premium cookware with classic style but modern technology
http://images.merchant.com/image.gif
9945
12345600012
In Stock
New
Home | Kitchen	Home & Garden > Kitchen & Dining > Kitchen Tools & Utensils > Kitchen Utensil Sets
cookware
"premium,cookware,set"
premium	cooking	set
black
cookware
http://r.merchant.com/1/
17.99
2014-11-05T08:15-05:00/2014-11-10T09:30-05:00
*/

unlink("../../ftp/feed-bing-shopping.txt");

//  #### Campi del tracciato di Bing Merchant ####
//  id
//  title
//  brand
//  link
//  price
//  description
//  image_link
//  mpn
//  gtin
//  availability
//  condition
//  product_type
//  product_category
//  bingads_grouping
//  bingads_label
//  custom_label_0
//  custom_label_1
//  custom_label_2
//  custom_label_3
//  custom_label_4
//  bingads_redirect
//  sale_price
//  sale_price_effective_date

$feed_google = fopen("../../ftp/feed-bing-shopping.txt", "a");
$feed_header = "";
$feed_header .= "id \t ";
$feed_header .= "title \t ";
$feed_header .= "brand \t ";
$feed_header .= "link \t ";
$feed_header .= "price \t ";
$feed_header .= "description \t ";
$feed_header .= "image_link \t ";
$feed_header .= "mpn \t ";
$feed_header .= "gtin \t ";
$feed_header .= "availability \t ";
$feed_header .= "condition \t ";
$feed_header .= "product_type \t ";
$feed_header .= "product_category ";
//$feed_header .= "bingads_grouping \t ";
//$feed_header .= "bingads_label \t ";
//$feed_header .= "custom_label_0 \t ";
//$feed_header .= "custom_label_1 \t ";
//$feed_header .= "custom_label_2 \t ";
//$feed_header .= "custom_label_3 \t ";
//$feed_header .= "custom_label_4 \t ";
//$feed_header .= "bingads_redirect \t ";
//$feed_header .= "sale_price \t ";
//$feed_header .= "sale_price_effective_date ";
$feed_header .= "\r\n";

fwrite($feed_google, $feed_header);

$querySql = "SELECT * FROM pr_prodotti
                     INNER JOIN mr_marche ON mr_id = pr_mr_id
                     INNER JOIN ct_categorie ON ct_id = pr_ct_id
                     WHERE pr_stato > 0 AND pr_giacenza > 0 
                     ORDER BY pr_timestamp";
$result = $dbConn->query($querySql);

while ($row_data = $result->fetch_array()) {

    $pr_id = $row_data['pr_id'];
    $pr_codice = $row_data['pr_codice'];
    $pr_fm_descrizione = $row_data['pr_fm_descrizione'];
    $pr_descrizione_linea = $row_data['pr_descrizione_linea'];
    $ct_categoria = $row_data['ct_categoria'];
    $pr_esistenza = $row_data['pr_esistenza'];
    $pr_titolo = $row_data['pr_titolo'];
    $pr_descrizione = $row_data['pr_descrizione'];
    $pr_immagine = $row_data['pr_immagine'];
    $pr_prezzo = $row_data['pr_prezzo'];
    $pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];
    $pr_codice_ean = $row_data['pr_codice_ean'];
    $mr_marche = $row_data['mr_marche'];
    $pr_codice_alternativo = $row_data['pr_codice_alternativo'];
    $pr_codice_iva = $row_data['pr_codice_iva'];

    $rewrite_link = generateProductLink($pr_id);
    $pr_url = "https://www.moncaffe.it" . $rewrite_link;
    $pr_immagine_url = "https://www.moncaffe.it/upload/prodotti/" . $pr_immagine;

    //Alimentazione dei campi e variabili per il record del Feed Bing Merchant
    $id = $pr_id;
    $title = $pr_titolo;
    $brand = $mr_marche;
    $link = $pr_url;
    $price = $pr_prezzo;
    $description = $pr_descrizione;
    $image_link = $pr_immagine_url;
    $mpn = $pr_codice;
    $gtin = $pr_codice_ean;
    $availability = 'in stock';
    $condition = 'new';
    $product_type = $ct_categoria;
    $product_category = $ct_categoria;
    $bingads_grouping = '';
    $bingads_label = '';
    $custom_label_0 = '';
    $custom_label_1 = '';
    $custom_label_2 = '';
    $custom_label_3 = '';
    $custom_label_4 = '';
    $bingads_redirect = $pr_url;
    $sale_price = $pr_prezzo_scontato;
    $sale_price_effective_date = '';

    //Scrittura del Feed Bing Merchant
    $feed_google = fopen("../../ftp/feed-bing-shopping.txt", "a");
    $feed_record = "";
    $feed_record .= $id . " \t ";
    $feed_record .= $title . " \t ";
    $feed_record .= $brand . " \t ";
    $feed_record .= $link . " \t ";
    $feed_record .= $sale_price . " \t ";
    $feed_record .= $description . " \t ";
    $feed_record .= $image_link . " \t ";
    $feed_record .= $mpn . " \t ";
    $feed_record .= $gtin . " \t ";
    $feed_record .= $availability . " \t ";
    $feed_record .= $condition . " \t ";
    $feed_record .= $product_type . " \t ";
    $feed_record .= $product_category . " ";
    //$feed_record .= $bingads_grouping." | ";
    //$feed_record .= $bingads_label." | ";
    //$feed_record .= $custom_label_0." | ";
    //$feed_record .= $custom_label_1." | ";
    //$feed_record .= $custom_label_2." | ";
    //$feed_record .= $custom_label_3." | ";
    //$feed_record .= $custom_label_4." | ";
    //$feed_record .= $bingads_redirect." | ";
    //$feed_record .= $sale_price." | ";
    //$feed_record .= $sale_price_effective_date."";
    $feed_record .= "\r\n";

    fwrite($feed_google, $feed_record);
}

$count = $result->num_rows;
$result->close();

$lf_data = time();

$querySql = "INSERT INTO lf_log_feed(lf_titolo, lf_tipo, lf_data, lf_record) VALUES ('Bing Shopping', 'bing', '$lf_data', '$count')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';

header("Location: ../admin/strumenti-feed-gst.php?update=$insert");
?>