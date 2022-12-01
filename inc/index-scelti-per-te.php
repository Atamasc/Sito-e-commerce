<section class="best-sells-area mb-30px">
    <div class="container">
        <!-- Section Title Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>Speciale Cialde </h2>
                    <p>Selezione cialde caffè ESE 44 scontate</p>
                </div>
            </div>
        </div>
        <!-- Section Title End -->
        <!-- Best Sell Slider Carousel Start -->
        <div class="best-sell-slider owl-carousel owl-nav-style">
            <!-- Single Item -->
            <?php
            //TODO Luca: commento la condizione di sconto sul prodotto | CAST(pr_sconto AS DECIMAL(10,2)) > 0 AND
            $querySql = "
                         SELECT * FROM pr_prodotti
                         WHERE
                               pr_ct_id = '2' AND
                               pr_immagine != '' AND
                               CAST(pr_prezzo AS DECIMAL(10,2)) <= 30 AND
                               pr_stato > 0
                         ORDER BY RAND() LIMIT 0,12
                        ";
            $result = $dbConn->query($querySql);
            $rows = $dbConn->affected_rows;

            while (($row_data = $result->fetch_assoc()) !== NULL) {
                $pr_id = $row_data['pr_id'];
                $pr_codice = $row_data['pr_codice'];
                $pr_esistenza = $row_data['pr_esistenza'];
                $pr_vetrina = $row_data['pr_vetrina'];
                $pr_novita = $row_data['pr_novita'];
                $pr_promo = $row_data['pr_promo'];
                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);
                $pr_link = generateProductLink($pr_id);

                $mr_marche = getMarca($row_data['pr_mr_id']);
                $si_sistema = getSistema($row_data['pr_si_id']);
                $mr_link = generateMarca2Link($row_data['pr_mr_id']);
                $si_link = generateSistemaLink($row_data['pr_si_id']);

                $pr_immagine = strlen($row_data['pr_immagine']) > 0 && is_file("upload/prodotti/" . $row_data['pr_immagine'])
                    ? "upload/prodotti/" . $row_data['pr_immagine']
                    : "assets/images/prodotto-dummy.jpg";
                $pi_immagine = getImg2Prodotto($pr_id);
                ?>
                <article class="list-product">
                    <div class="img-block">
                        <a href="<?php echo $pr_link; ?>" class="thumbnail">
                            <img class="first-img" data-src="<?php echo($pr_immagine) ?>" alt="" style="max-height: 255px"/>
                            <!--<img class="second-img" src="assets/images/product-image/organic/product-1.jpg" alt="" />-->
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
                            <a href="<?php echo $mr_link; ?>" title="<?php echo "Prodotti a marca $mr_marche"; ?>"><?php echo $mr_marche; ?></a>
                            <?php echo strlen($si_sistema) > 0 ? " / <a href='$si_link' title='Prodotti per sistemi $si_sistema'>$si_sistema</a>" : ""; ?>
                        </p>
                        <h3>
                            <a href="<?php echo $pr_link; ?>" class="product-link" style="font-size: 13px;"><?php echo $row_data['pr_titolo'] ?></a>
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
                                        <li class="current-price"><?php echo($row_data['pr_prezzo']) ?></li>
                                    <?php } else { ?>
                                        <li class="old-price"><?php echo($row_data['pr_prezzo']) ?></li>
                                        <li class="current-price"><?php echo($row_data['pr_prezzo_scontato']) ?></li>
                                        <!--<li class="discount-price"><?php echo($row_data['pr_sconto']) ?></li>-->
                                    <?php } ?>
                                <?php } else { ?>
                                    <li class="current-price"><?php echo($row_data['pr_prezzo']) ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="add-to-link">
                        <ul>
                            <li class="cart">
                                <?php if ($row_data['pr_giacenza'] > 5) { ?>

                                    <?php if (strlen($row_data['pr_prezzo']) < 1 && strlen($row_data['pr_prezzo_scontato']) < 1) { ?>
                                        <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                    <?php } else { ?>
                                        <a class="cart-btn carrello-add" data-codice="<?php echo $pr_codice; ?>" href="javascript:;">ACQUISTA</a>
                                    <?php }; ?>

                                <?php } else if ($row_data['pr_giancenza'] > 1) { ?>
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

            if ($rows == 0) echo "<p>Non ci sono prodotti</p>";

            $result->close();
            ?>
        </div>
        <!-- Best Sells Carousel End -->
    </div>
</section>

