<?php

function generateCatLink($ct_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT ct_categoria FROM ct_categorie WHERE ct_id = '$ct_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($ct_categoria) = $result->fetch_array();
    $result->close();

    $ct_url = generateURLRewrite($ct_categoria);

    return "$rootBasePath_http/$ct_url-ct$ct_id";

}

function generateSistemaLink($si_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT si_sistema FROM si_sistemi WHERE si_id = '$si_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($si_sistema) = $result->fetch_array();
    $result->close();

    $si_url = generateURLRewrite($si_sistema);

    return "$rootBasePath_http/$si_url-si$si_id";

}

function generateMarca2Link($mr_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT mr_marche FROM mr_marche WHERE mr_id = '$mr_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($mr_marche) = $result->fetch_array();
    $result->close();

    $mr_url = generateURLRewrite($mr_marche);

    return "$rootBasePath_http/$mr_url-mr$mr_id";

}

function generateSubCatLink($st_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT ct_categoria, st_sottocategoria FROM st_sottocategorie INNER JOIN ct_categorie ON ct_id = st_ct_id WHERE st_id = '$st_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($ct_categoria, $st_sottocategoria) = $result->fetch_array();
    $result->close();

    $ct_url = generateURLRewrite($ct_categoria);
    $st_url = generateURLRewrite($st_sottocategoria);

    return "$rootBasePath_http/$ct_url/$st_url-st$st_id";

}

function generateSubCatLink2($mr_id, $st_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT ct_categoria, st_sottocategoria FROM st_sottocategorie INNER JOIN ct_categorie ON ct_id = st_ct_id WHERE st_id = '$st_id' LIMIT 0,1  ";
    $result = $dbConn->query($querySql);
    list($ct_categoria, $st_sottocategoria) = $result->fetch_array();
    $result->close();

    $ct_url = generateURLRewrite($ct_categoria);
    $st_url = generateURLRewrite($st_sottocategoria);


    $querySql =
        "SELECT mr_marche FROM mr_marche WHERE mr_id = '$mr_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($mr_marche) = $result->fetch_array();
    $result->close();

    $mr_url = generateURLRewrite($mr_marche);

    return "$rootBasePath_http/$ct_url/$mr_url-per-$st_url-st$st_id-mr$mr_id";

}

