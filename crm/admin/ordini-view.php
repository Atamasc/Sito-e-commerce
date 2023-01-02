<?php include "inc/autoloader.php"; ?>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');
$get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";

$querySql = "SELECT or_timestamp FROM or_ordini INNER JOIN ut_utenti ON ut_codice = or_ut_codice WHERE or_codice = '$get_or_codice' LIMIT 0, 1";
$result = $dbConn->query($querySql);
$row = $result->fetch_array();
$or_timestamp = $row[0];
$result->close();
?>


<div class="modal-header">
    <div class="modal-title">
        <div class="mb-30">
            <h6>Dettaglio ordine #<?php echo $get_or_codice; ?> - <?php echo date('d/m/Y - H:i', $or_timestamp); ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="logo_stampa" style="display: none;">
    <img src="<?php echo "$rootBasePath_http/assets/images/logo/logo.png"; ?>" style="margin-left: 150px;">
</div>

<div class="modal-body">

    <div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Informazioni cliente</h5>

                    <div class="table-responsive">

                        <?php
                        $querySql = "SELECT ut_utenti.* FROM or_ordini INNER JOIN ut_utenti ON ut_codice = or_ut_codice WHERE or_codice = '$get_or_codice' LIMIT 0, 1";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;
                        $row_data = $result->fetch_assoc();
                        $result->close();
                        ?>

                        <div class="row w-100">

                            <div class="col-md-6">

                                <?php
                                echo "<b>" . $row_data['ut_nome'] . " " . $row_data['ut_cognome'] . "</b><br>";
                                echo $row_data["ut_indirizzo"] . " - " . $row_data["ut_citta"] . " (" . $row_data["ut_provincia"] . ") CAP: " . $row_data["ut_cap"] . " <br>";
                                ?>

                            </div>

                            <div class="col-md-6">

                                <?php
                                echo "E-mail: <a href='mailto:" . $row_data["ut_email"] . "'>" . $row_data["ut_email"] . "</a> <br>";
                                echo "Tel. " . $row_data["ut_telefono"];

                                ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Lista prodotti ordine #<?php echo $get_or_codice; ?></h5>

                    <div class="table-responsive">

                        <table class="table table-1 table-bordered table-striped mb-0">
                            <thead>
                            <tr>
                                <th>Prodotto / Codice</th>
                                <th class="text-center" width="50">Q.tà</th>
                                <th class="text-center" width="100">Prezzo</th>
                                <th class="text-center" width="100">Importo</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $querySql = "SELECT * FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$get_or_codice' ";
                            $result = $dbConn->query($querySql);
                            $rows = $dbConn->affected_rows;

                            $totale_ordine = 0;
                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                $or_id = $row_data['or_id'];
                                $or_pagamento = @$row_data['or_pagamento'];
                                $or_note = $row_data['or_note'];
                                $or_note_admin = $row_data['or_note_admin'];
                                $pr_ct_id = $row_data['pr_ct_id'];
                                $pr_titolo = $row_data['pr_titolo'];
                                $pr_codice = $row_data['pr_codice'];

                                $pr_ct_id_categoria = getCategoria($pr_ct_id, $dbConn);

                                $or_importo_totale = $row_data['or_pr_quantita'] * $row_data['or_pr_prezzo'];

                                $totale_ordine += $or_importo_totale;

                                echo "<tr>";

                                echo "<td>";
                                echo "<span style='font-size: 10px; font-style: italic;'>" . $pr_ct_id_categoria . "</span><br>";
                                echo $pr_titolo . " / " . $pr_codice;
                                echo "</td>";

                                echo "<td class='text-center'>" . $row_data['or_pr_quantita'] . "</td>";
                                echo "<td class='text-center'>" . formatPrice($row_data['or_pr_prezzo']) . "</td>";
                                echo "<td class='text-center'>&euro; " . formatPrice($or_importo_totale) . "</td>";

                                echo "</tr>";

                            };

                            if ($rows == 0) {
                                echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";
                            }

                            $result->close();
                            ?>

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

                        <table class="table table-1 table-bordered table-striped mb-0">
                            <tbody>

                            <?php
                            $querySql = "SELECT or_pr_quantita, or_pr_prezzo, or_pagamento, or_tipo_spedizione, or_coupon_valore, or_coupon_tipo, or_coupon FROM or_ordini INNER JOIN pr_prodotti ON pr_codice = or_pr_codice WHERE or_codice = '$get_or_codice' ";
                            $result = $dbConn->query($querySql);
                            $row_data = $result->fetch_assoc();

                            $or_pr_quantita = $row_data['or_pr_quantita'];
                            $or_pr_prezzo = $row_data['or_pr_prezzo'];
                            $or_totale = $or_pr_prezzo * $or_pr_quantita;

                            $or_pagamento = @$row_data['or_pagamento'];
                            $or_spedizione = $row_data['or_tipo_spedizione'];
                            $or_coupon_valore = $row_data['or_coupon_valore'];
                            $or_coupon_tipo = $row_data['or_coupon_tipo'];
                            $or_coupon = $row_data['or_coupon'];

                            $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale);
                            $or_spedizione_prezzo = getPrezzoSpedizione($or_spedizione, $or_totale);

                            $result->close();

                            $or_imponibile = $or_totale / 1.22;
                            $or_iva = $or_totale - $or_imponibile;

                            if (strlen($or_coupon) > 0) {
                                $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale / 100) * $or_coupon_valore;
                            } else {
                                $or_sconto_coupon = 0;
                            }

                            $or_totale = $or_totale - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;
                            ?>

                            <tr>
                                <td>Imponibile</td>
                                <td>&euro; <?php echo formatPrice($or_imponibile); ?></td>
                            </tr>

                            <tr>
                                <td>IVA (22%)</td>
                                <td>&euro; <?php echo formatPrice($or_iva); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di pagamento (<?php echo $or_pagamento; ?>)</td>
                                <td>&euro; <?php echo formatPrice($or_pagamento_prezzo); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di spedizione (<?php echo $or_spedizione; ?>)</td>
                                <td>&euro; <?php echo formatPrice($or_spedizione_prezzo); ?></td>
                            </tr>

                            <?php
                            if ($or_sconto_coupon > 0) {

                                ?>
                                <tr>
                                    <td>Sconto (<?php echo $or_coupon; ?>)</td>
                                    <td>&euro; <?php echo formatPrice($or_sconto_coupon); ?></td>
                                </tr>
                                <?php

                            }
                            ?>

                            <tr>
                                <td>Totale</td>
                                <td><strong>&euro; <?php echo formatPrice($or_totale); ?></strong></td>
                            </tr>

                            <tr>
                                <td colspan="2"><strong>Note cliente:</strong> <?php echo $or_note; ?></td>
                            </tr>

                            <!--<tr class="no-note">
                                <td colspan="2"><strong>Note riservate:</strong> <?php echo $or_note_admin; ?></td>
                            </tr>-->

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>

    <!-- PER MODIFICARE LO STILE CSS DELLA STAMPA ANDARE NELL'HEAD DI ordini-gst.php -->
    <button type="button" class="btn btn-primary" onclick="window.print();">
        <span><i class="fa fa-print"></i> Stampa</span>
    </button>

</div>


<?php include('../inc/db-close.php'); ?>
