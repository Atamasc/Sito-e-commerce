<?php include "../inc/db-conn.php"; ?>
<?php include "../../bin/url-rewrite.php"; ?>
<?php include "../../bin/function.php"; ?>
<?php
// #### Tracciato di esempio con documentazione ####
// #### https://support.google.com/merchants/answer/7052112?hl=it&ref_topic=6324338 ####

unlink("../../ftp/feed-google-shopping.txt");

//  #### Campi del tracciato di Google Merchant ####
//  id
//  title
//  description
//  google product category
//  product type
//  link
//  image link
//  condition
//  availability
//  price
//  sale price
//  sale price effective date
//  gtin
//  brand
//  mpn
//  item group id
//  gender
//  age group
//  color
//  size
//  shipping
//  shipping weight
//  tax_category

$feed_google = fopen("../../ftp/feed-google-shopping.txt", "a");
$feed_header = "";
$feed_header .= "id | ";
$feed_header .= "titolo | ";
$feed_header .= "descrizione | ";
//$feed_header .= "google product category | ";
//$feed_header .= "product type | ";
$feed_header .= "link | ";
$feed_header .= "image link | ";
$feed_header .= "condition | ";
$feed_header .= "availability | ";
$feed_header .= "price | ";
$feed_header .= "sale price | ";
//$feed_header .= "sale price effective date | ";
$feed_header .= "gtin | ";
$feed_header .= "brand | ";
$feed_header .= "mpn | ";
$feed_header .= "item group id | ";
//$feed_header .= "gender | ";
//$feed_header .= "age group | ";
//$feed_header .= "color | ";
//$feed_header .= "size | ";
//$feed_header .= "shipping | ";
//$feed_header .= "shipping weight | ";
$feed_header .= "included_destination | ";
$feed_header .= "tax_category ";
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
    $pr_esistenza = $row_data['pr_esistenza'];
    $pr_titolo = $row_data['pr_titolo'];
    $pr_descrizione = $row_data['pr_descrizione'];
    $pr_immagine = $row_data['pr_immagine'];
    $pr_prezzo = $row_data['pr_prezzo'];
    $pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];
    $pr_codice_ean = $row_data['pr_codice_ean'];
    $mr_marche = $row_data['mr_marche'];
    $pr_capofila = $row_data['pr_capofila'];
    $pr_codice_iva = 22;

    $rewrite_link = generateProductLink($pr_id);
    $pr_url = "https://www.moncaffe.it" . $rewrite_link;
    $pr_immagine_url = "https://www.moncaffe.it/upload/prodotti/" . $pr_immagine;

    //Alimentazione dei campi e variabili per il record del Feed Google Merchant
    $id = $pr_codice; //$pr_id;
    $title = ucfirst(strtolower($pr_titolo));
    $description = $pr_descrizione;
    $google_product_category = '';
    $product_type = '';
    $link = $pr_url;
    $image_link = $pr_immagine_url;
    $condition = 'new';
    $availability = 'in stock';
    $price = $pr_prezzo;
    $sale_price = $pr_prezzo_scontato;
    $sale_price_effective_date = '';
    $gtin = $pr_codice_ean;
    $brand = $mr_marche;
    $mpn = $pr_codice;
    $item_group_id = $pr_capofila;
    $gender = '';
    $age_group = '';
    $color = '';
    $size = '';
    $shipping = '';
    $shipping_weight = '';
    $included_destination = 'Shopping ads, Buy on Google listings, Display ads, Free listings';
    $tax_category = $pr_codice_iva;

    //Scrittura del Feed Google Merchant
    $feed_google = fopen("../../ftp/feed-google-shopping.txt", "a");
    $feed_record = "";
    $feed_record .= $id . " | ";
    $feed_record .= $title . " | ";
    $feed_record .= $description . " | ";
    //$feed_record .= $google_product_category."|";
    //$feed_record .= $product_type."|";
    $feed_record .= $link . " | ";
    $feed_record .= $image_link . " | ";
    $feed_record .= $condition . " | ";
    $feed_record .= $availability . " | ";
    $feed_record .= $price . " | ";
    $feed_record .= $sale_price . " | ";
    //$feed_record .= $sale_price_effective_date."|";
    $feed_record .= $gtin . " | ";
    $feed_record .= $brand . " | ";
    $feed_record .= $mpn . " | ";
    $feed_record .= $item_group_id . " | ";
    //$feed_record .= $gender."|";
    //$feed_record .= $age_group."|";
    //$feed_record .= $color."|";
    //$feed_record .= $size."|";
    //$feed_record .= $shipping."|";
    //$feed_record .= $shipping_weight."|";
    $feed_record .= $included_destination . " | ";
    $feed_record .= $tax_category . "";
    $feed_record .= "\r\n";

    fwrite($feed_google, $feed_record);
}

$count = $result->num_rows;
$result->close();

$lf_data = time();

$querySql = "INSERT INTO lf_log_feed(lf_titolo, lf_tipo, lf_data, lf_record) VALUES ('Google Shopping', 'google', '$lf_data', '$count')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$insert = $rows > 0 ? 'true' : 'false';

header("Location: ../admin/strumenti-feed-gst.php?update=$insert");
?>