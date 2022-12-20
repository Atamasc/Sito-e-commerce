<?php include "inc/autoloader.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybek</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        #coupon {
            background: #fff;
            border: 1px solid #ebebeb;
            height: 45px;
            margin-bottom: 30px;
            padding-left: 10px;
            outline: none;
            width: 100%;
        }

        .hid-ambaradan input[type="radio"] {
            /* display:none; */
        }

        .hid-ambaradan label i {
            width: 60px;
            display: block;
            margin: 0 auto;
            font-size: 4em;
        }

        @media only screen and (max-width: 600px) {
            .hid-ambaradan label i {
                font-size: 2em;
                transform: translateX(15px);
            }

            .hid-ambaradan label span {
                font-size: 12px;
                line-height: 16px;
                margin-top: 20px;
            }

            .hid-ambaradan .col-xs-4:nth-child(4) label span {
                margin-top: 36px;
            }

            .hid-ambaradan .col-xs-4 {
                padding: 5px;
            }
        }

        .hid-ambaradan {
            padding-bottom: 35px;
        }

        .hid-ambaradan label span {
            width: 100%;
            text-align: center;
            display: block;
            color: #000;
            font-weight: 400;
        }

        .hid-ambaradan label {
            width: 100%;
            display: block;
            margin: 0 auto;
            cursor: pointer;
            padding: 20px 0 10px;
            margin-bottom: 30px;
            color: #fff;
            border-radius: 5px;
            background-color: #006dcc;
            border: 1px #ccc solid;
            box-shadow: #ccc 2px 2px 5px;
        }

        #payment label.active-payment {
            border: 1px #16ab39 solid;
            box-shadow: #ccc 2px 2px 5px;
            background-color: #16ab39;
            color: #fff;
        }

        #shipment label.active-shipment {
            border: 1px #16ab39 solid;
            box-shadow: #ccc 2px 2px 5px;
            background-color: #16ab39;
            color: #fff;
        }

        .hid-ambaradan label span {
            color: #fff;
            margin: 0;
        }

        .hid-ambaradan label.active span {
            color: #fff;
        }

        .speedition input[type="radio"] {
            display: inline;
            width: 20px;
            margin-top: 10px;
            margin-right: 10px;
            height: 20px;
        }

        .speedition label {
            line-height: 20px;
        }

        .speedition label i {
            margin-right: 20px;
        }

        .speedition h2 {
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 500;
            background: #f5f5f5;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #ebebeb;
            line-height: 40px;
        }


        .speedition .col-xs-12:nth-child(2),
        .speedition .col-xs-12:nth-child(3) {
            padding: 20px 40px;
        }

        .btn-hover {
            background-color: #4fb68b;
            color: #fff;
            display: block;
            font-weight: 700;
            letter-spacing: 1px;
            line-height: 1;
            padding: 18px 20px;
            text-align: center;
            text-transform: uppercase;
            border-radius: 50px;
            z-index: 9;
            border-width: 0px;
        }

        .btn-hover:hover {
            background: #253237;
            color: #fff;
        }

        .btn-hover-rapido {
            background-color: #0b659f;
            color: #fff;
            display: block;
            font-weight: 700;
            letter-spacing: 1px;
            line-height: 1;
            padding: 18px 20px;
            text-align: center;
            text-transform: uppercase;
            border-radius: 50px;
            z-index: 9;
            border-width: 0px;
        }

        .btn-hover-rapido:hover {
            background: #253237;
            color: #fff;
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
                        <h1 class="breadcrumb-hrading">Carrello</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="index.php">Home</a></li>
                            <li>Carrello</li>
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
            <h3 class="cart-page-title">Il tuo carrello</h3>

            <?php if (@$_GET["insert"] == "exist") { ?>
                <p class="alert alert-warning">La mail inserita nell'ordine rapido risulta già presente, accedi per completare l'ordine</p>
                <br/>
            <?php }; ?>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    <?php if ($session_cl_login == 0) { ?>
                    <form action="checkout-do" method="post" id="formCarrello">
                        <?php } else { ?>
                        <form action="carrello-preview-do" method="post" id="formCarrello">
                            <?php } ?>

                            <div class="table-content table-responsive cart-table-content" style="display: grid">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Immagine</th>
                                        <th>Prodotto</th>
                                        <th>Prezzo</th>
                                        <th>Quantit&agrave;</th>
                                        <th>Totale</th>
                                        <th>Cancella</th>
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
                                        $cr_note = $row_data['cr_note'];
                                        $cr_coupon_codice = $row_data['cr_coupon_codice'];
                                        $cr_spedizione = $row_data['cr_spedizione'];

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
                                                <?php if ($pr_giacenza > 1) { ?>
                                                    <span style="color: #198f35; font-weight: bold;">Disponibile</span>
                                                <?php } else if ($pr_giacenza == 1) { ?>
                                                    <span style="color: #FF7D27; font-weight: bold;">In esaurimento</span>
                                                <?php } else { ?>
                                                    <span style="color: #FE0000; font-weight: bold;">Non disponibile</span>
                                                <?php } ?>
                                                <br> <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                                            </td>
                                            <td class="product-price-cart">
                                                <span class="amount">&euro;<?php echo formatPrice($pr_prezzo); ?></span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="cr-quantita" data-carrello="<?php echo $cr_id; ?>" data-target="#TOTAL-<?php echo $cr_id; ?>">
                                                    <?php if ($pr_giacenza > 0) { ?>
                                                        <input value="<?php echo $cr_pr_quantita; ?>" max="<?php echo $pr_giacenza; ?>" min="1" type="number">
                                                    <?php } else { ?>
                                                        <input value="<?php echo $pr_giacenza; ?>" max="0" min="0" disabled type="number">
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">&euro;<span id="TOTAL-<?php echo $cr_id; ?>"><?php echo $pr_totale; ?></span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="ajax/carrello-del-do?cr_id=<?php echo $cr_id; ?>"><i class="fa fa-times"></i></a>
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


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-clear">
                                            <!-- <button>Update Shopping Cart</button> -->
                                            <a href="index.php">Continua gli acquisti</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="payment" class="row hid-ambaradan">
                                <div class="col-12">
                                    <h3 style="font-weight: 500; font-size: 22px; margin-bottom: 20px;">Scegli il metodo di pagamento: </h3>
                                </div>

                                <div class="col-md-3">
                                    <label class="active-payment" for="stripe"><i class="fab fa-cc-stripe"></i><span>Carta di credito / Visa e Mastercard</span></label>
                                    <input style="display: none;" type="radio" id="stripe" name="cr_pagamento" title="Carta di credito" value="Stripe" checked>
                                    <span><em>Pagamento immediato con carta di credito o carta prepagata ricaricabile online</em></span>
                                </div>

                                <div class="col-md-3">
                                    <label for="paypal"><i class="fab fa-cc-paypal"></i><span>Paypal / carte di credito</span></label>
                                    <input style="display: none;" type="radio" id="paypal" name="cr_pagamento" title="Paypal" value="Paypal">
                                    <span><em>Pagamento immediato con conto paypal o carta di credito sul circuito paypal</em></span>
                                </div>

                                <div class="col-md-3">
                                    <label for="bonifico"><i class="fa fa-bank"></i><span>Bonifico bancario</span></label>
                                    <input style="display: none;" type="radio" id="bonifico" name="cr_pagamento" title="Bonifico" value="Bonifico">
                                    <span><em>Pagamento con bonifico bancario e contabilizzazione in almeno 2 giorni lavorativi</em></span>
                                </div>

                                <div class="col-md-3">
                                    <label for="contrassegno"><i class="fa fa-truck"></i><span>Contrassegno</span></label>
                                    <input style="display: none;" type="radio" id="contrassegno" name="cr_pagamento" title="Contrassegno" value="Contrassegno">
                                    <span><em>Pagamento in contanti al corriere, il servizio di spedizione prevede un supplemento di &euro; 7,90</em></span>
                                </div>

                            </div>

                            <div id="shipment" class="row hid-ambaradan">
                                <div class="col-12">
                                    <h3 style="font-weight: 500; font-size: 22px; margin-bottom: 20px;">Scegli le consegna:</h3>
                                </div>

                                <?php
                                $querySql = "SELECT * FROM ci_corrieri WHERE ci_stato > 0";
                                $result = $dbConn->query($querySql);
                                $rows = $result->num_rows;

                                while ($row_data = $result->fetch_assoc()) {

                                    $ci_id = $row_data['ci_id'];
                                    $ci_titolo = $row_data['ci_titolo'];
                                    $ci_descrizione = $row_data['ci_descrizione'];
                                    $ci_costo_standard = $row_data['ci_costo_standard'];
                                    $ci_costo_espressa = $row_data['ci_costo_espressa'];
                                    $ci_costo_estera = $row_data['ci_costo_estera'];
                                    $ci_tempi_standard = $row_data['ci_tempi_standard'];
                                    ?>
                                    <div class="col-md-3" style="background-color: #fff; padding: 10px;">
                                        <label <?php if ($ci_titolo == "BRT") echo "class='active-shipment'"; ?> for="<?php echo $ci_titolo; ?>"><span><?php echo $ci_titolo; ?></span></label>
                                        <input style="display: none;" type="radio" id="<?php echo $ci_titolo; ?>" name="cr_spedizione" title="<?php echo $ci_titolo; ?>" value="<?php echo $ci_titolo; ?>">
                                        <p>
                                            Spedizione Italia: &euro; <?php echo formatPrice($ci_costo_standard); ?>
                                            <br> Spedizione estera : &euro; <?php echo formatPrice($ci_costo_estera); ?>
                                            <br> Tempi di spedizione: <?php echo $ci_tempi_standard; ?>
                                        </p>
                                    </div>
                                    <?php

                                }
                                $result->close();

                                if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>Spedizione con Corriere Nazionale</td></tr>";
                                ?>
                            </div>


                            <?php if ($session_cl_login > 0) { ?>
                                <div id="address" class="row hid-ambaradan">
                                    <div class="col-12">
                                        <h3 style="font-weight: 500; font-size: 22px; margin-bottom: 20px;">Scegli indirizzo di spedizione:</h3>
                                    </div>

                                    <?php
                                    $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$session_cl_codice'";
                                    $result = $dbConn->query($querySql);
                                    $rows = $result->num_rows;

                                    while ($row_data = $result->fetch_assoc()) {

                                        $ut_indirizzo = $row_data['ut_indirizzo'];
                                        $ut_cap = $row_data['ut_cap'];
                                        $ut_citta = $row_data['ut_citta'];
                                        $ut_provincia = $row_data['ut_provincia'];
                                        ?>
                                        <div class="col-md-5">
                                            <h4 style="font-size: 18px; margin-bottom: 15px;">
                                                <span style="background: #4fb68b; color: #fff; padding: 5px;">Indirizzo Principale</span>
                                            </h4>
                                            <input type="radio" id="principale" name="cr_indirizzo" title="principale" value="principale" style="margin-bottom: 20px;" checked>
                                            <?php echo $ut_indirizzo; ?>, <?php echo $ut_citta; ?> - <?php echo $ut_cap; ?> (<?php echo $ut_provincia; ?>)
                                        </div>

                                        <?php

                                    }
                                    $result->close();
                                    ?>
                                </div>
                            <?php } ?>


                            <div class="row" style="justify-content: space-between;">
                                <div class="col-lg-4 col-md-6">
                                    <div class="cart-tax">
                                        <div class="title-wrap">
                                            <h4 class="cart-bottom-title section-bg-gray">COUPON E NOTE ORDINE</h4>
                                        </div>
                                        <!--<div class="tax-wrapper">
                                            <p>Enter your destination to get a shipping estimate.</p>
                                            <div class="tax-select-wrapper">
                                                <div class="tax-select">
                                                    <label>
                                                        * Country
                                                    </label>
                                                    <select class="email s-email s-wid">
                                                        <option>Bangladesh</option>
                                                        <option>Albania</option>
                                                        <option>Åland Islands</option>
                                                        <option>Afghanistan</option>
                                                        <option>Belgium</option>
                                                    </select>
                                                </div>
                                                <div class="tax-select">
                                                    <label>
                                                        * Region / State
                                                    </label>
                                                    <select class="email s-email s-wid">
                                                        <option>Bangladesh</option>
                                                        <option>Albania</option>
                                                        <option>Åland Islands</option>
                                                        <option>Afghanistan</option>
                                                        <option>Belgium</option>
                                                    </select>
                                                </div>
                                                <div class="tax-select mb-25px">
                                                    <label>
                                                        * Zip/Postal Code
                                                    </label>
                                                    <input type="text" />
                                                </div>
                                                <button class="cart-btn-2" type="submit">Get A Quote</button>
                                            </div>
                                        </div>-->

                                        <div class="tax-wrapper">
                                            <div class="tax-select-wrapper">
                                                <div class="discount-code">
                                                    <p>
                                                        Inserisci qui il codice coupon se ne hai uno. Per usare il codice coupon sconto, devi essere registrato.
                                                        <br>
                                                        <a href="registrati.php">Clicca qui per registrarti in 30 secondi</a>
                                                    </p>
                                                    <input type="text" name="cr_coupon" autocomplete="off" id="coupon" style="margin-bottom: 15px;"/>
                                                </div>
                                                <hr>
                                                <p class="mt-3" style="padding-top: 15px; margin-bottom: 10px;">Note ordine e biglietto regalo</p>
                                                <textarea id="coupon" name="cr_note" rows="4" style="width: 100%; height: 100px; margin-bottom: 0px;" placeholder="Specifica qui eventuali note ordine oppure quale messaggio vuoi che sia scritto in caso di confezione regalo."><?php echo @$cr_note; ?></textarea>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="discount-code-wrapper">
                                        <div class="title-wrap">
                                            <h4 class="cart-bottom-title section-bg-gray">REGISTRAZIONE</h4>
                                        </div>
                                        <div class="discount-code">
                                            <p>
                                                Scopri i vantaggi riservati di registrarti sul nostro sito per acquistare in sicurezza<br>
                                            </p>
                                        </div>

                                        <hr>
                                        <div class="discount-code">
                                            <p>
                                                <strong>Acquisto con registrazione all'area cliente</strong>
                                                <br> Se ti registri anche in fase di acquisto, puoi utilizzare i coupon sconto.
                                                <br> Inoltre registrandoti avrai una tua area riservata da cui visionare gli ordini, consultare lo stato di avanzamento e modificare le tue informazioni.
                                                <br>
                                            </p>
                                        </div>

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
                                //$cr_iva = $cr_totale * 0.22;
                                //$cr_no_iva = $cr_totale - $cr_iva;

                                $cr_imponibile = $cr_totale / 1.22;
                                $cr_iva = $cr_totale - $cr_imponibile;
                                ?>

                                <div class="col-lg-4 col-md-12">
                                    <div class="grand-totall">
                                        <div class="title-wrap">
                                            <h4 class="cart-bottom-title section-bg-gary-cart">IMPORTO CARRELLO</h4>
                                        </div>

                                        <h5>Riepilogo importi della merce in carrello senza spedizione</h5>
                                        <div class="total-shipping">
                                            <h5>Importi carrello</h5>
                                            <ul>
                                                <li>Imponibile
                                                    <span>&euro;<?php echo formatPrice($cr_imponibile); ?></span></li>
                                                <li>Iva <span>&euro;<?php echo formatPrice($cr_iva); ?></span></li>
                                            </ul>
                                        </div>
                                        <h4 class="grand-totall-title">Totale carrello
                                            <span>&euro;<?php echo formatPrice($cr_totale); ?></span></h4>
                                        <!-- <a href="#">Proceed to Checkout</a> -->

                                        <!--
                                <div class="carrello-total">
                                    <h5>Imponibile <span>&euro;<?php echo formatPrice($cr_imponibile); ?></span></h5>
                                    <h5>IVA <span>&euro;<?php echo formatPrice($cr_iva); ?></span></h5>
                                    <h4 class="grand-totall-title">Totale<span>&euro;<?php echo formatPrice($cr_totale); ?></span></h4><br>
                                </div>
                                -->

                                        <hr>

                                        <?php if ($session_cl_login == 0) { ?>
                                            <p>Registrati o accedi per effettuare l'acquisto</p><br>
                                            <a style="width: 290px; display: inline-block !important;" href="<?php echo "$rootBasePath_http/registrati"; ?>">Registrati subito</a>
                                            <br><br>
                                            <a style="width: 290px; display: inline-block !important;" href="<?php echo "$rootBasePath_http/login"; ?>">Accedi alla tua area</a>
                                            
                                        <?php } else {

                                            echo "<button class=\"btn-hover\" type=\"submit\" style=\"width: 100%;\">Conferma carrello</button>";

                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </form>

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
    $(document).ready(function () {
        $('#payment label').click(function () {
            $('#payment label').removeClass('active-payment');
            $(this).addClass('active-payment');
        });

        $('#shipment label').click(function () {
            $('#shipment label').removeClass('active-shipment');
            $(this).addClass('active-shipment');
        });

    });
</script>

</body>
</html>
