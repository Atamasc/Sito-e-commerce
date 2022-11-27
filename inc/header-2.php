<?php
function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

?>

<header class="main-header">
    <!-- Header Top Start -->
    <div class="header-top-nav">
        <div class="container-fluid">
            <div class="row">
                <!--Left Start-->
                <div class="col-lg-4 col-md-4">
                    <div class="left-text">
                        <p>Welcome you to Ecolife store!</p>
                    </div>
                </div>
                <!--Left End-->
                <!--Right Start-->
                <div class="col-lg-8 col-md-8 text-right">
                    <div class="header-right-nav">
                        <div class="dropdown-navs">
                            <ul>
                                <!-- Settings Start -->
                                <li class="dropdown after-n xs-after-n">
                                    <a class="angle-icon" href="#">Settings</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
                                <!-- Settings End -->
                                <!-- Currency Start -->
                                <li class="top-10px first-child">
                                    <select>
                                        <option value="1">USD $</option>
                                        <option value="2">EUR €</option>
                                    </select>
                                </li>
                                <!-- Currency End -->
                                <!-- Language Start -->
                                <li class="top-10px mr-15px">
                                    <select>
                                        <option value="1">English</option>
                                        <option value="2">France</option>
                                    </select>
                                </li>
                                <!-- Language End -->
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
    <div class="header-navigation sticky-nav">
        <div class="container-fluid">
            <div class="row">
                <!-- Logo Start -->
                <div class="col-md-2 col-sm-2">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/logo/logo-electronic-2.jpg" alt=""/></a>
                    </div>
                </div>
                <!-- Logo End -->
                <!-- Navigation Start -->
                <div class="col-md-10 col-sm-10">
                    <!--Main Navigation Start -->
                    <div class="main-navigation d-none d-lg-block">
                        <ul>
                            <li class="menu-dropdown">
                                <a href="#">Home <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Home Organic <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="index.html">Organic 1</a></li>
                                            <li><a href="index-2.html">Organic 2</a></li>
                                            <li><a href="index-3.html">Organic 3</a></li>
                                            <li><a href="index-4.html">Organic 4</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Home Cosmetic <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="index-5.html">Cosmetic 1</a></li>
                                            <li><a href="index-6.html">Cosmetic 2</a></li>
                                            <li><a href="index-7.html">Cosmetic 3</a></li>
                                            <li><a href="index-8.html">Cosmetic 4</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Home Digital <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="index-9.html">Digital 1</a></li>
                                            <li><a href="index-10.html">Digital 2</a></li>
                                            <li><a href="index-11.html">Digital 3</a></li>
                                            <li><a href="index-12.html">Digital 4</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Home Furniture <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="index-13.html">Furniture 1</a></li>
                                            <li><a href="index-14.html">Furniture 2</a></li>
                                            <li><a href="index-15.html">Furniture 3</a></li>
                                            <li><a href="index-16.html">Furniture 4</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Home Medical <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="index-17.html">Medical 1</a></li>
                                            <li><a href="index-18.html">Medical 2</a></li>
                                            <li><a href="index-19.html">Medical 3</a></li>
                                            <li><a href="index-20.html">Medical 4</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-dropdown">
                                <a href="#">Shop <i class="ion-ios-arrow-down"></i></a>
                                <ul class="mega-menu-wrap">
                                    <li>
                                        <ul>
                                            <li class="mega-menu-title"><a href="#">Shop Grid</a></li>
                                            <li><a href="shop-3-column.html">Shop Grid 3 Column</a></li>
                                            <li><a href="shop-4-column.html">Shop Grid 4 Column</a></li>
                                            <li><a href="shop-left-sidebar.html">Shop Grid Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Grid Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="mega-menu-title"><a href="#">Shop List</a></li>
                                            <li><a href="shop-list.html">Shop List</a></li>
                                            <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="mega-menu-title"><a href="#">Shop Single</a></li>
                                            <li><a href="single-product.html">Shop Single</a></li>
                                            <li><a href="single-product-variable.html">Shop Variable</a></li>
                                            <li><a href="single-product-affiliate.html">Shop Affiliate</a></li>
                                            <li><a href="single-product-group.html">Shop Group</a></li>
                                            <li><a href="single-product-tabstyle-2.html">Shop Tab 2</a></li>
                                            <li><a href="single-product-tabstyle-3.html">Shop Tab 3</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li class="mega-menu-title"><a href="#">Shop Single</a></li>
                                            <li><a href="single-product-slider.html">Shop Slider</a></li>
                                            <li><a href="single-product-gallery-left.html">Shop Gallery Left</a></li>
                                            <li><a href="single-product-gallery-right.html">Shop Gallery Right</a></li>
                                            <li><a href="single-product-sticky-left.html">Shop Sticky Left</a></li>
                                            <li><a href="single-product-sticky-right.html">Shop Sticky Right</a></li>
                                        </ul>
                                    </li>
                                    <li class="w-100">
                                        <ul class="banner-megamenu-wrapper d-flex">
                                            <li class="banner-wrapper mr-30px">
                                                <a href="single-product.html"><img src="assets/images/banner-image/banner-menu-3.jpg" alt=""/></a>
                                            </li>
                                            <li class="banner-wrapper">
                                                <a href="single-product.html"><img src="assets/images/banner-image/banner-menu-4.jpg" alt=""/></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-dropdown">
                                <a href="#">Pages <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="login.html">Login & Regiter Page</a></li>
                                    <li><a href="my-account.html">Account Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-dropdown">
                                <a href="#">Blog <i class="ion-ios-arrow-down"></i></a>
                                <ul class="sub-menu">
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Blog Grid <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a></li>
                                            <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Blog List <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a></li>
                                            <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-dropdown position-static">
                                        <a href="#">Blog Single <i class="ion-ios-arrow-down"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li><a href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a>
                                            </li>
                                            <li><a href="blog-single-right-sidebar.html">Blog Single Right Sidebar</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
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
                        <div class="cart-info home-10 home-9 d-flex">
                            <a href="compare.html" class="count-cart random"></a>
                            <a href="wishlist.html" class="count-cart heart"></a>
                            <div class="mini-cart-warp">
                                <a href="#" class="count-cart"><span>$20.00</span></a>
                                <div class="mini-cart-content">
                                    <ul>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="single-product.html"><img alt="" src="assets/images/product-image/mini-cart/1.jpg"/></a>
                                                <span class="product-quantity">1x</span>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="single-product.html">Juicy Couture...</a></h4>
                                                <span>$9.00</span>
                                                <div class="shopping-cart-delete">
                                                    <a href="#"><i class="ion-android-cancel"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="single-shopping-cart">
                                            <div class="shopping-cart-img">
                                                <a href="single-product.html"><img alt="" src="assets/images/product-image/mini-cart/2.jpg"/></a>
                                                <span class="product-quantity">1x</span>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="single-product.html">Water and Wind...</a></h4>
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
                                        <a class="default-btn" href="checkout.html">checkout</a>
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
                                <a href="index.html">HOME</a>
                                <ul>
                                    <li>
                                        <a href="#">Home Organic</a>
                                        <ul>
                                            <li><a href="index.html">Organic 1</a></li>
                                            <li><a href="index-2.html">Organic 2</a></li>
                                            <li><a href="index-3.html">Organic 3</a></li>
                                            <li><a href="index-4.html">Organic 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Cosmetic</a>
                                        <ul>
                                            <li><a href="index-5.html">Cosmetic 1</a></li>
                                            <li><a href="index-6.html">Cosmetic 2</a></li>
                                            <li><a href="index-7.html">Cosmetic 3</a></li>
                                            <li><a href="index-8.html">Cosmetic 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Digital</a>
                                        <ul>
                                            <li><a href="index-9.html">Digital 1</a></li>
                                            <li><a href="index-10.html">Digital 2</a></li>
                                            <li><a href="index-11.html">Digital 3</a></li>
                                            <li><a href="index-12.html">Digital 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Furniture</a>
                                        <ul>
                                            <li><a href="index-13.html">Furniture 1</a></li>
                                            <li><a href="index-14.html">Furniture 2</a></li>
                                            <li><a href="index-15.html">Furniture 3</a></li>
                                            <li><a href="index-16.html">Furniture 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Home Medical</a>
                                        <ul>
                                            <li><a href="index-17.html">Medical 1</a></li>
                                            <li><a href="index-18.html">Medical 2</a></li>
                                            <li><a href="index-19.html">Medical 3</a></li>
                                            <li><a href="index-20.html">Medical 4</a></li>
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
                                            <li><a href="shop-3-column.html">Shop Grid 3 Column</a></li>
                                            <li><a href="shop-4-column.html">Shop Grid 4 Column</a></li>
                                            <li><a href="shop-left-sidebar.html">Shop Grid Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Grid Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Shop List</a>
                                        <ul>
                                            <li><a href="shop-list.html">Shop List</a></li>
                                            <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Single Shop</a>
                                        <ul>
                                            <li><a href="single-product.html">Shop Single</a></li>
                                            <li><a href="single-product-variable.html">Shop Variable</a></li>
                                            <li><a href="single-product-affiliate.html">Shop Affiliate</a></li>
                                            <li><a href="single-product-group.html">Shop Group</a></li>
                                            <li><a href="single-product-tabstyle-2.html">Shop Tab 2</a></li>
                                            <li><a href="single-product-tabstyle-3.html">Shop Tab 3</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Single Shop</a>
                                        <ul>
                                            <li><a href="single-product-slider.html">Shop Slider</a></li>
                                            <li><a href="single-product-gallery-left.html">Shop Gallery Left</a></li>
                                            <li><a href="single-product-gallery-right.html">Shop Gallery Right</a></li>
                                            <li><a href="single-product-sticky-left.html">Shop Sticky Left</a></li>
                                            <li><a href="single-product-sticky-right.html">Shop Sticky Right</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="cart.html">Cart Page</a></li>
                                    <li><a href="checkout.html">Checkout Page</a></li>
                                    <li><a href="compare.html">Compare Page</a></li>
                                    <li><a href="login.html">Login & Regiter Page</a></li>
                                    <li><a href="my-account.html">Account Page</a></li>
                                    <li><a href="wishlist.html">Wishlist Page</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Blog</a>
                                <ul>
                                    <li><a href="blog-grid-left-sidebar.html">Blog Grid Left Sidebar</a></li>
                                    <li><a href="blog-grid-right-sidebar.html">Blog Grid Right Sidebar</a></li>
                                    <li><a href="blog-list-left-sidebar.html">Blog List Left Sidebar</a></li>
                                    <li><a href="blog-list-right-sidebar.html">Blog List Right Sidebar</a></li>
                                    <li><a href="blog-single-left-sidebar.html">Blog Single Left Sidebar</a></li>
                                    <li><a href="blog-single-right-sidebar.html">Blog Single Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- mobile menu end-->
        </div>
    </div>
    <!--Header Bottom Account End -->
</header>