<?php include "inc/autoloader.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Marilena Moda - Area personale</title>
    <meta name="description" content=""/>
    <?php include('inc/head.php'); ?>

</head>

<body class="home-5 home-6 home-8 home-9 home-electronic">
<div class="header section">

    <?php include('inc/header-2.php'); ?>


</div>


<!-- Breadcrumb Section Start -->
<div class="section">

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-light">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h1 class="title">Account</h1>
                <ul>
                    <li>
                        <a href="index">Home </a>
                    </li>
                    <li class="active"> Account</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

</div>
<!-- Breadcrumb Section End -->

<!-- My Account Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">

                <?php if (@$_GET["update"] == "true") { ?>
                    <div class="alert alert-success"><b>Modifica effettuata con successo.</b></div>
                <?php } elseif (@$_GET["update"] == "false_password") { ?>
                    <div class="alert alert-danger">
                        <b>La password e il campo conferma password non corrispondono, riprova.</b></div>
                <?php } ?>


                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i> Dashboard</a>
                                <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> I tuoi dati</a>
                                <a href="#carrello" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Carrello</a>
                                <a href="#wishlist" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Wishlist</a>
                                <a href="#password" data-bs-toggle="tab"><i class="fa fa-user"></i> Cambia password</a>
                                <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> I tuoi ordini</a>
                                <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Dashboard</h3>
                                        <p>Dalla Dashboard del tuo account puoi facilmente vedere e controllare i tuoi ordini recenti, gestire i tuoi indirizzi di fatturazione e spedizione e Modificare la tua password ed i dettagli dell'Account</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Ordini</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Codice</th>
                                                    <th>Totale prodotti</th>
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
                                                    $or_timestamp = $row_data['or_timestamp'];
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
                                                    echo "<td>" . date('d/m/Y', $or_timestamp) . "</td>";
                                                    echo "<td>$or_codice</td>";
                                                    echo "<td>" . $row_data['or_count'] . "</td>";
                                                    echo "<td>&euro;" . formatPrice($or_totale_importo) . "</td>";

                                                    //Gestione
                                                    echo "<td>";
                                                    echo "<a href='$rootBasePath_http/dettaglio-ordine?or_codice=$or_codice' class='btn btn-dark btn-hover-primary rounded-0 w-100' style='color: #ffffff;'>dettaglio</a>";
                                                    echo "</td>";
                                                    echo "</tr>";

                                                };

                                                if ($rows == '0') echo "<tr><td colspan='99' align='center'>Non hai ancora effettuato un'ordine</td></tr>";

                                                $result->close();
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="carrello" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Carrello</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
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
                                                        ? "$rootBasePath_http/ftp/immagini/" . $row_data['pr_immagine']
                                                        : "$rootBasePath_http/assets/img/no_img.jpg";

                                                    $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

                                                    $pr_titolo = $row_data['pr_titolo'];
                                                    $pr_link = generateProductLink($pr_id);

                                                    $cr_totale = $cr_totale + ($pr_prezzo * $cr_pr_quantita);
                                                    $pr_totale = $pr_prezzo * $cr_pr_quantita;
                                                    ?>
                                                    <tr>
                                                        <!--
                                            <td class="product_thumb">
                                                <a href="<?php echo $pr_link; ?>">
                                                    <img src="<?php echo $pr_immagine; ?>" alt="<?php echo $pr_titolo; ?>">
                                                </a>
                                            </td>
                                            -->
                                                        <td class="product_name">
                                                            <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="price">&euro;<?php echo formatPrice($pr_prezzo); ?></span>
                                                        </td>
                                                        <td class="product_quantity"><?php echo $cr_pr_quantita; ?></td>
                                                        <td class="product_total">&euro;<?php echo formatPrice($pr_totale); ?></td>
                                                        <td class="product_quantity">
                                                            <a href="carrello" class='view'>Carrello</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                                $result->close();

                                                if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>Il tuo carrello &egrave; vuoto</td></tr>";
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="wishlist" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Wishlist</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Immagine</th>
                                                    <th>Prodotto</th>
                                                    <th>Prezzo</th>
                                                    <th>Azioni</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                                $querySql =
                                                    "SELECT * FROM ws_wishlist " .
                                                    "INNER JOIN pr_prodotti ON ws_pr_codice = pr_codice " .
                                                    "WHERE ws_ut_codice = '$session_cl_codice' ";
                                                $result = $dbConn->query($querySql);
                                                $rows = $result->num_rows;

                                                $cr_totale = 0;
                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                    $pr_id = $row_data['pr_id'];
                                                    $pr_codice = $row_data['pr_codice'];
                                                    $pr_quantita = $row_data['pr_quantita'];

                                                    $pr_immagine = strlen($row_data['pr_immagine']) > 0
                                                        ? $upload_view_dir_prodotti . $row_data['pr_immagine']
                                                        : "assets/images/prodotto-dummy.png";

                                                    $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? formatPrice($row_data['pr_prezzo_scontato']) : formatPrice($row_data['pr_prezzo']);

                                                    $pr_titolo = $row_data['pr_titolo'];
                                                    if (strlen($pr_titolo) > 30) {
                                                        $pr_titolo = wordwrap($row_data['pr_titolo'], 30, "<br />");
                                                    }
                                                    $pr_link = generateProductLink($pr_id);

                                                    ?>
                                                    <tr>
                                                        <td class="pro-thumbnail">
                                                            <a href="<?php echo $pr_link; ?>"><img style="width: 100px;" class="img-fluid" src="<?php echo $pr_immagine; ?>" alt="<?php echo $pr_titolo; ?>"/></a>
                                                        </td>
                                                        <td class="product_name">
                                                            <a href="<?php echo $pr_link; ?>"><?php echo $pr_titolo; ?></a>
                                                        </td>
                                                        <td class="product-price">
                                                            <span class="price">&euro;<?php echo $pr_prezzo; ?></span>
                                                        </td>
                                                        <td class="product_quantity">
                                                            <button class="btn btn-dark btn-hover-primary rounded-0 w-100">
                                                                <a href="javascript:;" class="button carrello-add" data-codice="<?php echo $pr_codice; ?>" style="color: white">Acquista</a>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                $result->close();

                                                if ($rows == 0) echo "<tr><td colspan='99' style='text-align: center;'>La tua wishlist &egrave; vuota</td></tr>";
                                                ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->


                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">I tuoi dati</h3>

                                        <?php
                                        $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$session_cl_codice' ";
                                        $result = $dbConn->query($querySql);
                                        $row_data = $result->fetch_assoc();
                                        $result->close();
                                        ?>

                                        <div class="account-details-form">
                                            <form action="account-do" method="post">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Nome <span>*</span></label>
                                                            <input type="text" name="cl_nome" id="cl_nome" value="<?php echo $row_data['cl_nome']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Cognome <span>*</span></label>
                                                            <input type="text" name="cl_cognome" id="cl_cognome" value="<?php echo $row_data['cl_cognome']; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Email <span>*</span></label>
                                                            <input type="email" name="cl_email" id="cl_email" value="<?php echo $row_data['cl_email']; ?>" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Telefono <span>*</span></label>
                                                            <input type="text" name="cl_tel" id="cl_tel" value="<?php echo $row_data['cl_tel']; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Sigla di provincia (Es: Rm)
                                                                <span>*</span></label>
                                                            <input type="text" name="cl_provincia" id="cl_provincia" maxlength="2" value="<?php echo $row_data['cl_provincia']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">CAP</label>
                                                            <input type="text" name="cl_cap" id="cl_cap" value="<?php echo $row_data['cl_cap']; ?>" required>
                                                        </div>
                                                    </div>
                                                    <!--
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label class="required mb-1">Nazione <span>*</span></label>
                                                                <input type="text" name="cl_nazione" id="cl_nazione" value="<?php echo $row_data['cl_nazione']; ?>" required>

                                                            </div>
                                                        </div>
                                                        -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Citt&agrave;
                                                                <span>*</span></label>
                                                            <input type="text" name="cl_citta" id="cl_citta" value="<?php echo $row_data['cl_citta']; ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Indirizzo</label>
                                                            <input type="text" name="cl_indirizzo" id="cl_indirizzo" value="<?php echo $row_data['cl_indirizzo']; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <h4>Indirizzo alternativo</h4>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">CAP</label>
                                                            <input type="text" name="cl_cap_alternativo" id="cl_cap_alternativo" value="<?php echo $row_data['cl_cap_alternativo']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Indirizzo</label>
                                                            <input type="text" name="cl_indirizzo_alternativo" id="cl_indirizzo_alternativo" value="<?php echo $row_data['cl_indirizzo_alternativo']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Comune</label>
                                                            <input type="text" name="cl_citta_alternativo" id="cl_citta_alternativo" value="<?php echo $row_data['cl_citta_alternativo']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Sigla provincia (es: RM)</label>
                                                            <input type="text" name="cl_provincia_alternativo" id="cl_provincia_alternativo" maxlength="2" value="<?php echo $row_data['cl_provincia_alternativo']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <h4>Dati fatturazione (Compila questi campi solo se necessiti di fattura per i tuoi ordini)</h4>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Ragione sociale</label>
                                                            <input type="text" name="cl_ragione_sociale" id="cl_ragione_sociale" value="<?php echo $row_data['cl_ragione_sociale']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">P.IVA</label>
                                                            <input type="text" name="cl_partita_iva" id="cl_partita_iva" pattern="[0-9]*" title="solo valori numerici"
                                                                    value="<?php echo $row_data['cl_partita_iva']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Codice fiscale</label>
                                                            <input type="text" name="cl_codice_fiscale" id="cl_codice_fiscale" value="<?php echo $row_data['cl_codice_fiscale']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">SDI</label>
                                                            <input type="text" name="cl_sdi" id="cl_sdi" value="<?php echo $row_data['cl_sdi']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Email PEC</label>
                                                            <input type="email" name="cl_pec" id="cl_pec" value="<?php echo $row_data['cl_pec']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Sigla provincia fatturazione (es: RM)</label>
                                                            <input type="text" name="cl_provincia_fatturazione" id="cl_provincia_fatturazione" maxlength="2" value="<?php echo $row_data['cl_provincia_fatturazione']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Citt&agrave; Fatturazione</label>
                                                            <input type="text" name="cl_citta_fatturazione" id="cl_citta_fatturazione" value="<?php echo $row_data['cl_citta_fatturazione']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">CAP Fatturazione</label>
                                                            <input type="text" name="cl_cap_fatturazione" id="cl_cap_fatturazione" value="<?php echo $row_data['cl_cap_fatturazione']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Indirizzo Fatturazione</label>
                                                            <input type="text" name="cl_indirizzo_fatturazione" id="cl_indirizzo_fatturazione" value="<?php echo $row_data['cl_indirizzo_fatturazione']; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Register Button Start -->
                                                <div class="single-input-item mb-3">
                                                    <button type="submit" class="btn btn btn-dark btn-hover-primary rounded-0">Salva modifiche</button>
                                                </div>
                                                <!-- Register Button End -->


                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="password" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3 class="title">Cambia la tua password</h3>
                                        <div class="account-details-form">
                                            <form action="account-password-do" method="post">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Nuova password
                                                                <span>*</span></label>
                                                            <input type="password" name="cl_password_old" id="cl_password_old" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item mb-3">
                                                            <label class="required mb-1">Conferma password
                                                                <span>*</span></label>
                                                            <input type="password" name="cl_password" id="cl_password" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Register Button Start -->
                                                <div class="single-input-item mb-3">
                                                    <button type="submit" class="btn btn btn-dark btn-hover-primary rounded-0">Modifica password</button>
                                                </div>
                                                <!-- Register Button End -->

                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->

                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div>
                <!-- My Account Page End -->

            </div>
        </div>

    </div>
</div>
<!-- My Account Section End -->

<?php include('inc/footer.php'); ?>


<?php include('inc/javascript.php'); ?>

</body>

</html>