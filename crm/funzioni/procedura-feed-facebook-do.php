<?php include "../inc/db-conn.php"; ?>
<?php include "../../bin/url-rewrite.php"; ?>
<?php include "../../bin/function.php"; ?>
<?php
    // #### Tracciato di esempio con documentazione ####
    // #### https://www.facebook.com/business/help/120325381656392?id=725943027795860 ####
    
    /*
    id,
    title,
    description,
    availability,
    condition,
    price,
    link,
    image_link,
    brand,
    google_product_category,
    fb_product_category,
    quantity_to_sell_on_facebook,
    sale_price,
    sale_price_effective_date,
    item_group_id,
    gender,
    color,
    size,
    age_group,
    material,
    pattern,
    shipping,
    shipping_weight,
    style[0]
    
    0,
    Blue Facebook T-Shirt (Unisex),
    A vibrant blue crewneck T-shirt for all shapes and sizes. Made from 100% cotton.,
    in stock,
    new,
    "10,00 USD",
    https://www.facebook.com/facebook_t_shirt,
    https://www.facebook.com/t_shirt_image_001.jpg,
    Facebook,
    Apparel & Accessories > Clothing,
    Clothing & Accessories > Clothing,
    75,
    "10,00 USD",
    ,
    ,
    unisex,
    royal blue,
    M,
    adult,
    cotton,
    stripes,
    ,
    10 kg,
    Bodycon
    */

    unlink("../../ftp/feed-facebook-shopping.csv");

    //  #### Campi del tracciato di Facebook Shopping ####
    //  id
    //  title
    //  description
    //  availability
    //  condition
    //  price
    //  link
    //  image_link
    //  brand
    
    //  quantity_to_sell_on_facebook
    //  fb_product_category
    //  google_product_category

    //  sale_price
    //  sale_price_effective_date
    //  item_group_id
    //  visibility
    //  additional_image_link
    //  color
    //  gender
    //  size
    //  age_group
    //  material
    //  pattern
    //  shipping
    //  shipping_weight
    //  custom_label_0
    //  custom_label_1
    //  custom_label_2
    //  custom_label_3
    //  custom_label_4

    $feed_facebook = fopen("../../ftp/feed-facebook-shopping.csv","a");
    $feed_header = "";
    $feed_header .= "id , ";
    $feed_header .= "title , ";
    $feed_header .= "description , ";
    $feed_header .= "availability , ";
    $feed_header .= "condition , ";
    $feed_header .= "price , ";
    $feed_header .= "link , ";
    $feed_header .= "image_link , ";
    $feed_header .= "brand , ";
    $feed_header .= "quantity_to_sell_on_facebook , ";
    $feed_header .= "fb_product_category , ";
    $feed_header .= "google_product_category , ";
    $feed_header .= "sale_price , ";
    $feed_header .= "item_group_id ";
    $feed_header .= "\r\n";

    fwrite($feed_facebook, $feed_header);
    //fputcsv($feed_facebook, $top, "," );

    $querySql = "SELECT * FROM pr_prodotti
                     INNER JOIN mr_marchi ON mr_id = pr_mr_id
                     INNER JOIN ct_categorie ON ct_id = pr_ct_id
                     WHERE pr_stato > 0 AND pr_giacenza > 0 
                     ORDER BY pr_timestamp";
    $result = $dbConn->query($querySql);
    
    while ($row_data = $result->fetch_array()) {
    
        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $ct_categoria = $row_data['ct_categoria'];
        $pr_descrizione_linea = $row_data['pr_descrizione_linea'];
        $pr_descrizione_merceologia = $row_data['pr_descrizione_merceologia'];
        $pr_esistenza = $row_data['pr_esistenza'];
        $pr_titolo = $row_data['pr_titolo'];
        $pr_descrizione = $row_data['pr_descrizione'];
        $pr_immagine = $row_data['pr_immagine'];
        $pr_prezzo = $row_data['pr_prezzo'];
        $pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];
        $pr_codice_ean = $row_data['pr_codice_ean'];
        $mr_marchio = $row_data['mr_marchio'];
        $pr_capofila = $row_data['pr_capofila'];
        $pr_codice_iva = $row_data['pr_codice_iva'];
    
        $rewrite_link = generateProductLink($pr_id);
        $pr_url = "https://www.moncaffe.it".$rewrite_link;
        $pr_immagine_url = "https://www.moncaffe.it/upload/prodotti/".$pr_immagine;
    
        //Alimentazione dei campi e variabili per il record del Feed Facebook Shopping
        $id = $pr_id;
        $title = ucfirst(strtolower($pr_titolo));
        $description = ucfirst(strtolower($pr_descrizione));
        $availability = 'in stock';
        $condition = 'new';
        $price = $pr_prezzo." EUR";
        $link = $pr_url;
        $image_link = $pr_immagine_url;
        $brand = $mr_marchio;
        $quantity_to_sell_on_facebook = '5';
        $fb_product_category = $ct_categoria;
        $google_product_category = $ct_categoria;
        $sale_price = $pr_prezzo_scontato." EUR";
        $sale_price_effective_date = '';
        $item_group_id = $pr_capofila;
        $visibility = '';
        $additional_image_link = '';
        $color = '';
        $gender = '';
        $size = '';
        $age_group = '';
        $material = '';
        $pattern = '';
        $shipping = '';
        $shipping_weight = '';
        $custom_label_0 = '';
        $custom_label_1 = '';
        $custom_label_2 = '';
        $custom_label_3 = '';
        $custom_label_4 = '';
        
        //Scrittura del Feed Google Merchant
        $feed_facebook = fopen("../../ftp/feed-facebook-shopping.csv","a");
        $feed_record = "";
        $feed_record .= $id." , ";
        $feed_record .= $title." , ";
        $feed_record .= "\"".$title."\" , ";
        $feed_record .= $availability." , ";
        $feed_record .= $condition." , ";
        $feed_record .= "\"".$price."\", ";
        $feed_record .= $link." , ";
        $feed_record .= $image_link." , ";
        $feed_record .= "\"".$brand."\", ";
        $feed_record .= $quantity_to_sell_on_facebook." , ";
        $feed_record .= "\"".$fb_product_category."\" , ";
        $feed_record .= "\"".$google_product_category."\" , ";
        $feed_record .= "\"".$sale_price."\" , ";
        //$feed_record .= $sale_price_effective_date." , ";
        $feed_record .= $item_group_id." ";
        //$feed_record .= $visibility." , ";
        //$feed_record .= $additional_image_link." , ";
        //$feed_record .= $color." , ";
        //$feed_record .= $gender." , ";
        //$feed_record .= $size." , ";
        //$feed_record .= $age_group." , ";
        //$feed_record .= $material." , ";
        //$feed_record .= $pattern." , ";
        //$feed_record .= $shipping." , ";
        //$feed_record .= $shipping_weight." , ";
        //$feed_record .= $custom_label_0." , ";
        //$feed_record .= $custom_label_1." , ";
        //$feed_record .= $custom_label_2." , ";
        //$feed_record .= $custom_label_3." , ";
        //$feed_record .= $custom_label_4." ";
        $feed_record .= "\r\n";
        
        fwrite($feed_facebook, $feed_record);
        //$feed_facebook = fopen("../../ftp/feed-facebook-shopping.csv","a");
        //fputcsv($feed_facebook, $bottom, ";");
    }

$count = $result->num_rows;
$result->close();
    
    $lf_data = time();
    
    $querySql = "INSERT INTO lf_log_feed(lf_titolo, lf_tipo, lf_data, lf_record) VALUES ('Facebook Shopping', 'facebook', '$lf_data', '$count')";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    
    $insert = $rows > 0 ? 'true' : 'false';
    
    header("Location: ../admin/strumenti-feed-gst.php?update=$insert");
?>