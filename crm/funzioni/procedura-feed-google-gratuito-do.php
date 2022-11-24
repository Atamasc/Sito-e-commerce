<?php include "../inc/db-conn.php"; ?>
<?php include "../../bin/url-rewrite.php"; ?>
<?php include "../../bin/function.php"; ?>
<?php
    // #### Tracciato di esempio con documentazione ####
    // #### https://support.google.com/merchants/answer/7052112?hl=it&ref_topic=6324338 ####
    
    unlink("../../ftp/feed-google-shopping-gratuito.txt");

    //  #### Campi del tracciato di Google Merchant ####
    //  id
    //  title
    //  description
    //  link
    //  condition
    //  price
    //  availability
    //  image link
    //  gtin
    //  mpn
    //  brand
    //  google product category

    //  #### ATTRIBUTI AL MOMENTO NON INVIATI AL FEED ####
    //  product type
    //  sale price
    //  item group id
    //  shipping
    //  shipping weight
    //  tax_category

    $feed_google = fopen("../../ftp/feed-google-shopping-gratuito.txt","a");
    $feed_header = "";
    $feed_header .= "id | ";
    $feed_header .= "titolo | ";
    $feed_header .= "descrizione | ";
    $feed_header .= "link | ";
    $feed_header .= "condition | ";
    $feed_header .= "price | ";
    $feed_header .= "availability | ";
    $feed_header .= "image link | ";
    $feed_header .= "gtin | ";
    $feed_header .= "mpn | ";
    $feed_header .= "brand | ";
    $feed_header .= "google product category ";

    //$feed_header .= "product type | ";
    //$feed_header .= "sale price | ";
    //$feed_header .= "sale price effective date | ";
    //$feed_header .= "item group id | ";
    //$feed_header .= "gender | ";
    //$feed_header .= "age group | ";
    //$feed_header .= "color | ";
    //$feed_header .= "size | ";
    //$feed_header .= "shipping | ";
    //$feed_header .= "shipping weight | ";
    //$feed_header .= "included_destination | ";
    //$feed_header .= "tax_category ";
    $feed_header .= "\r\n";
    
    fwrite($feed_google, $feed_header);
    
    $querySql = "SELECT * FROM pr_prodotti
                 INNER JOIN mr_marchi ON mr_codice = pr_codice_marchio
                 WHERE pr_stato > 0 AND pr_esistenza > 0 AND mr_riservato = 0
                 ORDER BY pr_timestamp LIMIT 0,12";
    $result = $dbConn->query($querySql);
    
    while ($row_data = $result->fetch_array()) {
    
        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $pr_esistenza = $row_data['pr_esistenza'];
        $pr_descrizione_breve = $row_data['pr_descrizione_breve'];
        $pr_descrizione_estesa = $row_data['pr_descrizione_estesa'];
        $pr_immagine = $row_data['pr_immagine'];
        $pr_prezzo = $row_data['pr_prezzo'];
        $pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];
        $pr_codice_ean = $row_data['pr_codice_ean'];
        $pr_descrizione_marchio = $row_data['pr_descrizione_marchio'];
        $pr_codice_alternativo = $row_data['pr_codice_alternativo'];
        $pr_codice_iva = $row_data['pr_codice_iva'];
        
        $rewrite_link = generateProductLink($pr_id);
        $pr_url = "https://www.pepinoshop.com".$rewrite_link;
        $pr_immagine_url = "https://www.pepinoshop.com/ftp/immagini/".$pr_immagine;
        
        //Alimentazione dei campi e variabili per il record del Feed Google Merchant
        $id = $pr_codice; //$pr_id;
        $title = $pr_descrizione_breve;
        $description = $pr_descrizione_estesa;
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
        $brand = $pr_descrizione_marchio;
        $mpn = $pr_codice;
        $item_group_id = $pr_codice_alternativo;
        $gender = '';
        $age_group = '';
        $color = '';
        $size = '';
        $shipping = '';
        $shipping_weight = '';
        $included_destination = 'Free listings';
        $tax_category = $pr_codice_iva;
        
        //Scrittura del Feed Google Merchant
        $feed_google = fopen("../../ftp/feed-google-shopping-gratuito.txt","a");
        $feed_record = "";
        $feed_record .= $id." | ";
        $feed_record .= $title." | ";
        $feed_record .= $description." | ";
        $feed_record .= $link." | ";
        $feed_record .= $condition." | ";
        $feed_record .= $price." EUR | ";
        $feed_record .= $availability." | ";
        $feed_record .= $image_link." | ";
        $feed_record .= $gtin." | ";
        $feed_record .= $mpn." | ";
        $feed_record .= $brand." | ";
        $feed_record .= $google_product_category." ";
        
        //$feed_record .= $product_type."|";
        //$feed_record .= $sale_price." | ";
        //$feed_record .= $sale_price_effective_date."|";
        //$feed_record .= $item_group_id." | ";
        //$feed_record .= $gender."|";
        //$feed_record .= $age_group."|";
        //$feed_record .= $color."|";
        //$feed_record .= $size."|";
        //$feed_record .= $shipping."|";
        //$feed_record .= $shipping_weight."|";
        //$feed_record .= $included_destination." | ";
        //$feed_record .= $tax_category."";
        $feed_record .= "\r\n";
        
        fwrite($feed_google, $feed_record);
    }

$count = $result->num_rows;
$result->close();
    
    $lf_data = time();
    
    $querySql = "INSERT INTO lf_log_feed(lf_titolo, lf_tipo, lf_data, lf_record) VALUES ('Google Schede Gratuite', 'google-free', '$lf_data', '$count')";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    
    $insert = $rows > 0 ? 'true' : 'false';
    
    header("Location: ../admin/strumenti-feed-gst.php?update=$insert");
?>