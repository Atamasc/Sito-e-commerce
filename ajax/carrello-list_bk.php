<?php include "inc/autoloader.php"; ?>

<?php
$querySql =
    "SELECT * FROM pr_prodotti ".
    "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice ".
    "WHERE cr_cl_codice = '$session_cl_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->num_rows;
?>
<a href="javascript:void(0)">
    <img src="<?php echo $rootBasePath_http; ?>/assets/img/icon/icon-cart.png" alt="">
    <span class="item_count"><?php echo $rows; ?></span>
    <!--<span class="item_text">Prodotti - &euro;<?php echo formatPrice(getTotalecarrello($session_cl_codice))?></span></a>-->
<!--mini cart-->
<div class="mini_cart">
    <div class="cart_gallery">

        <?php
        $cr_totale = 0;
        while ($row_data = $result->fetch_assoc()) {

            $cr_id = $row_data['cr_id'];
            $pr_id = $row_data['pr_id'];
            $pr_codice = $row_data['pr_codice'];
            $cr_pr_quantita = $row_data['cr_pr_quantita'];

            $pr_immagine = getImmagineProdotto($pr_id);

            $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);

            $pr_titolo = $row_data['pr_titolo'];
            $pr_link = generateProductLink($pr_id);

            $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
            ?>

            <div class="cart_item">
                <div class="cart_img">
                    <a href="<?php echo $pr_link; ?>">
                        <img style="max-width: 50px;" src="<?php echo $pr_immagine; ?>" alt="<?php echo $pr_titolo; ?>">
                    </a>
                </div>
                <div class="cart_info">
                    <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                    <p><?php echo $cr_pr_quantita; ?> x <span> &euro;<?php echo formatPrice($pr_prezzo); ?> </span></p>
                </div>
                <div class="cart_remove">
                    <a data-target="<?php echo $cr_id; ?>" href="javascript:;" class="carrello-del"><i class="icon-x"></i></a>
                </div>
            </div>

            <?php

        }
        $result->close();

        if($rows == 0) {

            ?>

            <div class="cart_item">
                <div class="cart_img">
                </div>
                <div class="cart_info" style="color: white;">
                    Il carrello è vuoto
                </div>
                <div class="cart_remove">
                </div>
            </div>

            <?php

        }
        ?>

    </div>
    <div class="mini_cart_table">
        <div class="cart_table_border">
            <!--
            <div class="cart_total">
                <span>Sub total:</span>
                <span class="price">$125.00</span>
            </div>
            -->
            <div class="cart_total">
                <span>Totale:</span>
                <span class="price">&euro;<?php echo formatPrice($cr_totale); ?></span>
            </div>
        </div>
    </div>
    <div class="mini_cart_footer">
        <div class="cart_button">
            <a href="<?php echo "$rootBasePath_http/carrello"; ?>"><i class="fa fa-shopping-cart"></i> Vai al carrello </a>
        </div> 
        <!--
        <div class="cart_button">
            <a href="checkout.html"><i class="fa fa-sign-in"></i> Checkout</a>
        </div>
        -->

    </div>
</div>
<!--mini cart end-->

<script>
    $(".mini_cart_wrapper > a").on("click", function() {
        $(this).toggleClass('active');
        $('.mini_cart').slideToggle('medium');
    });
</script>