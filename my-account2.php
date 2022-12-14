<?php include "inc/autoloader.php"; ?>
<?php
if ($session_cl_login == 0) header("Location: $rootBasePath_http");
?>
<!DOCTYPE html>
<html lang="it">
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
                        <h1 class="breadcrumb-hrading">Il mio Account</h1>
                        <ul class="breadcrumb-links">
                            <li><a href="<?php echo $rootBasePath_http; ?>">Home</a></li>
                            <li>Il mio Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    <!-- checkout area start -->
    <div class="checkout-area mt-60px mb-40px">
        <div class="container">

            <?php if (@$_GET["update"] == "true") { ?>
                <div class="alert alert-success"><b>Modifica effettuata con successo.</b></div>
            <?php }; ?>

            <?php if (@$_GET["login"] == "true") { ?>
                <div class="alert alert-success"><b>Bentornato sul nostro store!</b></div>
            <?php }; ?>

            <div class="row">
                <div class="col-lg-3 dashboard-menu-container">
                    <div class="your-order-area">

                        <h3>Il tuo Account</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <ul class="dashboard-menu">
                                <li>
                                    <a href="#" id="dashboard-button" onclick="dash()">Dashboard<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                                <li><a href="#" id="dati-button">Modifica Dati<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                                <li>
                                    <a href="#" id="password-button" onclick="psw()">Modifica Password<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                                <li>
                                    <a href="#" id="ordini-button">Storico Ordini<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                                <li><a href="#" id="carrelli-button">Carrello<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                                <li><a href="#" id="preferiti-button">Preferiti<i class="ion-ios-arrow-forward"></i></a>
                                </li>
                            </ul>
                            <ul class="dashboard-menu2">
                                <li><a href="logout.php">Logout<i class="ion-ios-arrow-forward"></i></a></li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <form action="account-do" method="post">

                        <?php
                        $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$session_cl_codice' ";
                        $result = $dbConn->query($querySql);
                        $row_data = $result->fetch_assoc();
                        $result->close();
                        ?>

                        <div class="billing-info-wrap" id="dati" style="display: none">

                            <h3>I tuoi Dati</h3>

                            <div class="row">

                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Nome *</label>
                                        <input type="text" name="ut_nome" id="ut_nome" value="<?php echo $row_data['ut_nome']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Cognome *</label>
                                        <input type="text" name="ut_cognome" id="ut_cognome" value="<?php echo $row_data['ut_cognome']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Telefono *</label>
                                        <input type="text" name="ut_telefono" id="ut_telefono" value="<?php echo $row_data['ut_telefono']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Email *</label>
                                        <input type="email" name="ut_email" id="ut_email" value="<?php echo $row_data['ut_email']; ?>" required readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Provincia *</label>
                                        <input type="text" name="ut_provincia" id="ut_provincia" value="<?php echo $row_data['ut_provincia']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Comune *</label>
                                        <input type="text" name="ut_citta" id="ut_citta" value="<?php echo $row_data['ut_citta']; ?>" required>
                                        <!--
                                        <select id="comune" name="ut_citta" >
                                            <option value="">Seleziona una comune'</option>
                                            <option value=""></option>
                                        </select>
                                        -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Indirizzo *</label>
                                        <input type="text" name="ut_indirizzo" id="ut_indirizzo" value="<?php echo $row_data['ut_indirizzo']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>CAP *</label>
                                        <input type="text" name="ut_cap" id="ut_cap" value="<?php echo $row_data['ut_cap']; ?>" required>
                                    </div>
                                </div>

                            </div>

                            <button class="btn-form" type="submit">Salva modifiche</button>

                        </div>

                    </form>

                    <form action="account-password-do" method="post" style="display: none" id="formPsw">

                        <div class="billing-info-wrap" id="password">

                            <h3>Cambia la tua password</h3>

                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Nuova password <span>*</span></label>
                                        <input type="password" name="ut_password_old" id="ut_password_old" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="billing-info mb-20px">
                                        <label>Conferma password <span>*</span></label>
                                        <input type="password" name="ut_password" id="ut_password" required>
                                    </div>
                                </div>


                            </div>

                            <button class="btn-form" type="submit">Modifica password</button>

                        </div>

                    </form>

                    <div class="billing-info-wrap" id="dashboard">
                        <h3 class="cart-page-title">Dashboard Account</h3>
                        <h6>Questa è la tua area cliente privata, da qui puoi modificare i tuoi dati di spedizione/fatturazione, gestire i tuoi ordini e il tuo carrello o modificare la tua password di accesso a Moncaffe.it</h6>

                    </div>

                    <div class="billing-info-wrap" id="ordini">

                        <h3 class="cart-page-title">Ordini</h3>
                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <form action="#">
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Codice</th>
                                                <th>Totale Prodotti</th>
                                                <th>Totale</th>
                                                <th>Azioni</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php
                                            $querySql =
                                                "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo, COUNT(or_id) AS or_count FROM or_ordini " .
                                                "INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE ut_codice = '$session_cl_codice' " .
                                                "GROUP BY or_codice ORDER BY or_codice DESC ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $or_id = $row_data['or_id'];
                                                $or_codice = $row_data['or_codice'];
                                                $or_spedizione = $row_data['or_spedizione'];
                                                $or_pagamento = $row_data['or_pagamento'];
                                                $or_sconto = $row_data['or_sconto'];
                                                $or_coupon_valore = $row_data['or_coupon_valore'];
                                                $or_coupon_tipo = $row_data['or_coupon_tipo'];
                                                $or_coupon = $row_data['or_coupon'];
                                                $or_totale_importo = $row_data['or_totale_importo'];

                                                $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale_importo);

                                                if (strlen($or_coupon) > 0) {
                                                    $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale_importo / 100) * $or_coupon_valore;
                                                } else {
                                                    $or_sconto_coupon = 0;
                                                }

                                                $or_totale_importo = $or_totale_importo - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione;

                                                echo "<tr>";
                                                echo "<td>" . date('d/m/Y', substr($or_codice, 9)) . "</td>";
                                                echo "<td>$or_codice</td>";
                                                echo "<td>" . $row_data['or_count'] . "</td>";
                                                echo "<td>&euro;" . formatPrice($or_totale_importo) . "</td>";

                                                //Gestione
                                                echo "<td>";
                                                echo "<a href='$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice' class='view'>dettaglio</a>";
                                                echo "</td>";
                                                echo "</tr>";

                                            };

                                            if ($rows == '0') echo "<tr><td colspan='99' align='center'>Non hai ancora effettuato un'ordine</td></tr>";

                                            $result->close();
                                            ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>

                    <div class="billing-info-wrap" id="carrelli">
                        <h3 class="cart-page-title">Carrello</h3>
                        <div class="row" style="margin-bottom: 30px">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <form action="#">
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Prodotto</th>
                                                <th>Prezzo</th>
                                                <th>Quantit&aacute;</th>
                                                <th>Totale</th>
                                                <th>Azioni</th>
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
                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $cr_id = $row_data['cr_id'];
                                                $pr_id = $row_data['pr_id'];
                                                $pr_codice = $row_data['pr_codice'];
                                                $pr_quantita = $row_data['pr_quantita'];
                                                $cr_pr_quantita = $row_data['cr_pr_quantita'];
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
                                                    <td class="product_name">
                                                        <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="price">&euro;<?php echo formatPrice($pr_prezzo); ?></span>
                                                    </td>
                                                    <td class="product_quantity"><?php echo $cr_pr_quantita; ?></td>
                                                    <td class="product_total">&euro;<span id="TOTAL-<?php echo $cr_id; ?>"><?php echo $pr_totale; ?></span>
                                                    </td>
                                                    <td class="product_quantity">
                                                        <a href="carrello" class='view'>Carrello</a></td>
                                                </tr>

                                                <?php
                                            }
                                            $result->close();

                                            if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>Il tuo carrello è vuoto</td></tr>";
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="billing-info-wrap" id="preferiti">
                        <h3 class="cart-page-title">Wishlist</h3>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <form action="#">
                                    <div class="table-content table-responsive cart-table-content">
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Prodotto</th>
                                                <th>Prezzo</th>
                                                <th>Quantit&aacute;</th>
                                                <th>Azioni</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql =
                                                "SELECT * FROM pr_prodotti " .
                                                "INNER JOIN ws_wishlist ON ws_pr_codice = pr_codice " .
                                                "INNER JOIN ct_categorie ON pr_ct_id = ct_id " .
                                                "WHERE ws_ut_codice = '$session_cl_codice' ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $result->num_rows;

                                            while ($row_data = $result->fetch_assoc()) {

                                                $ws_id = $row_data['ws_id'];
                                                $pr_id = $row_data['pr_id'];
                                                $pr_codice = $row_data['pr_codice'];
                                                $ct_titolo = $row_data['ct_categoria'];

                                                $pr_immagine = getImmagineProdotto($pr_id);

                                                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);

                                                $pr_titolo = $row_data['pr_titolo'];
                                                $pr_link = generateProductLink($pr_id);
                                                ?>

                                                <tr>
                                                    <td class="product_name">
                                                        <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="price">&euro;<?php echo $pr_prezzo; ?></span></td>
                                                    <td class="product_quantity">1</td>
                                                    <td class="product_quantity">
                                                        <a href="wishlist" class='view'>Wishlist</a></td>
                                                </tr>

                                                <?php
                                            }
                                            $result->close();

                                            if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>La tua wishlist è vuota</td></tr>";
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- checkout area end -->
    <!-- Footer Area start -->
    <?php include('inc/footer.php'); ?>
    <!--  Footer Area End -->
</div>

<!-- Scripts to be loaded  -->
<!-- JS -->
<?php include('inc/javascript.php'); ?>

<script>

    function psw() {
        $("#formPsw").css("display", "block");
    }

    function dati() {
        $("#dati").css("display", "block");
    }


</script>

</body>
</html>
