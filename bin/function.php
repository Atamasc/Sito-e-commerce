<?php
function generateStripeFastOrder($or_codice, $or_totale, $or_rapido = 0)
{

    global $rootBasePath_http;

    include_once "bin/stripe/init.php";

    $or_totale = number_format($or_totale, 2, "", "");

    /* Chiave test
    sk_test_jAPtJgrgTG9mdERx6bikG9Pc

    Chiave produzione
    sk_live_BA6FpEfgpr3eR3x64Fgf0ztd
    */

    $stripe = new \Stripe\StripeClient(
        'sk_live_BA6FpEfgpr3eR3x64Fgf0ztd'
    );

    $json = $stripe->prices->create([
        'unit_amount' => $or_totale,
        'currency' => 'eur',
        //'recurring' => ['interval' => 'month'],
        //'product' => 'prod_LKbucOvjCYydtc',
        'product_data' => [
            'name' => "Ordine #$or_codice",
        ]
    ]);

    $price_id = $json->id;

    $json = $stripe->paymentLinks->create([
        'line_items' => [
            [
                'price' => "$price_id",
                'quantity' => 1,
            ],
        ],
        'after_completion' => [
            'type' => 'redirect',
            'redirect' => [
                'url' => "$rootBasePath_http/confirmStripe.php?or_codice=$or_codice&rapido=$or_rapido"
            ],
        ],

    ]);

    return $json->url;

}

function get_mr_marche($mr_codice)
{

    global $dbConn;

    $querySql = "SELECT mr_marche FROM mr_marche WHERE mr_codice = '" . $mr_codice . "'";
    $result = $dbConn->query($querySql);
    $mr_marche = $result->fetch_array()[0];
    $result->close();

    return $mr_marche;

}

function getImg2Prodotto($pr_id)
{

    global $dbConn;

    $querySql = "SELECT pi_immagine FROM pi_prodotti_immagini WHERE pi_pr_id = '$pr_id' LIMIT 0, 1";
    $result = $dbConn->query($querySql);
    $pi_immagine = $result->fetch_array()[0];
    $result->close();

    return strlen($pi_immagine) > 0 && is_file("upload/prodotti-immagini/$pi_immagine")
        ? "upload/prodotti-immagini/$pi_immagine"
        : "assets/images/prodotto-dummy.jpg";
}

function getCategoria($ct_id, $dbConn)
{

    $querySql = "SELECT ct_categoria FROM ct_categorie WHERE ct_id = '$ct_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['ct_categoria'];

}

function getSottocategoria($st_id, $dbConn)
{

    $querySql = "SELECT st_sottocategoria FROM st_sottocategorie WHERE st_id = '$st_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['st_sottocategoria'];

}

function getCatBySot($st_id, $dbConn)
{

    $querySql = "SELECT st_ct_id FROM st_sottocategorie WHERE st_id = '$st_id' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $result->close();

    $ct_id = $row_data['st_ct_id'];

    $querySql = "SELECT ct_categoria FROM ct_categorie WHERE ct_id = '$ct_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['ct_categoria'];

}

function countVarianti($pr_codice_alternativo)
{

    global $dbConn;

    $querySql =
        "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_stato > 0 AND pr_codice_alternativo = '$pr_codice_alternativo' " .
        "AND LENGTH(pr_immagine_mini) > 0 ORDER BY pr_id";
    $result = $dbConn->query($querySql);
    $count = $result->fetch_array()[0];
    $result->close();

    $querySql =
        "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_stato > 0 AND pr_codice_alternativo = '$pr_codice_alternativo' " .
        "AND LENGTH(pr_formato) > 0 ORDER BY pr_formato";
    $result = $dbConn->query($querySql);
    $count = $count + $result->fetch_array()[0];
    $result->close();

    return $count;

}

function countVariantiColore($pr_codice_alternativo)
{

    global $dbConn;

    $querySql =
        "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_stato > 0 AND pr_codice_alternativo = '$pr_codice_alternativo' " .
        "AND LENGTH(pr_immagine_mini) > 0 ORDER BY pr_id";
    $result = $dbConn->query($querySql);
    $count = $result->fetch_array()[0];
    $result->close();

    return $count;

}

function selectCategorie($get_ct_id)
{

    global $dbConn;
    $querySql = "SELECT * FROM ct_categorie ";
    $result = $dbConn->query($querySql);

    while ($row_data = $result->fetch_assoc()) {

        $ct_id = $row_data['ct_id'];
        $ct_categoria = $row_data['ct_categoria'];
        $stato = $get_ct_id == $ct_id ? "selected" : "";

        echo "<option value='$ct_id' $stato>$ct_categoria</option>";

    }

    $result->close();

}

function selectClientiCategorie($get_ct_id)
{

    global $dbConn;
    $querySql = "SELECT * FROM ct_categoria ";
    $result = $dbConn->query($querySql);

    while ($row_data = $result->fetch_assoc()) {

        $ct_id = $row_data['ct_id'];
        $ct_titolo = $row_data['ct_titolo'];
        $stato = $get_ct_id == $ct_id ? "selected" : "";

        echo "<option value='$ct_id' $stato>$ct_titolo</option>";

    }

    $result->close();

}

function get_access_credential($param_username, $param_password, $dbConn)
{

    $querySql_amministratore = "SELECT * FROM am_amministratore WHERE am_username = '$param_username' AND am_password = '$param_password'";
    $result_amministratore = $dbConn->query($querySql_amministratore);
    $rows_amministratore = $dbConn->affected_rows;

    while (($rows_amministratore = $result_amministratore->fetch_assoc()) !== NULL) {
        $username = $rows_amministratore['am_username'];
        $password = $rows_amministratore['am_password'];

        $credenziali = "administrator|" . $username . "|" . $password;

    };

    $result_amministratore->close();

    $checkCredential = $credenziali;
    return $checkCredential;
}

