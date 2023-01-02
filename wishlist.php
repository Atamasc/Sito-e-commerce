<?php include "inc/autoloader.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>


</head>
<body class="home-5 home-6 home-8 home-9 home-electronic">

<div id="main">
    <!-- Header Start -->
    <?php include('inc/header.php'); ?>
    <!-- Header End -->
    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Wishlist</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- cart area start -->
    <div class="cart-main-area mtb-60px">
        <div class="container">
            <h3 class="cart-page-title">La tua wishlist</h3>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content" style="display: grid">
                        <table>
                            <thead>
                            <tr>
                                <th class="product_remove">Elimina</th>
                                <th class="product_thumb">Immagine</th>
                                <th class="product_name">Prodotto</th>
                                <th class="product-price">Prezzo</th>
                                <th class="product_total">Azioni</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $querySql =
                                "SELECT * FROM pr_prodotti " .
                                "INNER JOIN ws_wishlist ON ws_pr_codice = pr_codice " .
                                "WHERE ws_ut_codice = '$session_cl_codice' ";
                            $result = $dbConn->query($querySql);
                            $rows = $result->num_rows;

                            while ($row_data = $result->fetch_assoc()) {

                                $ws_id = $row_data['ws_id'];
                                $pr_id = $row_data['pr_id'];
                                $pr_codice = $row_data['pr_codice'];
                                $pr_giacenza = $row_data['pr_giacenza'];

                                $pr_immagine = getImmagineProdotto($pr_id);

                                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

                                $pr_titolo = $row_data['pr_titolo'];
                                $pr_link = generateProductLink($pr_id);
                                ?>

                                <tr>
                                    <td class="product_remove">
                                        <a href="ajax/wishlist-del-do?ws_id=<?php echo $ws_id; ?>">X</a></td>
                                    <td class="product_thumb">
                                        <a href="<?php echo $pr_link; ?>"><img src="<?php echo $pr_immagine; ?>" width="100px"></a>
                                    </td>
                                    <td class="product_name">
                                        <a href="<?php echo $pr_link; ?>"><b><?php echo $pr_titolo; ?></b></a><br></td>
                                    <td class="product-price">&euro;<?php echo formatPrice($pr_prezzo); ?></td>
                                    <td class="product_total">
                                        <div class="pro-details-quality" style="justify-content: center;">
                                            <div class="pro-details-cart btn-hover">
                                                <?php if ($pr_giacenza > 0) { ?>
                                                    <a href="javascript:;" class="button carrello-add" data-codice="<?php echo $pr_codice; ?>">Aggiungi al carrello</a>
                                                <?php } else { ?>
                                                    <a href="javascript:;" class="button">Non disponibile</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                            }
                            $result->close();

                            if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>La tua wishlist è vuota</td></tr>";
                            ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php include('inc/footer.php'); ?>
</div>

<?php include('inc/javascript.php'); ?>

</body>
</html>
