<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ordini da consegnare</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <!--
                        <thead>
                        <tr>
                            <th>Denominazione</th>
                            <th class="text-center" width="100">Importo</th>
                            <th class="text-center" width="450">Stato di lavorazione</th>
                            <th class="text-center">Gestione</th>
                        </tr>
                        </thead>
                        -->
                        <tbody>

                        <?php
                        $querySql =
                            "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini ".
                            "INNER JOIN cl_clienti ON or_cl_codice = cl_codice WHERE or_op_id = '$session_id' AND or_stato_conferma > 0 AND or_stato = 0 ".
                            "GROUP BY or_codice ORDER BY or_codice DESC ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $or_id = $row_data['or_id'];
                            $or_codice = $row_data['or_codice'];

                            /*echo "<tr>";
                            echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                            echo "<td class='text-center'>&euro; ".formatPrice($row_data['or_totale_importo'])."</td>";

                            //Stato di evasione
                            echo "<td align='center'>";

                            if ($row_data['or_stato_pagamento'] < 1)
                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'><i class='fas fa-money-bill-alt'></i></button></a>&nbsp;";
                            else
                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'><i class='fas fa-money-bill-alt'></i></button></a>&nbsp;";

                            if ($row_data['or_stato_spedizione'] == 0)
                                echo "<a class='btn btn-sm btn-danger' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";
                            else if ($row_data['or_stato_spedizione'] == 1)
                                echo "<a class='btn btn-sm btn-orange' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";
                            else
                                echo "<a class='btn btn-sm btn-success' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";

                            /*if ($row_data['or_stato'] < 1)
                                echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando scalerai la giacenza dei prodotti e non potrai tornare ad uno stato precedente.' ".
                                    "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Non evaso</button>&nbsp;";
                            else
                                echo "<a class='btn btn-sm btn-success disabled' href='javascript:;' title='Attiva'>Evaso</a>&nbsp;";*/

                            /*echo "</td>";

                            //Gestione
                            echo "<td align='center'>";
                            echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'>dettaglio</button>&nbsp;";
                            echo "</td>";
                            echo "</tr>";*/

                            echo "<tr>";
                            echo "<td colspan='99'><b>Cliente</b><br>".$row_data['cl_ragione_sociale']."</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td class='text-center'>&euro; ".formatPrice($row_data['or_totale_importo'])."</td>";

                            //Stato di evasione
                            echo "<td align='center'>";

                            if ($row_data['or_stato_pagamento'] < 1)
                                echo "<a class='btn btn-sm btn-danger' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-money-bill-alt'></i></a>&nbsp;";
                            else
                                echo "<a class='btn btn-sm btn-success' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-money-bill-alt'></i></a>&nbsp;";

                            if ($row_data['or_stato_spedizione'] == 0)
                                echo "<a class='btn btn-sm btn-danger' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";
                            else if ($row_data['or_stato_spedizione'] == 1)
                                echo "<a class='btn btn-sm btn-orange' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";
                            else
                                echo "<a class='btn btn-sm btn-success' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";

                            /*if ($row_data['or_stato'] < 1)
                                echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando scalerai la giacenza dei prodotti e non potrai tornare ad uno stato precedente.' ".
                                    "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Non evaso</button>&nbsp;";
                            else
                                echo "<a class='btn btn-sm btn-success disabled' href='javascript:;' title='Attiva'>Evaso</a>&nbsp;";*/

                            echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'>dettaglio</button>&nbsp;";
                            echo "</td>";
                            echo "</tr>";

                        };

                        if ($rows == '0') {
                            echo "<tr><td colspan='99' align='center'>Non ci sono ordini presenti</td></tr>";
                        }

                        $result->close();
                        ?>

                        </tbody>
                    </table>

                </div>

                <p class="mt-2"><i class='fas fa-money-bill-alt'></i> <span class="text-danger">Non pagato</span> / <span class="text-success">Pagato</span></p>
                <p><i class='fas fa-shipping-fast'></i> <span class="text-danger">Non consegnato</span> / <span class="text-warning">In consegna</span> / <span class="text-success">Consegnato</span></p>

            </div>
        </div>
    </div>

    <div class="col-xl-4 mb-30">
        <div class="card card-statistics h-100">
            <!-- action group -->
            <div class="card-body">
                <h5 class="card-title">Gestione rapida</h5>
                <h4><a class='btn btn-purple w-100' href='distribuzione-gst.php'>Distribuzione</a></h4>
                <h4><a class='btn btn-primary w-100' href='ordini-gst.php'>Ordini</a></h4>
                <h4><a class='btn btn-success w-100' href='clienti-gst.php'>Clienti</a></h4>
                <h4><a class='btn btn-orange w-100' href='giacenze-gst.php'>Giacenze</a></h4>
            </div>
        </div>
    </div>

</div>