;

function get_access_credential_op($param_username, $param_password, $dbConn)
{

    $querySql = "SELECT * FROM op_operatori WHERE op_codice = '$param_username' AND op_password = '$param_password'";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $username = $rows['op_codice'];
        $password = $rows['op_password'];

        $credenziali = "operatore|" . $username . "|" . $password;

    };

    $result->close();

    $checkCredential = $credenziali;
    return $checkCredential;

}

function get_access_credential_cl($param_username, $param_password, $dbConn)
{

    $querySql = "SELECT * FROM cl_clienti WHERE cl_email = '$param_username' AND cl_password = '$param_password'";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $username = $rows['cl_email'];
        $password = $rows['cl_password'];

        $credenziali = "cliente|" . $username . "|" . $password;

    };

    $result->close();

    $checkCredential = $credenziali;
    return $checkCredential;

}

function selectProvince($cm_province_param, $cm_regioni_param, $dbConn)
{

    $querySql = "SELECT DISTINCT(cm_provincia) FROM cm_comuni WHERE cm_id > 0 ";
    if (strlen($cm_regioni_param) > 0) $querySql .= " AND cm_regione = '$cm_regioni_param' ";
    $querySql .= " ORDER BY cm_provincia ";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $cm_provincia = $rows['cm_provincia'];
        $status = ($cm_province_param == $cm_provincia) ? "selected" : "";
        echo "<option value='$cm_provincia' $status>$cm_provincia</option>";

    };

}

function selectComuni($cm_comune_param, $cm_provincia_param, $dbConn)
{

    $querySql = "SELECT DISTINCT(cm_comune) FROM cm_comuni WHERE cm_id > 0 ";
    if (strlen($cm_provincia_param) > 0) $querySql .= " AND cm_provincia = '$cm_provincia_param' ";
    $querySql .= " ORDER BY cm_comune ";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $cm_comune = $rows['cm_comune'];
        $status = ($cm_comune_param == $cm_comune) ? "selected" : "";
        echo "<option value='" . stripslashes($cm_comune) . "' $status>$cm_comune</option>";

    };

}

function countEmailLista($ns_id, $dbConn)
{

    $querySql = "SELECT COUNT(ne_id) AS count_email FROM ne_newsletter_email WHERE ne_ns_id = '$ns_id' AND ne_id > 0";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $result->close();

    return $row_data['count_email'];

}

function countListe(mysqli $dbConn)
{

    $querySql = "SELECT COUNT(ns_id) AS ns_count FROM ns_newsletter_liste ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $result->close();

    return $row_data['ns_count'];

}