function generateFamigliaLink($pr_fm_codice)
{

    global $dbConn, $rootBasePath_http;

    $pr_fm_arr = str_split($pr_fm_codice, 2);
    $fm_link = "$rootBasePath_http";

    $querySql =
        "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . "0000' ";
    $result = $dbConn->query($querySql);
    $pr_fm_descrizione = $result->fetch_array()[0];
    $result->close();

    $famiglia_url = generateURLRewrite($pr_fm_descrizione);
    $fm_link .= "/$famiglia_url";

    if ($pr_fm_arr[1] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . $pr_fm_arr[1] . "00' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    if ($pr_fm_arr[2] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '$pr_fm_codice' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    return "$fm_link-$pr_fm_codice";

}

function generateLineaLink($pr_codice_linea, $pr_fm_codice = "")
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT pr_descrizione_linea, pr_descrizione_marche FROM pr_prodotti " .
        "WHERE pr_codice_linea = '$pr_codice_linea' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($pr_descrizione_linea, $pr_descrizione_marche) = $result->fetch_array();
    $result->close();

    $marche_url = generateURLRewrite($pr_descrizione_marche);
    $linea_url = generateURLRewrite($pr_descrizione_linea);

    if (strlen($pr_fm_codice) == 0) return "$rootBasePath_http/marche-$marche_url/linea-$linea_url-$pr_codice_linea";

    $pr_fm_arr = str_split($pr_fm_codice, 2);
    $fm_link = "$rootBasePath_http/marche-$marche_url/linea-$linea_url";

    $querySql =
        "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . "0000' ";
    $result = $dbConn->query($querySql);
    $pr_fm_descrizione = $result->fetch_array()[0];
    $result->close();

    $famiglia_url = generateURLRewrite($pr_fm_descrizione);
    $fm_link .= "/$famiglia_url";

    if ($pr_fm_arr[1] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . $pr_fm_arr[1] . "00' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    if ($pr_fm_arr[2] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '$pr_fm_codice' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    return "$fm_link-$pr_codice_linea-$pr_fm_codice";

}

function generateMarcaLink($pr_codice_marche, $pr_fm_codice = "")
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT pr_descrizione_marche FROM pr_prodotti " .
        "WHERE pr_codice_marche = '$pr_codice_marche' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($pr_descrizione_marche) = $result->fetch_array();
    $result->close();

    $marche_url = generateURLRewrite($pr_descrizione_marche);

    if (strlen($pr_fm_codice) == 0) return "$rootBasePath_http/marche-$marche_url-$pr_codice_marche";

    $pr_fm_arr = str_split($pr_fm_codice, 2);
    $fm_link = "$rootBasePath_http/marche-$marche_url";

    $querySql =
        "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . "0000' ";
    $result = $dbConn->query($querySql);
    $pr_fm_descrizione = $result->fetch_array()[0];
    $result->close();

    $famiglia_url = generateURLRewrite($pr_fm_descrizione);
    $fm_link .= "/$famiglia_url";

    if ($pr_fm_arr[1] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '" . $pr_fm_arr[0] . $pr_fm_arr[1] . "00' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    if ($pr_fm_arr[2] != '00') {

        $querySql =
            "SELECT fm_descrizione FROM fm_famiglie WHERE fm_codice = '$pr_fm_codice' ";
        $result = $dbConn->query($querySql);
        $pr_fm_descrizione = $result->fetch_array()[0];
        $result->close();

        $famiglia_url = generateURLRewrite($pr_fm_descrizione);
        $fm_link .= "/$famiglia_url";

    }

    return "$fm_link-$pr_codice_marche-$pr_fm_codice";

}

function generateProductLink($pr_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT pr_titolo, pr_si_id, pr_mr_id, pr_formato FROM pr_prodotti " .
        "WHERE pr_id = '$pr_id' ";
    $result = $dbConn->query($querySql);
    list($pr_titolo, $pr_si_id, $pr_mr_id, $pr_formato) = $result->fetch_array();
    $result->close();

    $pr_sistema = getSistema($pr_si_id);
    $pr_marche = getMarca($pr_mr_id);

    $pr_url = generateURLRewrite("$pr_titolo");
    if (strlen($pr_marche) > 0) $pr_url .= "-della-" . generateURLRewrite($pr_marche);
    if (strlen($pr_sistema) > 0) $pr_url .= "-sistema-" . generateURLRewrite($pr_sistema);
    if (strlen($pr_formato) > 0) $pr_url .= "-" . generateURLRewrite($pr_formato);

    return "$rootBasePath_http/$pr_url-pr$pr_id";

}

function generateBlogLink($bl_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql = "SELECT bc_titolo, bl_titolo FROM bl_blog INNER JOIN bc_blog_categorie ON bc_id = bl_bc_id WHERE bl_id = '$bl_id' ";
    $result = $dbConn->query($querySql);
    list($bc_titolo, $bl_titolo) = $result->fetch_array();
    $result->close();

    $bc_url = generateURLRewrite($bc_titolo);
    $bl_url = generateURLRewrite($bl_titolo);
    $link = "$rootBasePath_http/blog/$bc_url/$bl_url-$bl_id";

    return $link;

}

function generateBlogCatLink($bc_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql = "SELECT bc_titolo FROM bc_blog_categorie WHERE bc_id = '$bc_id' ";
    $result = $dbConn->query($querySql);
    $bc_titolo = $result->fetch_array()[0];
    $result->close();

    $bc_url = generateURLRewrite($bc_titolo);
    $link = "$rootBasePath_http/blog/$bc_url-$bc_id";

    return $link;

}

function generateBlogTagLink($tg_tag, $tg_id)
{

    global $rootBasePath_http;

    $tag_url = generateURLRewrite($tg_tag);
    $id_url = generateURLRewrite($tg_id);
    $link = "$rootBasePath_http/blog/tag/$tag_url-$id_url";

    return $link;

}

// ==== ====

function generateURLRewrite($string)
{

    if (strlen($string) == 0) return "-";

    $unwanted_array = array(
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');
    $string = strtr($string, $unwanted_array);

    $string = str_replace("&", "e", $string);
    $string = str_replace(array("°", "_", "'", '"', " ", ".", "(", ")", ",", ".", ":", ";", "/", "#", "+", "*", "%", "|", "?", "!"), "-", $string);
    $string = iconv('ISO-8859-1', 'US-ASCII//TRANSLIT', $string);

    $string = str_replace("?", "-", $string);
    $string = preg_replace('/\s+/', '', $string);
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

?>