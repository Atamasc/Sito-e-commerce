<?php include "inc/autoloader.php"; ?>
<?php
$get_page_type = @(int)$_GET['page_type'];
$get_pr_search = isset($_GET['pr_search']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_search"]))) : "";
$get_pr_ct_id = isset($_GET['pr_ct_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_ct_id"]))) : "";
$get_pr_mr_id = isset($_GET['pr_mr_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_mr_id"]))) : "";

$get_order_by = isset($_GET['orderby']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["orderby"]))) : 1;

switch ($get_page_type) {

    case 6:
    {
        $mr_titolo = getMarca($get_pr_mr_id);
        $page_title = getMarca($get_pr_mr_id);
        $page_link = generateMarca2Link($get_pr_mr_id);

        $page_bread =
            "<li><a href='lista-prodotti.php'>Prodotti</a></li>
            <li>$mr_titolo</li>";

        break;
    }

    case 3:
    {
        $page_title = getCategoria($get_pr_ct_id, $dbConn);
        $page_link = generateCatLink($get_pr_ct_id);

        $page_bread =
            "<li><a href='lista-prodotti.php'>Prodotti</a></li>
             <li>$page_title</li>";
        break;
    }

    case 2:
    {
        $page_title = "Ricerca";
        $page_link = "$rootBasePath_http/ricerca/" . getVarGet(array("page", "page_type"));

        $page_bread =
            "<li>Ricerca</li>";
        break;
    }

    default:
    {
        $page_title = "I nostri prodotti";
        $page_link = "$rootBasePath_http/prodotti";

        $page_bread =
            "<li>Prodotti</li>";
        break;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title; ?></title>

    <?php include('inc/head.php'); ?>

    <style>
        .categories-menu li a {
            margin-left: 0 !important;
            font-size: 16px !important;
        }

        .categories-menu a span {
            float: right;
            margin-right: 30px;
        }

        .categories-menu {
            margin-bottom: 20px;
        }

        .main-heading h2:before {
            background: #0090f0;
        }
    </style>
</head>

<body class="home-5 home-6 home-8 home-9 home-electronic">
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
    <?php include('inc/header-2.php'); ?>
    <!-- Header End -->

    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Lista prodotti</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <?php echo $page_bread; ?>
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
                    <div class="shop-top-bar">
                        <!-- Left Side start -->
                        <div class="shop-tab nav mb-res-sm-15">
                            <!--                            <a class="active" href="#shop-1" data-toggle="tab"> <i class="fa fa-th show_grid"></i> </a>-->
                            <!--                            <a href="#shop-2" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>-->

                            <?php
                            $querySql = "SELECT COUNT(DISTINCT pr_codice) FROM pr_prodotti INNER JOIN mr_marche ON pr_mr_id=mr_id WHERE pr_stato > 0 ";
                            if (strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                            if (strlen($get_pr_search) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_search%' OR mr_titolo LIKE '%$get_pr_search%' ) ";
                            if (strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
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
                                    if ($get_page_type == 6) {

                                        echo "<option value=\"\">Scegli una marca</option>
                                                      <option value=\"\"> </option>";

                                        $querySql_sp =
                                            "SELECT * FROM mr_marche " .
                                            "WHERE mr_id != '$get_pr_mr_id' " .
                                            "ORDER BY mr_titolo ";
                                        $result_sp = $dbConn->query($querySql_sp);

                                        while (($row_data_sp = $result_sp->fetch_assoc()) !== NULL) {

                                            $mr_id = $row_data_sp['mr_id'];
                                            $mr_titolo = $row_data_sp['mr_titolo'];
                                            $marchio_link = generateMarca2Link($mr_id);
                                            ?>

                                            <option value="<?php echo $marchio_link; ?>"><?php echo $mr_titolo; ?></option>

                                            <?php
                                        }
                                    } else {

                                        ?>

                                        <option value="">Scegli un'opzione</option>
                                        <option value=""></option>
                                        <option value="index">Home</option>
                                        <option value="carrello">Il tuo carrello</option>
                                        <?php
                                        if ($session_cl_login == 0) {

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
                                    $querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marche ON pr_mr_id = mr_id WHERE pr_stato > 0 ";
                                    if (strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                    if (strlen($get_pr_search) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_search%' OR mr_titolo LIKE '%$get_pr_search%' ) ";
                                    if (strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
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
                                        $pr_sconto = $row_data['pr_sconto'];
                                        $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
                                        $pr_link = generateProductLink($pr_id);
                                        $count_varianti = getEsistenzaGiacenzaVariante($pr_codice, $dbConn);

                                        $mr_marchio = getMarca($row_data['pr_mr_id']);
                                        $mr_link = generateMarca2Link($row_data['pr_mr_id']);

                                        $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("upload/prodotti/" . $row_data['pr_immagine'])
                                            ? "$rootBasePath_http/upload/prodotti/" . $row_data['pr_immagine']
                                            : "assets/images/prodotto-dummy.jpg";
                                        $pi_immagine = @getImg2Prodotto($pr_id);
                                        ?>

                                        <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6 col-xs-12">
                                            <article class="list-product">
                                                <div class="img-block">
                                                    <a href="<?php echo $pr_link; ?>" class="thumbnail">
                                                        <img class="first-img" src="<?php echo $pr_immagine; ?>" alt=""/>
                                                        <img class="second-img" src="<?php echo $pi_immagine; ?>" alt=""/>
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
                                                        <a href="<?php echo $mr_link; ?>"><?php echo $mr_marchio; ?></a>
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

                                                    <h3>
                                                        <a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $row_data['pr_titolo']; ?></a>
                                                    </h3>
                                                    <div class="rating-product">
                                                        <?php $media_voto = mediaRecensioni($pr_codice, $dbConn) ?>

                                                        <?php
                                                        $star = '<i class="ion-android-star"></i>';
                                                        $star_dis = '<i class="ion-android-star" style="color: #D0D0D0;"></i>';

                                                        switch ($media_voto) {
                                                            case '1':
                                                                echo $star . $star_dis . $star_dis . $star_dis . $star_dis;
                                                                break;
                                                            case '2':
                                                                echo $star . $star . $star_dis . $star_dis . $star_dis;
                                                                break;
                                                            case '3':
                                                                echo $star . $star . $star . $star_dis . $star_dis;
                                                                break;
                                                            case '4':
                                                                echo $star . $star . $star . $star . $star_dis;
                                                                break;
                                                            case '5':
                                                                echo $star . $star . $star . $star . $star;
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
                                                            <?php } else { ?>
                                                                <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="add-to-link">
                                                    <ul>
                                                        <li class="cart">
                                                            <?php if ($row_data['pr_giacenza'] > 1) { ?>
                                                                <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                                            <?php } else if ($row_data['pr_giacenza'] == 1) { ?>
                                                                <span style="color: #FF7D27; font-weight: bold;">In esaurimento</span>
                                                            <?php } else { ?>
                                                                <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                            <?php } ?>
                                                        </li>
                                                        <?php if ($session_cl_login > 0) { ?>
                                                            <li>
                                                                <div class="wishlist-btn wishlist-add" data-codice="<?php echo $pr_codice; ?>">
                                                                    <a href="javascript:;" title="Aggiungi ai preferiti"><i class="ion-android-favorite-outline"></i></a>
                                                                </div>
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

                                        if ($i < 1 || $i > $tot_pages) continue;

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

    <?php include('inc/footer.php'); ?>

</div>

<?php include('inc/javascript.php'); ?>

<!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->

<!-- <script src="assets/js/plugins.min.js"></script> -->

</body>
</html>
