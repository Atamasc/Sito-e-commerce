<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ultimi ordini</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th width="260">Codice ordine</th>
                            <th>Denominazione</th>
                            <th class="text-center" width="100">Importo</th>
                            <!--<th class="text-center" width="450">Stato di lavorazione</th>-->
                            <th class="text-center" width="220">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql =
                            "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini " .
                            "INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE " . strlen(or_codice) . " > 0 " .
                            "GROUP BY or_codice ORDER BY or_codice DESC LIMIT 0, 5 ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $or_totale_importo = $row_data['or_totale_importo'];
                            $or_id = $row_data['or_id'];
                            $or_codice = $row_data['or_codice'];
                            $or_coupon_valore = $row_data['or_coupon_valore'];
                            $or_coupon_tipo = $row_data['or_coupon_tipo'];
                            $or_coupon = $row_data['or_coupon'];
                            $or_pagamento = $row_data['or_pagamento'];
                            $or_spedizione = $row_data['or_tipo_spedizione'];

                            $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale_importo);
                            $or_spedizione_prezzo = getPrezzoSpedizione($or_spedizione, $or_totale_importo);

                            if (strlen($or_coupon) > 0) {
                                $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale_importo / 100) * $or_coupon_valore;
                            } else {
                                $or_sconto_coupon = 0;
                            }

                            $or_totale = $or_totale_importo - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;

                            echo "<tr>";
                            echo "<td>$or_codice del " . date('d/m/Y - H:i', substr($or_codice, 9)) . "</td>";
                            echo "<td>" . $row_data['ut_nome'] . " " . $row_data['ut_cognome'] . "</td>";
                            echo "<td class='text-center'>&euro; " . formatPrice($or_totale) . "</td>";

                            //Stato di evasione
                            /*
                            echo "<td align='center'>";

                            if ($row_data['or_stato_conferma'] == '0')
                                echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non confermato</button></a>&nbsp;";
                            else
                                echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Confermato</button></a>&nbsp;";

                            if ($row_data['or_stato_pagamento'] == '0')
                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non pagato</button></a>&nbsp;";
                            else
                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Pagato</button></a>&nbsp;";

                            if ($row_data['or_stato_spedizione'] == '0')
                                echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' ".
                                    "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Non spedito</button>&nbsp;";
                            else
                                echo "<button class='btn btn-sm btn-success alert-2' data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedito</button>&nbsp;";

                            if ($row_data['or_stato']  == '0')
                                echo "<a href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non evaso</button></a>&nbsp;";
                            else
                                echo "<a href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Evaso</button></a>&nbsp;";

                            echo "</td>";
                            */
                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-success btn-sm' href='ordini-gst.php?or_codice=$or_codice' title='Modifica'>Gestisci</a>&nbsp;";
                            echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'>dettaglio</button>&nbsp;";
                            //echo "<button class='btn btn-danger btn-sm elimina' data-href='ordini-del-do.php?or_codice=$or_codice' title='Elimina'>elimina</button>";
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

            </div>
        </div>
    </div>

    <div class="col-xl-4 mb-30">
        <div class="card card-statistics h-100">
            <!-- action group -->
            <div class="card-body">
                <h5 class="card-title">Gestione rapida vendite</h5>
                <!--<h4><a href="#"><i class="fa fa-facebook-official"></i></a>&nbsp;<a href="#"><i class="fa fa-instagram"></i></a></h4>-->
                <h4><a class='btn btn-primary w-100' href='ordini-gst.php'>Ordini</a></h4>
                <h4><a class='btn btn-orange w-100' href='prodotti-gst.php'>Catalogo</a></h4>
                <h4><a class='btn btn-success w-100' href='utenti-gst.php'>Clienti</a></h4>
            </div>
        </div>
    </div>

</div>