function countInviiNewsletter(mysqli $dbConn)
{

    $querySql = "SELECT COUNT(no_id) FROM no_newsletter_log GROUP BY no_timestamp ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function countPostBlog(mysqli $dbConn)
{

    $querySql = "SELECT COUNT(bl_id) FROM bl_blog ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function countClienti(mysqli $dbConn)
{

    $querySql = "SELECT COUNT(cl_id) FROM cl_clienti ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function countAttivita()
{

    global $dbConn;

    $querySql = "SELECT COUNT(at_id) FROM at_attivita WHERE at_stato > 0 ";
    $result = $dbConn->query($querySql);
    $row = $result->fetch_row();
    $result->close();

    return $row[0];

}

function countOrdini()
{

    global $dbConn;

    $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini WHERE or_stato = 1 ";
    $result = $dbConn->query($querySql);
    $row = $result->fetch_row();
    $result->close();

    return $row[0];

}

function countOrdiniEvasiOggi($op_id)
{

    global $dbConn;

    $start = strtotime("today", time());
    $end = strtotime("tomorrow", $start) - 1;

    $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini WHERE or_stato = 1 AND or_op_id = '$op_id' AND or_timestamp >= '$start' AND or_timestamp <= '$end' ";
    $result = $dbConn->query($querySql);
    $row = $result->fetch_row();
    $result->close();

    return $row[0];

}

function countProdotti(mysqli $dbConn)
{
    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];
}

function countRecensioni($pr_codice, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(rc_id) FROM rc_recensioni WHERE rc_pr_codice = '$pr_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getCodRecensioni($pr_capofila)
{

    global $dbConn;

    $querySql =
        "SELECT pr_codice FROM pr_prodotti WHERE pr_capofila = '$pr_capofila' AND pr_id = '$pr_capofila' ";
    $result = $dbConn->query($querySql);
    $pr_codice = $result->fetch_array()[0];
    $result->close();

    return $pr_codice;

}

function getImmagineBlog($bl_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql = "SELECT bl_immagine FROM bl_blog WHERE bl_id = $bl_id ";
    $result = $dbConn->query($querySql);
    $bl_immagine = $result->fetch_array()[0];

    return "$rootBasePath_http/upload/blog/$bl_immagine";

}

function mediaRecensioni($pr_codice, mysqli $dbConn)
{
    $querySqlCount = "SELECT COUNT(rc_id) FROM rc_recensioni WHERE rc_id > 0 AND rc_pr_codice = '$pr_codice' ";
    $result = $dbConn->query($querySqlCount);
    $row = $result->fetch_row();
    $row_cnt = $row[0];

    $media = 0;
    if ($row_cnt > 0) {
        $querySql = "SELECT * FROM rc_recensioni WHERE rc_id > 0 AND rc_pr_codice = '$pr_codice' ";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

        $voto_totale = 0;
        while (($row_data = $result->fetch_assoc()) !== NULL) {
            $rc_voto = $row_data['rc_voto'];
            $voto_totale += $rc_voto;
        }

        $media = $voto_totale / $row_cnt;
    }

    return ceil($media);
}

function existRecensioniCliente($pr_codice, $cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(rc_id) FROM rc_recensioni WHERE rc_pr_codice = '$pr_codice' AND rc_cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getSistema($si_id)
{

    global $dbConn;

    $querySql = "SELECT si_sistema FROM si_sistemi WHERE si_id = '$si_id' LIMIT 0, 1 ";
    $result = $dbConn->query($querySql);
    $si_sistema = $result->fetch_array()[0];
    $result->close();

    return $si_sistema;

}

function getMarca($mr_id)
{

    global $dbConn;

    $querySql = "SELECT mr_marche FROM mr_marche WHERE mr_id = '$mr_id' LIMIT 0, 1 ";
    $result = $dbConn->query($querySql);
    $mr_marche = $result->fetch_array()[0];
    $result->close();

    return $mr_marche;

}

function getMetaDescCategoria($pr_ct_id)
{

    global $dbConn;

    $querySql = "SELECT ct_meta_desc FROM ct_categorie WHERE ct_id = '$pr_ct_id' ";
    $result = $dbConn->query($querySql);
    $ct_meta_desc = $result->fetch_array()[0];
    $result->close();

    return $ct_meta_desc;

}

function getMetaDescSottocat($pr_st_id)
{

    global $dbConn;

    $querySql = "SELECT st_meta_desc FROM st_sottocategorie WHERE st_id = '$pr_st_id' ";
    $result = $dbConn->query($querySql);
    $st_meta_desc = $result->fetch_array()[0];
    $result->close();

    return $st_meta_desc;

}

function getMetaKeyCategoria($pr_ct_id)
{

    global $dbConn;

    $querySql = "SELECT ct_meta_keywords FROM ct_categorie WHERE ct_id = '$pr_ct_id' ";
    $result = $dbConn->query($querySql);
    $ct_meta_keywords = $result->fetch_array()[0];
    $result->close();

    return $ct_meta_keywords;

}

function getMetaKeySottocat($pr_st_id)
{

    global $dbConn;

    $querySql = "SELECT st_meta_keywords FROM st_sottocategorie WHERE st_id = '$pr_st_id' ";
    $result = $dbConn->query($querySql);
    $st_meta_keywords = $result->fetch_array()[0];
    $result->close();

    return $st_meta_keywords;

}

function getTitleCategoria($pr_ct_id)
{

    global $dbConn;

    $querySql = "SELECT ct_title FROM ct_categorie WHERE ct_id = '$pr_ct_id' ";
    $result = $dbConn->query($querySql);
    $ct_title = $result->fetch_array()[0];
    $result->close();

    return $ct_title;

}

function getTitleSottocat($pr_st_id)
{

    global $dbConn;

    $querySql = "SELECT st_title FROM st_sottocategorie WHERE st_id = '$pr_st_id' ";
    $result = $dbConn->query($querySql);
    $st_title = $result->fetch_array()[0];
    $result->close();

    return $st_title;

}

function getH1Categoria($pr_ct_id)
{

    global $dbConn;

    $querySql = "SELECT ct_h1 FROM ct_categorie WHERE ct_id = '$pr_ct_id' ";
    $result = $dbConn->query($querySql);
    $ct_h1 = $result->fetch_array()[0];
    $result->close();

    return $ct_h1;

}

function getH1Sottocat($pr_st_id)
{

    global $dbConn;

    $querySql = "SELECT st_h1 FROM st_sottocategorie WHERE st_id = '$pr_st_id' ";
    $result = $dbConn->query($querySql);
    $st_h1 = $result->fetch_array()[0];
    $result->close();

    return $st_h1;

}

function getMetaDescSistema($pr_si_id)
{

    global $dbConn;

    $querySql = "SELECT si_meta_desc FROM si_sistemi WHERE si_id = '$pr_si_id' ";
    $result = $dbConn->query($querySql);
    $si_meta_desc = $result->fetch_array()[0];
    $result->close();

    return $si_meta_desc;

}

function getMetaKeySistema($pr_si_id)
{

    global $dbConn;

    $querySql = "SELECT si_meta_keywords FROM si_sistemi WHERE si_id = '$pr_si_id' ";
    $result = $dbConn->query($querySql);
    $si_meta_keywords = $result->fetch_array()[0];
    $result->close();

    return $si_meta_keywords;

}

function getTitleSistema($pr_si_id)
{

    global $dbConn;

    $querySql = "SELECT si_title FROM si_sistemi WHERE si_id = '$pr_si_id' ";
    $result = $dbConn->query($querySql);
    $si_title = $result->fetch_array()[0];
    $result->close();

    return $si_title;

}

function getEsistenzaGiacenzaVariante($pr_codice, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_codice = '" . $pr_codice . "' AND pr_capofila != pr_id AND pr_giacenza > 0 ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getDescMarca($pr_codice_marche)
{

    global $dbConn;

    $querySql = "SELECT mr_descrizione FROM mr_marche WHERE mr_codice = '$pr_codice_marche' ";
    $result = $dbConn->query($querySql);
    $mr_descrizione = $result->fetch_array()[0];
    $result->close();

    return $mr_descrizione;

}

function getDescrizioneMarca($pr_codice_marche)
{

    global $dbConn;

    $querySql = "SELECT mr_descrizione FROM mr_marche WHERE mr_codice = '$pr_codice_marche' LIMIT 0, 1 ";
    $result = $dbConn->query($querySql);
    $mr_descrizione = $result->fetch_array()[0];
    $result->close();

    return $mr_descrizione;

}

function getImgMarca($mr_codice)
{

    global $dbConn, $rootBasePath_http;

    $querySql = "SELECT mr_immagine FROM mr_marche WHERE mr_codice = '$mr_codice' ";
    $result = $dbConn->query($querySql);
    $mr_immagine = $result->fetch_array()[0];
    $result->close();

    return strlen($mr_immagine) > 0 && file_exists("upload/marche/$mr_immagine") ? "$rootBasePath_http/upload/marche/$mr_immagine" : "assets/img/prodotto-dummy.jpg";

}

function getBannerMarca($mr_codice)
{

    global $dbConn, $rootBasePath_http;

    $querySql = "SELECT mr_banner FROM mr_marche WHERE mr_codice = '$mr_codice' ";
    $result = $dbConn->query($querySql);
    $mr_banner = $result->fetch_array()[0];
    $result->close();

    return strlen($mr_banner) > 0 && is_file("upload/marche/$mr_banner") ? "$rootBasePath_http/upload/marche/$mr_banner" : "";

}

function selectListeEmail($ns_id_param, $dbConn, $check = 0)
{

    if ($check == 1) {

        include_once "../class/class.controllo-mail.php";
        $checkmail = new ControlloMail($dbConn);

    }

    $querySql = "SELECT * FROM ns_newsletter_liste WHERE ns_id > 0 ORDER BY ns_lista ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $ns_id = $row_data['ns_id'];
        $ns_lista = $row_data['ns_lista'];

        $stato = $ns_id_param == $ns_id ? "selected" : "";


        if ($check == 1) {

            $count = countEmailLista($ns_id, $dbConn);

            if (!$checkmail->CheckMailEx($count)) $stato = "disabled";

        }

        if ($stato == 'disabled') echo "<option style='background-color: lightgrey;' value='$ns_id' $stato>$ns_lista (supera il limite)</option>";
        else echo "<option value='$ns_id' $stato>$ns_lista</option>";

    }

    $result->close();
}

function pageGetProdVetrina()
{
    global $dbConn;

    $querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marche ON mr_codice = pr_codice_marche WHERE pr_stato > 0 AND mr_riservato = 0 AND pr_prezzo_scontato > 0 AND pr_vetrina = 'S' ORDER BY RAND() LIMIT 0,4";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
        $pr_link = generateProductLink($pr_id);

        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("ftp/immagini/" . $row_data['pr_immagine'])
            ? "ftp/immagini/" . $row_data['pr_immagine']
            : "assets/img/prodotto-dummy.jpg";
        ?>
        <article class="single_product">
            <figure>
                <div class="product_thumb">
                    <!--<div class="vetrina">VETRINA</div>-->
                    <a class="primary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo $pr_immagine; ?>" alt="" class="img-fix-xs"> </a>
                    <a class="secondary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo "ftp/immagini/" . $row_data['pr_immagine_2']; ?>" alt="" class="img-fix-xs">
                    </a>
                </div>
                <figcaption class="product_content">
                    <h4 class="product_name">
                        <a href="<?php echo $pr_link; ?>"><?php echo $row_data['pr_descrizione_breve']; ?></a></h4>
                    <div class="product_rating">
                        <?php $media_voto = mediaRecensioni($pr_codice, $dbConn) ?>

                        <?php $star = '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>' ?>

                        <?php
                        switch ($media_voto) {
                            case '1':
                                echo $star;
                                break;
                            case '2':
                                echo $star . $star;
                                break;
                            case '3':
                                echo $star . $star . $star;
                                break;
                            case '4':
                                echo $star . $star . $star . $star;
                                break;
                            case '5':
                                echo $star . $star . $star . $star . $star;
                                break;
                            default:
                                echo "";
                                break;
                        }
                        ?>
                    </div>
                    <div class="price_box">
                        <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                            <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                            <?php } else { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                                <!--<span class="old_price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>-->
                            <?php } ?>
                        <?php } ?>
                    </div>

                </figcaption>
            </figure>
        </article>

        <?php

    }

    if ($rows == 0) echo "<p>Non ci sono prodotti</p>";

    $result->close();
}

function pageGetProdNovita()
{
    global $dbConn;

    $querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marche ON mr_codice = pr_codice_marche WHERE pr_stato > 0 AND mr_riservato = 0 AND pr_prezzo_scontato > 0 AND pr_novita = 'S' ORDER BY RAND() LIMIT 0,4";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
        $pr_link = generateProductLink($pr_id);

        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("ftp/immagini/" . $row_data['pr_immagine'])
            ? "ftp/immagini/" . $row_data['pr_immagine']
            : "assets/img/prodotto-dummy.jpg";
        ?>
        <article class="single_product">
            <figure>
                <div class="product_thumb">
                    <!--<div class="new">NOVIT&Agrave;</div>-->
                    <a class="primary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo $pr_immagine; ?>" alt="" class="img-fix-xs"> </a>
                    <a class="secondary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo "ftp/immagini/" . $row_data['pr_immagine_2']; ?>" alt="" class="img-fix-xs">
                    </a>
                </div>
                <figcaption class="product_content">
                    <h4 class="product_name">
                        <a href="<?php echo $pr_link; ?>"><?php echo $row_data['pr_descrizione_breve']; ?></a></h4>
                    <div class="product_rating">
                        <?php $media_voto = mediaRecensioni($pr_codice, $dbConn) ?>

                        <?php $star = '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>' ?>

                        <?php
                        switch ($media_voto) {
                            case '1':
                                echo $star;
                                break;
                            case '2':
                                echo $star . $star;
                                break;
                            case '3':
                                echo $star . $star . $star;
                                break;
                            case '4':
                                echo $star . $star . $star . $star;
                                break;
                            case '5':
                                echo $star . $star . $star . $star . $star;
                                break;
                            default:
                                echo "";
                                break;
                        }
                        ?>
                    </div>
                    <div class="price_box">
                        <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                            <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                            <?php } else { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                                <!--<span class="old_price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>-->
                            <?php } ?>
                        <?php } ?>
                    </div>

                </figcaption>
            </figure>
        </article>

        <?php

    }

    if ($rows == 0) echo "<p>Non ci sono prodotti</p>";

    $result->close();
}

