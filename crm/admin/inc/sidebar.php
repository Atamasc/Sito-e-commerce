<div class="side-menu-fixed">
    <div class="scrollbar side-menu-bg">
        <ul class="nav navbar-nav side-menu" id="sidebarnav">
            <!-- menu item Dashboard-->
            <li>
                <a href="dashboard.php"><i class="ti-blackboard"></i><span class="right-nav-text">Dashboard</span></a>
            </li>

            <!-- menu title -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Gestioni </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#clienti">
                    <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">Clienti</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="clienti" class="collapse" data-parent="#sidebarnav">
                    <li><a href="clienti-add.php">Nuovo cliente</a></li>
                    <li><a href="clienti-gst.php">Elenco clienti</a></li>
                    <li><a href="clienti-privacy-gst.php">Privacy</a></li>
                    <!--<li><a href="clienti-mod.php">Modifica cliente</a></li>-->
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#notifiche">
                    <div class="pull-left"><i class="ti-bell"></i><span class="right-nav-text">Notifiche</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="notifiche" class="collapse" data-parent="#sidebarnav">
                    <li><a href="notifiche-gst.php">Gestione notifiche</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#marchi">
                    <div class="pull-left"><i class="ti-medall"></i><span class="right-nav-text">Marchi</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="marchi" class="collapse" data-parent="#sidebarnav">
                    <li><a href="marchi-add.php">Nuovo marchio</a></li>
                    <li><a href="marchi-gst.php">Gestione marchi</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#sistemi">
                    <div class="pull-left"><i class="ti-settings"></i><span class="right-nav-text">Sistemi</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="sistemi" class="collapse" data-parent="#sidebarnav">
                    <li><a href="sistemi-add.php">Nuovo sistema</a></li>
                    <li><a href="sistemi-gst.php">Gestione sistemi</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#prodotti">
                    <div class="pull-left"><i class="ti-folder"></i><span class="right-nav-text">Catalogo</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="prodotti" class="collapse" data-parent="#sidebarnav">
                    <li><a href="prodotti-add.php">Nuovo prodotto</a></li>
                    <li><a href="prodotti-gst.php">Elenco prodotti</a></li>
                    <li><a href="prodotti-categorie-gst.php">Categorie prodotti</a></li>
                    <li><a href="prodotti-sottocategorie-gst.php">Sottocategorie prodotti</a></li>

                    <li style="display: none;"><a href="prodotti-mod.php">Modifica prodotto</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#recensioni">
                    <div class="pull-left"><i class="fas fa-star"></i><span class="right-nav-text">Recensioni</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="recensioni" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="recensioni-add.php">Nuova recensione</a> </li>
                    <li> <a href="recensioni-gst.php">Gestione recensioni</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#coupon">
                    <div class="pull-left"><i class="ti-ticket"></i><span class="right-nav-text">Coupon</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="coupon" class="collapse" data-parent="#sidebarnav">
                    <li><a href="coupon-add.php">Nuovo coupon</a></li>
                    <li><a href="coupon-gst.php">Gestione coupon</a></li>
                    <li><a href="coupon-analisi.php">Analisi coupon</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#carrelli">
                    <div class="pull-left"><i class="ti-shopping-cart"></i><span class="right-nav-text">Carrelli</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="carrelli" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="carrelli-gst.php">Gestione carrelli</a> </li>
                    <li> <a href="carrelli-log-gst.php">Log e report email</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#ordini">
                    <div class="pull-left"><i class="ti-bag"></i><span class="right-nav-text">Ordini</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="ordini" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="ordini-gst.php">Gestione ordini</a> </li>
                    <li> <a href="ordini-eliminati-gst.php">Ordini eliminati</a> </li>
                    <li> <a href="ordini-storico-gst.php">Storico ordini</a> </li>
                </ul>
            </li>

            <!--
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#assistenza">
                    <div class="pull-left"><i class="ti-email"></i><span class="right-nav-text">Assistenza</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="assistenza" class="collapse" data-parent="#sidebarnav">
                    <li><a href="contatti-gst.php">Elenco contatti</a></li>
                </ul>
            </li>
            -->

            <!-- menu title -->
            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Marketing</li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#blog">
                    <div class="pull-left"><i class="ti-agenda"></i><span class="right-nav-text">Blog</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="blog" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="blog-add.php">Crea post blog</a> </li>
                    <li> <a href="blog-gst.php">Gestione post blog</a> </li>
                    <li> <a href="blog-categorie-gst.php">Gestione categorie blog</a></li>
                    <li> <a href="tag-gst.php">Gestione tag</a> </li>

                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#newsletter">
                    <div class="pull-left"><i class="ti-email"></i><span class="right-nav-text">Newsletter</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="newsletter" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="newsletter-immagine-add.php">Crea campagna mail</a> </li>
                    <li> <a href="newsletter-blog-add.php">Crea campagna blog</a> </li>
                    <li> <a href="newsletter-gst.php">Gestione campagne mail</a> </li>
                    <li> <a href="newsletter-blog-gst.php">Gestione campagne blog</a> </li>
                    <li> <a href="newsletter-liste-gst.php">Gestione liste email</a> </li>
                    <li> <a href="newsletter-log-gst.php">Log e report campagne</a> </li>
                </ul>
            </li>

            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Impostazioni</li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#spedizionieri">
                    <div class="pull-left"><i class="ti-package"></i><span class="right-nav-text">Spedizionieri</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="spedizionieri" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="spedizionieri-add.php">Aggiungi spedizioniere</a> </li>
                    <li> <a href="spedizionieri-gst.php">Gestione spedizionieri</a> </li>

                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#pagamenti">
                    <div class="pull-left"><i class="ti-credit-card"></i><span class="right-nav-text">Pagamenti</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="pagamenti" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="strumenti-pagamenti.php">Gestione pagamenti</a> </li>

                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#strumenti">
                    <div class="pull-left"><i class="ti-user"></i><span class="right-nav-text">Strumenti</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>

                <ul id="strumenti" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="strumenti-feed-gst.php">Gestione feed</a> </li>
                    <li><a href="strumenti-cropping.php">Modifica immagini</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#aspetto">
                    <div class="pull-left"><i class="fal fa-image"></i><span class="right-nav-text">Aspetto</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="aspetto" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="slide-gst.php">Gestione slide</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                    <div class="pull-left"><i class="ti-id-badge"></i><span class="right-nav-text">Accesso</span></div>
                    <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
                </a>
                <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                    <li> <a href="strumenti-password-mod.php">Modifica password</a> </li>
                </ul>
            </li>
            <!-- menu item timeline-->
            <!--<li>
                <a href="strumenti-importazioni-gst.php"><i class="ti-import"></i><span class="right-nav-text">Importazioni</span> </a>
            </li>-->
            <li>
                <a href="logout.php"><i class="ti-power-off"></i><span class="right-nav-text">Logout</span> </a>
            </li>
        </ul>
    </div>
</div>