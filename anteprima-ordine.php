<?php include "inc/autoloader.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

</head>
<body class="home-5 home-6 home-8 home-9 home-electronic">
<!-- main layout start from here -->
<!--====== PRELOADER PART START ======-->

<!-- <div id="preloader">
<div class="preloader">
    <span></span>
    <span></span>
</div>
</div> -->

<!--====== PRELOADER PART ENDS ======-->
<div id="main">
    <!-- Header Start -->
    <?php include('inc/header-2.php'); ?>
    <!-- Header End -->
    <!-- Breadcrumb Area start -->
    <section class="breadcrumb-area" style="background: url(assets/images/breadcrumb-bg/breadcrumb.jpg) no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <h1 class="breadcrumb-hrading">Anteprima ordine</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Anteprima ordine</li>
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
            <h3 class="cart-page-title">Anteprima ordine</h3>

            <?php if (@$_GET['del'] == 'true') { ?>
                <div class="alert alert-danger">
                    Alcuni prodotti sono stati eliminati dal carrello perchè non risultano disponibili al momento. Grazie.
                </div>
            <?php } ?>

            <?php if (@$_GET['insert'] == 'false') { ?>
                <div class="alert alert-danger">
                    Si &egrave; verificato un errore. Riprova!
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="table-content table-responsive cart-table-content" style="display: grid">
                        <table>
                            <thead>
                            <tr>
                                <th>Immagine</th>
                                <th>Prodotto</th>
                                <th>Prezzo</th>
                                <th>Quantit&agrave;</th>
                                <th>Totale</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $querySql =
                                "SELECT * FROM pr_prodotti " .
                                "INNER JOIN cr_carrello ON cr_pr_codice = pr_codice " .
                                "WHERE cr_ut_codice = '$session_cl_codice' ";
                            $result = $dbConn->query($querySql);
                            $rows = $result->num_rows;

                            $cr_totale = 0;
                            while ($row_data = $result->fetch_assoc()) {

                                $cr_id = $row_data['cr_id'];
                                $pr_id = $row_data['pr_id'];
                                $pr_codice = $row_data['pr_codice'];
                                $pr_giacenza = $row_data['pr_giacenza'];
                                $cr_pr_quantita = $row_data['cr_pr_quantita'];
                                $cr_indirizzo = $row_data['cr_indirizzo'];
                                $cr_note = $row_data['cr_note'];

                                $pr_immagine = strlen($row_data['pr_immagine'])
                                    ? "$rootBasePath_http/upload/prodotti/" . $row_data['pr_immagine']
                                    : "$rootBasePath_http/assets/img/no_img.jpg";

                                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

                                $pr_titolo = $row_data['pr_titolo'];
                                $pr_link = generateProductLink($pr_id);

                                $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
                                $pr_totale = formatPrice($pr_prezzo * $cr_pr_quantita);
                                ?>

                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="<?php echo $pr_link; ?>"><img src="<?php echo $pr_immagine; ?>" style="width: 100px" alt="<?php echo $pr_titolo; ?>"/></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a></td>
                                    <td class="product-price-cart">
                                        <span class="amount">&euro;<?php echo formatPrice($pr_prezzo); ?></span></td>
                                    <td class="product-quantity"><?php echo $cr_pr_quantita; ?></td>
                                    <td class="product-subtotal">&euro;<span id="TOTAL-<?php echo $cr_id; ?>"><?php echo $pr_totale; ?></span>
                                    </td>
                                </tr>

                                <?php

                            }
                            $result->close();

                            if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>Il tuo carrello è vuoto</td></tr>";
                            ?>

                            </tbody>
                        </table>
                    </div>

                    <br><br>


                    <!--<div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <button>Update Shopping Cart</button>
                                    <a href="#">Clear Shopping Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <div class="row" style="justify-content: space-between;">

                        <?php
                        $querySql =
                            "SELECT * FROM ut_utenti " .
                            "WHERE ut_codice = '$session_cl_codice' ";
                        $result = $dbConn->query($querySql);
                        $rows = $result->num_rows;

                        while ($row_data = $result->fetch_assoc()) {

                            $ut_indirizzo = $row_data['ut_indirizzo'];
                            $ut_cap = $row_data['ut_cap'];
                            $ut_citta = $row_data['ut_citta'];
                            $ut_provincia = $row_data['ut_provincia'];
                            ?>

                            <div class="col-lg-4 col-md-6">
                                <div class="cart-tax" style="<?php if (isMobile()) echo ''; else echo 'width: 450px;'; ?>">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">INDIRIZZO DI SPEDIZIONE</h4>
                                    </div>

                                    <div class="tax-wrapper">
                                        <p>Controlla il seguente indirizzo di spedizione, se non è corretto clicca sul pulsante per aggiornarlo.</p>
                                        <br>
                                        <p>
                                            Indirizzo: <?php echo $ut_indirizzo; ?> <br> CAP: <?php echo $ut_cap; ?>
                                            <br> Città: <?php echo $ut_citta; ?>
                                            <br> Provincia <?php echo $ut_provincia; ?><br>
                                        </p>
                                        <br>
                                        <div class="tax-select-wrapper">
                                            <a href="my-account">
                                                <button class="cart-btn-2" type="submit">Modifica Indirizzo</button>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php
                        }
                        $result->close();
                        ?>

                        <?php
                        $querySql =
                            "SELECT * FROM cr_carrello " .
                            "INNER JOIN ci_corrieri ON ci_titolo = cr_spedizione " .
                            "WHERE cr_ut_codice = '$session_cl_codice' LIMIT 0,1 ";
                        $result = $dbConn->query($querySql);
                        $rows = $result->num_rows;

                        while ($row_data = $result->fetch_assoc()) {

                            $cr_spedizione = $row_data['cr_spedizione'];
                            $ci_titolo = $row_data['ci_titolo'];
                            $ci_tempi_standard = $row_data['ci_tempi_standard'];
                            $ut_cap = $row_data['ci_descrizione'];
                            $ut_citta = $row_data['ci_costo_standard'];
                            $ut_provincia = $row_data['ci_ordine_minimo'];
                            ?>

                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">CORRIERE SELEZIONATO</h4>
                                    </div>
                                    <div class="discount-code">
                                        <p>Il tuo ordine sarà spedito da: <?php echo $cr_spedizione; ?></p>
                                        <p>
                                            Tempi di consegna: <?php echo $ci_tempi_standard; ?>
                                            <br><br> Riceverai una mail quando la spedizione sarà affidata al corriere.<br> Per modificare il corriere clicca sul pulsante di seguito.
                                        </p>
                                        <br> <a href="carrello">
                                            <button class="cart-btn-2">Modifica corriere</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        $result->close();
                        ?>

                        <!--<div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">Codice Coupon</h4>
                                </div>
                                <div class="discount-code">
                                    <p>Inserisci qui il codice coupon se ne hai uno.</p>
                                    <form>
                                        <input type="text" required="" name="name" />
                                        <button class="cart-btn-2" type="submit">Applica Coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>-->

                        <?php
                        $querySql = "SELECT * FROM cr_carrello INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice WHERE cr_ut_codice = '$session_cl_codice' ";
                        $result = $dbConn->query($querySql);

                        $cr_totale = 0;
                        while ($row_data = $result->fetch_assoc()) {
                            $cr_pagamento = $row_data['cr_pagamento'];
                            $cr_spedizione = $row_data['cr_spedizione'];
                            $cr_pr_quantita = $row_data['cr_pr_quantita'];
                            $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
                            $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
                            $cr_coupon_spedizione = $row_data['cr_coupon_spedizione'];
                            $cr_coupon = $row_data['cr_coupon'];
                            $cr_coupon2 = $row_data['cr_coupon'];
                            $cr_coupon_tipo = $row_data['cr_coupon_tipo'];
                        }

                        $cr_coupon = $cr_coupon_tipo == "importo"
                            ? (float)$cr_coupon
                            : (float)($cr_totale / 100) * (float)$cr_coupon;


                        $cr_pagamento_prezzo = getPrezzoPagamento($cr_pagamento, $cr_totale);
                        $cr_spedizione_prezzo = getPrezzoSpedizione($cr_spedizione, $cr_totale);

                        if ($cr_coupon_spedizione == 1) {
                            $cr_spedizione_prezzo = 0.00;
                        }

                        $result->close();

                        //$cr_sconto = getScontoPunti($cr_punti);

                        $cr_imponibile = $cr_totale / 1.22;
                        $cr_iva = $cr_totale - $cr_imponibile;

                        $cr_totale = $cr_totale - $cr_coupon + $cr_pagamento_prezzo + $cr_spedizione_prezzo;
                        ?>

                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">TOTALE</h4>
                                </div>

                                <div class="carrello-total">
                                    <h5>Imponibile <span>&euro;<?php echo formatPrice($cr_imponibile); ?></span></h5>
                                    <h5>IVA <span>&euro;<?php echo formatPrice($cr_iva); ?></span></h5>
                                    <h5>Spese di spedizione
                                        <span>&euro;<?php echo formatPrice($cr_spedizione_prezzo); ?></span></h5>
                                    <h5>Spese di pagamento (<?php echo $cr_pagamento; ?>)
                                        <span>&euro;<?php echo formatPrice($cr_pagamento_prezzo); ?></span></h5>

                                    <?php
                                    if ($cr_coupon > 0) {
                                        ?>
                                        <h5>Sconto coupon <?php if ($cr_coupon_tipo == "percentuale") echo "(" . $cr_coupon2 . "%)"; ?>
                                            <span><b>-</b> &euro;<?php echo formatPrice($cr_coupon); ?></span></h5>

                                        <?php

                                    }
                                    ?>

                                    <h4 class="grand-totall-title">Totale<span>&euro;<?php echo formatPrice($cr_totale); ?></span>
                                    </h4><br>

                                </div>
                                <a style="margin-right: 5px; display: inline-block !important;" href="<?php echo "$rootBasePath_http"; ?>"> Continua gli acquisti </a> o
                                <a style="margin-left: 5px; display: inline-block !important;" href="<?php echo "$rootBasePath_http/carrello-confirm-do"; ?>">Conferma l'ordine</a>

                                <br><br>
                                <?php
                                if (strlen($cr_note) > 0) {

                                    ?>
                                    <p style="font-size: smaller;">Note ordine: <?php echo $cr_note; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart area end -->
    <!-- Footer Area start -->
    <?php include('inc/footer.php'); ?>
    <!--  Footer Area End -->
</div>

<?php include('inc/javascript.php'); ?>

</body>
</html>