function pageGetProdPromo()
{
    global $dbConn;

    $querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marche ON mr_codice = pr_codice_marche WHERE pr_stato > 0 AND mr_riservato = 0 AND pr_prezzo_scontato > 0 AND pr_promo = 'S' ORDER BY RAND() LIMIT 0,4";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $pr_id = $row_data['pr_id'];
        $pr_codice = $row_data['pr_codice'];
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
        $pr_link = generateProductLink($pr_id);

        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("ftp/immagini/" . $row_data['pr_immagine'])
            ? "ftp/immagini/" . $row_data['pr_immagine']
            : "assets/img/prodotto-dummy.jpg";
        ?>
        <article class="single_product">
            <figure>
                <div class="product_thumb">
                    <!--<div class="offerta">PROMO</div>-->
                    <a class="primary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo $pr_immagine; ?>" alt="" class="img-fix-xs"> </a>
                    <a class="secondary_img" href="<?php echo $pr_link; ?>">
                        <img src="<?php echo "ftp/immagini/" . $row_data['pr_immagine_2']; ?>" alt="" class="img-fix-xs">
                    </a>
                </div>
                <figcaption class="product_content">
                    <h4 class="product_name">
                        <a href="<?php echo $pr_link; ?>"><?php echo $row_data['pr_descrizione_breve']; ?></a></h4>
                    <div class="product_rating">
                        <?php $media_voto = mediaRecensioni($pr_codice, $dbConn) ?>

                        <?php $star = '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>' ?>

                        <?php
                        switch ($media_voto) {
                            case '1':
                                echo $star;
                                break;
                            case '2':
                                echo $star . $star;
                                break;
                            case '3':
                                echo $star . $star . $star;
                                break;
                            case '4':
                                echo $star . $star . $star . $star;
                                break;
                            case '5':
                                echo $star . $star . $star . $star . $star;
                                break;
                            default:
                                echo "";
                                break;
                        }
                        ?>
                    </div>
                    <div class="price_box">
                        <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                            <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                            <?php } else { ?>
                                <span class="current_price">A partire da &euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                                <!--<span class="old_price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>-->
                            <?php } ?>
                        <?php } ?>
                    </div>

                </figcaption>
            </figure>
        </article>

        <?php

    }

    if ($rows == 0) echo "<p>Non ci sono prodotti</p>";

    $result->close();
}

