<?php
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$querySql =
    "SELECT * FROM pr_prodotti " .
    "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice " .
    "WHERE cr_ut_codice = '$session_cl_codice' ";
$result = $dbConn->query($querySql);
$rows = $result->num_rows;
$_SESSION['rows'] = $rows;
?>

<a href="javascript:void(0)" class="count-cart" rel="nofollow"><span>&euro;<?php echo formatPrice(getTotalecarrello($session_cl_codice)) ?></span></a>
<div class="mini-cart-content">
    <ul>

        <?php
        $cr_totale = 0;
        while ($row_data = $result->fetch_assoc()) {

            $cr_id = $row_data['cr_id'];
            $pr_id = $row_data['pr_id'];
            $pr_codice = $row_data['pr_codice'];
            $cr_pr_quantita = $row_data['cr_pr_quantita'];

            $pr_immagine = strlen($row_data['pr_immagine'])
                ? "$rootBasePath_http/upload/prodotti/" . $row_data['pr_immagine']
                : "$rootBasePath_http/assets/img/no_img.jpg";

            $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

            $pr_titolo = $row_data['pr_titolo'];
            $pr_link = generateProductLink($pr_id);

            $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
            ?>

            <li class="single-shopping-cart">
                <div class="shopping-cart-img">
                    <a href="<?php echo $pr_link; ?>"><img style="max-width: 100px;" alt="<?php echo $pr_titolo; ?>" src="<?php echo $pr_immagine; ?>"/></a>
                    <span class="product-quantity"><?php echo $cr_pr_quantita; ?></span>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a></h4>
                    <span>&euro;<?php echo formatPrice($pr_prezzo); ?></span>
                    <div class="shopping-cart-delete">
                        <a data-target="<?php echo $cr_id; ?>" href="javascript:;" class="carrello-del"><i class="ion-android-cancel"></i></a>
                    </div>
                </div>
            </li>

            <?php

        }
        $result->close();

        if ($rows == 0) echo "<br><p style='text-align: center;'>Il carrello &egrave; vuoto</p>";
        ?>

    </ul>


    <div class="shopping-cart-total">
        <h4 class="shop-total">Totale : <span>&euro;<?php echo formatPrice($cr_totale); ?></span></h4>
    </div>
    <div class="shopping-cart-btn text-center">
        <a class="default-btn" href="<?php echo "$rootBasePath_http/carrello"; ?>">Vai al carrello</a>
    </div>
</div>


<style>
    .count-cart.sel:after {
        position: absolute;
        top: 9px;
        right: auto;
        width: 18px;
        height: 18px;
        content: "<?php echo $_SESSION['rows']; ?>";
        color: #fff;
        line-height: 18px;
        text-align: center;
        border-radius: 50%;
        float: right;
    }

    .count-cart.sel span {
        width: 55px;
    }
</style>

<script>
    $('.count-cart').toggleClass('sel');
</script>