<?php
function generateStripeFastOrder($or_codice, $or_totale, $or_rapido = 0)
{

    global $rootBasePath_http;

    include_once "../../bin/stripe/init.php";

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

function generateStripeMailOrder($or_codice, $or_totale, $ut_codice)
{

    global $rootBasePath_http;

    include_once "../../bin/stripe/init.php";

    $or_totale = number_format($or_totale, 2, "", "");

    $code_64 = base64_encode("$or_codice|$ut_codice|$rootBasePath_http/confirmStripe.php?or_codice=$or_codice");
    $return_link = "$rootBasePath_http/fast-login/$code_64";

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
                'url' => "$return_link"
            ],
        ],

    ]);

    return $json->url;

}

/* ==== ==== */


function selectMerceologia($pr_codice_merceologia_param)
{

    global $dbConn;

    $querySql = "SELECT DISTINCT pr_codice_merceologia, pr_descrizione_merceologia FROM pr_prodotti WHERE length(pr_codice_merceologia) > 0 ORDER BY pr_codice_merceologia";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $pr_codice_merceologia = $rows['pr_codice_merceologia'];
        $pr_descrizione_merceologia = $rows['pr_descrizione_merceologia'];

        $status = ($pr_codice_merceologia_param == $pr_codice_merceologia) ? "selected" : "";

        echo "<option value='$pr_codice_merceologia' $status>$pr_codice_merceologia - $pr_descrizione_merceologia</option>";
    }

    $result->close();

}

function selectFamiglie($pr_fm_codice_param)
{

    global $dbConn;

    $querySql = "SELECT DISTINCT pr_fm_codice, pr_fm_descrizione FROM pr_prodotti WHERE length(pr_fm_codice) > 0 ORDER BY pr_fm_codice";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $pr_fm_codice = $rows['pr_fm_codice'];
        $pr_fm_descrizione = $rows['pr_fm_descrizione'];

        $status = ($pr_fm_codice_param == $pr_fm_codice) ? "selected" : "";

        echo "<option value='$pr_fm_codice' $status>$pr_fm_codice - $pr_fm_descrizione</option>";
    }

    $result->close();

}

function selectMarca($pr_mr_id)
{

    global $dbConn;

    $querySql = "SELECT mr_id, mr_titolo FROM mr_marche WHERE mr_id > 0 ORDER BY mr_titolo";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $mr_id = $rows['mr_id'];
        $mr_titolo = $rows['mr_titolo'];

        $status = ($pr_mr_id == $mr_id) ? "selected" : "";

        echo "<option value='$mr_id' $status>$mr_titolo</option>";
    }

    $result->close();

}

function selectCodiceMarca($mr_codice_param)
{

    global $dbConn;

    $querySql = "SELECT mr_codice, mr_titolo FROM mr_marche WHERE mr_id > 0 ORDER BY mr_titolo";
    $result = $dbConn->query($querySql);

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $mr_codice = $rows['mr_codice'];
        $mr_titolo = $rows['mr_titolo'];

        $status = ($mr_codice_param == $mr_codice) ? "selected" : "";

        echo "<option value='$mr_codice' $status>$mr_titolo</option>";
    }

    $result->close();

}

function getImgCapofila($pr_capofila)
{

    global $dbConn;

    $querySql = "SELECT pr_immagine FROM pr_prodotti WHERE pr_id = '$pr_capofila' AND pr_capofila = '$pr_capofila'";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();

    $pr_immagine = $row_data['pr_immagine'];

    $result->close();

    return $pr_immagine;

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

function selectCategorieProdotti($ct_id_param, mysqli $dbConn)
{

    $querySql = "SELECT * FROM ct_categorie WHERE ct_id > 0 ORDER BY ct_categoria ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $ct_id = $row_data['ct_id'];
        $ct_categoria = $row_data['ct_categoria'];

        $stato = $ct_id_param == $ct_id ? "selected" : "";

        echo "<option value='$ct_id' $stato>$ct_categoria</option>";

    }

    $result->close();
}


//Funzione count utilizzo coupon
function get_numero_utilizzi_by_code($uc_coupon_param, $dbConn)
{
    $queryCountSql_coupon = "SELECT COUNT(DISTINCT uc_ordine) FROM uc_utilizzo_coupon WHERE uc_coupon = '" . $uc_coupon_param . "' ";
    $result = $dbConn->query($queryCountSql_coupon);
    $row = $result->fetch_row();

    $row_cnt_utilizzi = $row[0];

    return $row_cnt_utilizzi;
}