function getProdottoById($pr_id, mysqli $dbConn)
{

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$pr_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['pr_descrizione'];

}

function getIDClienteByCodice($cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT * FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['cl_id'];

}

function getTitoloBlog($bl_id, $dbConn)
{

    $querySql = "SELECT bl_titolo FROM bl_blog WHERE bl_id IN ('$bl_id') ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    if ($rows == 0) return "//";
    else return $row_data['bl_titolo'];

}

// === FUNZIONI VARIE FRANCESCO ===

function purifyString($string)
{

    if (strlen($string) == 0) return "";

    $string = str_replace("' ", "'", $string);
    $string = preg_replace('#\ \ +#', ' ', $string);
    $string = trim($string);

    return $string;
}

function download_remote_file($file_url, $save_to)
{

    $content = file_get_contents($file_url);
    file_put_contents($save_to, $content);

    if (strlen($content) > 0) return 1;
    else return 0;

}

function truncate($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
{

    if ($considerHtml) {

        // if the plain text is shorter than the maximum length, return the whole text

        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {

            return $text;

        }

        // splits all html-tags to scanable lines

        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);

        $total_length = strlen($ending);

        $open_tags = array();

        $truncate = '';

        foreach ($lines as $line_matchings) {

            // if there is any html-tag in this line, handle it and add it (uncounted) to the output

            if (!empty($line_matchings[1])) {

                // if it?s an ?empty element? with or without xhtml-conform closing slash (f.e.)

                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {

                    // do nothing

                    // if tag is a closing tag (f.e.)

                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {

                    // delete tag from $open_tags list

                    $pos = array_search($tag_matchings[1], $open_tags);

                    if ($pos !== false) {

                        unset($open_tags[$pos]);

                    }

                    // if tag is an opening tag (f.e. )

                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {

                    // add tag to the beginning of $open_tags list

                    array_unshift($open_tags, strtolower($tag_matchings[1]));

                }

                // add html-tag to $truncate?d text

                $truncate .= $line_matchings[1];

            }

            // calculate the length of the plain text part of the line; handle entities as one character

            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));

            if ($total_length + $content_length > $length) {

                // the number of characters which are left

                $left = $length - $total_length;

                $entities_length = 0;

                // search for html entities

                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {

                    // calculate the real length of all entities in the legal range

                    foreach ($entities[0] as $entity) {

                        if ($entity[1] + 1 - $entities_length <= $left) {

                            $left--;

                            $entities_length += strlen($entity[0]);

                        } else {

                            // no more characters left

                            break;

                        }

                    }

                }

                $truncate .= substr($line_matchings[2], 0, $left + $entities_length);

                // maximum lenght is reached, so get off the loop

                break;

            } else {

                $truncate .= $line_matchings[2];

                $total_length += $content_length;

            }

            // if the maximum length is reached, get off the loop

            if ($total_length >= $length) {

                break;

            }

        }

    } else {

        if (strlen($text) <= $length) {

            return $text;

        } else {

            $truncate = substr($text, 0, $length - strlen($ending));

        }

    }

    // if the words shouldn't be cut in the middle...

    if (!$exact) {

        // ...search the last occurance of a space...

        $spacepos = strrpos($truncate, ' ');

        if (isset($spacepos)) {

            // ...and cut the text in this position

            $truncate = substr($truncate, 0, $spacepos);

        }

    }

    // add the defined ending to the text

    $truncate .= $ending;

    if ($considerHtml) {

        // close all unclosed html-tags

        foreach ($open_tags as $tag) {

            $truncate .= '';

        }

    }

    return $truncate;

}

