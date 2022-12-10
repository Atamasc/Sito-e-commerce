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
                        <?php if ($session_cl_login == 0) { ?>
                            <p>Benvenuto su Cybek</p>
                        <?php } else { ?>

                        <?php } ?>
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
                        <a href="index.php"><img src="assets/images/logo/logo-electronic-2.jpg" alt=""/></a>
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
                                <li><a href="blog.php">Blog</a></li>
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
                                <a href="wishlist.php" class="count-cart heart"></a>
                            <?php } ?>

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
        </div>
    </div>
    <!--Header Bottom Account End -->
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
                                <form action="#">
                                    <input placeholder="Search entire store here ..." type="text"/>
                                    <div class="search-category">
                                        <select class="bootstrap-select" name="poscats">
                                            <option value="0">All categories</option>
                                            <option value="68">
                                                Electronics
                                            </option>
                                            <option value="69">
                                                - - Accessories &amp; Parts
                                            </option>
                                            <option value="75">
                                                - - - - Cables &amp; Adapters
                                            </option>
                                            <option value="76">
                                                - - - - Batteries
                                            </option>
                                            <option value="77">
                                                - - - - Chargers
                                            </option>
                                            <option value="78">
                                                - - - - Bags &amp; Cases
                                            </option>
                                            <option value="79">
                                                - - - - Electronic Cigarettes
                                            </option>
                                            <option value="70">
                                                - - Audio &amp; Video
                                            </option>
                                            <option value="80">
                                                - - - - Televisions
                                            </option>
                                            <option value="81">
                                                - - - - TV Receivers
                                            </option>
                                            <option value="82">
                                                - - - - Projectors
                                            </option>
                                            <option value="83">
                                                - - - - Audio Amplifier Boards
                                            </option>
                                            <option value="84">
                                                - - - - TV Sticks
                                            </option>
                                            <option value="71">
                                                - - Camera &amp; Photo
                                            </option>
                                            <option value="85">
                                                - - - - Digital Cameras
                                            </option>
                                            <option value="86">
                                                - - - - Camcorders
                                            </option>
                                            <option value="87">
                                                - - - - Camera Drones
                                            </option>
                                            <option value="88">
                                                - - - - Action Cameras
                                            </option>
                                            <option value="89">
                                                - - - - Photo Studio Supplies
                                            </option>
                                            <option value="72">
                                                - - Portable Audio &amp; Video
                                            </option>
                                            <option value="90">
                                                - - - - Headphones
                                            </option>
                                            <option value="91">
                                                - - - - Speakers
                                            </option>
                                            <option value="92">
                                                - - - - MP3 Players
                                            </option>
                                            <option value="93">
                                                - - - - VR/AR Devices
                                            </option>
                                            <option value="94">
                                                - - - - Microphones
                                            </option>
                                            <option value="73">
                                                - - Smart Electronics
                                            </option>
                                            <option value="95">
                                                - - - - Wearable Devices
                                            </option>
                                            <option value="96">
                                                - - - - Smart Home Appliances
                                            </option>
                                            <option value="97">
                                                - - - - Smart Remote Controls
                                            </option>
                                            <option value="98">
                                                - - - - Smart Watches
                                            </option>
                                            <option value="99">
                                                - - - - Smart Wristbands
                                            </option>
                                            <option value="74">
                                                - - Video Games
                                            </option>
                                            <option value="100">
                                                - - - - Handheld Game Players
                                            </option>
                                            <option value="101">
                                                - - - - Game Controllers
                                            </option>
                                            <option value="102">
                                                - - - - Joysticks
                                            </option>
                                            <option value="103">
                                                - - - - Stickers
                                            </option>
                                        </select>
                                    </div>
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
                            <li>
                                <a href="index.php">HOME</a>
                                <ul>
                                    <li>
                                        <a href="#">Home Organic</a>
                                        <ul>
                                            <li><a href="index.php">Organic 1</a></li>
                                            <li><a href="index-2.php">Organic 2</a></li>
                                            <li><a href="index-3.php">Organic 3</a></li>
                                            <li><a href="index-4.php">Organic 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Cosmetic</a>
                                        <ul>
                                            <li><a href="index-5.php">Cosmetic 1</a></li>
                                            <li><a href="index-6.php">Cosmetic 2</a></li>
                                            <li><a href="index-7.php">Cosmetic 3</a></li>
                                            <li><a href="index-8.php">Cosmetic 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Digital</a>
                                        <ul>
                                            <li><a href="index-9.php">Digital 1</a></li>
                                            <li><a href="index-10.php">Digital 2</a></li>
                                            <li><a href="index-11.php">Digital 3</a></li>
                                            <li><a href="index-12.php">Digital 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Furniture</a>
                                        <ul>
                                            <li><a href="index-13.php">Furniture 1</a></li>
                                            <li><a href="index-14.php">Furniture 2</a></li>
                                            <li><a href="index-15.php">Furniture 3</a></li>
                                            <li><a href="index-16.php">Furniture 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Medical</a>
                                        <ul>
                                            <li><a href="index-17.php">Medical 1</a></li>
                                            <li><a href="index-18.php">Medical 2</a></li>
                                            <li><a href="index-19.php">Medical 3</a></li>
                                            <li><a href="index-20.php">Medical 4</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Shop</a>
                                <ul>
                                    <li>
                                        <a href="#">Shop Grid</a>
                                        <ul>
                                            <li><a href="shop-3-column.php">Shop Grid 3 Column</a></li>
                                            <li><a href="shop-4-column.php">Shop Grid 4 Column</a></li>
                                            <li><a href="shop-left-sidebar.php">Shop Grid Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.php">Shop Grid Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Shop List</a>
                                        <ul>
                                            <li><a href="shop-list.php">Shop List</a></li>
                                            <li><a href="shop-list-left-sidebar.php">Shop List Left Sidebar</a>
                                            </li>
                                            <li><a href="shop-list-right-sidebar.php">Shop List Right Sidebar</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Single Shop</a>
                                        <ul>
                                            <li><a href="single-product.php">Shop Single</a></li>
                                            <li><a href="single-product-variable.php">Shop Variable</a></li>
                                            <li><a href="single-product-affiliate.php">Shop Affiliate</a></li>
                                            <li><a href="single-product-group.php">Shop Group</a></li>
                                            <li><a href="single-product-tabstyle-2.php">Shop Tab 2</a></li>
                                            <li><a href="single-product-tabstyle-3.php">Shop Tab 3</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Single Shop</a>
                                        <ul>
                                            <li><a href="single-product-slider.php">Shop Slider</a></li>
                                            <li><a href="single-product-gallery-left.php">Shop Gallery Left</a>
                                            </li>
                                            <li><a href="single-product-gallery-right.php">Shop Gallery Right</a>
                                            </li>
                                            <li><a href="single-product-sticky-left.php">Shop Sticky Left</a></li>
                                            <li><a href="single-product-sticky-right.php">Shop Sticky Right</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li><a href="about.php">About Page</a></li>
                                    <li><a href="cart.php">Cart Page</a></li>
                                    <li><a href="checkout.php">Checkout Page</a></li>
                                    <li><a href="compare.php">Compare Page</a></li>
                                    <li><a href="login.php">Login & Regiter Page</a></li>
                                    <li><a href="my-account.php">Account Page</a></li>
                                    <li><a href="wishlist.php">Wishlist Page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog-grid-left-sidebar.php">Blog Grid Left Sidebar</a></li>
                                    <li><a href="blog-grid-right-sidebar.php">Blog Grid Right Sidebar</a></li>
                                    <li><a href="blog-list-left-sidebar.php">Blog List Left Sidebar</a></li>
                                    <li><a href="blog-list-right-sidebar.php">Blog List Right Sidebar</a></li>
                                    <li><a href="blog-single-left-sidebar.php">Blog Single Left Sidebar</a></li>
                                    <li><a href="blog-single-right-sidebar.php">Blog Single Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.php">Contact Us</a></li>
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
                <button class="category-toggle"><i class="fa fa-bars"></i> All Categories</button>
            </div>

            <!-- Category Menu -->
            <nav class="category-menu">
                <ul>
                    <li class="menu-item-has-children menu-item-has-children-1">
                        <a href="#">Accessories & Parts<i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-1">
                            <li><a href="#">Cables & Adapters</a></li>
                            <li><a href="#">Batteries</a></li>
                            <li><a href="#">Chargers</a></li>
                            <li><a href="#">Bags & Cases</a></li>
                            <li><a href="#">Electronic Cigarettes</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children menu-item-has-children-2">
                        <a href="#">Camera & Photo<i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-2">
                            <li><a href="#">Digital Cameras</a></li>
                            <li><a href="#">Camcorders</a></li>
                            <li><a href="#">Camera Drones</a></li>
                            <li><a href="#">Action Cameras</a></li>
                            <li><a href="#">Photo Studio Supplies</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children menu-item-has-children-3">
                        <a href="#">Smart Electronics <i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-3">
                            <li><a href="#">Wearable Devices</a></li>
                            <li><a href="#">Smart Home Appliances</a></li>
                            <li><a href="#">Smart Remote Controls</a></li>
                            <li><a href="#">Smart Watches</a></li>
                            <li><a href="#">Smart Wristbands</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children menu-item-has-children-4">
                        <a href="#">Audio & Video <i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-4">
                            <li><a href="#">Televisions</a></li>
                            <li><a href="#">TV Receivers</a></li>
                            <li><a href="#">Projectors</a></li>
                            <li><a href="#">Audio Amplifier Boards</a></li>
                            <li><a href="#">TV Sticks</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children menu-item-has-children-5">
                        <a href="#">Portable Audio & Video <i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-5">
                            <li><a href="#">Headphones</a></li>
                            <li><a href="#">Speakers</a></li>
                            <li><a href="#">MP3 Players</a></li>
                            <li><a href="#">VR/AR Devices</a></li>
                            <li><a href="#">Microphones</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children menu-item-has-children-6">
                        <a href="#">Video Game <i class="ion-ios-arrow-down"></i></a>
                        <!-- category submenu -->
                        <ul class="category-mega-menu category-mega-menu-6">
                            <li><a href="#">Handheld Game Players</a></li>
                            <li><a href="#">Game Controllers</a></li>
                            <li><a href="#">Joysticks</a></li>
                            <li><a href="#">Stickers</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Televisions</a></li>
                    <li><a href="#">Digital Cameras</a></li>
                    <li><a href="#">Headphones</a></li>
                    <li><a href="#">Wearable Devices</a></li>
                    <li><a href="#">Smart Watches</a></li>
                    <li><a href="#">Game Controllers</a></li>
                    <li><a href="#"> Smart Home Appliances</a></li>
                    <li class="hidden"><a href="#">Projectors</a></li>
                    <li>
                        <a href="#" id="more-btn"><i class="ion-ios-plus-empty" aria-hidden="true"></i> More Categories</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!--=======  End of category menu =======-->
    </div>
    <!-- Beauty Category -->
</header>