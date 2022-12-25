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
    <!-- Banner Area Start -->
    <div class="banner-3-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="banner-wrapper mb-30px">
                        <a href="<?php echo generateMarca2Link(3); ?>"><img src="assets/images/banner-1.jpg" style="height: 260px; object-fit: cover" alt=""/></a>
                    </div>
                    <div class="banner-wrapper mb-res-sm-30">
                        <a href="<?php echo generateMarca2Link(2); ?>"><img src="assets/images/banner-2.jpg" style="height: 260px; object-fit: cover" alt=""/></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-res-xs-30">
                    <div class="banner-wrapper">
                        <a href="shop-4-column.html"><img src="assets/images/banner-image/23.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area End -->
    <!-- Best Sells Area Start -->
    <section class="best-sells-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h2>Best Sellers</h2>
                        <p>Add bestselling products to weekly line up</p>
                    </div>
                    <!-- Section Title Start -->
                </div>
            </div>
            <!-- Best Sell Slider Carousel Start -->
            <div class="best-sell-slider owl-carousel owl-nav-style">
                <!-- Single Item -->
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
                        <h2><a href="single-product.html" class="product-link">Juicy Couture Juicy Quilted Ter..</a>
                        </h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€18.90</li>
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
                            <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
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
                        <h2><a href="single-product.html" class="product-link">New Balance Fresh Foam Ka..</a></h2>
                        <div class="rating-product">
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                            <i class="ion-android-star"></i>
                        </div>
                        <div class="pricing-meta">
                            <ul>
                                <li class="old-price">€18.90</li>
                                <li class="current-price">€15.12</li>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
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
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Brixton Patrol All Terrain Ano..</a></h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
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
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNER</span></a>
                        <h2><a href="single-product.html" class="product-link">Juicy Couture Tricot Logo Strip..</a>
                        </h2>
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
                <!-- Single Item -->
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
                        <h2><a href="single-product.html" class="product-link">New Balance Arishi Sport v1</a></h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/9.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/electronic/10.jpg" alt=""/> </a>
                        <div class="quick-view">
                            <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                <i class="ion-ios-search-strong"></i> </a>
                        </div>
                    </div>
                    <ul class="product-flag">
                        <li class="new">New</li>
                    </ul>
                    <div class="product-decs">
                        <a class="inner-link" href="shop-4-column.html"><span>GRAPHIC CORNAR</span></a>
                        <h2><a href="single-product.html" class="product-link">Fila Locker Room Varsity Jacket</a></h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/11.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/electronic/11.jpg" alt=""/> </a>
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
                        <h2><a href="single-product.html" class="product-link">Water and Wind Resistant Ins..</a></h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/12.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/electronic/12.jpg" alt=""/> </a>
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
                        <h2><a href="single-product.html" class="product-link">New Luxury Men's Slim Fit Shi...</a></h2>
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
                            <img class="first-img" src="assets/images/product-image/electronic/13.jpg" alt=""/>
                            <img class="second-img" src="assets/images/product-image/electronic/13.jpg" alt=""/> </a>
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
                        <h2><a href="single-product.html" class="product-link">Originals Kaval Windbreaker...</a></h2>
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
                        <h2><a href="single-product.html" class="product-link">Brixton Patrol All Terrain Anor...</a>
                        </h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
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
                        <h2><a href="single-product.html" class="product-link">Madden by Steve Madden Cale 6</a></h2>
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
                <!-- Single Item -->
                <article class="list-product">
                    <div class="img-block">
                        <a href="single-product.html" class="thumbnail">
                            <img class="first-img" src="assets/images/product-image/electronic/3.jpg" alt=""/>
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
                        <h2><a href="single-product.html" class="product-link">Juicy Couture Juicy Quilted Ter..</a>
                        </h2>
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
                <!-- Single Item -->
            </div>
            <!-- Best Sell Slider Carousel End -->
        </div>
    </section>
    <!-- Best Sell Area End -->
    <!-- Category Area Start -->
    <section class="categorie-area mb-60px mt-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Section Title -->
                    <div class="section-title mt-res-sx-30px mt-res-md-30px">
                        <h2>Popular Categories</h2>
                        <p>Add Popular Categories to weekly line up</p>
                    </div>
                    <!-- Section Title -->
                </div>
            </div>
            <!-- Category Slider Start -->
            <div class="category-slider owl-carousel owl-nav-style">
                <!-- Single item -->
                <div class="category-item">
                    <div class="category-list mb-30px">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-1.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Vegetables</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <div class="category-list">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-2.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Salad & Dips</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Single item -->
                <div class="category-item">
                    <div class="category-list mb-30px">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-3.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Fruit</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <div class="category-list">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-4.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Baking & Cooking</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Single item -->
                <div class="category-item">
                    <div class="category-list mb-30px">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-5.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Cream & Custard</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <div class="category-list">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-6.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Milk, Butter & Eggs</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Single item -->
                <div class="category-item">
                    <div class="category-list mb-30px">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-7.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Spreads & Margarine</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                    <div class="category-list">
                        <div class="category-thumb">
                            <a href="shop-4-column.html">
                                <img src="assets/images/product-image/electronic/thumb-8.jpg" alt=""/> </a>
                        </div>
                        <div class="desc-listcategoreis">
                            <div class="name_categories">
                                <h4>Fresh Vegetables</h4>
                            </div>
                            <span class="number_product">17 Products</span> <a href="shop-4-column.html"> Shop Now
                                <i class="ion-android-arrow-dropright-circle"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Single item -->
            </div>
        </div>
    </section>
    <!-- Category Area End  -->
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
                        <a href="shop-4-column.html"><img src="assets/images/banner-image/28.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area 2 End -->
    <!-- Category Product  Area start-->
    <section class="category-product-area home-10">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-9">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-4">
                            <!-- Section Title -->
                            <div class="section-title">
                                <h2>Audio & Video</h2>
                            </div>
                            <!-- Section Title -->
                            <div class="category-product-slider owl-carousel responsive-owl-nav-style owl-nav-style">
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2><a href="single-product.html" class="product-link">Water and Wind...</a>
                                            </h2>
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
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/14.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Originals Kaval Win...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/3.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/4.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
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
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/5.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/6.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
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
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/7.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Originals Kaval Win...</a>
                                            </h2>
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
                                    </article>
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/12.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/13.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
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
                                    </article>
                                    <article class="list-product">
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Originals Kaval Win...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
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
                                    </article>
                                </div>
                                <!-- Single Item -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-4">
                            <!-- Section Title -->
                            <div class="section-title mt-res-sx-30px mt-res-md-30px">
                                <h2>Camera & Photo</h2>
                            </div>
                            <!-- Section Title -->
                            <div class="category-product-slider owl-carousel responsive-owl-nav-style owl-nav-style">
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/5.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/6.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/7.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Brixton Patrol Terr...</a>
                                            </h2>
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
                                    </article>
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
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
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/14.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Brixton Patrol Terr...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price not-cut">€10.90</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/3.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/4.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€20.90</li>
                                                    <li class="current-price">€15.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Brixton Patrol Terr...</a>
                                            </h2>
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
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/10.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Balance Fresh...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-4">
                            <!-- Section Title -->
                            <div class="section-title mt-res-sx-30px mt-res-md-30px">
                                <h2>Smart Electronics</h2>
                            </div>
                            <!-- Section Title -->
                            <div class="category-product-slider owl-carousel responsive-owl-nav-style owl-nav-style">
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/12.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/13.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2><a href="single-product.html" class="product-link">Water and Wind...</a>
                                            </h2>
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
                                    </article>
                                    <article class="list-product">
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Luxury Men's...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€19.90</li>
                                                    <li class="current-price">€15.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Trans-Weight Ho...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price not-cut">€14.90</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/5.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/6.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€12.90</li>
                                                    <li class="current-price">€11.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/7.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/8.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Luxury Slim...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price not-cut">€9.90</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
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
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Trans-Weight Ho...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€29.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                                <div class="feature-slider-item">
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/1.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Juicy Couture Solid...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€15.90</li>
                                                    <li class="current-price">€10.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/2.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/14.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">New Luxury Slim...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price not-cut">€9.90</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="list-product">
                                        <div class="img-block">
                                            <a href="single-product.html" class="thumbnail">
                                                <img class="first-img" src="assets/images/product-image/electronic/3.jpg" alt=""/>
                                                <img class="second-img" src="assets/images/product-image/electronic/4.jpg" alt=""/>
                                            </a>
                                            <div class="quick-view">
                                                <a class="quick_view" href="#" data-link-action="quickview" title="Quick view" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="ion-ios-search-strong"></i> </a>
                                            </div>
                                        </div>
                                        <div class="product-decs">
                                            <a class="inner-link" href="shop-4-column.html"><span>STUDIO DESIGN</span></a>
                                            <h2>
                                                <a href="single-product.html" class="product-link">Trans-Weight Ho...</a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i> <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="pricing-meta">
                                                <ul>
                                                    <li class="old-price">€25.90</li>
                                                    <li class="current-price">€21.51</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- Single Item -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-12 d-lg-none d-xl-block col-xl-3 mtb-res-sm-30 mtb-res-md-30">
                    <div class="banner-inner">
                        <a href="shop-4-column.html"><img src="assets/images/banner-image/29.jpg" alt="" class="img-responsive"/></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Product  Area end-->

    <?php include('inc/brand.php'); ?>

    <?php include('inc/footer.php'); ?>

</div>


<?php include('inc/javascript.php'); ?>

</body>
</html>