;

//Funzione popolamento select regioni
function get_importo_utilizzi_by_code($uc_coupon_param, $dbConn)
{

    $querySql = "SELECT * FROM uc_utilizzo_coupon WHERE uc_coupon = '" . $uc_coupon_param . "' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $totale_importo = 0;
    while (($rows = $result->fetch_assoc()) !== NULL) {

        $uc_ordine = $rows['uc_ordine'];

        $querySql_importo = "SELECT * FROM or_ordini WHERE or_codice = '" . $uc_ordine . "' AND or_stato_pagamento > 0 ";
        $result_importo = $dbConn->query($querySql_importo);
        $rows_importo = $dbConn->affected_rows;

        $totale_ordine = 0;
        while (($rows_importo = $result_importo->fetch_assoc()) !== NULL) {

            $or_importo_totale = $rows_importo['or_pr_quantita'] * $rows_importo['or_pr_prezzo'];
            $totale_ordine += $or_importo_totale;

        };

        $totale_importo += $totale_ordine;

    };

    return formatPrice($totale_importo);

}

;

function countProdottiCategoria($ct_id)
{

    global $dbConn;

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_ct_id = '$ct_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function countProdottiSottocategoria($st_id)
{

    global $dbConn;

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_st_id = '$st_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function countSottocategorieCategoria($ct_id)
{

    global $dbConn;

    $querySql = "SELECT COUNT(st_id) FROM st_sottocategorie WHERE st_ct_id = '$ct_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

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

function getEsistenzaVarianti($pr_id, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_capofila = '$pr_id' AND pr_id != '$pr_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function selectColori($ut_id_param, mysqli $dbConn)
{

    $querySql = "SELECT * FROM ut_colori WHERE ut_id > 0 ORDER BY ut_colore ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $ut_id = $row_data['ut_id'];
        $ut_colore = $row_data['ut_colore'];

        $stato = $ut_id_param == $ut_id ? "selected" : "";

        echo "<option value='$ut_id' $stato>$ut_colore</option>";

    }

    $result->close();
}

function getColoreById($ut_id, mysqli $dbConn)
{

    $querySql = "SELECT ut_colore, ut_rgb FROM ut_colori WHERE ut_id = '$ut_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    list($ut_colore, $ut_rgb) = $result->fetch_array();
    $result->close();

    if ($rows == 0) return "//";
    else return "<div style='background-color: $ut_rgb; width: 10px; height: 10px; display: inline-block;'></div> $ut_colore";

}

function selectCliente($rc_ut_codice, $dbConn)
{

    $querySql = "SELECT * FROM ut_utenti WHERE ut_stato>0  ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $ut_codice = $row_data['ut_codice'];
        $ut_nome = $row_data['ut_nome'];
        $ut_cognome = $row_data['ut_cognome'];

        $stato = $rc_ut_codice == $ut_codice ? "selected" : "";
        echo "<option value='$ut_codice' $stato>$ut_nome $ut_cognome</option>";

    }

    $result->close();
}


function selectProdotto($rc_pr_codice, $dbConn)
{

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_stato>0  ";
    $result = $dbConn->query($querySql);

    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $pr_codice = $row_data['pr_codice'];
        $pr_titolo = $row_data['pr_titolo'];

        $stato = $rc_pr_codice == $pr_codice ? "selected" : "";
        echo "<option value='$pr_codice' $stato>$pr_titolo</option>";

    }

    $result->close();
}

function getCodiceProdottoById($pr_id, mysqli $dbConn)
{

    $querySql = "SELECT pr_codice FROM pr_prodotti WHERE pr_id = '$pr_id' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function selectFornitori($get_fr_id)
{

    global $dbConn;
    $querySql = "SELECT * FROM fr_fornitori ";
    $result = $dbConn->query($querySql);

    while ($row_data = $result->fetch_assoc()) {

        $fr_id = $row_data['fr_id'];
        $fr_ragione_sociale = $row_data['fr_ragione_sociale'];
        $stato = $get_fr_id == $fr_id ? "selected" : "";

        echo "<option value='$fr_id' $stato>$fr_ragione_sociale</option>";

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

function countClientiAssociati($cv_id)
{

    global $dbConn;
    $querySql = "SELECT COUNT(ut_id) FROM ut_utenti INNSER JOIN ca_convenzioni_clienti ON ca_ut_id = ut_id WHERE ca_cv_id = '$cv_id' ";
    $result = $dbConn->query($querySql);
    $count = $result->fetch_array()[0];
    $result->close();

    return $count;

}

function get_access_credential($param_username, $param_password, $dbConn)
{

    $querySql_amministratore = "SELECT * FROM am_amministratore WHERE am_username = '$param_username' AND am_password = '$param_password'";
    $result_amministratore = $dbConn->query($querySql_amministratore);
    $rows_amministratore = $dbConn->affected_rows;

    $credenziali = "";
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

    $querySql = "SELECT * FROM ut_utenti WHERE ut_email = '$param_username' AND ut_password = '$param_password'";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    while (($rows = $result->fetch_assoc()) !== NULL) {

        $username = $rows['ut_email'];
        $password = $rows['ut_password'];

        $credenziali = "cliente|" . $username . "|" . $password;

    };

    $result->close();

    $checkCredential = $credenziali;
    return $checkCredential;

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

function countTotaleOrdini(mysqli $dbConn)
{

    $querySql = "SELECT or_id, or_pr_prezzo, or_pr_quantita, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0  ";
    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_id = $row_data['or_id'];
        $or_pr_prezzo = $row_data['or_pr_prezzo'];
        $or_pr_quantita = $row_data['or_pr_quantita'];
        $or_coupon_tipo = $row_data['or_coupon_tipo'];
        $or_coupon_valore = $row_data['or_coupon_valore'];
        $or_coupon = $row_data['or_coupon'];

        $totale += ($or_pr_prezzo * $or_pr_quantita);

    }
    $result->close();

    $sconto = getTotaleScontoByTipoOrdine('');
    $spedizione = getTotaleSpedizioneByTipoOrdine('');
    $pagamento = getTotalePagamentoByTipoOrdine('');

    $totale = $totale - $sconto + $spedizione + $pagamento;

    return $totale;

}

function countTotaleOrdiniPagati(mysqli $dbConn)
{

    $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita), or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 1 ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    $totale = $row_data[0];
    $or_coupon_tipo = $row_data[1];
    $or_coupon_valore = $row_data[2];
    $or_coupon = $row_data[3];

    $sconto = getTotaleScontoByTipoOrdine('Pagati');
    $spedizione = getTotaleSpedizioneByTipoOrdine('Pagati');
    $pagamento = getTotalePagamentoByTipoOrdine('Pagati');

    $totale = $totale - $sconto + $spedizione + $pagamento;

    return $totale;
}

function countTotaleOrdiniSospesi(mysqli $dbConn)
{

    $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita), or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 0 ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    $totale = $row_data[0];
    $or_coupon_tipo = $row_data[1];
    $or_coupon_valore = $row_data[2];
    $or_coupon = $row_data[3];

    $sconto = getTotaleScontoByTipoOrdine('Sospesi');
    $spedizione = getTotaleSpedizioneByTipoOrdine('Sospesi');
    $pagamento = getTotalePagamentoByTipoOrdine('Sospesi');

    $totale = $totale - $sconto + $spedizione + $pagamento;

    return $totale;
}

function countTotaleOrdiniNonSpediti(mysqli $dbConn)
{

    $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita), or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_spedizione = 0 ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    $totale = $row_data[0];
    $or_coupon_tipo = $row_data[1];
    $or_coupon_valore = $row_data[2];
    $or_coupon = $row_data[3];

    $sconto = getTotaleScontoByTipoOrdine('NonSpediti');
    $spedizione = getTotaleSpedizioneByTipoOrdine('NonSpediti');
    $pagamento = getTotalePagamentoByTipoOrdine('NonSpediti');

    $totale = $totale - $sconto + $spedizione + $pagamento;

    return $totale;
}

function getTotaleScontoByTipoOrdine($tipo)
{
    global $dbConn;

    switch ($tipo) {

        case "Pagati":
            $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) as totale, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_stato_pagamento = 1 AND or_eliminato = 0 GROUP BY or_codice ";
            break;

        case "Sospesi":
            $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) as totale, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_stato_pagamento = 0 AND or_eliminato = 0 GROUP BY or_codice ";
            break;

        case "NonSpediti":
            $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) as totale, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_stato_spedizione = 0 AND or_eliminato = 0 GROUP BY or_codice ";
            break;

        default:
            $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) as totale, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 GROUP BY or_codice ";
            break;
    }

    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $totale = $row_data['totale'];
        $or_coupon_tipo = $row_data['or_coupon_tipo'];
        $or_coupon_valore = $row_data['or_coupon_valore'];
        $or_coupon = $row_data['or_coupon'];

        if (strlen($or_coupon) > 0) {
            $sconto += $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($totale / 100) * $or_coupon_valore;
        } else {
            $sconto += 0;
        }

    }
    $result->close();

    return $sconto;
}

