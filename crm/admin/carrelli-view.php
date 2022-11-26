<?php include "inc/autoloader.php"; ?>

<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=ISO-8859-1');
*/

$get_cr_id = isset($_GET['cr_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_id']))) : "";
?>

<div class="modal-header">
    <div class="modal-title">
        <div class="mb-30">
            <h6>Dettaglio carrello #<?php echo $get_cr_id; ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body">

    <div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Informazioni cliente</h5>

                    <div class="table-responsive">

                        <?php
                        $querySql = "SELECT * FROM ut_utenti INNER JOIN cr_carrello ON ut_codice = cr_ut_codice WHERE cr_id = $get_cr_id LIMIT 0, 1";

                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;
                        $row_data = $result->fetch_assoc();
                        $result->close();

                        ?>

                        <div class="row w-100">

                            <?php if ((int)$row_data['ut_id'] > 0) { ?>

                                <div class="col-md-6">

                                    <?php
                                    echo "<b>" . $row_data['ut_nome'] . " " . $row_data['ut_cognome'] . "</b><br>";
                                    echo $row_data["ut_indirizzo"] . " - " . $row_data["ut_citta"] . " (" . $row_data["ut_provincia"] . ") CAP: " . $row_data["ut_cap"] . " <br>";
                                    echo "Tel. " . $row_data["ut_telefono"] . " | Fax. " . $row_data["ut_fax"];
                                    ?>

                                </div>

                                <div class="col-md-6">

                                    <?php
                                    echo "<br>P.IVA: " . $row_data["ut_partita_iva"] . " | Cod. Fiscale: " . $row_data["ut_codice_fiscale"] . " <br>";
                                    echo "E-mail: <a href='mailto:" . $row_data["ut_email"] . "'>" . $row_data["ut_email"] . "</a> <br>";
                                    ?>

                                </div>

                            <?php } else { ?>

                                <div class="col-md-6"><br>Cliente non registrato<br></div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Lista prodotti carrello #<?php echo $get_cr_id; ?></h5>

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
                            $querySql = "SELECT * FROM pr_prodotti INNER JOIN cr_carrello ON pr_codice = cr_pr_codice WHERE cr_id = $get_cr_id";
                            $result = $dbConn->query($querySql);
                            $rows = $dbConn->affected_rows;

                            $totale_ordine = 0;
                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                $cr_id = $row_data['cr_id'];
                                $cr_pagamento = $row_data['cr_pagamento'];
                                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

                                $cr_importo_totale = $row_data['cr_pr_quantita'] * $pr_prezzo;

                                $totale_ordine += $cr_importo_totale;

                                echo "<tr>";
                                echo "<td>" . $row_data['pr_titolo'] . " / " . $row_data['pr_codice'] . "</td>";
                                echo "<td class='text-center'>" . $row_data['cr_pr_quantita'] . "</td>";
                                echo "<td class='text-center'>" . formatPrice($pr_prezzo) . "</td>";
                                echo "<td class='text-center'>&euro; " . formatPrice($cr_importo_totale) . "</td>";

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
                            $querySql = "SELECT COUNT(pr_id) AS cr_count, 
                                         cr_pagamento, cr_spedizione, pr_prezzo_scontato, pr_prezzo, cr_pr_quantita FROM pr_prodotti 
                                         INNER JOIN cr_carrello ON pr_codice = cr_pr_codice WHERE cr_id = '$get_cr_id' ";
                            $result = $dbConn->query($querySql);
                            $row_data = $result->fetch_assoc();

                            $cr_count = $row_data['cr_count'];
                            $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
                            $cr_pr_quantita = $row_data['cr_pr_quantita'];

                            $cr_totale = $pr_prezzo * $cr_pr_quantita;

                            $cr_pagamento = $row_data['cr_pagamento'];
                            $cr_spedizione = $row_data['cr_spedizione'];

                            $cr_pagamento_prezzo = getPrezzoPagamento($cr_pagamento, $cr_totale);
                            $cr_spedizione_prezzo = getPrezzoSpedizione($cr_spedizione, $cr_totale);

                            $result->close();

                            $cr_imponibile = $cr_totale / 1.22;
                            $cr_iva = $cr_totale - $cr_imponibile;

                            $cr_totale = $cr_totale + $cr_pagamento_prezzo + $cr_spedizione_prezzo;
                            ?>

                            <tr>
                                <td>Imponibile</td>
                                <td>&euro; <?php echo formatPrice($cr_imponibile); ?></td>
                            </tr>

                            <tr>
                                <td>IVA (22%)</td>
                                <td>&euro; <?php echo formatPrice($cr_iva); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di pagamento (<?php echo $cr_pagamento; ?>)</td>
                                <td>&euro; <?php echo formatPrice($cr_pagamento_prezzo); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di spedizione (<?php echo $cr_spedizione; ?>)</td>
                                <td>&euro; <?php echo formatPrice($cr_spedizione_prezzo); ?></td>
                            </tr>

                            <tr>
                                <td>Totale</td>
                                <td><strong>&euro; <?php echo formatPrice($cr_totale); ?></strong></td>
                            </tr>

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

</div>

<?php include('../inc/db-close.php'); ?>
