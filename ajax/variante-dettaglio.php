<?php include "inc/autoloader.php"; ?>
<?php
$get_pr_id = (int)$_GET["pr_id"];

$querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$get_pr_id'  ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();

$get_pr_codice = $row_data['pr_codice'];
$pr_ct_id = $row_data['pr_ct_id'];
$pr_colore = $row_data['pr_colore'];

$pr_immagine = getImmagineProdotto($get_pr_id);
$page_link = generateProductLink($get_pr_id);
?>
<div class="col-lg-6 col-md-6">
    <div class="product-details-tab">
        <div id="img-1" class="zoomWrapper single-zoom">
            <a href="javascript:;">
                <img id="zoom1" src="<?php echo $pr_immagine; ?>" data-zoom-image="<?php echo $pr_immagine; ?>" alt="big-1">
            </a>
        </div>
        <div class="single-zoom-thumb">
            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                <li>
                    <a href="javascript:;" class="elevatezoom-gallery active" data-update="" data-image="<?php echo $pr_immagine; ?>"
                       data-zoom-image="<?php echo $pr_immagine; ?>">
                        <img src="<?php echo $pr_immagine; ?>" alt="zo-th-1"/>
                    </a>

                </li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-6">
    <div class="product_d_right">
        <form action="javascript:;">
            <h1><a href="javascript:;"><?php echo $row_data['pr_titolo']; ?></a></h1>
            <h5><a href="javascript:;">Codice: <?php echo $row_data['pr_codice']; ?></a></h5>
            <!--
            <div class="product_nav">
                <ul>
                    <li class="prev"><a href="prodotto-dettaglio.php"><i class="fa fa-angle-left"></i></a></li>
                    <li class="next"><a href="product-grouped.html"><i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
            -->
            <!--
            <div class=" product_ratting">
                <ul>
                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                    <li class="review"><a href="#"> (customer review ) </a></li>
                </ul>

            </div>
            -->

            <div class="price_box">
                <?php if ($row_data['pr_prezzo_scontato'] <= $row_data['pr_prezzo']) { ?>
                    <span class="current_price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>
                <?php } else { ?>
                    <span class="current_price">&euro;<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?></span>
                    <span class="current_price">(- <?php echo formatPercent($row_data['pr_sconto']); ?>%)</span>
                    <span class="old_price">&euro;<?php echo formatPrice($row_data['pr_prezzo']); ?></span>
                <?php } ?>
            </div>
            <div class="product_desc">
                <p><?php echo $row_data['pr_descrizione']; ?></p>
            </div>


            <div class="product_variant color">
                <h3>Varianti</h3>
                <label>Scegli il colore</label>
                <ul>
                    <?php
                    pageGetVariantiColore($get_pr_id);
                    function pageGetVariantiColore($get_pr_id) {

                        global $dbConn;
                        $pr_capofila = getCapofilaID($get_pr_id);

                        $querySql =
                            "SELECT * FROM pr_prodotti INNER JOIN cl_colori ON pr_colore = cl_id WHERE pr_stato > 0 ".
                            "AND (pr_capofila = '$pr_capofila' OR pr_id = '$pr_capofila') GROUP BY cl_id ORDER BY pr_id";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        if ($rows > 0) {

                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                $pr_id = $row_data['pr_id'];
                                $pr_link = generateVarianteLink($pr_id);
                                $class = $pr_id == $get_pr_id ? "selected" : "";

                                $pr_immagine = getImmagineProdotto($pr_id);
                                ?>
                                <!--
                                <li class="color-dynamic selected">
                                    <a style="background-color: <?php echo $row_data['cl_rgb']; ?>" href="javascript:;"></a>
                                    <?php //functionGetSelectTaglia($pr_id, $row_data['cl_id']); ?>
                                </li>
                                -->

                                <li class="<?php echo $class; ?>">
                                    <a class="iframe-url" href="javascript:;" title="<?php echo $row_data['cl_colore']; ?>"
                                       data-href="ajax/variante-dettaglio?pr_id=<?php echo $pr_id; ?>"><img src="<?php echo $pr_immagine; ?>"></a>
                                </li>
                                <?php

                            }


                        }

                        $result->close();

                    }
                    ?>

                </ul>
            </div>

            <?php
            pageGetVariantiTaglia($get_pr_id, $pr_colore);
            function pageGetVariantiTaglia($get_pr_id, $pr_colore) {

                global $dbConn;
                $pr_capofila = getCapofilaID($get_pr_id);

                $querySql =
                    "SELECT DISTINCT(tg_id), pr_id, tg_taglia FROM pr_prodotti INNER JOIN tg_taglie ON pr_misura = tg_id WHERE pr_stato > 0 ".
                    "AND (pr_capofila = '$pr_capofila' OR pr_id = '$pr_capofila') AND pr_colore = '$pr_colore' ORDER BY tg_taglia";
                $result = $dbConn->query($querySql);
                $rows = $dbConn->affected_rows;

                if ($rows > 0) {

                    ?>
                    <div class="product_variant size">
                        <label>Scegli la taglia</label>
                        <select class="niceselect_option iframe-select" id="color2" name="produc_color2">
                            <option selected value="1"> seleziona una taglia</option>
                            <?php
                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                $pr_id = $row_data['pr_id'];
                                $class = $pr_id == $get_pr_id ? "selected" : "";
                                ?>
                                <option <?php echo $class; ?> value="<?php echo $pr_id; ?>" data-href="ajax/variante-dettaglio?pr_id=<?php echo $pr_id; ?>">
                                    <?php echo $row_data['tg_taglia']; ?>
                                </option>
                                <?php

                            }
                            ?>
                        </select>
                    </div>
                    <?php

                }

                $result->close();

            }
            ?>

            <div class="product_variant quantity">
                <?php if ($row_data['pr_giacenza'] > 1) { ?>
                    <h4>Disponibilità: <span style="color: #198f35">Disponibile</span></h4>
                <?php } else if ($row_data['pr_giacenza'] == 1) { ?>
                    <h4>Disponibilità: <span style="color: #FF7D27">In esaurimento</span></h4>
                <?php } else { ?>
                    <h4>Disponibilità: <span style="color: #FE0000">Non disponibile</span></h4>
                <?php } ?>
            </div>

            <div class="product_variant quantity">

                <label>quantit&agrave;</label>
                <input min="1" max="100" value="1" type="number" id="pr_quantita">
                <?php if (($row_data['pr_giacenza'] > 0) && ($row_data['pr_prezzo'] != '0.00')) { ?>
                    <button class="button carrello-add" data-codice="<?php echo $get_pr_codice; ?>" href="javascript:;">Aggiungi al carrello</button>
                <?php } else { ?>
                    <button class="button" data-codice="" style="background-color: #7f7f7f;">Non Disponibile</button>
                <?php }; ?>

            </div>

            <?php if($session_cl_login > 0) { ?>
                <div class="product_d_action">
                    <ul>
                        <li class="wishlist-add" data-codice="<?php echo $get_pr_codice; ?>"><a href="javascript:;" title="Add to wishlist">+ Wishlist</a></li>
                        <?php /*if ($row_data['pr_giacenza'] < 1) { ?>
                            <?php $np_link = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>
                            <li class="notification-add" data-codice="<?php echo $get_pr_codice; ?>" data-link="<?php echo $np_link; ?>"><a id="tooltip_a" href="javascript:;" title="Avviso disponibilità">+ Avviso Disponibilità
                                    <p id="tooltip">Cliccando qui sarai avvisato tramite una notifica mail automatica quando il prodotto tornerà disponibile all'acquisto.</p>
                                </a></li>
                        <?php }*/ ?>
                    </ul>
                </div>
            <?php } ?>

        </form>

        <!--
        <div class="product_d_meta">
            <span>Categoria: <a href="#">Abiti</a></span>

            <span>Tags:
                    <a href="#">Cinture</a>
                    <a href="#">Abiti</a>
                </span>
        </div>
        -->
        <div class="priduct_social">
            <ul>
                <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Mi Piace</a></li>
                <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>
                <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> Salva</a></li>
                <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> Condividi</a></li>
            </ul>
        </div>
    </div>
</div>

<!--
<script>
    $(".mini_cart_wrapper > a").on("click", function() {
        $(this).toggleClass('active');
        $('.mini_cart').slideToggle('medium');
    });
</script>
-->

<script>

    $(function() {

        history.pushState({}, null, "<?php echo $page_link; ?>");


    });


    $(".iframe-url").click(function () {

        $.get($(this).data("href"), function (data) {

            $(".ajax-iframe").html(data);

        });

    });

    $(".iframe-select").change(function () {

        $.get($(this).find('option:selected').data("href"), function (data) {

            $(".ajax-iframe").html(data);

        });

    });
</script>

<script>
    $(".color-dynamic").click(function() {

        $('.color-dynamic').removeClass('selected');
        $(this).addClass('selected');
        $('.niceselect_option').html($(".color-dynamic > .select").html());

    });
</script>

<script src="assets/js/custom.js?<?php echo time(); ?>"></script>
