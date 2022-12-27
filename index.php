<?php include('inc/autoloader.php'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Cybek</title>
    <meta name="description" content="Vendita di prodotti informatici"/>
    <?php include('inc/head.php'); ?>
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

    <?php include('inc/header-index.php'); ?>

    <!-- Slider Arae Start -->
    <div class="slider-area">
        <div class="slider-active-3 owl-carousel slider-hm8 owl-dot-style">
            <!-- Slider Single Item Start -->
            <div class="slider-height-10 d-flex align-items-start justify-content-start bg-img" style="background-image: url(assets/images/slider-image/1.jpg); background-position: unset !important;">
                <div class="container">
                    <div class="slider-content-5 slider-animated-1 text-left">
                        <!--                        <span class="animated">Apple</span>-->
                        <h1 class="animated">
                            <strong> NUOVI IPHONE </strong><br/> Sono arrivati i nuovi modelli
                        </h1>
                        <p class="animated">Verifica nello shop</p>
                        <a href="<?php echo generateMarca2Link(3); ?>" class="shop-btn animated">VAI ORA</a>
                    </div>
                </div>
            </div>
            <!-- Slider Single Item End -->
            <!-- Slider Single Item Start -->
            <div class="slider-height-10 d-flex align-items-start justify-content-start bg-img" style="background-image: url(assets/images/slider-image/2.png);">
                <div class="container">
                    <div class="slider-content-5 slider-animated-1 text-left">
                        <!--                        <span class="animated">EXPLORE MORE</span>-->
                        <h1 class="animated">
                            <strong>SAMSUNG</strong><br/> Scopri tutti i modelli
                        </h1>
                        <!--                        <p class="animated">Scopri tutti i modelli</p>-->
                        <a href="<?php echo generateMarca2Link(2); ?>" class="shop-btn animated">VAI ORA</a>
                    </div>
                </div>
            </div>
            <!-- Slider Single Item End -->
        </div>
    </div>
    <!-- Slider Arae End -->
    <!-- Static Area Start -->
    <section class="static-area home-10">
        <div class="container">
            <div class="static-area-wrap">
                <div class="row">
                    <!-- Static Single Item Start -->
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0">
                            <img src="assets/images/icons/static-icons-1.png" alt="" class="img-responsive"/>
                            <div class="single-static-meta">
                                <h4>Spedizione Gratuita</h4>
                                <p>Per gli ordini superiori a &euro;29,90</p>
                            </div>
                        </div>
                    </div>
                    <!-- Static Single Item End -->
                    <!-- Static Single Item Start -->
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <div class="single-static pb-res-md-0 pb-res-sm-0 pb-res-xs-0 pt-res-xs-20">
                            <img src="assets/images/icons/static-icons-2.png" alt="" class="img-responsive"/>
                            <div class="single-static-meta">
                                <h4>Possibilit&agrave; di reso</h4>
                                <p>Entro 14 giorni dall'acquisto</p>
                            </div>
                        </div>
                    </div>
                    <!-- Static Single Item End -->
                    <!-- Static Single Item Start -->
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <div class="single-static pt-res-md-30 pb-res-sm-30 pb-res-xs-0 pt-res-xs-20">
                            <img src="assets/images/icons/static-icons-3.png" alt="" class="img-responsive"/>
                            <div class="single-static-meta">
                                <h4>Pagamenti sicuri al 100%</h4>
                                <p>Non corri rischi con noi.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Static Single Item End -->
                    <!-- Static Single Item Start -->
                    <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
                        <div class="single-static pt-res-md-30 pb-res-sm-30 pt-res-xs-20">
                            <img src="assets/images/icons/static-icons-4.png" alt="" class="img-responsive"/>
                            <div class="single-static-meta">
                                <h4>Supporto 24/7</h4>
                                <p>Contatta la nostra assistenza</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Static Area End -->

    <!-- Best Sells Area Start -->
    <section class="best-sells-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2>I pi&ugrave; venduti</h2>
                        <p>I prodotti pi&ugrave; venduti</p>
                    </div>
                    <!-- Section Title Start -->
                </div>
            </div>
            <!-- Best Sell Slider Carousel Start -->
            <div class="best-sell-slider owl-carousel owl-nav-style">
                <!-- Single Item -->

                <?php
                $querySql = "
                                 SELECT * FROM pr_prodotti
                                 WHERE pr_immagine != '' AND pr_stato > 0 AND pr_giacenza > 0
                                 ORDER BY RAND() LIMIT 0,10
                                ";
                $result = $dbConn->query($querySql);
                $rows = $dbConn->affected_rows;

                while (($row = $result->fetch_assoc()) !== NULL) {
                    $pr_id = $row['pr_id'];
                    $pr_codice = $row['pr_codice'];
                    $pr_prezzo_scontato = $row['pr_prezzo_scontato'];
                    $pr_prezzo = $row['pr_prezzo'];
                    $pr_link = generateProductLink($pr_id);
                    $pr_titolo = $row['pr_titolo'];
                    $pr_giacenza = $row['pr_giacenza'];

                    $mr_marchio = getMarca($row['pr_mr_id']);
                    $mr_link = generateMarca2Link($row['pr_mr_id']);

                    $pr_immagine = strlen($row['pr_immagine']) > 0 && is_file("upload/prodotti/" . $row['pr_immagine'])
                        ? "upload/prodotti/" . $row['pr_immagine']
                        : "assets/images/prodotto-dummy.jpg";
                    $pi_immagine = getImg2Prodotto($pr_id);
                    ?>

                    <article class="list-product">
                        <div class="img-block">
                            <a href="<?php echo $pr_link; ?>" class="thumbnail">
                                <img class="first-img" src="<?php echo $pr_immagine; ?>" alt=""/>
                                <img style="background: white" class="second-img" src="<?php echo $pi_immagine; ?>" alt=""/>
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

                            <h3>
                                <a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $row['pr_titolo']; ?></a>
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
                                    <?php if ($row['pr_prezzo_scontato'] > 0) { ?>
                                        <?php if ($row['pr_prezzo_scontato'] == $row['pr_prezzo']) { ?>
                                            <li class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo_scontato']); ?></li>
                                        <?php } else { ?>
                                            <li class="old-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></li>
                                            <li class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo_scontato']); ?></li>
                                            <li class="discount-price">- <?php echo formatPercent($row['pr_sconto']); ?>%</li>
                                            <!-- <li class="discount-price">- <?php echo formatPercent($pr_sconto); ?>%</li> -->
                                        <?php } ?>
                                    <?php } else { ?>
                                        <li class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="add-to-link">
                            <ul>
                                <li class="cart">
                                    <?php if ($row['pr_giacenza'] > 1) { ?>
                                        <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                    <?php } else if ($row['pr_giacenza'] == 1) { ?>
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

                    <?php
                }
                $result->close();
                ?>


            </div>
            <!-- Best Sell Slider Carousel End -->
        </div>
    </section>
    <!-- Best Sell Area End -->

    <!-- Banner Area Start -->
    <div class="banner-3-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="banner-wrapper mb-30px">
                        <a href="<?php echo generateMarca2Link(3); ?>"><img src="assets/images/banner-1.jpg" style="height: 260px;" alt=""/></a>
                    </div>
                    <div class="banner-wrapper mb-res-sm-30">
                        <a href="<?php echo generateMarca2Link(2); ?>"><img src="assets/images/banner-2.jpg" style="height: 260px;" alt=""/></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-res-xs-30">
                    <div class="banner-wrapper">
                        <a href="<?php echo generateMarca2Link(4); ?>"><img src="assets/images/banner-3.jpg" style="height: 550px; object-fit: cover" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area End -->


    <!-- Recent Add Product Area Start -->
    <section class="recent-add-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title -->
                    <div class="section-title">
                        <h2>New Arrivals</h2>
                        <p>Add new products to weekly line up</p>
                    </div>
                    <!-- Section Title -->
                </div>
            </div>
            <!-- Recent Product slider Start -->
            <div class="recent-product-slider owl-carousel owl-nav-style">
                <div class="product-inner-item">
                    <!-- Single Item -->
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/> </a>
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
                                <img class="first-img" src="assets/images/product-image/electronic/9.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/10.jpg" alt=""/>
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
                                    <li class="current-price">€34.11</li>
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
                </div>
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/11.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/11.jpg" alt=""/>
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
                            <h2><a href="single-product.html" class="product-link">Brixton Patrol All Terr...</a></h2>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/14.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/2.jpg" alt=""/> </a>
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
                            <h2><a href="single-product.html" class="product-link">New Luxury Men's Slim...</a></h2>
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
                </div>
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/3.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/3.jpg" alt=""/> </a>
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
                                    <li class="old-price">€35.90</li>
                                    <li class="current-price">€34.11</li>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/4.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/4.jpg" alt=""/> </a>
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
                                    <li class="current-price">€34.11</li>
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
                </div>
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/10.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/10.jpg" alt=""/>
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
                                    <li class="old-price">€11.90</li>
                                    <li class="current-price">€10.12</li>
                                    <li class="discount-price">-15%</li>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/7.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/> </a>
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
                                    <li class="old-price not-cut">€19.90</li>
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
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/12.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/12.jpg" alt=""/>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/> </a>
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
                            <h2><a href="single-product.html" class="product-link">New Balance Fresh Foa...</a></h2>
                            <div class="rating-product">
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price">€18.90</li>
                                    <li class="current-price">€15.11</li>
                                    <li class="discount-price">-20%</li>
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
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/13.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/13.jpg" alt=""/>
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
                            <h2><a href="single-product.html" class="product-link">Juicy Couture Solid Slee...</a></h2>
                            <div class="rating-product">
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">€18.90</li>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/6.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/5.jpg" alt=""/> </a>
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
                            <h2><a href="single-product.html" class="product-link">New Balance Fresh Foa...</a></h2>
                            <div class="rating-product">
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price not-cut">€18.90</li>
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
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/15.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/15.jpg" alt=""/>
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
                                    <li class="old-price">€11.90</li>
                                    <li class="current-price">€10.12</li>
                                    <li class="discount-price">-15%</li>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/> </a>
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
                                    <li class="old-price not-cut">€19.90</li>
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
                <!-- Single Item -->
                <div class="product-inner-item">
                    <article class="list-product mb-30px">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/5.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/6.jpg" alt=""/> </a>
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
                    <article class="list-product">
                        <div class="img-block">
                            <a href="single-product.html" class="thumbnail">
                                <img class="first-img" src="assets/images/product-image/electronic/7.jpg" alt=""/>
                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/> </a>
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
                            <h2><a href="single-product.html" class="product-link">New Balance Fresh Foa...</a></h2>
                            <div class="rating-product">
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                <i class="ion-android-star"></i>
                            </div>
                            <div class="pricing-meta">
                                <ul>
                                    <li class="old-price">€18.90</li>
                                    <li class="current-price">€15.11</li>
                                    <li class="discount-price">-20%</li>
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
                <!-- Single Item -->
            </div>
            <!-- Recent Area Slider End -->
        </div>
    </section>
    <!-- Recent product area end -->
    <!-- Banner Area 2 Start -->
    <div class="banner-area-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-inner">
                        <a href="<?php echo generateMarca2Link(6); ?>"><img style="object-fit: cover; height: 296px; object-position: 0px -120px;" src="assets/images/sony.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area 2 End -->


    <?php include('inc/brand.php'); ?>

    <?php include('inc/footer.php'); ?>

</div>


<?php include('inc/javascript.php'); ?>

</body>
</html>