function is_base64_encoded($data)
{
    if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
        return 1;
    } else {
        return 0;
    }
}

;

function formatPercent($number)
{

    return number_format($number, 0, ",", ".");

}

function formatPrice($number)
{

    return number_format($number, 2, ",", ".");

}

function formatPriceForDB($number)
{

    $number = str_replace(".", "", $number);
    $number = str_replace(",", ".", $number);

    return $number;

}

function dateToTimestamp($date)
{

    list($day, $month, $year) = explode("/", $date);
    return mktime(0, 0, 0, $month, $day, $year);

}


// ==== EMAIL ====

function convertLink($string, $root_base_path, $codice_log, $ne_email)
{

    $url = "$root_base_path/crm/clicker.php?cod=$codice_log&email=$ne_email&url=";

    $dom = new DOMDocument;

    @$dom->loadHTML($string);

    $links = $dom->getElementsByTagName('a');

    foreach ($links as $link) {

        $string = str_replace(array('href="' . $link->getAttribute('href') . '"', "href='" . $link->getAttribute('href') . "'"),
            'href="' . $url . $link->getAttribute('href') . '"', $string);

    }

    return $string;

}

//========= IMAGE ==============
function checkImage($immagine, $upload_path, $array_size)
{

    //$array_size = array("409x309", "848x641", "60x60", "105x79", "453x343");

    foreach ($array_size as &$size) {

        list($width, $height) = explode("x", $size);
        resizeImage($immagine, $upload_path, $width, $height);

    }

    return 1;

}


function checkImageName($immagine, $upload_path, $array_size, $image_name)
{

    list($width, $height) = explode("x", $array_size);
    return resizeImage($immagine, $upload_path, $width, $height, 33, false, 0, $image_name);

}

function resizeImage($immagine, $upload_path, $width, $height, $qualita = 100, $responsive = false, $ritaglia = 0, $image_name_new = "")
{
    if (!file_exists($immagine)) return 0;

    $imagick = new Imagick(realpath($immagine));
    $imagick->setImageCompressionQuality($qualita);

    $cropWidth = $imagick->getImageWidth();
    $cropHeight = $imagick->getImageHeight();

    if ($ritaglia) {
        /*$newWidth = $cropWidth / 2;
        $newHeight = $cropHeight / 2;*/

        $min_val = $cropWidth > $cropHeight ? $cropHeight : $cropWidth;
        $newWidth = $min_val;
        $newHeight = $min_val;

        $imagick->cropimage(
            $newWidth,
            $newHeight,
            ($cropWidth - $newWidth) / 2,
            ($cropHeight - $newHeight) / 2
        );

        $imagick->scaleimage(
            $imagick->getImageWidth() * 2,
            $imagick->getImageHeight() * 2
        );
    }

    $imagick->resizeImage($width, $height, 0, 1.0, $responsive);

    $imagick->stripImage();

    //header("Content-Type: image/jpg");
    //return $imagick->getImageBlob();

    /*$img_path = explode("/", $immagine);
    $img_path = $img_path[count($img_path) - 2];*/
    if (strlen($image_name_new) == 0) $image_name_new = $width . "x" . $height;

    return $imagick->writeImage("$upload_path/$image_name_new");
}

function optimizeImageProdotto($immagine, $upload_path, $immagine_name, $dimensione)
{

    if (file_exists("$upload_path/$immagine_name")) return "$upload_path/$immagine_name";

    if (!file_exists($upload_path)) {

        mkdir($upload_path, 0777);
        chmod($upload_path, 0777);

    }

    $remote_img = end(explode("/", $immagine));
    /*if(!file_exists("../../upload/bak/$remote_img"))*/
    $download = download_remote_file($immagine, "../../upload/bak/$remote_img");

    if ($download > 0) checkImageName("../../upload/bak/$remote_img", $upload_path, $dimensione, $immagine_name);

    return $download;

}


// ======== ============
function getInfoTesseraCliente($cl_codice)
{

    global $dbConn;

    $querySql = "SELECT cl_stato_tessera, cl_saldo_punti FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data;

}

