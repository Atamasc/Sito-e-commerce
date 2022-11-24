<?php include "inc/autoloader.php"; ?>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');

$get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Dettaglio ordine #<?php echo $get_or_codice; ?></h6>
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
                        $querySql = "SELECT cl_clienti.* FROM or_ordini INNER JOIN cl_clienti ON cl_codice = or_cl_codice WHERE or_codice = '$get_or_codice' LIMIT 0, 1";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;
                        $row_data = $result->fetch_assoc();
                        $result->close();
                        ?>

                        <div class="row w-100">

                            <div class="col-md-6">

                                <?php
                                echo "<b>".$row_data['cl_nome']." ".$row_data['cl_cognome']."</b><br>";
                                echo $row_data["cl_indirizzo"]." - ".$row_data["cl_citta"]." (".$row_data["cl_provincia"].") CAP: ".$row_data["cl_cap"]." <br>";
                                echo "Tel. ".$row_data["cl_tel"]." | Cell. ".$row_data["cl_cell"]." | Fax. ".$row_data["cl_fax"];
                                ?>

                            </div>

                            <div class="col-md-6">

                                <?php
                                echo "<br>P.IVA: ".$row_data["cl_partita_iva"]." | Cod. Fiscale: ".$row_data["cl_codice_fiscale"]." <br>";
                                echo "E-mail: <a href='mailto:".$row_data["cl_email"]."'>".$row_data["cl_email"]."</a> <br>";
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
                                <th>Prodotto / Codice lotto</th>
                                <th class="text-center" width="50">Q.tà</th>
                                <th class="text-center" width="100">Prezzo</th>
                                <th class="text-center" width="100">Importo</th>
                            </tr>
                            </thead>
                            <tbody>

                                <?php
                                $querySql =
                                    "SELECT * FROM or_ordini ".
                                    "INNER JOIN gi_giacenze ON gi_id = or_gi_id ".
                                    "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                    "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                    "WHERE or_codice = '$get_or_codice' ORDER BY pr_descrizione";
                                $result = $dbConn->query($querySql);
                                $rows = $dbConn->affected_rows;

                                $totale_ordine = 0;
                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                    $or_id = $row_data['or_id'];
                                    $or_pagamento = $row_data['or_pagamento'];

                                    $or_importo_totale = $row_data['or_pr_quantita'] * $row_data['or_pr_prezzo'];

                                    $totale_ordine += $or_importo_totale;

                                    echo "<tr>";
                                    echo "<td>".$row_data['pr_descrizione']." / ".$row_data['lt_codice']."</td>";
                                    echo "<td class='text-center'>".$row_data['or_pr_quantita']."</td>";
                                    echo "<td class='text-center'>".formatPrice($row_data['or_pr_prezzo'])."</td>";
                                    echo "<td class='text-center'>&euro; ".formatPrice($or_importo_totale)."</td>";

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
                            $querySql = "SELECT COUNT(or_id) AS or_count, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale, or_pagamento, or_tipo_spedizione FROM or_ordini WHERE or_codice = '$get_or_codice' ";
                            $result = $dbConn->query($querySql);
                            $row_data = $result->fetch_assoc();

                            $or_count = $row_data['or_count'];
                            $or_totale = $row_data['or_totale'];

                            $or_pagamento = $row_data['or_pagamento'];
                            $or_spedizione = $row_data['or_tipo_spedizione'];

                            /*$or_pagamento_prezzo = getPrezzoPagamento($or_pagamento);
                            $or_spedizione_prezzo = getPrezzoSpedizione($dbConn);*/

                            $result->close();

                            $or_iva = $or_totale * 0.22;
                            $or_imponibile = $or_totale - $or_iva;

                            //$or_totale = $or_totale + $or_pagamento_prezzo + $or_spedizione_prezzo;
                            ?>

                            <!--
                            <tr>
                                <td>Imponibile</td><td>&euro; <?php echo formatPrice($or_imponibile); ?></td>
                            </tr>

                            <tr>
                                <td>IVA (22%)</td><td>&euro; <?php echo formatPrice($or_iva); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di pagamento (<?php echo $or_pagamento; ?>)</td><td>&euro; <?php //echo formatPrice($or_pagamento_prezzo); ?></td>
                            </tr>

                            <tr>
                                <td>Spese di spedizione (<?php echo $or_spedizione; ?>)</td><td>&euro; <?php //echo formatPrice($or_spedizione_prezzo); ?></td>
                            </tr>
                            -->
                            <tr>
                                <td>Totale</td><td><strong>&euro; <?php echo formatPrice($or_totale); ?></strong></td>
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
