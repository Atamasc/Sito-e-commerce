<?php include "inc/autoloader.php"; ?>
<?php
$get_pr_id = $dbConn->real_escape_string(stripslashes(trim($_GET["pr_id"])));

$querySql =
    "SELECT * FROM pr_prodotti " .
    "LEFT JOIN ct_categorie ON pr_ct_id = ct_id " .
    "WHERE pr_id = '$get_pr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();

$pr_id = $row_data['pr_id'];
$pr_codice = $row_data['pr_codice'];
$pr_capofila = $row_data['pr_capofila'];
$get_pr_capofila = $row_data['pr_capofila'];

$pr_titolo = $row_data['pr_titolo'];
$pr_abstract = $row_data['pr_abstract'];
$pr_giacenza = $row_data['pr_giacenza'];
$pr_peso = $row_data['pr_peso'];
$pr_stato = $row_data['pr_stato'];
$cl_email = @getEmailClienteByCodice($session_cl_codice, $dbConn);

$ct_categoria = $row_data['ct_categoria'];
$ct_titolo = $ct_categoria;

$mr_marchio = getMarca($row_data['pr_mr_id']);
$mr_link = generateMarca2Link($row_data['pr_mr_id']);
$ct_link = generateCatLink($row_data['pr_ct_id']);

$pr_immagine = strlen($row_data['pr_immagine']) > 0 && file_exists("upload/prodotti/" . $row_data['pr_immagine'])
    ? "upload/prodotti/" . $row_data['pr_immagine']
    : "assets/images/prodotto-dummy.jpg";

$pr_prezzo = $row_data['pr_prezzo'];
$pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];
$pr_sconto = $row_data['pr_sconto'];

$count_recensioni = countRecensioni($pr_codice, $dbConn);