function getEmailClienteByCodice($cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT cl_email FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getPrezzoParzialeMarca($mr_codice, mysqli $dbConn)
{

    $querySql = "SELECT mr_prezzo_parziale FROM mr_marche WHERE mr_codice = '$mr_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

//Funzione popolamento select regioni
function getNazioniSelect($id_nazione_param, $dbConn)
{

    $querySql = "SELECT * FROM si_stati ORDER BY si_nazione";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $si_nazione = $rows['si_nazione'];
        $si_inglese = $rows['si_inglese'];
        $si_duelettere = $rows['si_duelettere'];

        $status = ($id_nazione_param == $si_duelettere) ? "selected" : "";

        echo $select_nazione = "<option value='$si_duelettere' " . $status . ">$si_nazione - $si_inglese ($si_duelettere)</option>";
    };

}

;

//Funzione popolamento select regioni
function getProvinceSelect($id_provincia_param)
{

    global $dbConn;

    $querySql = "SELECT DISTINCT cm_provincia FROM cm_comuni ORDER BY cm_provincia";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $cm_id = $rows['cm_id'];
        $cm_provincia = $rows['cm_provincia'];

        $status = ($id_provincia_param == $cm_provincia) ? "selected" : "";

        echo $select_regione = "<option value='$cm_provincia' $status>$cm_provincia</option>";
    }

    $result->close();

}

function getNominativoClienteByCodice($cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT cl_nome, cl_cognome FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0] . " " . $row_data[1];

}

