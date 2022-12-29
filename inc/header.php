<?php
function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

?>

<!-- Header Start -->
<header class="main-header home-10 responsive">
    <!-- Header Top Start -->
    <div class="header-top-nav">
        <div class="container">
            <div class="row">
                <!--Left Start-->
                <div class="col-lg-4 col-md-4">
                    <div class="left-text">
                        <p>Benvenuto su Cybek</p>
                    </div>
                </div>
                <!--Left End-->
                <!--Right Start-->
                <div class="col-lg-8 col-md-8 text-right">
                    <div class="header-right-nav">
                        <div class="dropdown-navs">
                            <ul>
                                <!-- Settings Start -->
                                <li class="dropdown after-n">
                                    <a class="angle-icon" href="javascript:;">Account</a>
                                    <ul class="dropdown-nav">
                                        <?php
                                        if ($session_cl_login == 0) {

                                            ?>
                                            <li><a href="login">Accedi</a></li>
                                            <li><a href="registrati">Registrati</a></li>
                                            <?php

                                        } else {

                                            ?>
                                            <li><a href="my-account">Dashboard</a></li>
                                            <li><a href="carrello">Carrello</a></li>
                                            <li><a href="logout">Logout</a></li>
                                            <?php

                                        }
                                        ?>
                                    </ul>
                                </li>
                                <!-- Settings End -->

                            </ul>
                        </div>
                    </div>
                </div>
                <!--Right End-->
            </div>
        </div>
    </div>
    <!-- Header Top End -->
    <!-- Header Buttom Start -->
    <div class="header-navigation d-none d-lg-block sticky-nav">
        <div class="container">
            <div class="row">
                <!-- Logo Start -->
                <div class="col-md-2 col-sm-2">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/logo/logo.jpg" alt=""/></a>
                    </div>
                </div>
                <!-- Logo End -->
                <div class="col-md-10 col-sm-10">
                    <!--Header Bottom Account Start -->
                    <div class="header_account_area">
                        <!--Main Navigation Start -->
                        <div class="main-navigation d-none d-lg-block">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="lista-prodotti.php">Prodotti</a></li>

                                <li class="menu-dropdown">
                                    <a href="javascript:;">Marche <i class="ion-ios-arrow-down"></i></a>
                                    <ul class="sub-menu">

                                        <?php
                                        headerGetMarca();
                                        function headerGetMarca()
                                        {
                                            global $dbConn;

                                            $querySql = "SELECT mr_id, mr_titolo FROM mr_marche WHERE mr_stato > 0 ";
                                            $result = $dbConn->query($querySql);
                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $mr_id = $row_data['mr_id'];
                                                $mr_titolo = $row_data['mr_titolo'];

                                                $mr_link = generateMarca2Link($mr_id);
                                                ?>
                                                <li><a href="<?php echo $mr_link; ?>"><?php echo $mr_titolo; ?></a></li>
                                                <?php
                                            }
                                            $result->close();
                                        }

                                        ?>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                        <!--Main Navigation End -->
                        <!--Cart info Start -->
                        <div class="cart-info d-flex">

                            <!--     <div class="header-right-nav">
                                     <div class="dropdown-navs">
                                         <ul>
                                             <li class="dropdown after-n">
                                                 <a class="angle-icon" href="#">Settings</a>
                                                 <ul class="dropdown-nav">
                                                     <li><a href="my-account.php">My Account</a></li>
                                                     <li><a href="checkout.php">Checkout</a></li>
                                                     <li><a href="login.php">Login</a></li>
                                                 </ul>
                                             </li>

                                         </ul>
                                     </div>
                                 </div>-->
                            <?php if ($session_cl_login > 0) { ?>
                                <a href="wishlist.php" title="Preferiti" class="count-cart heart"></a>
                            <?php } ?>

                            <div class="mini-cart-warp">
                                <a href="javascript:void(0)" class="count-cart"><span>&euro;0,00</span></a>
                                <div class="mini-cart-content">
                                    <!--                                    <ul>-->
                                    <!--                                        <li class="single-shopping-cart">-->
                                    <!--                                            <div class="shopping-cart-img">-->
                                    <!--                                                <a href="single-product.php"><img alt="" src="assets/images/product-image/mini-cart/1.jpg"/></a>-->
                                    <!--                                                <span class="product-quantity">1x</span>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="shopping-cart-title">-->
                                    <!--                                                <h4><a href="single-product.php">Juicy Couture...</a></h4>-->
                                    <!--                                                <span>$9.00</span>-->
                                    <!--                                                <div class="shopping-cart-delete">-->
                                    <!--                                                    <a href="#"><i class="ion-android-cancel"></i></a>-->
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                        </li>-->
                                    <!--                                        <li class="single-shopping-cart">-->
                                    <!--                                            <div class="shopping-cart-img">-->
                                    <!--                                                <a href="single-product.php"><img alt="" src="assets/images/product-image/mini-cart/2.jpg"/></a>-->
                                    <!--                                                <span class="product-quantity">1x</span>-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="shopping-cart-title">-->
                                    <!--                                                <h4><a href="single-product.php">Water and Wind...</a></h4>-->
                                    <!--                                                <span>$11.00</span>-->
                                    <!--                                                <div class="shopping-cart-delete">-->
                                    <!--                                                    <a href="#"><i class="ion-android-cancel"></i></a>-->
                                    <!--                                                </div>-->
                                    <!--                                            </div>-->
                                    <!--                                        </li>-->
                                    <!--                                    </ul>-->
                                    <div class="shopping-cart-total">
                                        <h4>Subtotal : <span>$20.00</span></h4>
                                        <h4>Shipping : <span>$7.00</span></h4>
                                        <h4>Taxes : <span>$0.00</span></h4>
                                        <h4 class="shop-total">Total : <span>$27.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-btn text-center">
                                        <a class="default-btn" href="checkout.php">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Cart info End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Header Bottom Account End -->
    <!-- Menu Content Start -->
    <div class="header-buttom-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left d-none d-lg-block">
                    <div class="d-flex align-items-start justify-content-start">
                        <!-- Beauty Category -->
                        <div class="beauty-category vertical-menu home-9 home-10">
                            <h3 class="vertical-menu-heading vertical-menu-toggle">Categorie</h3>
                            <ul class="vertical-menu-wrap open-menu-toggle">

                                <?php
                                $querySql = "SELECT ct_id, ct_categoria FROM ct_categorie WHERE ct_stato > 0 ";
                                $result = $dbConn->query($querySql);
                                $rows = $dbConn->affected_rows;

                                while (($row_data = $result->fetch_assoc()) !== NULL) {
                                    $ct_id = $row_data['ct_id'];
                                    $ct_categoria = $row_data['ct_categoria'];
                                    $ct_link = generateCatLink($ct_id);
                                    ?>
                                    <li>
                                        <a href="<?php echo $ct_link; ?>"><?php echo $ct_categoria; ?></a>
                                    </li>
                                    <?php
                                }
                                $result->close();
                                ?>

                                <!--                                <li class="hidden"><a href="#">Projectors</a></li>-->
                                <!--                                <li>-->
                                <!--                                    <a href="#" id="more-btn"><i class="ion-ios-plus-empty" aria-hidden="true"></i> More Categories</a>-->
                                <!--                                </li>-->
                            </ul>
                        </div>
                        <!-- Beauty Category -->
                        <!--Seach Area Start -->
                        <div class="header_account_list search_list">
                            <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                            <div class="dropdown_search">
                                <form action="<?php echo "$rootBasePath_http/ricerca"; ?>" method="post">
                                    <input placeholder="Cerca nello shop..." type="text" name="pr_search"/>
                                    <button type="submit">
                                        <i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                        </div>
                        <!--Seach Area End -->
                        <!--Contact info Start -->
                        <div class="contact-link-wrap">
                            <div class="contact-link">
                                <div class="phone">
                                    <p>Chiamaci:</p>
                                    <a href="tel:(+800)345678">(+800)1234</a>
                                </div>
                            </div>
                            <!--Contact info End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Content End -->
    <!-- Header Buttom Start -->
    <div class="header-navigation blue-bg sticky-nav d-lg-none">
        <div class="container position-relative">
            <div class="row">
                <!-- Logo Start -->
                <div class="col-md-2 col-sm-2">
                    <div class="logo">
                        <a href="index.php"><img src="assets/images/logo/logo-electronic.jpg" alt=""/></a>
                    </div>
                </div>
                <!-- Logo End -->
                <!-- Navigation Start -->
                <div class="col-md-10 col-sm-10">
                    <!--Main Navigation End -->
                    <!--Header Bottom Account Start -->
                    <div class="header_account_area">
                        <!--Seach Area Start -->
                        <div class="header_account_list search_list">
                            <a href="javascript:void(0)"><i class="ion-ios-search-strong"></i></a>
                            <div class="dropdown_search">
                                <form action="<?php echo "$rootBasePath_http/ricerca"; ?>" method="post">
                                    <input placeholder="Cerca nello shop..." type="text" name="pr_search"/>
                                    <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                </form>
                            </div>
                        </div>
                        <!--Seach Area End -->
                        <!--Contact info Start -->
                        <div class="contact-link">
                            <div class="phone">
                                <p>Call us:</p>
                                <a href="tel:(+800)345678">(+800)345678</a>
                            </div>
                        </div>
                        <!--Contact info End -->
                        <!--Cart info Start -->
                        <div class="cart-info d-flex">
                            <a href="compare.php" class="count-cart random d-xs-none"></a>
                            <a href="wishlist.php" class="count-cart heart d-xs-none"></a>
                            <div class="mini-cart-warp">
                                <a href="#" class="count-cart"><span>$20.00</span></a>
                                <div class="mini-cart-content">
                                    <ul>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="single-product.php"><img alt="" src="assets/images/product-image/mini-cart/1.jpg"/></a>
                                                <span class="product-quantity">1x</span>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="single-product.php">Juicy Couture...</a></h4>
                                                <span>$9.00</span>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="ion-android-cancel"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="single-product.php"><img alt="" src="assets/images/product-image/mini-cart/2.jpg"/></a>
                                                <span class="product-quantity">1x</span>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="single-product.php">Water and Wind...</a></h4>
                                                <span>$11.00</span>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="ion-android-cancel"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-total">
                                        <h4>Subtotal : <span>$20.00</span></h4>
                                        <h4>Shipping : <span>$7.00</span></h4>
                                        <h4>Taxes : <span>$0.00</span></h4>
                                        <h4 class="shop-total">Total : <span>$27.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-btn text-center">
                                        <a class="default-btn" href="checkout.php">checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Cart info End -->
                    </div>
                </div>
            </div>
            <!-- mobile menu -->
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="lista-prodotti.php">Prodotti</a></li>

                            <li class="menu-dropdown">
                                <a href="javascript:;">Marche <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">

                                    <?php
                                    headerGetMarca();
                                    ?>

                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- mobile menu end-->
        </div>
    </div>
    <!--Header Bottom Account End -->
    <!-- Beauty Category -->
    <div class="container d-lg-none">
        <!--=======  category menu  =======-->
        <div class="hero-side-category">
            <!-- Category Toggle Wrap -->
            <div class="category-toggle-wrap">
                <!-- Category Toggle -->
                <button class="category-toggle"><i class="fa fa-bars"></i> Tutte le Categorie</button>
            </div>

            <!-- Category Menu -->
            <nav class="category-menu">
                <ul>

                    <?php
                    $querySql = "SELECT ct_id, ct_categoria FROM ct_categorie WHERE ct_stato > 0 ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row_data = $result->fetch_assoc()) !== NULL) {
                        $ct_id = $row_data['ct_id'];
                        $ct_categoria = $row_data['ct_categoria'];
                        $ct_link = generateCatLink($ct_id);
                        ?>
                        <li>
                            <a href="<?php echo $ct_link; ?>"><?php echo $ct_categoria; ?></a>
                        </li>
                        <?php
                    }
                    $result->close();
                    ?>

                </ul>
            </nav>
        </div>

        <!--=======  End of category menu =======-->
    </div>
    <!-- Beauty Category -->
</header>