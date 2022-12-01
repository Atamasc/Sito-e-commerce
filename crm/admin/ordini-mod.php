<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";
    ?>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Gestione ordine </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione ordine</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-4 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Stati ordine</h5>

                                    <p>Clicca sugli stati per modificarli</p>

                                    <?php
                                    $querySql = "SELECT * FROM or_ordini WHERE or_codice = '$get_or_codice' GROUP BY or_codice LIMIT 0, 1 ";
                                    $result = $dbConn->query($querySql);
                                    $rows = $dbConn->affected_rows;
                                    $row_data = $result->fetch_assoc();

                                    $or_id = $row_data['or_id'];
                                    $or_codice = $row_data['or_codice'];
                                    $or_pagamento = $row_data['or_pagamento'];
                                    $or_tracking = $row_data['or_tracking'];
                                    $or_fattura = $row_data['or_fattura'];
                                    $or_ut_codice = $row_data['or_ut_codice'];
                                    $or_note = $row_data['or_note'];
                                    $or_note_admin = $row_data['or_note_admin'];

                                    if ($or_fattura == '0') {
                                        $or_fattura = 'No';
                                    } else if ($or_fattura == '1') {
                                        $or_fattura = 'SI';
                                    }

                                    if ($row_data['or_stato_conferma'] == '0')
                                        echo "<a style='margin-top: 7px;' class='btn btn-danger' href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Non confermato</a>&nbsp;";
                                    else
                                        echo "<a style='margin-top: 7px;' class='btn btn-success' href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Confermato</a>&nbsp;";

                                    if ($row_data['or_stato_pagamento'] == '0')
                                        echo "<a style='margin-top: 7px;' class='btn btn-danger' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'>Non pagato</a>&nbsp;";
                                    else
                                        echo "<a style='margin-top: 7px;' class='btn btn-success' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'>Pagato</a>&nbsp;";

                                    if ($row_data['or_stato_spedizione'] == '0')
                                        echo "<button style='margin-top: 7px;' class='btn btn-danger alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' " .
                                            "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Non spedito</button>&nbsp;";
                                    else
                                        echo "<a style='margin-top: 7px;' class='btn btn-success' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedito</a>&nbsp;";

                                    if ($row_data['or_stato'] == '0') {
                                        echo "<button style='margin-top: 7px;' class='btn btn-danger alert-2' data-text='Continuando invierai una mail di conferma evasione al cliente' " .
                                            "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</button>&nbsp;";
                                    } else {
                                        echo "<a style='margin-top: 7px;' class='btn btn-success' href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</a>&nbsp;";
                                    }

                                    if ($row_data['or_fattura'] == '0')
                                        echo "<a style='margin-top: 7px;' class='btn btn-danger' href='ordini-fattura-do.php?or_codice=$or_codice' title='Attiva'>Fattura non richiesta</a>&nbsp;";
                                    else
                                        echo "<a style='margin-top: 7px;' class='btn btn-info' href='ordini-fattura-do.php?or_codice=$or_codice' title='Attiva'>Fattura richiesta</a>&nbsp;";

                                    /*
                                    if ($row_data['or_regalo']  == '0')
                                        echo "<a class='btn btn-danger' href='javascript:;' title='Attiva'>Confezione regalo non richiesta</a>&nbsp;";
                                    else
                                        echo "<a class='btn btn-info' href='javascript:;' title='Attiva'>Confezione regalo richiesta</a>&nbsp;";
                                    */
                                    //if ($row_data['or_fattura'] == '0') echo "<button class='btn btn-danger' title='Fattura non richiesta'>Fattura non richiesta</button>&nbsp;";
                                    //else echo "<button class='btn btn-info' title='Fattura richiesta'>Fattura richiesta</button>&nbsp;";


                                    $result->close();
                                    ?>

                                </div>

                            </div>
                        </div>

                        <div class="col-xl-5 mb-30">

                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <?php
                                    $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$or_ut_codice' LIMIT 0, 1 ";
                                    $result = $dbConn->query($querySql);
                                    $rows = $dbConn->affected_rows;
                                    $row_data = $result->fetch_assoc();

                                    $ut_id = $row_data['ut_id'];

                                    $result->close();
                                    ?>

                                    <div style="display: flex; justify-content: space-between;">
                                        <h5 class="card-title border-0 pb-0">Dati cliente</h5>
                                        <button style="height: 30px;" class='btn btn-primary btn-sm modale' data-href='utenti-scheda-modale.php?ut_id=<?php echo $ut_id; ?>' title='Visualizza scheda'>Visualizza tutti i dati</button>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 mb-2">
                                            <b>Nome e Cognome: </b>&nbsp;
                                            <?php echo $row_data['ut_nome'] . ' ' . $row_data['ut_cognome']; ?>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <b>Telefono: </b>&nbsp;
                                            <?php echo $row_data['ut_telefono']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Indirizzo: </b>&nbsp;
                                            <?php echo $row_data['ut_indirizzo'] . ', ' .
                                                $row_data['ut_cap'] . ', ' .
                                                $row_data['ut_citta'] . ' (' .
                                                $row_data['ut_provincia'] . ')';
                                            ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Codice fiscale: </b>&nbsp;
                                            <?php echo $row_data['ut_codice_fiscale']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Email: </b>&nbsp;
                                            <?php echo $row_data['ut_email']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Password: </b>&nbsp;
                                            <?php echo $row_data['ut_password']; ?>
                                        </div>

                                    </div>

                                    <br>

                                    <h5 class="card-title border-0 pb-0">Codice tracking</h5>

                                    <form method="post" action="ordini-mod-do.php">

                                        <input type="hidden" name="or_codice" value="<?php echo $or_codice; ?>">

                                        <div class="form-row" style="width: 1250px;">

                                            <div class="col-md-6 input-group mb-3">
                                                <input type="url" class="form-control" id="or_tracking" name="or_tracking" placeholder="Inserire qui il link completo" value="<?php echo $or_tracking; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Aggiorna</button>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if (strlen($row_data['or_tracking']) > 0) { ?>
                                            <div class="form-row">
                                                <div class="col-md-6 input-group mb-3">
                                                    Link completo: &nbsp;
                                                    <a href="<?php echo $or_tracking; ?>"><?php echo $or_tracking; ?></a>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-3 mb-30">

                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Metodo di pagamento</h5>

                                    <form method="post" action="ordini-pagamento-do.php">

                                        <input type="hidden" name="or_codice" value="<?php echo $or_codice; ?>">

                                        <div class="form-row">

                                            <div class="col-md-12 input-group mb-3">
                                                <select class="form-control" id="or_pagamento" name="or_pagamento" required>
                                                    <option value="">Seleziona un metodo di pagamento</option>
                                                    <option value=""></option>
                                                    <option value="Bonifico" <?php echo $or_pagamento == "Bonifico" ? "selected" : ""; ?>>Bonifico</option>
                                                    <option value="Paypal" <?php echo $or_pagamento == "Paypal" ? "selected" : ""; ?>>Paypal</option>
                                                    <!--<option value="Gestpay" <?php echo $or_pagamento == "Gestpay" ? "selected" : ""; ?>>Gestpay</option>-->
                                                    <option value="Contrassegno" <?php echo $or_pagamento == "Contrassegno" ? "selected" : ""; ?>>Contrassegno</option>
                                                    <option value="Stripe" <?php echo $or_pagamento == "Stripe" ? "selected" : ""; ?>>Stripe</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Aggiorna</button>
                                                </div>
                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista prodotti ordine #<?php echo $get_or_codice; ?></h5>

                                    <?php
                                    if (@$_GET['delete'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Eliminazione avvenuta con successo.
                                        </div>
                                        <?php

                                    } elseif (@$_GET['coupon'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Coupon aggiunto con successo.
                                        </div>
                                        <?php

                                    } elseif (@$_GET['coupon'] == 'exist') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Il cliente ha gi&agrave; utilizzato questo coupon.
                                        </div>
                                        <?php

                                    } elseif (@$_GET['coupon'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Errore nell'aggiunta coupon.
                                        </div>
                                        <?php

                                    } elseif (@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Articolo aggiunto con successo.
                                        </div>
                                        <?php

                                    } elseif (@$_GET['insert'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Errore nell'aggiunta articolo.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Prodotto / Codice</th>
                                                <th class="text-center" width="50">Quantità</th>
                                                <th class="text-center" width="150">Prezzo</th>
                                                <th class="text-center">Importo</th>
                                                <th class="text-center" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <form method="post" action="ordini-prodotti-mod-do.php">
                                                <?php
                                                $querySql = "SELECT * FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$get_or_codice' ORDER BY pr_titolo";
                                                $result = $dbConn->query($querySql);
                                                $rows = $dbConn->affected_rows;

                                                $totale_ordine = 0;
                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                    $or_id = $row_data['or_id'];
                                                    $or_pr_quantita = $row_data['or_pr_quantita'];
                                                    $or_pr_codice = $row_data['or_pr_codice'];
                                                    $or_spedizione = $row_data['or_tipo_spedizione'];
                                                    $or_sconto = $row_data['or_sconto'];
                                                    $or_coupon_valore = $row_data['or_coupon_valore'];
                                                    $or_coupon_tipo = $row_data['or_coupon_tipo'];
                                                    $or_coupon = $row_data['or_coupon'];

                                                    $or_importo_totale = $row_data['or_pr_quantita'] * $row_data['or_pr_prezzo'];

                                                    $pr_ct_id = $row_data['pr_ct_id'];
                                                    $pr_st_id = $row_data['pr_st_id'];
                                                    $pr_mr_id = $row_data['pr_mr_id'];
                                                    $pr_si_id = $row_data['pr_si_id'];

                                                    $pr_titolo = $row_data['pr_titolo'];
                                                    $pr_codice = $row_data['pr_codice'];

                                                    $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);
                                                    $pr_st_id_sottocategoria = getSottocategoria($pr_st_id, $dbConn);
                                                    $pr_mr_id_marchio = getMarchio($pr_mr_id, $dbConn);
                                                    $pr_si_id_sistema = getSistema($pr_si_id, $dbConn);

                                                    $totale_ordine += $or_importo_totale;

                                                    echo "<tr>";

                                                    echo "<td>";
                                                    echo "<span style='font-size: 10px; font-style: italic;'>" . $pr_ct_id_categoria . " / " . $pr_st_id_sottocategoria . "</span><br>";
                                                    echo $pr_titolo . " / " . $pr_codice;
                                                    echo "</td>";

                                                    echo "<td><input type='text' class='form-control input-order pattern-number' name='or_pr_quantita[$or_id]' " .
                                                        "value='" . $or_pr_quantita . "' autocomplete='off' required></td>";
                                                    echo "<td><span class='oreo-span'>&euro;</span><input type='text' class='form-control input-order pattern-price' " .
                                                        "name='or_pr_prezzo[$or_id]' value='" . formatPrice($row_data['or_pr_prezzo']) . "' autocomplete='off' required></td>";
                                                    echo "<td class='text-center'>&euro; " . formatPrice($or_importo_totale) . "</td>";

                                                    //Gestione
                                                    echo "<td align='center'>";
                                                    echo "<button type='submit' class='btn btn-info btn-sm'>aggiorna</button>&nbsp;";
                                                    echo "<a href='#' class='btn btn-danger btn-sm elimina' data-href='ordini-prodotti-del-do.php?or_id=$or_id&or_pr_quantita=$or_pr_quantita&or_pr_codice=$or_pr_codice' title='Elimina'>elimina</a>";
                                                    echo "</td>";
                                                    echo "</tr>";

                                                };

                                                if ($rows == 0) {
                                                    echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";
                                                }

                                                $result->close();
                                                ?>

                                            </form>

                                            <form method="post" action="ordini-articoli-add-do.php">

                                                <tr>
                                                    <td colspan="4">
                                                        <span class="oreo-span">Aggiungi un prodotto col codice</span>
                                                        <input type="text" class='form-control input-order' name="or_pr_codice" required>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="hidden" name="or_codice" value="<?php echo $get_or_codice; ?>">

                                                        <input type="submit" class='btn btn-info btn-sm' value="aggiungi">
                                                    </td>
                                                </tr>

                                            </form>

                                            <form method="post" action="ordini-coupon-add-do.php">

                                                <tr>
                                                    <td colspan="4">
                                                        <span class="oreo-span">Applica coupon all'ordine</span>
                                                        <input style="width: 145px;" type="text" class='form-control input-order' name="or_coupon" required>
                                                    </td>

                                                    <td class="text-center">
                                                        <input type="hidden" name="or_codice" value="<?php echo $get_or_codice; ?>">
                                                        <input type="hidden" name="or_ut_codice" value="<?php echo $or_ut_codice; ?>">

                                                        <input type="submit" class='btn btn-info btn-sm' value="applica">
                                                    </td>
                                                </tr>

                                            </form>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-30">
                                            <tbody>

                                            <?php
                                            $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $totale_ordine);
                                            $or_spedizione_prezzo = getPrezzoSpedizione($or_spedizione, $totale_ordine);

                                            if (strlen($or_coupon) > 0) {
                                                $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($totale_ordine / 100) * $or_coupon_valore;
                                            } else {
                                                $or_sconto_coupon = 0;
                                            }

                                            //$or_coupon = getCouponByCodice($get_or_codice, $dbConn);

                                            $or_imponibile = $totale_ordine / 1.22;
                                            $or_iva = $totale_ordine - $or_imponibile;

                                            $totale_ordine = $totale_ordine - $or_sconto_coupon + $or_spedizione_prezzo + $or_pagamento_prezzo;

                                            ?>

                                            <tr>
                                                <td class="text-right">Imponibile</td>
                                                <td width="200">&euro; <?php echo formatPrice($or_imponibile); ?></td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">IVA (22%)</td>
                                                <td width="200">&euro; <?php echo formatPrice($or_iva); ?></td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">Spese di spedizione (<?php echo $or_spedizione; ?>)</td>
                                                <td width="200">&euro; <?php echo formatPrice($or_spedizione_prezzo); ?></td>
                                            </tr>

                                            <tr>
                                                <td class="text-right">Spese di pagamento (<?php echo $or_pagamento; ?>)</td>
                                                <td width="200">&euro; <?php echo formatPrice($or_pagamento_prezzo); ?></td>
                                            </tr>


                                            <?php
                                            if ($or_sconto_coupon > 0) {
                                                ?>
                                                <tr>
                                                    <td class="text-right">Sconto (<?php echo $or_coupon; ?>)</td>
                                                    <td width="200">
                                                        <b>-</b> &euro;<?php echo formatPrice($or_sconto_coupon); ?>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                            <tr>
                                                <td class="text-right">Totale ordine</td>
                                                <td width="200">&euro; <?php echo formatPrice($totale_ordine); ?></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-30">
                                            <tbody>

                                            <tr>
                                                <td width="200" class="text-right">
                                                    <strong>Richiesta fattura:</strong> <?php echo $or_fattura; ?></td>

                                                <td><?php if ($or_fattura == 'SI') { ?>
                                                        <strong>Dati Fatturazione</strong><br/>
                                                        <?php
                                                        $querySql = "SELECT * FROM ut_utenti WHERE ut_codice = '$or_ut_codice' LIMIT 0, 1 ";
                                                        $result = $dbConn->query($querySql);
                                                        $rows = $dbConn->affected_rows;
                                                        $row_data = $result->fetch_assoc();

                                                        $ut_id = $row_data['ut_id'];
                                                        $ut_nome = $row_data['ut_nome'];
                                                        $ut_cognome = $row_data['ut_cognome'];
                                                        $ut_ragione_sociale = $row_data['ut_ragione_sociale'];
                                                        $ut_partita_iva = $row_data['ut_partita_iva'];
                                                        $ut_codice_fiscale = $row_data['ut_codice_fiscale'];
                                                        $ut_pec = $row_data['ut_pec'];
                                                        $ut_sdi = $row_data['ut_sdi'];
                                                        $ut_indirizzo_fatturazione = $row_data['ut_indirizzo_fatturazione'];
                                                        $ut_cap_fatturazione = $row_data['ut_cap_fatturazione'];
                                                        $ut_citta_fatturazione = $row_data['ut_citta_fatturazione'];
                                                        $ut_provincia_fatturazione = $row_data['ut_provincia_fatturazione'];

                                                        $result->close();
                                                        ?>

                                                        Nome e cognome: <?php echo $ut_nome . " " . $ut_cognome; ?><br/>
                                                        Ragione Sociale: <?php echo $ut_ragione_sociale; ?><br/>
                                                        Partita Iva: <?php echo $ut_partita_iva; ?><br/>
                                                        Codice Fiscale: <?php echo $ut_codice_fiscale; ?><br/>
                                                        Email PEC: <?php echo $ut_pec; ?><br/>
                                                        SDI: <?php echo $ut_sdi; ?><br/>
                                                        Indirizzo Fatturazione: <?php echo $ut_indirizzo_fatturazione . " - " . $ut_citta_fatturazione . " (" . $ut_provincia_fatturazione . ") " . $ut_cap_fatturazione . " "; ?>
                                                    <?php } ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td width="200" class="text-right">
                                                    <strong>Modalità di pagamento</strong></td>
                                                <td><?php echo $or_pagamento; ?></td>
                                            </tr>

                                            <tr>
                                                <td width="200" class="text-right"><strong>Note cliente</strong></td>
                                                <td><?php echo $or_note; ?></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                    <h5 class="card-title border-0 pb-0">Note Admin (Non visibili al cliente)</h5>

                                    <form method="post" action="ordini-note-mod-do.php">

                                        <input type="hidden" name="or_codice" value="<?php echo $or_codice; ?>">

                                        <div class="form-row">

                                            <div class="col-md-6 input-group mb-3">
                                                <textarea class="form-control" id="or_note_admin" name="or_note_admin" rows="3" placeholder="Note riservate all'amministratore, non saranno visibili al cliente."><?php echo $or_note_admin; ?></textarea>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">Aggiorna</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>

                    <?php include "inc/footer.php"; ?>

                    <!--=================================
                     footer -->
                </div>
            </div>
        </div>
    </div>

    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>