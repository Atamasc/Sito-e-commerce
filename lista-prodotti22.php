<!-- lista-prodotti.php -->

<?php include "inc/autoloader.php"; ?>
<?php
$get_page_type = (int)$_GET['page_type'];
$get_pr_formato = isset($_GET['pr_formato']) ? (int)$_GET['pr_formato'] : "";
$get_pr_search = isset($_GET['pr_search']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_search"]))) : "";
$get_pr_ct_id = isset($_GET['pr_ct_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_ct_id"]))) : "";
$get_pr_st_id = isset($_GET['pr_st_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_st_id"]))) : "";
$get_pr_si_id = isset($_GET['pr_si_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_si_id"]))) : "";
$get_pr_mr_id = isset($_GET['pr_mr_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_mr_id"]))) : "";

$get_order_by = isset($_GET['orderby']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["orderby"]))) : 1;

$meta_description = '';

switch ($get_page_type) {

    case 7: {

        $querySql = "SELECT ct_id, st_sottocategoria, ct_categoria, st_descrizione FROM st_sottocategorie LEFT JOIN ct_categorie ON ct_id = st_ct_id WHERE st_id = '$get_pr_st_id' ";
        $result = $dbConn->query($querySql);
        list($ct_id, $st_sottocategoria, $ct_categoria, $st_descrizione) = $result->fetch_array();
        $result->close();

        $querySql = "SELECT mr_marchio, mr_descrizione FROM mr_marchi WHERE mr_id = '$get_pr_mr_id' ";
        $result = $dbConn->query($querySql);
        list($mr_marchio, $mr_descrizione) = $result->fetch_array();
        $result->close();

        $titolo_bread = $st_sottocategoria.' della '.$mr_marchio;

        $page_title = "$st_sottocategoria / $ct_categoria della $mr_marchio";
        $page_desc = "I nostri prodotti per '$page_title' ";
        $page_link = generateSubCatLink2($get_pr_mr_id, $get_pr_st_id);

        $ct_url = generateCatLink($ct_id);
        $st_url = generateSubCatLink($get_pr_st_id);
        $page_bread =
            "<li><a href='$ct_url'>$ct_categoria</a></li><li><a href='$st_url'>$st_sottocategoria</a></li><li>$mr_marchio</li>";


        /* todo:delete OLD SELECT PER MARCHI */
        /*function pageGenerateSelect() {

            global $dbConn, $get_pr_st_id, $get_pr_mr_id;

            $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_mr_id = mr_id AND pr_st_id = '$get_pr_st_id'";
            $querySql =
                "SELECT mr_id, mr_marchio, ($subQuery) AS mr_count FROM mr_marchi WHERE mr_stato > 0 HAVING mr_count > 0 " .
                "ORDER BY mr_count DESC, mr_marchio ";
            $result = $dbConn->query($querySql);

            $select = "<option value=''>Cerca per marchio</option><option value='' disabled></option>";
            while (($row_data = $result->fetch_assoc()) !== NULL) {

                $mr_id = $row_data['mr_id'];
                $mr_marchio = $row_data['mr_marchio'];
                $mr_count = $row_data['mr_count'];
                $mr_link = generateSubCatLink2($mr_id, $get_pr_st_id);
                $selected = $mr_id == $get_pr_mr_id ? "selected" : "";

                $select .= "<option value='$mr_link' $selected>$mr_marchio ($mr_count)</option>";

            }

            $result->close();

            return $select;

        }*/
        function pageGenerateSelect() {

            global $dbConn, $get_pr_mr_id, $get_pr_st_id;

            $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_st_id = st_id AND pr_mr_id = '$get_pr_mr_id'";
            $querySql =
                "SELECT st_id, st_sottocategoria, ct_categoria, ($subQuery) AS st_count FROM st_sottocategorie INNER JOIN ct_categorie ON ct_id = st_ct_id WHERE st_stato > 0 HAVING st_count > 0 " .
                "ORDER BY ct_categoria, st_count DESC, st_sottocategoria ";
            $result = $dbConn->query($querySql);

            $last_ct = "";
            $select = "<option value=''>Filtra per tipologia</option><option value='' disabled></option>";
            while (($row_data = $result->fetch_assoc()) !== NULL) {

                $st_id = $row_data['st_id'];
                $st_sottocategoria = $row_data['st_sottocategoria'];
                $ct_categoria = $row_data['ct_categoria'];
                $st_count = $row_data['st_count'];
                $st_link = generateSubCatLink2($get_pr_mr_id, $st_id);

                if ($last_ct != $ct_categoria) {

                    $select .= "<option disabled>$ct_categoria</option>";
                    $last_ct = $ct_categoria;

                }

                $selected = $get_pr_st_id == $st_id ? "selected" : "";
                $select .= "<option value='$st_link' $selected>&nbsp;&nbsp;$st_sottocategoria ($st_count)</option>";

            }

            $result->close();

            return $select;

        }
        $page_select = pageGenerateSelect();

        break;
    }

    case 6: {

        $mr_titolo = getMarchio($get_pr_mr_id);

        $titolo_bread = "Prodotti $mr_titolo";

        $page_title = "Prodotti $mr_titolo";
        $page_desc = "I nostri prodotti $mr_titolo ";
        $page_link = generateMarchio2Link($get_pr_mr_id);

        $page_bread =
            "<li>$mr_titolo</li>";


        function pageGenerateSelect() {

            global $dbConn, $get_pr_mr_id;

            $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_st_id = st_id AND pr_mr_id = '$get_pr_mr_id'";
            $querySql =
                "SELECT st_id, st_sottocategoria, ct_categoria, ($subQuery) AS st_count FROM st_sottocategorie INNER JOIN ct_categorie ON ct_id = st_ct_id WHERE st_stato > 0 HAVING st_count > 0 " .
                "ORDER BY ct_categoria, st_count DESC, st_sottocategoria ";
            $result = $dbConn->query($querySql);

            $last_ct = "";
            $select = "<option value=''>Filtra per tipologia</option><option value='' disabled></option>";
            while (($row_data = $result->fetch_assoc()) !== NULL) {

                $st_id = $row_data['st_id'];
                $st_sottocategoria = $row_data['st_sottocategoria'];
                $ct_categoria = $row_data['ct_categoria'];
                $st_count = $row_data['st_count'];
                $st_link = generateSubCatLink2($get_pr_mr_id, $st_id);

                if ($last_ct != $ct_categoria) {

                    $select .= "<option disabled>$ct_categoria</option>";
                    $last_ct = $ct_categoria;

                }

                $select .= "<option value='$st_link'>&nbsp;&nbsp;$st_sottocategoria ($st_count)</option>";

            }

            $result->close();

            return $select;

        }
        $page_select = pageGenerateSelect();

        break;
    }

    case 5: {

        $si_titolo = getSistema($get_pr_si_id);

        if(strlen(getTitleSistema($get_pr_si_id, $dbConn)) > 0){
            $page_title = getTitleSistema($get_pr_si_id, $dbConn);
        }else{
            $page_title = "Prodotti per $si_titolo";
        }

        $titolo_bread = "Prodotti per $si_titolo";

        $page_desc = "I nostri prodotti per $page_title ";
        $page_link = generateSistemaLink($get_pr_si_id);

        $meta_description = getMetaDescSistema($get_pr_si_id);
        $meta_keywords = getMetaKeySistema($get_pr_si_id);

        $page_bread =
            "<li>Sistema $si_titolo</li>";

        function pageGenerateSelect() {

            global $dbConn, $get_pr_si_id;

            $subQuery = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_st_id = st_id AND pr_si_id = '$get_pr_si_id'";
            $querySql =
                "SELECT st_id, st_sottocategoria, ct_categoria, ($subQuery) AS st_count FROM st_sottocategorie INNER JOIN ct_categorie ON ct_id = st_ct_id WHERE st_stato > 0 HAVING st_count > 0 " .
                "ORDER BY ct_categoria, st_count DESC, st_sottocategoria ";
            $result = $dbConn->query($querySql);

            $last_ct = "";
            $select = "<option value=''>Filtra per tipologia</option><option value='' disabled></option>";
            while (($row_data = $result->fetch_assoc()) !== NULL) {

                $st_id = $row_data['st_id'];
                $st_sottocategoria = $row_data['st_sottocategoria'];
                $ct_categoria = $row_data['ct_categoria'];
                $st_count = $row_data['st_count'];
                $st_link = generateSubCatLink($st_id);

                if ($last_ct != $ct_categoria) {

                    $select .= "<option disabled>$ct_categoria</option>";
                    $last_ct = $ct_categoria;

                }

                $select .= "<option value='$st_link'>&nbsp;&nbsp;$st_sottocategoria ($st_count)</option>";

            }

            $result->close();

            return $select;

        }
        $page_select = pageGenerateSelect();

        break;
    }

    case 4: {

        $querySql = "SELECT ct_id, st_sottocategoria, ct_categoria, st_descrizione FROM st_sottocategorie LEFT JOIN ct_categorie ON ct_id = st_ct_id WHERE st_id = '$get_pr_st_id' ";
        $result = $dbConn->query($querySql);
        list($ct_id, $st_sottocategoria, $ct_categoria, $st_descrizione) = $result->fetch_array();
        $result->close();

        $titolo_bread = getH1Sottocat($get_pr_st_id, $dbConn);

        $meta_description = getMetaDescSottocat($get_pr_st_id);
        $meta_keywords = getMetaKeySottocat($get_pr_st_id);

        if(strlen(getTitleSottocat($get_pr_st_id, $dbConn)) > 0){
            $page_title = getTitleSottocat($get_pr_st_id, $dbConn);
        }else{
            $page_title = "$st_sottocategoria / $ct_categoria";
        }

        $page_desc = strlen($st_descrizione) > 0 ? $st_descrizione : "I nostri prodotti per '$page_title' ";
        $page_link = generateSubCatLink($get_pr_st_id);

        $ct_url = generateCatLink($ct_id);
        $page_bread =
            "<li><a href='$ct_url'>$ct_categoria</a></li><li>$st_sottocategoria</li>";

        /* TODO:delete OLD CODE CREA PROBLEMI */
        /*$ct_titolo = getCatBySot($get_pr_st_id, $dbConn);
        $page_title = $ct_titolo." > ".getSottocategoria($get_pr_st_id, $dbConn);
        $page_title2 = getSottocategoria($get_pr_st_id, $dbConn);
        $page_desc = "I nostri prodotti per \"$page_title\" ";

        if ($get_pr_st_id > 0 && $get_pr_mr_id > 0){
        $page_link = generateSubCatLink2($get_pr_mr_id, $get_pr_st_id);
        } else {
        $page_link = generateSubCatLink($get_pr_st_id); }*/

        break;
    }

    case 3: {

        if(strlen(getTitleCategoria($get_pr_ct_id, $dbConn)) > 0){
            $page_title = getTitleCategoria($get_pr_ct_id, $dbConn);
        }else{
            $page_title = getCategoria($get_pr_ct_id, $dbConn);
        }

        $titolo_bread = getH1Categoria($get_pr_ct_id, $dbConn);

        $page_desc = "I nostri prodotti per '$page_title' ";
        $page_link = generateCatLink($get_pr_ct_id);

        $meta_description = getMetaDescCategoria($get_pr_ct_id);
        $meta_keywords = getMetaKeyCategoria($get_pr_ct_id);

        $page_bread =
            "<li>$page_title</li>";
        break;
    }

    case 2: {

        $page_title = "Ricerca";
        $titolo_bread = "Ricerca";
        $page_desc = "Ricerca tra i nostri prodotti";
        $page_link = "$rootBasePath_http/ricerca/".getVarGet(array("page", "page_type"));

        $page_bread =
            "<li>Ricerca</li>";
        break;
    }

    default: {

        $page_title = "I nostri prodotti";
        $titolo_bread = "I nostri prodotti";
        $page_desc = "Tutti i nostri prodotti";
        $page_link = "$rootBasePath_http/prodotti";

        $page_bread =
            "<li>Prodotti</li>";
        break;
    }

}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $meta_description != "" ? $meta_description : $page_desc; ?>">
    <meta name="keywords" content="<?php echo $meta_keywords; ?>">

    <link rel="canonical" href="<?php echo $page_link; ?>" />

    <?php include('inc/head.php'); ?>

    <style>
        /* FRANCESCO */
        .categories-menu a span {

            float: right;
            margin-right: 30px;

        }

        .categories-submenu {

            margin-left: 10px;

        }

        .open-submenu {

            width: 100%;
            text-align: right;

        }

        /* freccetta per il breadcrumb */
        .breadcrumb-links li a:after {
            content: none;
        }

    </style>

</head>

<body>
<!-- main layout start from here -->
<!--====== PRELOADER PART START ======-->

<!-- <div id="preloader">
<div class="preloader">
    <span></span>
    <span></span>
</div>
</div> -->

<!--====== PRELOADER PART ENDS ======-->
<div id="main">
    <!-- Header Start -->
    <?php include('inc/header.php'); ?>
    <!-- Header End -->
    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/background-breadcrumb.png); background-position: center center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content" style="background: rgba(199,168,150,0.9); display: inline-block; padding: 10px; border-radius: 10px;">
                        <h1 class="breadcrumb-hrading" style="text-transform: none;"><?php echo $titolo_bread; ?></h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->



    <!-- Shop Category Area End -->
    <div class="shop-category-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-last col-md-12 order-md-first">
                    <!-- Shop Top Area Start -->

                    <?php if ($get_page_type == 3) {

                        function getDatiSeoCat(){

                                global $dbConn, $get_pr_ct_id;

                                $querySql = "SELECT ct_immagine, ct_h2, ct_descrizione FROM ct_categorie WHERE ct_id = '$get_pr_ct_id' ";
                                $result = $dbConn->query($querySql);
                                $row_data = $result->fetch_assoc();

                                $ct_immagine = $row_data['ct_immagine'];
                                $ct_h2 = $row_data['ct_h2'];
                                $ct_descrizione = $row_data['ct_descrizione'];

                                $result->close();

                                return array($ct_immagine, $ct_h2, $ct_descrizione);
                        }

                        list($ct_immagine, $ct_h2, $ct_descrizione) = getDatiSeoCat();
                        ?>
                        <div class="shop-tab nav mb-res-sm-15" style="max-width: unset; float: unset;">

                            <?php if (strlen($ct_immagine) > 0) { ?>
                            <img src="upload/categorie/<?php echo $ct_immagine; ?>" title="<?php echo $ct_h2; ?>" alt="<?php echo $ct_h2; ?>" <?php if (isMobile()) { ?> style="width: 100%;" <?php } else { ?> style="width: 197%;" <?php } ?> >
                            <?php } ?>


                            <?php if (strlen($ct_h2) > 0 || strlen($ct_descrizione) > 0) { ?>
                            <div style="margin-bottom: 20px; width: 100%; margin-top: 20px;">

                                <?php if (strlen($ct_h2) > 0) { ?>
                                <h2 style=" <?php if (isMobile()) echo 'margin-top: 15px;'; else echo 'width: 1051px;'; ?> text-align: left; color: #c15a54; font-weight: bold; "><?php echo $ct_h2; ?></h2>
                                <?php } ?>

                                <?php if (strlen($ct_descrizione) > 0) { ?> <p id="desc" style="text-transform: none; font-size: 16px; margin-top: 10px; color: #492205;"><?php echo $ct_descrizione; ?></p> <?php } ?>

                            </div>
                            <?php } ?>

                        </div>
                    <?php } ?>


                    <?php if ($get_page_type == 4) {

                        function getDatiSeoSottocat(){

                            global $dbConn, $get_pr_st_id;

                            $querySql = "SELECT st_immagine, st_h2, st_descrizione FROM st_sottocategorie WHERE st_id = '$get_pr_st_id' ";
                            $result = $dbConn->query($querySql);
                            $row_data = $result->fetch_assoc();

                            $st_immagine = $row_data['st_immagine'];
                            $st_h2 = $row_data['st_h2'];
                            $st_descrizione = $row_data['st_descrizione'];

                            $result->close();

                            return array($st_immagine, $st_h2, $st_descrizione);
                        }

                        list($st_immagine, $st_h2, $st_descrizione) = getDatiSeoSottocat();
                        ?>
                        <div class="shop-tab nav mb-res-sm-15" style="max-width: unset; float: unset;">

                            <?php if (strlen($st_immagine) > 0) { ?>
                                <img src="upload/sottocategorie/<?php echo $st_immagine; ?>" <?php if (isMobile()) { ?> style="width: 100%;" <?php } else { ?> style="width: 197%;" <?php } ?> >
                            <?php } ?>


                            <?php if (strlen($st_h2) > 0 || strlen($st_descrizione) > 0) { ?>
                            <div style="margin-bottom: 20px; width: 100%; margin-top: 20px;">

                                <?php if (strlen($st_h2) > 0) { ?>
                                    <h2 style=" <?php if (isMobile()) echo 'margin-top: 15px;'; else echo 'width: 1051px;'; ?> text-align: left; color: #c15a54; font-weight: bold; "><?php echo $st_h2; ?></h2>
                                <?php } ?>

                                <?php if (strlen($st_descrizione) > 0) { ?> <p id="desc" style="text-transform: none; font-size: 16px; margin-top: 10px; color: #492205;"><?php echo $st_descrizione; ?></p> <?php } ?>

                            </div>
                            <?php } ?>

                        </div>
                    <?php } ?>

                    <div class="shop-top-bar">
                        <!-- Left Side start -->
                        <div class="shop-tab nav mb-res-sm-15">
                            <!--
                            <a class="active" href="#shop-1" data-toggle="tab">
                                <i class="fa fa-th show_grid"></i>
                            </a>
                            -->
                            <!--<a href="#shop-2" data-toggle="tab">
                                <i class="fa fa-list-ul"></i>
                            </a>-->

                            <?php
                            $querySql = "SELECT COUNT(DISTINCT pr_codice) FROM pr_prodotti INNER JOIN mr_marchi ON pr_mr_id=mr_id WHERE pr_stato > 0 ";
                            if(strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                            if(strlen($get_pr_search) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_search%' OR mr_marchio LIKE '%$get_pr_search%' ) ";
                            if(strlen($get_pr_st_id) > 0) $querySql .= " AND pr_st_id = '$get_pr_st_id' ";
                            if(strlen($get_pr_si_id) > 0) $querySql .= " AND pr_si_id = '$get_pr_si_id' ";
                            if(strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
                            $result = $dbConn->query($querySql);
                            $row = $result->fetch_row();

                            // numero totale del count
                            $row_cnt = $row[0];
                            // risultati per pagina(secondo parametro di LIMIT)
                            $per_page = 24;
                            // numero totale di pagine
                            $tot_pages = ceil($row_cnt / $per_page);
                            // pagina corrente
                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                            // primo parametro di LIMIT
                            $primo = ($current_page - 1) * $per_page;

                            if ($per_page > $row_cnt) $per_page = $row_cnt;
                            ?>

                            <p>Mostrati <?php echo $per_page; ?> prodotti su <?php echo $row_cnt; ?></p>
                        </div>
                        <!-- Left Side End -->
                        <!-- Right Side Start -->
                        <div class="select-shoing-wrap">
                            <div class="shot-product">
                                <p>Filtra</p>
                            </div>
                            <div class="shop-select">
                                <select class="form-select" onchange="if (this.value.length > 0) location = this.value;">

                                    <?php
                                    if (isset($page_select)) echo $page_select;
                                    else if ($get_page_type == 3) {

                                        echo "<option value=\"\">Scegli una sottocategoria</option>
                                                      <option value=\"\"> </option>";

                                        $querySql =
                                            "SELECT * FROM st_sottocategorie " .
                                            "WHERE st_ct_id = '$get_pr_ct_id' " .
                                            "ORDER BY st_sottocategoria ";
                                        $result_st = $dbConn->query($querySql);

                                        while (($row_data_st = $result_st->fetch_assoc()) !== NULL) {

                                            $st_id = $row_data_st['st_id'];
                                            $st_sottocategoria = $row_data_st['st_sottocategoria'];
                                            $sottocategoria_link = generateSubCatLink($st_id);
                                            ?>

                                            <option value="<?php echo $sottocategoria_link; ?>"><?php echo $st_sottocategoria; ?></option>

                                            <?php
                                        }
                                    }elseif ($get_page_type == 4 || $get_page_type == 7) {

                                        /* TODO:delete OLD CODE */
                                        echo "<option value=\"\">Scegli un marchio</option>
                                                      <option value=\"\"> </option>";

                                        $subQuery = "SELECT DISTINCT pr_mr_id FROM pr_prodotti WHERE pr_st_id = '$get_pr_st_id' AND pr_stato > 0";
                                        $result = $dbConn->query($subQuery);

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $mr_id = $row_data['pr_mr_id'];

                                            $querySql_mr =
                                                "SELECT mr_marchio, mr_id FROM mr_marchi " .
                                                "WHERE mr_id = '$mr_id' " .
                                                "ORDER BY mr_marchio ";
                                            $result_sp = $dbConn->query($querySql_mr);

                                            while (($row_data_mr = $result_sp->fetch_assoc()) !== NULL) {

                                                $mr_id = $row_data_mr['mr_id'];
                                                $mr_marchio = $row_data_mr['mr_marchio'];
                                                $marchio_link = generateSubCatLink2($mr_id, $get_pr_st_id);
                                                ?>

                                                <option value="<?php echo $marchio_link; ?>"><?php echo $mr_marchio; ?></option>

                                                <?php
                                            }
                                        }
                                    }elseif ($get_page_type == 5 ){

                                        echo "<option value=\"\">Scegli un sistema</option>
                                                      <option value=\"\"> </option>";

                                        $querySql_sp =
                                            "SELECT * FROM si_sistemi ".
                                            "WHERE si_id != '$get_pr_si_id' ".
                                            "ORDER BY si_sistema ";
                                        $result_sp = $dbConn->query($querySql_sp);

                                        while (($row_data_sp = $result_sp->fetch_assoc()) !== NULL) {

                                            $si_id = $row_data_sp['si_id'];
                                            $si_sistema = $row_data_sp['si_sistema'];
                                            $sistema_link = generateSistemaLink($si_id);
                                            ?>

                                            <option value="<?php echo $sistema_link; ?>"><?php echo $si_sistema; ?></option>

                                            <?php
                                        }
                                    }elseif ($get_page_type == 6 ){

                                        echo "<option value=\"\">Scegli un marchio</option>
                                                      <option value=\"\"> </option>";

                                        $querySql_sp =
                                            "SELECT * FROM mr_marchi ".
                                            "WHERE mr_id != '$get_pr_mr_id' ".
                                            "ORDER BY mr_marchio ";
                                        $result_sp = $dbConn->query($querySql_sp);

                                        while (($row_data_sp = $result_sp->fetch_assoc()) !== NULL) {

                                            $mr_id = $row_data_sp['mr_id'];
                                            $mr_marchio = $row_data_sp['mr_marchio'];
                                            $marchio_link = generateMarchio2Link($mr_id);
                                            ?>

                                            <option value="<?php echo $marchio_link; ?>"><?php echo $mr_marchio; ?></option>

                                            <?php
                                        }
                                    }else{

                                        ?>

                                        <option value="">Scegli un'opzione</option>
                                        <option value=""></option>
                                        <option value="index">Home</option>
                                        <option value="carrello">Il tuo carrello</option>
                                        <?php
                                        if($session_cl_login == 0) {

                                            ?>
                                            <option value="registrati">Registrati</option>
                                            <?php

                                        } else {

                                            ?>
                                            <option value="my-account">Account</option>
                                            <?php
                                        }
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <!-- Right Side End -->
                    </div>
                    <!-- Shop Top Area End -->

                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area mt-35">
                        <!-- Shop Tab Content Start -->
                        <div class="tab-content jump">
                            <!-- Tab One Start -->
                            <div id="shop-1" class="tab-pane active">
                                <div class="row">

                                    <?php
                                    $querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marchi ON pr_mr_id = mr_id WHERE pr_stato > 0 ";
                                    if(strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                    if(strlen($get_pr_search) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_search%' OR mr_marchio LIKE '%$get_pr_search%' ) ";
                                    if(strlen($get_pr_st_id) > 0) $querySql .= " AND pr_st_id = '$get_pr_st_id' ";
                                    if(strlen($get_pr_si_id) > 0) $querySql .= " AND pr_si_id = '$get_pr_si_id' ";
                                    if(strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
                                    //$querySql .= " AND pr_id = pr_capofila";
                                    //$querySql .= " GROUP BY pr_id";
                                    $querySql .= " ORDER BY CAST(pr_prezzo AS DECIMAL(10,2)) ";
                                    /*if ($get_order_by == 1) $querySql .= " ORDER BY pr_titolo ";
                                    else if ($get_order_by == 2) $querySql .= " ORDER BY CAST(pr_prezzo AS DECIMAL(10,2)) ";
                                    else if ($get_order_by == 3) $querySql .= " ORDER BY CAST(pr_prezzo AS DECIMAL(10,2)) DESC ";*/
                                    $querySql .= " LIMIT $primo, $per_page";
                                    //echo "<br>querySql:".$querySql;
                                    $result = $dbConn->query($querySql);
                                    $rows = $dbConn->affected_rows;

                                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                                        $pr_id = $row_data['pr_id'];
                                        $pr_codice = $row_data['pr_codice'];
                                        $pr_esistenza = $row_data['pr_esistenza'];
                                        $pr_vetrina = $row_data['pr_vetrina'];
                                        $pr_novita = $row_data['pr_novita'];
                                        $pr_promo = $row_data['pr_promo'];
                                        $pr_sconto = $row_data['pr_sconto'];
                                        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
                                        $pr_link = generateProductLink($pr_id);
                                        $count_varianti = getEsistenzaGiacenzaVariante($pr_codice, $dbConn);

                                        $mr_marchio = getMarchio($row_data['pr_mr_id']);
                                        $si_sistema = getSistema($row_data['pr_si_id']);
                                        $mr_link = generateMarchio2Link($row_data['pr_mr_id']);
                                        $si_link = generateSistemaLink($row_data['pr_si_id']);

                                        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("upload/prodotti/".$row_data['pr_immagine'])
                                            ? "upload/prodotti/".$row_data['pr_immagine']
                                            : "assets/images/prodotto-dummy.jpg";
                                        $pi_immagine = getImg2Prodotto($pr_id);
                                        ?>

                                        <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6 col-xs-12">
                                            <article class="list-product">
                                                <div class="img-block">
                                                    <a href="<?php echo $pr_link; ?>" class="thumbnail">
                                                        <img class="first-img" data-src="<?php echo $pr_immagine; ?>" alt="" />
                                                        <img class="second-img" data-src="<?php echo $pi_immagine; ?>" alt="" />
                                                    </a>
                                                    <div class="quick-view">
                                                        <!--<a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="ion-ios-search-strong"></i>
                                                        </a>-->

                                                        <a class="quick_view" href="<?php echo $pr_link; ?>"><i class="ion-ios-search-strong"></i></a>
                                                    </div>
                                                </div>
                                                <!--<ul class="product-flag">
                                                    <li class="new">New</li>
                                                </ul>-->
                                                <div class="product-decs">

                                                    <p class="inner-link">
                                                        <a href="<?php echo $mr_link; ?>" title="<?php echo "Prodotti a marchio $mr_marchio"; ?>"><?php echo $mr_marchio; ?></a>
                                                        <?php echo strlen($si_sistema) > 0 ? " / <a href='$si_link' title='Prodotti per sistemi $si_sistema'>$si_sistema</a>" : ""; ?>
                                                    </p>

                                                    <div>
                                                        <?php if ($row_data['pr_giacenza'] > 5) { ?>
                                                            <span style="color: #198f35; font-weight: bold;">Disponibile</span>
                                                        <?php } else if ($row_data['pr_giacenza'] > 0 && $row_data['pr_giacenza'] <= 5) { ?>
                                                            <span style="color: orange; font-weight: bold;">In esaurimento</span>
                                                        <?php } else if ($row_data['pr_giacenza'] == 0) { ?>
                                                            <span style="color: red; font-weight: bold;">Esaurito</span>
                                                        <?php } else { ?>
                                                            <?php if ($count_varianti > 0) { ?>
                                                                <span style="color: #198f35; font-weight: bold;">Varianti Disponibili</span>
                                                            <?php } else { ?>
                                                                <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>

                                                    <h3><a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $row_data['pr_titolo']; ?></a></h3>
                                                    <p><?php echo $row_data['pr_formato']; ?></p>
                                                    <div class="rating-product">
                                                        <?php $media_voto = mediaRecensioni($pr_codice, $dbConn) ?>

                                                        <?php
                                                        $star = '<i class="ion-android-star"></i>';
                                                        $star_dis = '<i class="ion-android-star" style="color: #D0D0D0;"></i>';

                                                        switch ($media_voto) {
                                                            case '1':
                                                                echo $star.$star_dis.$star_dis.$star_dis.$star_dis;
                                                                break;
                                                            case '2':
                                                                echo $star.$star.$star_dis.$star_dis.$star_dis;
                                                                break;
                                                            case '3':
                                                                echo $star.$star.$star.$star_dis.$star_dis;
                                                                break;
                                                            case '4':
                                                                echo $star.$star.$star.$star.$star_dis;
                                                                break;
                                                            case '5':
                                                                echo $star.$star.$star.$star.$star;
                                                                break;
                                                            default:
                                                                //echo $star.$star.$star.$star.$star_dis."";
                                                                echo "";
                                                                break;
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="pricing-meta">
                                                        <ul>
                                                            <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                                                                <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                                                    <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></li>
                                                                <?php } else { ?>
                                                                    <li class="old-price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></li>
                                                                    <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></li>
                                                                    <li class="discount-price">- <?php echo formatPercent($row_data['pr_sconto']); ?>%</li>
                                                                    <!-- <li class="discount-price">- <?php echo formatPercent($pr_sconto); ?>%</li> -->
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div>&nbsp;</div>
                                                    <div>
                                                        <table style="border: 0px solid #000; width: 100%;" border="0">
                                                            <tr>
                                                                <td style="background-color: #c84e52; color: #fff; font-weight: bold;">Formato</td>
                                                                <td style="background-color: #c84e52; color: #fff; text-align: right; font-weight: bold;">Prezzo</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="background-color: #eee;"><?php echo $row_data['pr_formato']; ?></td>
                                                                <td style="text-align: right;">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <div>&nbsp;</div>
                                                    <div>
                                                        <p>Aggiungi al carrello</p>
                                                    </div>
                                                </div>
                                                <div class="add-to-link">
                                                    <ul>
                                                        <li class="cart">
                                                            <?php if ($row_data['pr_giacenza'] > 1) { ?>
                                                                <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                                            <?php } else if ($row_data['pr_giancenza'] == 1) { ?>
                                                                <span style="color: #FF7D27; font-weight: bold;">In esaurimento</span>
                                                            <?php } else { ?>
                                                                <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                            <?php } ?>
                                                        </li>
                                                        <?php if($session_cl_login > 0) { ?>
                                                            <li>
                                                                <div class="wishlist-btn wishlist-add" data-codice="<?php echo $pr_codice; ?>"><a href="javascript:;" title="Aggiungi ai preferiti"><i class="ion-android-favorite-outline"></i></a></div>
                                                            </li>
                                                        <?php } ?>
                                                        <!--<li>
                                                            <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                                                        </li>-->
                                                    </ul>
                                                </div>
                                            </article>
                                        </div>

                                        <?php

                                    }

                                    if ($rows == 0) echo "<p>Non ci sono prodotti</p>";

                                    $result->close();

                                    $paginazione = "";

                                    for ($i = $current_page - 5; $i <= $current_page + 5; $i++) {

                                        if($i < 1 || $i > $tot_pages) continue;

                                        if ($i == $current_page)
                                            $paginazione .= "<li><a class='active' href='javascript:;' title='Vai alla pagina $i'>$i</a></li>";
                                        else
                                            $paginazione .= "<li><a href='$page_link/$i' title='Vai alla pagina $i'>$i</a></li>";
                                    }

                                    if ($current_page + 5 < $tot_pages) $paginazione .= "<li>...</li><li><a href='$page_link/$tot_pages' title='Vai alla pagina $tot_pages'>$tot_pages</a></li>";
                                    ?>

                                </div>
                            </div>
                            <!-- Tab One End -->

                        </div>
                        <!-- Shop Tab Content End -->
                        <!--  Pagination Area Start -->
                        <div class="pro-pagination-style text-center">
                            <ul>
                                <!-- <li>
                                     <a class="prev" href="#"><i class="ion-ios-arrow-left"></i></a>
                                 </li>-->
                                <?php echo $paginazione; ?>
                                <!--<li>
                                    <a class="next" href="#"><i class="ion-ios-arrow-right"></i></a>
                                </li>-->
                            </ul>
                        </div>
                        <!--  Pagination Area End -->
                    </div>
                    <!-- Shop Bottom Area End -->
                </div>
                <!-- Sidebar Area Start -->
                <?php include('inc/shop-sidebar.php'); ?>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </div>
    <!-- Shop Category Area End -->
    <!-- Footer Area start -->
    <?php include('inc/footer.php'); ?>
    <!--  Footer Area End -->
</div>

<!-- Modal -->
<!--
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="tab-content quickview-big-img">
                            <div id="pro-1" class="tab-pane fade show active">
                                <img src="#" alt="" />
                            </div>
                        </div>

                        <div class="quickview-wrap mt-15">
                            <div class="quickview-slide-active owl-carousel nav owl-nav-style owl-nav-style-2" role="tablist">
                                <a class="active" data-toggle="tab" href="#pro-1"><img src="assets/images/product-image/organic/product-11.jpg" alt="" /></a>
                                <a data-toggle="tab" href="#pro-2"><img src="assets/images/product-image/organic/product-9.jpg" alt="" /></a>
                                <a data-toggle="tab" href="#pro-3"><img src="assets/images/product-image/organic/product-20.jpg" alt="" /></a>
                                <a data-toggle="tab" href="#pro-4"><img src="assets/images/product-image/organic/product-19.jpg" alt="" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="product-details-content quickview-content">
                            <h3>TITOLO</h3>
                            <p class="reference">Reference:<span> demo_172</span></p>
                            <div class="pro-details-rating-wrap">
                                <div class="rating-product">
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                    <i class="ion-android-star"></i>
                                </div>
                                <span class="read-review"><a class="reviews" href="#">Read reviews (1)</a></span>
                            </div>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">?18.90</li>
                                </ul>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore et dolore magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                            <div class="pro-details-size-color">
                                <div class="pro-details-color-wrap">
                                    <span>Color</span>
                                    <div class="pro-details-color-content">
                                        <ul>
                                            <li class="blue"></li>
                                            <li class="maroon active"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" />
                                </div>
                                <div class="pro-details-cart btn-hover">
                                    <a href="#"> + Add To Cart</a>
                                </div>
                            </div>
                            <div class="pro-details-wish-com">
                                <div class="pro-details-wishlist">
                                    <a href="#"><i class="ion-android-favorite-outline"></i>Add to wishlist</a>
                                </div>
                                <div class="pro-details-compare">
                                    <a href="#"><i class="ion-ios-shuffle-strong"></i>Add to compare</a>
                                </div>
                            </div>
                            <div class="pro-details-social-info">
                                <span>Share</span>
                                <div class="social-info">
                                    <ul>
                                        <li>
                                            <a href="https://www.facebook.com/moncaffe.it"><i class="ion-social-facebook"></i></a>
                                        </li>

                                        <li>
                                            <a href="https://www.instagram.com/moncaffe.it/"><i class="ion-social-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- Modal end -->

<!-- Scripts to be loaded  -->
<!-- JS -->
<?php include('inc/javascript.php'); ?>

<script>
    $('#desc').next().css({'font-size':'18px', 'margin-top':'30px'});
</script>

</body>
</html>
