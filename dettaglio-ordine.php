<?php include "inc/autoloader.php"; ?>
<?php
$get_or_codice = isset($_GET["or_codice"]) ? $dbConn->real_escape_string($_GET["or_codice"]) : 0;

//TODO setto il valore di conversione di default a 1 prima dell'assegnazione reale di conversione
$or_totale_ordine = '1';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

    <?php
    if (@$_GET['insert'] == 'true') {
        $querySql = "SELECT COUNT(or_id) AS or_count, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale, or_pagamento, or_spedizione, or_tipo_spedizione, or_coupon, or_coupon_valore, or_coupon_tipo FROM or_ordini WHERE or_codice = '$get_or_codice' ";
        $result = $dbConn->query($querySql);
        $row_data = $result->fetch_assoc();

        $or_count = $row_data['or_count'];
        $or_totale = $row_data['or_totale'];

        $or_pagamento = $row_data['or_pagamento'];
        $or_spedizione = $row_data['or_spedizione'];
        $or_coupon_valore = $row_data['or_coupon_valore'];
        $or_coupon_tipo = $row_data['or_coupon_tipo'];
        $or_coupon = $row_data['or_coupon'];
        $or_tipo_spedizione = $row_data['or_tipo_spedizione'];

        $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
        $or_spedizione_prezzo = getPrezzoSpedizione($or_tipo_spedizione, $or_totale);

        $result->close();

        $or_imponibile = $or_totale / 1.22;
        $or_iva = $or_totale - $or_imponibile;

        $or_sconto_coupon = 0;
        if (strlen($or_coupon) > 0) {
            $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale / 100) * $or_coupon_valore;
        }

        $or_totale_ordine = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione;

        $ut_email = getEmailClienteByCodice($session_cl_codice, $dbConn);
    }
    ?>

    <style>
        .stato h5 {
            font-weight: bold;
        }

        .stato h5 span {
            padding: 5px 10px;
            margin-left: 20px;
            border-radius: 15px;
            color: #fff;
            font-size: 13px;
            text-transform: uppercase;
        }

        .stato h5 span.success {
            background: #73cc77;
        }

        .stato h5 span.danger {
            background: #ff7776;
        }

        .form-select {
            width: 100%;
            display: block;
            border: 1px solid #e1e1e1;
        }
    </style>
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
                        <h1 class="breadcrumb-hrading">Dettaglio ordine</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Dettaglio ordine</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <div id="logo_stampa" style="display: none">
        <img src="<?php echo "$rootBasePath_http/assets/images/logo/logo.png"; ?>" style="margin-left: 150px;">
    </div>

    <!-- cart area start -->
    <div class="cart-main-area mtb-60px">
        <div class="container" id="container">
            <h3 class="cart-page-title">Dettaglio ordine</h3>

            <?php if (@$_GET['insert'] == 'true') { ?>
                <div class="alert alert-success">
                    Acquisto avvenuto con successo!
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
                                "INNER JOIN or_ordini ON or_pr_codice = pr_codice " .
                                "WHERE or_ut_codice = '$session_cl_codice' AND or_codice = '$get_or_codice' ";
                            $result = $dbConn->query($querySql);
                            $rows = $result->num_rows;

                            $or_totale = 0;
                            while ($row_data = $result->fetch_assoc()) {

                                $or_id = $row_data['or_id'];
                                $pr_id = $row_data['pr_id'];
                                $pr_codice = $row_data['pr_codice'];
                                $pr_quantita = $row_data['pr_quantita'];
                                $or_pr_quantita = $row_data['or_pr_quantita'];
                                $or_pagamento = $row_data['or_pagamento'];
                                $or_tipo_spedizione = $row_data['or_tipo_spedizione'];
                                $or_tracking = @$row_data['or_tracking'];

                                $pr_immagine = strlen($row_data['pr_immagine'])
                                    ? "$rootBasePath_http/upload/prodotti/" . $row_data['pr_immagine']
                                    : "$rootBasePath_http/assets/img/no_img.jpg";

                                $pr_prezzo = $row_data['or_pr_prezzo'];

                                $pr_titolo = $row_data['pr_titolo'];
                                $pr_link = generateProductLink($pr_id);

                                $or_totale = $or_totale + ($pr_prezzo * $or_pr_quantita);
                                $pr_totale = formatPrice($pr_prezzo * $or_pr_quantita);
                                ?>

                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="<?php echo $pr_link; ?>"><img src="<?php echo $pr_immagine; ?>" style="width: 100px" alt="<?php echo $pr_titolo; ?>"/></a>
                                    </td>
                                    <td class="product-name">
                                        <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a></td>
                                    <td class="product-price-cart">
                                        <span class="amount">&euro;<?php echo formatPrice($pr_prezzo); ?></span></td>
                                    <td class="product-quantity"><?php echo $or_pr_quantita; ?></td>
                                    <td class="product-subtotal">&euro;<span id="TOTAL-<?php echo $or_id; ?>"><?php echo $pr_totale; ?></span>
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
                        $querySql = "SELECT * FROM or_ordini WHERE or_codice = '$get_or_codice' LIMIT 0, 1 ";
                        $result = $dbConn->query($querySql);
                        $row_data = $result->fetch_assoc();

                        $or_note = $row_data['or_note'];

                        $or_stato_pagamento = $row_data['or_stato_pagamento'] == 1
                            ? "<span class='success'>Pagato</span>" : "<span class='danger'>Non pagato</span>";
                        $or_stato_spedizione = $row_data['or_stato_spedizione'] == 1
                            ? "<span class='success'>Spedito</span>" : "<span class='danger'>Non spedito</span>";

                        $link_tracking = "<a style='text-align: left;' href='$or_tracking'>$or_tracking</a> ";

                        $result->close();
                        ?>

                        <div class="col-lg-4 col-md-6">
                            <div class="cart-tax" style="<?php if (isMobile()) echo ''; else echo 'width: 630px;'; ?>">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gray">STATO ORDINE</h4>
                                </div>

                                <div class="stato"><br>
                                    <h5>Ordine N°: <?php echo $get_or_codice; ?></h5><br>
                                    <h5>Stato pagamento: <?php echo $or_stato_pagamento; ?></h5><br>
                                    <h5>Stato spedizione: <?php echo $or_stato_spedizione; ?></h5><br>
                                    <hr>
                                    <p><b>Note ordine:</b> <?php echo $or_note; ?></p>

                                    <?php if (@strlen($row_data['or_tracking']) > 0) { ?>
                                        <p><b>Tracking:</b> <?php echo $link_tracking; ?></p>
                                    <?php } ?>
                                </div>

                                <?php
                                if ($row_data['or_stato_pagamento'] == 0) {

                                    ?>
                                    <hr style="margin-bottom: 20px;">
                                    <form action="ordini-mod-do" method="post">
                                        <p style="padding-bottom: 9px"><b>Cambia metodo di pagamento</b></p>

                                        <select id="or_pagamento" name="or_pagamento" class="form-select" required onchange="this.form.submit();" style="">
                                            <option value="Paypal" <?php echo $or_pagamento == "Paypal" ? "selected" : ""; ?>>Carta di credito / Paypal</option>
                                            <option value="Bonifico" <?php echo $or_pagamento == "Bonifico" ? "selected" : ""; ?>>Bonifico</option>
                                            <option value="Contrassegno" <?php echo $or_pagamento == "Contrassegno" ? "selected" : ""; ?>>Contrassegno</option>
                                            <option value="Stripe" <?php echo $or_pagamento == "Stripe" ? "selected" : ""; ?>>Carta di credito / Stripe</option>
                                        </select>

                                        <input type="hidden" name="or_codice" value="<?php echo $get_or_codice; ?>">
                                    </form>
                                    <br>

                                    <?php

                                }

                                if ($or_pagamento == "Bonifico") {

                                    ?>
                                    <br>
                                    <hr>
                                    <p><b>Dettagli bonifico</b></p>
                                    <table>
                                        <tr>
                                            <td style="width: 50%;">Intestatario bonifico:</td>
                                            <td><strong><?php echo $bonifico["int_conto"]; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Banca:</td>
                                            <td><strong><?php echo $bonifico["banca_bonifico"]; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>IBAN:</td>
                                            <td><strong><?php echo $bonifico["iban_bonifico"]; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Bic/swift:</td>
                                            <td><strong><?php echo $bonifico["bic_bonifico"]; ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>Causale:</td>
                                            <td>
                                                <strong>Acquisto moncaffe.it N° ordine <?php echo $get_or_codice; ?></strong>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php

                                } else if ($row_data['or_stato_pagamento'] == 0 && $or_pagamento == 'Paypal') {

                                    $querySql = "SELECT COUNT(or_id) AS or_count, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale, or_pagamento, or_spedizione, or_tipo_spedizione, or_coupon, or_coupon_valore, or_coupon_tipo FROM or_ordini WHERE or_codice = '$get_or_codice' ";
                                    $result = $dbConn->query($querySql);
                                    $row_data = $result->fetch_assoc();

                                    $or_count = $row_data['or_count'];
                                    $or_totale = $row_data['or_totale'];

                                    $or_pagamento = $row_data['or_pagamento'];
                                    $or_spedizione = $row_data['or_spedizione'];
                                    $or_coupon_valore = $row_data['or_coupon_valore'];
                                    $or_coupon_tipo = $row_data['or_coupon_tipo'];
                                    $or_coupon = $row_data['or_coupon'];
                                    $or_tipo_spedizione = $row_data['or_tipo_spedizione'];

                                    $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
                                    $or_spedizione_prezzo = getPrezzoSpedizione($or_tipo_spedizione, $or_totale);

                                    $result->close();

                                    $or_imponibile = $or_totale / 1.22;
                                    $or_iva = $or_totale - $or_imponibile;

                                    $or_sconto_coupon = 0;
                                    if (strlen($or_coupon) > 0) {
                                        $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale / 100) * $or_coupon_valore;
                                    }

                                    $or_totale_ordine = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione;

                                    $importo_totale_ordine_paypal = number_format($or_totale_ordine, 2, '.', '');

                                    /*
                                    $_SESSION['or_codice'] = $get_or_codice;
                                    $_SESSION['importo_totale'] = $importo_totale_ordine_paypal;

                                    $gestpay_link = "$rootBasePath_http/pagamento-paypal";
                                    */

                                    $return_link = "$rootBasePath_http/confirmPayPal.php?or_codice=$get_or_codice";
                                    $cancel_link = "$rootBasePath_http/dettaglio-ordine?or_codice=$get_or_codice&insert=false";

                                    $paypal_link = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=$emailPaypal&item_name=Order Code&item_number=$get_or_codice&amount=$importo_totale_ordine_paypal&invoice=$get_or_codice&currency_code=EUR&return=$return_link&cancel_return=$cancel_link";

                                    ?>

                                    <div style="margin-top: 45px;">
                                        <a style="max-width: 200px; text-align: center;" class="btn btn-primary" href="<?php echo $paypal_link; ?>">Paga adesso</a>
                                    </div>

                                    <!-- //TODO LUCA: Fix su errore stripe ho uploadato pagina e ho notato un doppio bottone paypal, forse la nuova procedura di paypal che non è completa ?
                                    <div style="margin-top: 45px;">
                                        <a style="max-width: 200px; text-align: center;" class="btn btn-primary"
                                           href="pagamento-paypal?or_codice=<?php echo $get_or_codice; ?>">Paga adesso</a>
                                    </div>
                                    -->
                                    <?php


                                } else if ($row_data['or_stato_pagamento'] == 0 && $or_pagamento == 'Stripe') {

                                    $querySql = "SELECT COUNT(or_id) AS or_count, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale, or_pagamento, or_spedizione, or_tipo_spedizione, or_coupon, or_coupon_valore, or_coupon_tipo FROM or_ordini WHERE or_codice = '$get_or_codice' ";
                                    $result = $dbConn->query($querySql);
                                    $row_data = $result->fetch_assoc();

                                    $or_count = $row_data['or_count'];
                                    $or_totale = $row_data['or_totale'];

                                    $or_pagamento = $row_data['or_pagamento'];
                                    $or_spedizione = $row_data['or_spedizione'];
                                    $or_coupon_valore = $row_data['or_coupon_valore'];
                                    $or_coupon_tipo = $row_data['or_coupon_tipo'];
                                    $or_coupon = $row_data['or_coupon'];
                                    $or_tipo_spedizione = $row_data['or_tipo_spedizione'];

                                    $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
                                    $or_spedizione_prezzo = getPrezzoSpedizione($or_tipo_spedizione, $or_totale);

                                    $result->close();

                                    $or_imponibile = $or_totale / 1.22;
                                    $or_iva = $or_totale - $or_imponibile;

                                    $or_sconto_coupon = 0;
                                    if (strlen($or_coupon) > 0) {
                                        $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale / 100) * $or_coupon_valore;
                                    }

                                    $or_totale_ordine = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione;
                                    $importo_totale_ordine = number_format($or_totale_ordine, 2, '.', '');

                                    $stripe_redirect = generateStripeFastOrder($get_or_codice, $importo_totale_ordine);
                                    ?>

                                    <div style="margin-top: 45px;">
                                        <a style="max-width: 200px; text-align: center;" class="btn btn-primary" href="<?php echo $stripe_redirect; ?>">Paga adesso</a>
                                    </div>
                                    <?php


                                }
                                ?>

                            </div>
                        </div>


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
                        /*
                        $querySql_count = "SELECT SUM(or_pr_prezzo * or_pr_quantita) AS or_totale FROM or_ordini WHERE or_codice = '$get_or_codice' ";
                        $result_count = $dbConn->query($querySql_count);
                        $row_data = $result_count->fetch_assoc();

                        $or_totale = $row_data['or_totale'];

                        $punti_ordine = $or_totale / 2;
                        $punti_ordine = ceil($punti_ordine);*/

                        $querySql = "SELECT COUNT(or_id) AS or_count, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale, or_pagamento, or_spedizione, or_coupon_valore, or_coupon_tipo, or_coupon, or_tipo_spedizione FROM or_ordini WHERE or_codice = '$get_or_codice' ";
                        $result = $dbConn->query($querySql);
                        $row_data = $result->fetch_assoc();

                        $or_count = $row_data['or_count'];
                        $or_totale = $row_data['or_totale'];

                        $or_pagamento = $row_data['or_pagamento'];
                        $or_spedizione = $row_data['or_spedizione'];
                        $or_coupon_valore = $row_data['or_coupon_valore'];
                        $or_coupon_tipo = $row_data['or_coupon_tipo'];
                        $or_coupon = @$row_data['or_coupon'];
                        $or_tipo_spedizione = $row_data['or_tipo_spedizione'];

                        $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
                        $or_spedizione_prezzo = getPrezzoSpedizione($or_tipo_spedizione, $or_totale);
                        $or_coupon = getCouponByCodice($get_or_codice, $dbConn);

                        $or_sconto_coupon = 0;
                        if (@strlen($or_coupon) > 0) {
                            $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale / 100) * $or_coupon_valore;
                        }

                        $result->close();

                        $or_iva = $or_totale * 0.22;
                        $or_imponibile = $or_totale - $or_iva;

                        $or_totale = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione;

                        ?>

                        <div class="col-lg-4 col-md-12" style="max-width: unset;">
                            <div class="grand-totall" style="<?php if (isMobile()) echo ''; else echo 'width: 630px;'; ?>">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">TOTALE</h4>
                                </div>

                                <div class="carrello-total">
                                    <h5>Imponibile <span>&euro;<?php echo formatPrice($or_imponibile); ?></span></h5>
                                    <h5>IVA <span>&euro;<?php echo formatPrice($or_iva); ?></span></h5>
                                    <h5>Spese di spedizione
                                        <span>&euro;<?php echo formatPrice($or_spedizione); ?></span></h5>
                                    <h5>Spese di pagamento (<?php echo $or_pagamento; ?>)
                                        <span>&euro;<?php echo formatPrice($or_pagamento_prezzo); ?></span></h5>

                                    <?php
                                    if ($or_sconto_coupon > 0) {
                                        ?>
                                        <h5>Sconto (<?php echo $or_coupon; ?>)
                                            <span><b>-</b> &euro;<?php echo formatPrice($or_sconto_coupon); ?></span>
                                        </h5>

                                        <?php
                                    }
                                    ?>

                                    <h4 class="grand-totall-title">Totale<span>&euro;<?php echo formatPrice($or_totale); ?></span>
                                    </h4><br>

                                </div>

                                <div class="col-12 text-right" style="margin-top: 10px; <?php if (isMobile()) echo ''; else echo 'margin-left: 360px;'; ?>">
                                    <a style="max-width: 200px;" class="btn btn-secondary btn-print" href="javascript:PrintElem()">Stampa</a>
                                </div>

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

<script>

    function PrintElem() {

        $(".main-header").hide();
        $(".footer-area").hide();
        $("#logo_stampa").css('display', 'unset');
        $(".breadcrumb-area").hide();

        $(".btn-print").hide();
        window.print();
        $(".btn-print").fadeIn();

        $(".main-header").delay(2000).fadeIn();
        $(".footer-area").delay(2000).fadeIn();
        $(".breadcrumb-area").delay(2000).fadeIn();
        $("#logo_stampa").delay(2000).fadeOut();

    }

</script>

</body>
</html>