function getScontoByData($or_timestamp_da, $or_timestamp_a)
{
    global $dbConn;

    $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) as totale, or_coupon_tipo, or_coupon_valore, or_coupon FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 ";
    if (strlen($or_timestamp_da) > 0) $querySql .= " AND or_timestamp >= '$or_timestamp_da' ";
    if (strlen($or_timestamp_a) > 0) $querySql .= " AND or_timestamp <= '$or_timestamp_a' ";
    $querySql .= " GROUP BY or_codice ";

    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $totale = $row_data['totale'];
        $or_coupon_tipo = $row_data['or_coupon_tipo'];
        $or_coupon_valore = $row_data['or_coupon_valore'];
        $or_coupon = $row_data['or_coupon'];

        if (strlen($or_coupon) > 0) {
            $sconto += $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($totale / 100) * $or_coupon_valore;
        } else {
            $sconto += 0;
        }

    }
    $result->close();

    return $sconto;

}

function getTotAcquistiByData($or_timestamp_da, $or_timestamp_a)
{
    global $dbConn;

    $querySql = "SELECT pr_prezzo_acquisto FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice INNER JOIN pr_prodotti ON or_pr_codice = pr_codice WHERE or_id > 0 AND or_eliminato = 0 ";
    if (strlen($or_timestamp_da) > 0) $querySql .= " AND or_timestamp >= '$or_timestamp_da' ";
    if (strlen($or_timestamp_a) > 0) $querySql .= " AND or_timestamp <= '$or_timestamp_a' ";
    $querySql .= " GROUP BY or_codice ";

    $totale = 0;
    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $pr_prezzo_acquisto = $row_data['pr_prezzo_acquisto'];
        $totale += $pr_prezzo_acquisto;

    }
    $result->close();

    return $totale;

}

