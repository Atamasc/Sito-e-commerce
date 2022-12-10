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


function generateMarca2Link($mr_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT mr_titolo FROM mr_marche WHERE mr_id = '$mr_id' LIMIT 0,1 ";
    $result = $dbConn->query($querySql);
    list($mr_titolo) = $result->fetch_array();
    $result->close();

    $mr_url = generateURLRewrite($mr_titolo);

    return "$rootBasePath_http/$mr_url-mr$mr_id";

}

function generateProductLink($pr_id)
{

    global $dbConn, $rootBasePath_http;

    $querySql =
        "SELECT pr_id, pr_titolo, ct_categoria FROM pr_prodotti INNER JOIN ct_categorie ON pr_ct_id = ct_id " .
        "WHERE pr_id = '$pr_id' ";
    $result = $dbConn->query($querySql);
    list($pr_id, $pr_titolo, $ct_categoria) = $result->fetch_array();
    $result->close();

    $pr_url = generateURLRewrite($pr_titolo);
    $ct_categoria = generateURLRewrite($ct_categoria);
    $link = "$rootBasePath_http/$pr_url-$pr_id";

    return $link;

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
        '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'C', '�' => 'E', '�' => 'E',
        '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'U',
        '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'Y', '�' => 'B', '�' => 'Ss', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'c',
        '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'o', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o',
        '�' => 'o', '�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'y', '�' => 'b', '�' => 'y');
    $string = strtr($string, $unwanted_array);

    $string = str_replace("&", "e", $string);
    $string = str_replace(array("�", "_", "'", '"', " ", ".", "(", ")", ",", ".", ":", ";", "/", "#", "+", "*", "%", "|", "?", "!"), "-", $string);
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