function getNomeClienteByCodice($cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT cl_nome FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function checkFatturazione($cl_codice)
{

    global $dbConn;

    $querySql = "SELECT COUNT(cl_id) FROM cl_clienti WHERE cl_codice = '$cl_codice' " .
        "AND LENGTH(cl_ragione_sociale) > 0 AND (LENGTH(cl_partita_iva) > 0 OR LENGTH(cl_codice_fiscale) > 0) " .
        "AND (LENGTH(cl_sdi) > 0 OR LENGTH(cl_pec) > 0) AND LENGTH(cl_indirizzo_fatturazione) > 0 " .
        "AND LENGTH(cl_cap_fatturazione) > 0 AND LENGTH(cl_comune_fatturazione) > 0 AND LENGTH(cl_provincia_fatturazione) > 0 ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function getIndirizzoClienteByCodice($cl_codice, mysqli $dbConn)
{

    $querySql = "SELECT cl_indirizzo, cl_comune, cl_provincia, cl_cap FROM cl_clienti WHERE cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0] . " " . $row_data[1] . " (" . $row_data[2] . ") CAP:" . $row_data[3];

}


function getTotalecarrello($cl_codice)
{

    global $dbConn;

    $querySql =
        "SELECT * FROM pr_prodotti " .
        "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice " .
        "WHERE cr_cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);

    $cr_totale = 0;
    while ($row_data = $result->fetch_assoc()) {

        $cr_pr_quantita = $row_data['cr_pr_quantita'];
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
        $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
    }
    $result->close();

    return $cr_totale;

}

function getPrezzoPagamento($cr_pagamento, $cr_totale)
{
    global $dbConn;

    $cr_pagamento_prezzo = 0;
    switch ($cr_pagamento) {

        case "Bonifico":
            $querySql = "SELECT dp_valore FROM dp_dati_pagamenti WHERE dp_nome = 'perc_bonifico' ";
            $result = $dbConn->query($querySql);
            $dp_valore = $result->fetch_array()[0];
            $result->close();

            $cr_pagamento_prezzo = $dp_valore > 0 ? $cr_totale * ($dp_valore / 100) : 0;
            break;

        case "Stripe":
        case "Paypal":
            $querySql = "SELECT dp_valore FROM dp_dati_pagamenti WHERE dp_nome = 'perc_paypal' ";
            $result = $dbConn->query($querySql);
            $dp_valore = $result->fetch_array()[0];
            $result->close();

            $cr_pagamento_prezzo = strlen($dp_valore) > 0 ? $cr_totale * ($dp_valore / 100) : 0;
            break;

        case "Contrassegno":
            $querySql = "SELECT dp_valore FROM dp_dati_pagamenti WHERE dp_nome = 'costo_contrassegno' ";
            $result = $dbConn->query($querySql);
            $dp_valore = $result->fetch_array()[0];
            $result->close();

            $cr_pagamento_prezzo = $dp_valore;
            break;

    }

    return $cr_pagamento_prezzo;

}

function getScontoPunti($cr_punti)
{

    switch ($cr_punti) {

        case 80:
        {

            $cr_sconto = 10.00;
            break;

        }

        case 160:
        {

            $cr_sconto = 30.00;
            break;

        }

        case 290:
        {

            $cr_sconto = 50.00;
            break;

        }

        default:
        {

            $cr_sconto = 0.00;
            break;

        }

    }

    return $cr_sconto;

}

function getPrezzoSpedizione($spedizione, $totale)
{

    global $dbConn;

    $querySql =
        "SELECT * FROM ci_corrieri " .
        "WHERE ci_titolo = '$spedizione' ";
    $result = $dbConn->query($querySql);
    $rows = $result->num_rows;

    while ($row_data = $result->fetch_assoc()) {
        $ci_costo_standard = $row_data['ci_costo_standard'];
        $ci_ordine_minimo = $row_data['ci_ordine_minimo'];
        $ci_titolo = $row_data['ci_titolo'];

        $prezzo = 0;
        /*if ($totale == 0) $prezzo = 0;
        else if ($totale < $ci_ordine_minimo) $prezzo = $ci_costo_standard;
        else $prezzo = 0;*/

        if ($ci_titolo == 'BRT' && $totale > 29.90) {
            $prezzo = 0;
        } else {
            $prezzo = $ci_costo_standard;
        }

    }

    return $prezzo;

}

function getImmagineProdotto($pr_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT pr_immagine FROM pr_prodotti WHERE pr_id = '$pr_id' LIMIT 0, 1";
    $result = $dbConn->query($querySql);
    $pr_immagine = $result->fetch_array()[0];
    $result->close();

    $pr_immagine = strlen($pr_immagine) > 0
        ? "$rootBasePath_http/upload/prodotti/$pr_immagine"
        : "$rootBasePath_http/upload/prodotti/prodotto-dummy.jpg";

    return $pr_immagine;

}

function getCouponByCodice($get_or_codice, mysqli $dbConn)
{

    $querySql = "SELECT uc_coupon FROM uc_utilizzo_coupon WHERE uc_ordine = '$get_or_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

//==== ====

function getVarGet($exclude)
{

    if (!is_array($exclude)) $exclude = array($exclude);

    $string = "";
    foreach ($_GET as $k => $v) {

        if (in_array($k, $exclude)) continue;
        if (strlen($v) > 0) $string .= "&$k=$v";

    }

    return trim($string, "&");

}

function varGetToInput($exclude)
{

    if (!is_array($exclude)) $exclude = array($exclude);

    $string = "";
    foreach ($_GET as $k => $v) {

        if (in_array($k, $exclude)) continue;
        if (strlen($v) > 0) $string .= "<input type='hidden' name='$k' value='$v'>";

    }

    return $string;

}

function checkLinkSpam($value)
{

    if (preg_match('/http|www/i', $value)) return 0;
    else return 1;

}

function checkAntiBot($array, $exclude = array())
{

    foreach ($array as $key => $value) {

        if (!in_array($key, $exclude)) {

            if (checkLinkSpam($value) == 0) die("You are a robot");

        }

    }

}

function getUserIP()
{

    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
    elseif (filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
    else $ip = $remote;

    return $ip;
}

function addLogPrivacy($py_nominativo, $py_email, $py_dati, $py_origine, $py_azione, $py_attivita, $py_checkbox_privacy, $py_checkbox_marketing, $py_checkbox_cessione, $dbConn)
{

    $py_token = rand(000000000000, 999999999999);
    $py_timestamp = time();
    $py_ip = getUserIP();

    $querySql =
        "INSERT INTO py_privacy (" .
        "py_nominativo, py_email, py_dati, py_token, py_origine, py_azione, py_attivita, py_timestamp, py_ip, " .
        "py_checkbox_privacy, py_checkbox_marketing, py_checkbox_cessione, py_stato" .
        ") VALUES (" .
        "'$py_nominativo', '$py_email', '$py_dati', '$py_token', '$py_origine', '$py_azione', '$py_attivita', '$py_timestamp', '$py_ip', " .
        "'$py_checkbox_privacy', '$py_checkbox_marketing', '$py_checkbox_cessione', 1) ";

    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    return $rows;

}

function checkQnt($pr_codice, $pr_quantita = 1)
{

    global $dbConn;

    $querySql = "SELECT pr_giacenza FROM pr_prodotti WHERE pr_codice = '$pr_codice' ";
    $result = $dbConn->query($querySql);
    $pr_giacenza = $result->fetch_array()[0];
    $result->close();

    return $pr_giacenza < $pr_quantita ? $pr_giacenza : $pr_quantita;

}

// include resources inserito da antonio
function loadExFile($tag, $files = array())
{

    $string = "";
    foreach ($files as $file) $string .= " " . file_get_contents($file);
    return "<$tag>$string</$tag>";

}

// fine include resources inserito da antonio

function getStatoCarrello($cl_codice)
{

    /*
     * FRANCESCO (Funzione per redirect)
     * */

    global $dbConn;

    $querySql =
        "SELECT COUNT(cr_id), cr_pagamento FROM cr_carrello WHERE cr_cl_codice = '$cl_codice' ";
    $result = $dbConn->query($querySql);
    list($cr_totale, $cr_pagamento) = $result->fetch_array();
    $result->close();

    if ($cr_totale > 0 && strlen($cr_pagamento) > 0) return 2;
    else if ($cr_totale > 0) return 1;
    else return 0;

}

/////////////////////////////////////
//INIZIO DATI PAGAMENTO PER IL FLUSSO
function configGetDato($dp_nome)
{

    global $dbConn;


    return 2;

}

$emailPaypal = configGetDato("email_paypal");
$emailPaypal = strlen($emailPaypal) > 0 ? $emailPaypal : "info@lucasweb.it";

$bonifico = array(
    "int_conto" => configGetDato("int_conto"),
    "banca_bonifico" => configGetDato("banca_bonifico"),
    "iban_bonifico" => configGetDato("iban_bonifico"),
    "bic_bonifico" => configGetDato("bic_bonifico"),
);

$bonifico["int_conto"] = strlen($bonifico["int_conto"]) > 0 ? $bonifico["int_conto"] : "//";
$bonifico["banca_bonifico"] = strlen($bonifico["banca_bonifico"]) > 0 ? $bonifico["banca_bonifico"] : "//";
$bonifico["iban_bonifico"] = strlen($bonifico["iban_bonifico"]) > 0 ? $bonifico["iban_bonifico"] : "//";
$bonifico["bic_bonifico"] = strlen($bonifico["bic_bonifico"]) > 0 ? $bonifico["bic_bonifico"] : "//";
//FINE DATI PAGAMENTO PER IL FLUSSO
/////////////////////////////////////


?>