$page_title = $pr_titolo;
$page_link = generateProductLink($pr_capofila);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $pr_titolo; ?> | Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

    <style>
        .current-price {
            font-size: 36px;
            font-weight: bold;
            color: unset !important;
        }

        .pro-details-social-info {
            border-bottom: 0;
            margin-top: unset;
            padding-bottom: unset;
        }

        .rating-product input[type="radio"] {
            display: none
        }

        .rating-product label {
            color: #fa0;
            font-size: 20px;
            cursor: pointer;
            font-style: normal;
        }

        .rating-product label i.fa-star {
            font-style: normal;
        }

        .rating-product i.fa-star {
            color: #fa0;
        }


        @media (max-width: 320px) {
            .subscribe-form.box form input {
                padding: unset !important;
            }
        }

        .subscribe-form.box form input {
            color: #4c4c51;
        }

        .clear input.button {
            color: #fff !important;
        }

        .product-dec-slider-2 .slick-slide img {
            width: 134px !important;
        }

        .reference a {
            color: black;
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
    <?php include('inc/header.php'); ?>
    <!-- Header End -->

    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading"><?php echo $pr_titolo; ?></h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="<?php echo $ct_link; ?>"><?php echo $ct_categoria; ?></a></li>
                            <li><?php echo $pr_titolo; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- Shop details Area start -->
    <section class="product-details-area mtb-60px">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="product-details-img product-details-tab">
                        <div class="zoompro-wrap zoompro-2">
                            <div class="zoompro-border zoompro-span">
                                <img class="zoompro" src="<?php echo $pr_immagine; ?>" data-zoom-image="<?php echo $pr_immagine; ?>" alt=""/>
                            </div>
                        </div>
                        <div id="gallery" class="product-dec-slider-2" style="margin-top: 40px;">
                            <a class="active" data-image="<?php echo $pr_immagine; ?>" data-zoom-image="<?php echo $pr_immagine; ?>">
                                <img src="<?php echo $pr_immagine; ?>" alt="" style="cursor: pointer"/>

                                <?php
                                pageGetImage($get_pr_id);
                                function pageGetImage($pr_id)
                                {

                                    global $dbConn, $rootBasePath_http;

                                    $querySql = "SELECT pi_immagine FROM pi_prodotti_immagini WHERE pi_pr_id = '$pr_id' AND pi_stato > 0 ";
                                    $result = $dbConn->query($querySql);

                                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                                        $pi_immagine = strlen($row_data['pi_immagine']) > 0 && file_exists("upload/prodotti-immagini/" . $row_data['pi_immagine'])
                                            ? "$rootBasePath_http/upload/prodotti-immagini/" . $row_data['pi_immagine']
                                            : "$rootBasePath_http/assets/img/prodotto-dummy.jpg";
                                        ?>
                                        <a data-image="<?php echo $pi_immagine; ?>" data-zoom-image="<?php echo $pi_immagine; ?>">
                                            <img src="<?php echo $pi_immagine; ?>" data-src="<?php echo $pi_immagine; ?>" style="cursor: pointer" alt=""/>
                                        </a>
                                        <?php

                                    }

                                    $result->close();

                                }

                                ?>

                                <!--                            <a data-image="assets/images/product-image/organic/product-19.jpg" data-zoom-image="assets/images/product-image/organic/zoom/4.jpg">-->
                                <!--                                <img src="assets/images/product-image/organic/product-19.jpg" alt=""/> </a>-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12">
                    <div class="product-details-content">
                        <h2 style="margin-top: 0px; text-align: left; font-weight: bold; background-color: #fff; line-height: 36px; margin-bottom: 10px;"><?php echo $pr_titolo; ?></h2>
                        <p class="reference" style="padding-bottom: 10px">Categoria:<a href="<?php echo $ct_link; ?>"><span style="padding-right: 40px;"> <?php echo $ct_titolo; ?></span></a> Marca:<a href="<?php echo $mr_link; ?>"><span> <?php echo $mr_marchio; ?></span></a>
                        </p>
                        <div class="pro-details-rating-wrap">
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

                        </div>
                        <div class="pricing-meta" style="margin: 10px 0;">
                            <ul>
                                <?php if ($row_data['pr_prezzo_scontato'] > 0) { ?>
                                    <?php if ($row_data['pr_prezzo_scontato'] == $row_data['pr_prezzo']) { ?>
                                        <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></li>
                                    <?php } else { ?>
                                        <li class="old-price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></li>
                                        <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></li>
                                        <li class="discount-price">- <?php echo $row_data['pr_sconto']; ?>%</li>
                                    <?php } ?>
                                <?php } else { ?>
                                    <li class="current-price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <?php if ($row_data['pr_giacenza'] > 5) { ?>
                            <b>Disponibilit&agrave;:</b>
                            <span style="color: #198f35; font-weight: bold;">Disponibile</span>
                        <?php } else if ($row_data['pr_giacenza'] > 0 && $row_data['pr_giacenza'] <= 5) { ?>
                            <b>Disponibilit&agrave;:</b>
                            <span style="color: orange; font-weight: bold;">In esaurimento</span>
                        <?php } else if ($row_data['pr_giacenza'] == 0) { ?>
                            <b>Disponibilit&agrave;:</b> <span style="color: red; font-weight: bold;">Esaurito</span>
                        <?php } ?>

                        <div class="pro-details-quality">

                            <?php if (($pr_giacenza > 0) && ($pr_stato > 0)) { ?>

                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" min="1" max="<?php echo $pr_giacenza; ?>" value="1" id="pr_quantita"/>
                                </div>

                            <?php } ?>

                            <div class="pro-details-cart btn-hover">

                                <?php if (($pr_giacenza > 0) && ($pr_stato > 0)) { ?>

                                    <?php if (strlen($pr_prezzo) < 1 && strlen($pr_prezzo_scontato) < 1) { ?>
                                        <a class="button" data-codice="" style="background-color: #7f7f7f;">Non Disponibile</a>
                                    <?php } else { ?>
                                        <a href="javascript:;" class="button carrello-add" data-codice="<?php echo $pr_codice; ?>">Acquista</a>
                                    <?php }; ?>

                                <?php } else { ?>

                                    <b style="color: #ff1818; font-size: initial">Non disponibile</b>

                                <?php }; ?>

                            </div>
                        </div>


                        <?php if ($session_cl_login > 0) { ?>

                            <div class="pro-details-wish-com" style="margin-bottom: 7px;">
                                <div class="pro-details-wishlist wishlist-add" data-codice="<?php echo $pr_codice; ?>">
                                    <a href="javascript:;"><i class="ion-android-favorite-outline"></i>Aggiungi alla wishlist</a>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="pro-details-social-info" style="margin-top: 5px">
                            <span>Seguici sui social</span>
                            <div class="social-info">
                                <ul>
                                    <li>
                                        <a href="javascript:;"><i class="ion-social-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="ion-social-twitter"></i></a>
                                    </li>
                                    <!--                                    <li>-->
                                    <!--                                        <a href="#"><i class="ion-social-google"></i></a>-->
                                    <!--                                    </li>-->
                                    <li>
                                        <a href="javascript:;"><i class="ion-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php include "inc/tab-varianti.php"; ?>


                        <!--                        <div class="pro-details-policy">-->
                        <!--                            <ul>-->
                        <!--                                <li>-->
                        <!--                                    <img src="assets/images/icons/policy.png" alt=""/><span>Security Policy (Edit With Customer Reassurance Module)</span>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <img src="assets/images/icons/policy-2.png" alt=""/><span>Delivery Policy (Edit With Customer Reassurance Module)</span>-->
                        <!--                                </li>-->
                        <!--                                <li>-->
                        <!--                                    <img src="assets/images/icons/policy-3.png" alt=""/><span>Return Policy (Edit With Customer Reassurance Module)</span>-->
                        <!--                                </li>-->
                        <!--                            </ul>-->
                        <!--                        </div>-->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop details Area End -->
    <!-- product details description area start -->
    <div class="description-review-area mb-60px">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a class="active" data-toggle="tab" href="#des-details1">Descrizione</a>
                    <a data-toggle="tab" href="#des-details2">Dettagli</a>
                    <a data-toggle="tab" href="#des-details3">Recensioni (<?php echo $count_recensioni; ?>)</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper">
                            <ul>
                                <li><span>Peso</span> <?php echo $pr_peso > 0 ? $pr_peso . " kg" : "Non disponibile"; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <?php echo $row_data['pr_descrizione']; ?>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row" style="flex-wrap: wrap">

                            <?php
                            $exist_recensioni = existRecensioniCliente($pr_codice, $session_cl_codice, $dbConn);
                            if ($exist_recensioni < 1) {
                            } else {
                                ?>

                                <div class="col-lg-7" style="max-width: 100%; flex: unset;">
                                    <div class="review-wrapper">

                                        <?php
                                        $pr_cod = getCodRecensioni($get_pr_capofila);

                                        $querySql = "SELECT * FROM rc_recensioni WHERE rc_id > 0 AND (rc_pr_codice = '$pr_codice' OR rc_pr_codice = '$pr_cod') ORDER BY rc_timestamp DESC ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $rc_pr_codice = $row_data["rc_pr_codice"];
                                            $rc_nominativo = $row_data['rc_nominativo'];
                                            $rc_testo = $row_data["rc_testo"];
                                            $rc_voto = $row_data['rc_voto'];
                                            $rc_timestamp = date("d/m/Y", $row_data["rc_timestamp"]);
                                            ?>

                                            <div class="single-review">
                                                <div class="review-img">
                                                    <img style="width: 65%" src="assets/images/user.png"/>
                                                </div>
                                                <div class="review-content">
                                                    <div class="review-top-wrap">
                                                        <div class="review-left">
                                                            <div class="review-name">
                                                                <h4><?php echo $rc_nominativo ?></h4>
                                                            </div>
                                                            <div class="rating-product">
                                                                <?php
                                                                foreach (range(1, $rc_voto) as $number) echo "<i class='ion-android-star'></i>";
                                                                ?>
                                                                <!--<i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>-->
                                                            </div>
                                                        </div>
                                                        <!--<div class="review-left">
                                                            <a href="#">Reply</a>
                                                        </div>-->
                                                    </div>
                                                    <div class="review-bottom">
                                                        <p>
                                                            <?php echo $rc_testo ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        $result->close();
                                        ?>

                                    </div>
                                </div>

                                <?php
                            }
                            if ($session_cl_login > 0) {

                                $exist_recensioni = existRecensioniCliente($pr_codice, $session_cl_codice, $dbConn);
                                if ($exist_recensioni < 1) {
                                    ?>

                                    <div class="col-lg-5">
                                        <div class="ratting-form-wrapper pl-50">
                                            <h3>Aggiungi recensione</h3><br>
                                            <div class="ratting-form">
                                                <form id="review-form" method="POST" action="recensioni-add-do">
                                                    <div class="star-box">
                                                        <span>Lascia una valutazione: </span>
                                                        <div class="rating-product">

                                                            <label for="1"><i class="ion-android-star-outline"></i></label>
                                                            <input type="radio" id="1" name="rc_voto" value="1">

                                                            <label for="2"><i class="ion-android-star-outline"></i></label>
                                                            <input type="radio" id="2" name="rc_voto" value="2">

                                                            <label for="3"><i class="ion-android-star-outline"></i></label>
                                                            <input type="radio" id="3" name="rc_voto" value="3">

                                                            <label for="4"><i class="ion-android-star-outline"></i></label>
                                                            <input type="radio" id="4" name="rc_voto" value="4">

                                                            <label for="5"><i class="ion-android-star-outline"></i></label>
                                                            <input type="radio" id="5" name="rc_voto" value="5">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!--<div class="col-md-6">
                                                            <div class="rating-form-style mb-10">
                                                                <input placeholder="Name" type="text" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="rating-form-style mb-10">
                                                                <input placeholder="Email" type="email" />
                                                            </div>
                                                        </div>-->
                                                        <div class="col-md-12">
                                                            <div class="rating-form-style form-submit">
                                                                <textarea name="rc_testo" placeholder="Messaggio"></textarea>
                                                                <input type="hidden" name="rc_pr_codice" value="<?php echo $pr_codice; ?>">
                                                                <input type="hidden" name="rc_ut_codice" value="<?php echo $session_cl_codice; ?>">
                                                                <input type="hidden" name="refer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                                                <input type="submit" value="Invia"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <div class="comment_title">
                                        <p>Hai gi&agrave; lasciato una recensione per questo prodotto. </p>
                                    </div>
                                <?php } ?>

                            <?php } else { ?>
                                <div class="comment_title">
                                    <p>Accedi o registrati per lasciare una recensione per questo prodotto.</p>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->
    <!-- Recent Add Product Area Start -->
    <section class="recent-add-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title -->
                    <div class="section-title">
                        <h2>You Might Also Like</h2>
                        <p>Add Related products to weekly line up</p>
                    </div>
                    <!-- Section Title -->
                </div>
            </div>
            <!-- Recent Product slider Start -->
            <div class="recent-product-slider owl-carousel owl-nav-style">
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-11.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-12.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Originals Kaval Windbr...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€23.90</li>
                                <li class="current-price">€21.51</li>
                                <li class="discount-price">-10%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-1.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-1.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Juicy Couture Juicy Quil...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€35.90</li>
                                <li class="current-price">€34.21</li>
                                <li class="discount-price">-5%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-3.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-4.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Brixton Patrol All Terrai...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-6.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-6.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">New Balance Arishi Spo...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-22.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-15.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Calvin Klein Jeans Refle...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-14.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-14.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Madden by Steve Madd...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€12.90</li>
                                <li class="current-price">€10.21</li>
                                <li class="discount-price">-10%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
            </div>
            <!-- Recent product slider end -->
        </div>
    </section>
    <!-- Recent product area end -->
    <!-- Recent Add Product Area Start -->
    <section class="recent-add-area mt-30 mb-30px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title -->
                    <div class="section-title">
                        <h2>In The Same Category</h2>
                        <p>16 other products in the same category:</p>
                    </div>
                    <!-- Section Title -->
                </div>
            </div>
            <!-- Recent Product slider Start -->
            <div class="recent-product-slider owl-carousel owl-nav-style">
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-15.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-15.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Originals Kaval Windbr...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€23.90</li>
                                <li class="current-price">€21.51</li>
                                <li class="discount-price">-10%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-14.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-14.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Juicy Couture Juicy Quil...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€35.90</li>
                                <li class="current-price">€34.21</li>
                                <li class="discount-price">-5%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-22.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-23.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Brixton Patrol All Terrai...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-9.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-9.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">New Balance Arishi Spo...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-18.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-18.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Calvin Klein Jeans Refle...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€29.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-7.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-8.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Madden by Steve Madd...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€12.90</li>
                                <li class="current-price">€10.21</li>
                                <li class="discount-price">-10%</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-17.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-16.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Trans-Weight Hooded...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€11.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/organic/product-9.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/organic/product-9.jpg" alt=""/>
                        </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                        <h2><a href="single-product.html" class="product-link">Water and Wind Resist...</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price not-cut">€11.90</li>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart"><a class="cart-btn" href="#">ADD TO CART </a></li>
                            <li>
                                <a href="wishlist.html"><i class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li>
                                <a href="compare.html"><i class="ion-ios-shuffle-strong"></i></a>
                            </li>
                        </ul>
                    </div>
                </article>
                <!-- Single Item -->
            </div>
            <!-- Recent product slider end -->
        </div>
    </section>
    <!-- Recent product area end -->

    <!-- Footer Area start -->
    <?php include('inc/footer.php'); ?>
    <!--  Footer Area End -->

</div>

<?php include('inc/javascript.php'); ?>

<script>

    $(document).ready(function () {


        $('.ion-android-star-outline').addClass('notyet');

        $('.notyet.ion-android-star-outline').mouseover(function () {
            $(this).removeClass('ion-android-star-outline').addClass('ion-android-star');
            $(this).parent().prevAll().children().removeClass('ion-android-star-outline').addClass('ion-android-star');
        });

        $('.notyet.ion-android-star-outline').mouseleave(function () {
            $('.notyet.ion-android-star').removeClass('ion-android-star').addClass('ion-android-star-outline');
        });

        $('.ion-android-star-outline').click(function () {
            $('.ion-android-star').removeClass('notyet');
            $(this).parent().nextAll().children().off('mouseover');
        });

    });

</script>

</body>
</html>