function getTotAcquisti($or_codice)
{
    global $dbConn;

    $querySql =
        "SELECT SUM(pr_prezzo_acquisto * or_pr_quantita) AS or_totale_importo_acquisto FROM pr_prodotti " .
        "INNER JOIN or_ordini ON or_pr_codice = pr_codice WHERE or_eliminato = 0 AND or_codice = '$or_codice' ";
    $querySql .= " GROUP BY or_codice ";

    $totale = 0;
    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_totale_importo_acquisto = $row_data['or_totale_importo_acquisto'];
        $totale += $or_totale_importo_acquisto;

    }
    $result->close();

    return $totale;

}

function countArtNoImporto($or_codice)
{
    global $dbConn;

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti INNER JOIN or_ordini ON or_pr_codice = pr_codice
    WHERE or_eliminato = 0 AND or_codice = '$or_codice' AND (LENGTH(pr_prezzo_acquisto) = 0 OR pr_prezzo_acquisto = '' OR pr_prezzo_acquisto = 0) ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function countProdottiSenzaPrezzoAcquisto(mysqli $dbConn)
{

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_prezzo_acquisto = '' OR pr_prezzo_acquisto = 0 ";
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

    $querySql = "SELECT COUNT(ut_id) FROM ut_utenti ";
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

    $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 ";
    $result = $dbConn->query($querySql);
    $row = $result->fetch_row();
    $result->close();

    return $row[0];

}

function countOrdiniEvasi()
{

    global $dbConn;

    $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_stato = 1 AND or_eliminato = 0";
    $result = $dbConn->query($querySql);
    $row = $result->fetch_row();
    $result->close();

    return $row[0];

}

function countOrdiniSospesi()
{

    global $dbConn;

    $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_stato_pagamento = 0 AND or_eliminato = 0";
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


function countProdottiMarca($pr_mr_id, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_mr_id = '$pr_mr_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function countProdottiSistema($pr_si_id)
{

    global $dbConn;

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_si_id = '$pr_si_id' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

}

function countProdottiLinea($pr_codice_linea, mysqli $dbConn)
{

    $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_codice_linea = '$pr_codice_linea' ";
    $result = $dbConn->query($querySql);
    $count = (int)$result->fetch_array()[0];
    $result->close();

    return $count;

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

function isValidUrl($url)
{

    if (!$url || !is_string($url)) return false;

    if (!preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url)) return false;
    else return true;
}

function formatPrice($number)
{

    return @number_format($number, 2, ",", ".");

}

function formatPriceForDB($number)
{

    $number = str_replace(".", "", $number);
    $number = str_replace(",", ".", $number);

    return @$number;

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

function generateURLRewrite($string)
{

    if (strlen($string) == 0) return "-";
    $string = iconv('ISO-8859-1', 'US-ASCII//TRANSLIT', $string);
    $string = str_replace("A(C)", "e", $string);
    $string = str_replace("'", "", $string);
    $string = str_replace("&", "e", $string);
    $string = str_replace(array("_", '"', " ", ".", "?", "(", ")", ",", ".", ":", ";", "/", "#", "+", "*", "%", "|"), "-", $string);

    $string = preg_replace('#\-\-+#', '-', $string);
    $string = trim($string, '-');

    $string = strtolower($string);

    return $string;
}

function convertURLRewrite($string)
{

    if (strlen($string) == 0) return 0;
    $string = iconv('US-ASCII//TRANSLIT', 'ISO-8859-1', $string);
    $string = str_replace("-", " ", $string);
    $string = trim($string, ' ');

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

function checkTagArticolo($tg_id, $bl_id)
{

    global $dbConn;
    $querySql = "SELECT COUNT(tb_id) FROM tb_tag_blog WHERE tb_tg_id = '$tg_id' AND tb_bl_id = '$bl_id' ";
    $result = $dbConn->query($querySql);
    $count = $result->fetch_array()[0];
    $result->close();

    return $count;

}

function selectTag($par1)
{

    global $dbConn;

    $querySql = "SELECT * FROM tg_tag WHERE tg_stato > 0 ORDER BY tg_tag ";
    $result = $dbConn->query($querySql);

    while ($row_data = $result->fetch_assoc()) {

        $tg_id = $row_data['tg_id'];
        $tg_tag = $row_data['tg_tag'];
        //$status = $tg_id == $par1 ? 'selected' : '';
        $status = checkTagArticolo($tg_id, $par1) > 0 ? 'selected' : '';

        echo "<option value='$tg_id' $status >$tg_tag</option>";
    }

    $result->close();

}

function selectBlogCategorie($bc_param = "", $dbConn)
{

    $querySql = "SELECT * FROM bc_blog_categorie";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    if ($rows > 0) {
        while (($row_data = $result->fetch_assoc()) !== NULL) {

            $bc_id = $row_data['bc_id'];
            $bc_titolo = $row_data['bc_titolo'];
            $status = $bc_id == $bc_param ? 'selected' : '';

            echo "<option value='$bc_id' $status>$bc_titolo</option>";
        }
        $result->close();
    }
}

function getTotaleSpedizioneByTipoOrdine($tipo)
{
    global $dbConn;

    switch ($tipo) {

        case "Pagati":
            $querySql = "SELECT or_spedizione FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 1 GROUP BY or_codice ";
            break;

        case "Sospesi":
            $querySql = "SELECT or_spedizione FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 0 GROUP BY or_codice ";
            break;

        case "NonSpediti":
            $querySql = "SELECT or_spedizione FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_spedizione = 0 GROUP BY or_codice ";
            break;

        default:
            $querySql = "SELECT or_spedizione FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 GROUP BY or_codice ";
            break;
    }

    $result = $dbConn->query($querySql);
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_spedizione = $row_data['or_spedizione'];
        $spedizione += $or_spedizione;
    }
    $result->close();

    return $spedizione;
}

function getTotalePagamentoByTipoOrdine($ordine)
{
    global $dbConn;

    switch ($ordine) {

        case "Pagati":
            $querySql = "SELECT or_pagamento, or_pr_prezzo, or_pr_quantita FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 1  ";
            break;

        case "Sospesi":
            $querySql = "SELECT or_pagamento, or_pr_prezzo, or_pr_quantita FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_pagamento = 0  ";
            break;

        case "NonSpediti":
            $querySql = "SELECT or_pagamento, or_pr_prezzo, or_pr_quantita FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 AND or_stato_spedizione = 0  ";
            break;

        default:
            $querySql = "SELECT or_pagamento, or_pr_prezzo, or_pr_quantita FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0  ";
            break;
    }

    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

    $totale = 0;
    while (($row_data = $result->fetch_assoc()) !== NULL) {

        $or_importo_totale = $row_data['or_pr_quantita'] * $row_data['or_pr_prezzo'];
        $or_pagamento = $row_data['or_pagamento'];

        $totale += getPrezzoPagamento($or_pagamento, $or_importo_totale);
    }

    return $totale;
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

function getPrezzoSpedizione($spedizione, $totale)
{

    global $dbConn;

    //OLD
    /*$prezzo = 0;
    if ($totale == 0) $prezzo = 0;
    else if ($totale < 29.90) $prezzo = 5.90;
    else $prezzo = 0;*/

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

        if ($ci_titolo == 'BRT' && $totale > 29.90) {
            $prezzo = 0;
        } else {
            $prezzo = $ci_costo_standard;
        }

    }

    return @$prezzo;

}


function convertLinkOrdini($string, $root_base_path, $codice_log, $ut_email)
{

    $url = "$root_base_path/crm/clicker-ordini.php?cod=$codice_log&email=$ut_email&url=";

    $dom = new DOMDocument;

    @$dom->loadHTML($string);

    $links = $dom->getElementsByTagName('a');

    foreach ($links as $link) {

        $string = str_replace(array('href="' . $link->getAttribute('href') . '"', "href='" . $link->getAttribute('href') . "'"),
            'href="' . $url . $link->getAttribute('href') . '"', $string);

    }

    return $string;

}

function getCouponByCodice($get_or_codice, mysqli $dbConn)
{

    $querySql = "SELECT uc_coupon FROM uc_utilizzo_coupon WHERE uc_ordine = '$get_or_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getEmailClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_email FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getNominativoClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_nome, ut_cognome FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0] . " " . $row_data[1];

}

function getNomeClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_nome FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getTimestampClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_data FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getIDClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_id FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0];

}

function getIndirizzoClienteByCodice($ut_codice, mysqli $dbConn)
{

    $querySql = "SELECT ut_indirizzo, ut_citta, ut_provincia, ut_cap FROM ut_utenti WHERE ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_array();
    $result->close();

    return $row_data[0] . " " . $row_data[1] . " (" . $row_data[2] . ") CAP:" . $row_data[3];

}

function getTotaleOrdine($ut_codice)
{

    global $dbConn;

    $querySql =
        "SELECT pr_prezzo, pr_prezzo_scontato FROM pr_prodotti " .
        "INNER JOIN or_ordini ON or_pr_codice = pr_codice " .
        "WHERE or_ut_codice = '$ut_codice' ";
    $result = $dbConn->query($querySql);

    $or_totale = 0;
    while ($row_data = $result->fetch_assoc()) {

        $or_pr_quantita = $row_data['or_pr_quantita'];
        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
        $or_totale = $or_totale + ($pr_prezzo * $or_pr_quantita);
    }
    $result->close();

    return $or_totale;
}

function getMarca($mr_id)
{

    global $dbConn;

    $querySql = "SELECT mr_titolo FROM mr_marche WHERE mr_id = '$mr_id' ";
    $result = $dbConn->query($querySql);
    $mr_marche = $result->fetch_array()[0];
    $result->close();

    return $mr_marche;

}

function getSistema($si_id)
{

    global $dbConn;

    $querySql = "SELECT si_sistema FROM si_sistemi WHERE si_id = '$si_id' ";
    $result = $dbConn->query($querySql);
    $si_sistema = $result->fetch_array()[0];
    $result->close();

    return $si_sistema;

}


/////////////////////////////////////
//INIZIO DATI PAGAMENTO
function configGetDato($dp_nome)
{

    global $dbConn;

    $querySql = "SELECT dp_valore FROM dp_dati_pagamenti WHERE dp_nome = '$dp_nome' ";
    $result = $dbConn->query($querySql);
    $dp_valore = $result->fetch_array()[0];
    $result->close();

    return "s";

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
//FINE DATI PAGAMENTO
/////////////////////////////////////


?>