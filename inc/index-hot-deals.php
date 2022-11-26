<section class="hot-deal-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title">
                            <h2>Scontatissimi</h2>
                            <p>Offerte imperdibili in quantità limitata</p>
                        </div>
                        <!-- Section Title End-->
                    </div>
                </div>
                <!-- Hot Deal Slider Start -->
                <div class="hot-deal owl-carousel owl-nav-style">
                    
                    <?php
                    //TODO Luca: commento la condizione di prezzo | CAST(pr_prezzo AS DECIMAL(10,2)) > 30 AND
                    $querySql = "
                                 SELECT * FROM pr_prodotti
                                 WHERE
                                       pr_immagine != '' AND
                                       CAST(pr_sconto AS DECIMAL(10,2)) > 20 AND
                                       pr_stato > 0
                                 ORDER BY RAND() LIMIT 0,4
                                ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;
                    
                    while (($row = $result->fetch_assoc()) !== NULL) {
                        $pr_id = $row['pr_id'];
                        $pr_codice = $row['pr_codice'];
                        $pr_esistenza = $row['pr_esistenza'];
                        $pr_vetrina = $row['pr_vetrina'];
                        $pr_novita = $row['pr_novita'];
                        $pr_promo = $row['pr_promo'];
                        $pr_prezzo_scontato = $row['pr_prezzo_scontato'];
                        $pr_prezzo = $row['pr_prezzo'];
                        $pr_link = generateProductLink($pr_id);
                        $pr_titolo = $row['pr_titolo'];
                        $pr_giacenza = $row['pr_giacenza'];
                        
                        $mr_marchio = getMarchio($row['pr_mr_id']);
                        $si_sistema = getSistema($row['pr_si_id']);
                        $mr_link = generateMarchio2Link($row['pr_mr_id']);
                        $si_link = generateSistemaLink($row['pr_si_id']);
                        
                        $pr_immagine = strlen($row['pr_immagine']) > 0 && is_file("upload/prodotti/".$row['pr_immagine'])
                            ? "upload/prodotti/".$row['pr_immagine']
                            : "assets/images/prodotto-dummy.jpg";
                        $pi_immagine = getImg2Prodotto($pr_id);
                        ?>
                        
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
                            <ul class="product-flag">
                                <li class="new">Offerta</li>
                            </ul>
                            <div class="product-decs">
                                <p class="inner-link">
                                    <a href="<?php echo $mr_link; ?>" title="<?php echo "Prodotti a marchio $mr_marchio"; ?>"><?php echo $mr_marchio; ?></a>
                                    <?php echo strlen($si_sistema) > 0 ? " / <a href='$si_link' title='Prodotti per sistemi $si_sistema'>$si_sistema</a>" : ""; ?>
                                </p>
                                <h3><a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $pr_titolo; ?></a></h3>
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
                                        <?php if ( $row['pr_prezzo'] == $row['pr_prezzo_scontato']){ ?>
                                            <span class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></span>
                                        <?php }else{?>
                                            <span class="old-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></span>
                                            <span class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo_scontato']); ?></span>
                                            <span class="discount-price">- <?php echo formatPercent($row['pr_sconto']); ?>%</span>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li class="cart" style="float: none;">
                                            <?php if ($pr_giacenza > 1) { ?>

                                                <?php if (strlen($row['pr_prezzo']) < 1 && strlen($row['pr_prezzo_scontato']) < 1) { ?>
                                                    <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                <?php } else { ?>
                                                    <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                                <?php }; ?>

                                            <?php } else if ($pr_giacenza == 1) { ?>
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
                            </div>
                            <div class="in-stock">Disponibilit&agrave;:
                                <?php if ($pr_giacenza > 1) { ?>

                                    <?php if (strlen($row['pr_prezzo']) < 1 && strlen($row['pr_prezzo_scontato']) < 1) { ?>
                                        <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                    <?php } else { ?>
                                        <span style="color: green; font-weight: bold;"> Disponibile</span>
                                    <?php }; ?>

                                <?php } else if ($pr_giacenza == 1) { ?>
                                    <span style="color: #FF7D27; font-weight: bold;">In esaurimento</span>
                                <?php } else { ?>
                                    <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                <?php } ?>
                            
                            </div>
                            
                            <div class="clockdiv">
                                <!--<div class="title_countdown">Hurry Up! Offers ends in:</div>
                                <div data-countdown="2021/03/01"></div>-->
                            </div>
                        </article>
                    
                    <?php }
                    $result->close();
                    ?>
                
                </div>
                <!-- Hot Deal Slider End -->
            </div>
            <!-- New Arrivals Area Start -->
            <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Section Title -->
                        <div class="section-title ml-0px mt-res-sx-30px">
                            <h2>Scontati</h2>
                            <p>Una vasta gamma di prodotti scontati disponibili</p>
                        </div>
                        <!-- Section Title -->
                    </div>
                </div>
                <!-- New Product Slider Start -->
                <div class="new-product-slider owl-carousel owl-nav-style">
                    
                    <?php
                    //TODO Luca: commento la condizione legata alle offerte | AND pr_prezzo_scontato > 0 AND pr_prezzo_scontato != pr_prezzo
                    
                    $querySql = "SELECT * FROM pr_prodotti WHERE pr_stato > 0 AND pr_sconto > 0 ORDER BY RAND() LIMIT 0,16";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row = $result->fetch_assoc()) !== NULL) {
                        $pr_id = $row['pr_id'];
                        $pr_codice = $row['pr_codice'];
                        $pr_esistenza = $row['pr_esistenza'];
                        $pr_vetrina = $row['pr_vetrina'];
                        $pr_novita = $row['pr_novita'];
                        $pr_promo = $row['pr_promo'];
                        $pr_prezzo_scontato = $row['pr_prezzo_scontato'];
                        $pr_prezzo = $row['pr_prezzo'];
                        $pr_link = generateProductLink($pr_id);
                        $pr_titolo = $row['pr_titolo'];
                        $pr_giacenza = $row['pr_giacenza'];
                        
                        $mr_marchio = getMarchio($row['pr_mr_id']);
                        $si_sistema = getSistema($row['pr_si_id']);
                        $mr_link = generateMarchio2Link($row['pr_mr_id']);
                        $si_link = generateSistemaLink($row['pr_si_id']);

                        $pr_immagine = strlen($row['pr_immagine']) > 0 && is_file("upload/prodotti/".$row['pr_immagine'])
                            ? "upload/prodotti/".$row['pr_immagine']
                            : "assets/images/prodotto-dummy.jpg";
                        $pi_immagine = getImg2Prodotto($pr_id);
                        ?>

                        <div class="product-inner-item">

                            <article class="list-product mb-30px">
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
                                <ul class="product-flag">
                                    <li class="new">Offerta</li>
                                </ul>
                                <div class="product-decs">
                                    <p class="inner-link">
                                        <a href="<?php echo $mr_link; ?>" title="<?php echo "Prodotti a marchio $mr_marchio"; ?>"><?php echo $mr_marchio; ?></a>
                                        <?php echo strlen($si_sistema) > 0 ? " / <a href='$si_link' title='Prodotti per sistemi $si_sistema'>$si_sistema</a>" : ""; ?>
                                    </p>
                                    <h2><a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $pr_titolo; ?></a></h2>
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
                                            <span class="old-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></span>
                                            <span class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo_scontato']); ?></span>
                                            <span class="discount-price">- <?php echo formatPercent($row['pr_sconto']); ?>%</span>
                                        </ul>
                                    </div>
                                </div>
                                <div class="add-to-link">
                                    <ul>
                                        <li class="cart">
                                            <?php if ($pr_giacenza > 1) { ?>

                                                <?php if (strlen($row['pr_prezzo']) < 1 && strlen($row['pr_prezzo_scontato']) < 1) { ?>
                                                    <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                <?php } else { ?>
                                                    <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                                <?php }; ?>

                                            <?php } else if ($pr_giacenza == 1) { ?>
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

                            <?php
                            //query che mostra i prodotti della riga inferiore
                            $querySql2 = "SELECT * FROM pr_prodotti WHERE pr_stato > 0 AND pr_prezzo_scontato > 0 AND pr_prezzo_scontato != pr_prezzo AND pr_id != '$pr_id' ORDER BY RAND() LIMIT 0,8 ";
                            $result2 = $dbConn->query($querySql2);
                            $row = $result->fetch_assoc();
                            $result2->close();

                            $pr_id = $row['pr_id'];
                            $pr_codice = $row['pr_codice'];
                            $pr_esistenza = $row['pr_esistenza'];
                            $pr_vetrina = $row['pr_vetrina'];
                            $pr_novita = $row['pr_novita'];
                            $pr_promo = $row['pr_promo'];
                            $pr_prezzo_scontato = $row['pr_prezzo_scontato'];
                            $pr_prezzo = $row['pr_prezzo'];
                            $pr_link = generateProductLink($pr_id);
                            $pr_titolo = $row['pr_titolo'];
                            $pr_giacenza = $row['pr_giacenza'];

                            $mr_marchio = getMarchio($row['pr_mr_id']);
                            $si_sistema = getSistema($row['pr_si_id']);
                            $mr_link = generateMarchio2Link($row['pr_mr_id']);
                            $si_link = generateSistemaLink($row['pr_si_id']);

                            $pr_immagine = strlen($row['pr_immagine']) > 0 && is_file("upload/prodotti/".$row['pr_immagine'])
                                ? "upload/prodotti/".$row['pr_immagine']
                                : "assets/images/prodotto-dummy.jpg";
                            $pi_immagine = getImg2Prodotto($pr_id);
                            ?>

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
                                 <ul class="product-flag">
                                     <li class="new">Offerta</li>
                                 </ul>
                                 <div class="product-decs">
                                     <p class="inner-link">
                                         <a href="<?php echo $mr_link; ?>" title="<?php echo "Prodotti a marchio $mr_marchio"; ?>"><?php echo $mr_marchio; ?></a>
                                         <?php echo strlen($si_sistema) > 0 ? " / <a href='$si_link' title='Prodotti per sistemi $si_sistema'>$si_sistema</a>" : ""; ?>
                                     </p>

                                     <h3><a href="<?php echo $pr_link; ?>" class="product-link"><?php echo $pr_titolo; ?></a></h3>
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
                                             <span class="old-price">&euro;<?php echo formatPrice($row['pr_prezzo']); ?></span>
                                             <span class="current-price">&euro;<?php echo formatPrice($row['pr_prezzo_scontato']); ?></span>
                                             <span class="discount-price">- <?php echo formatPercent($row['pr_sconto']); ?>%</span>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="add-to-link">
                                     <ul>
                                         <li class="cart">
                                             <?php if ($pr_giacenza > 1) { ?>

                                                 <?php if (strlen($row['pr_prezzo']) < 1 && strlen($row['pr_prezzo_scontato']) < 1) { ?>
                                                     <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                 <?php } else { ?>
                                                     <span class="cart carrello-add" data-codice="<?php echo $pr_codice; ?>"><a class="cart-btn" href="javascript:;">ACQUISTA </a></span>
                                                 <?php }; ?>

                                             <?php } else if ($pr_giacenza == 1) { ?>
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
                    
                    <?php }
                    $result->close();
                    ?>
                
                </div>
                <!-- Product Slider End -->
            </div>
        </div>
    </div>
</section>
