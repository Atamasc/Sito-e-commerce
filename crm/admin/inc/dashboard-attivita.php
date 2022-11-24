<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Prossime attività</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Tipologia</th>
                            <th>Luogo</th>
                            <th>Esito</th>
                            <th>Data e ora</th>
                            <th style="text-align: center; width: 100px;">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql =
                            "SELECT * FROM at_attivita INNER JOIN cl_clienti ON cl_id = at_cl_id WHERE at_id > 0 ".
                            "ORDER BY at_data_attivita, at_ora_attivita LIMIT 0, 10";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $at_id = $row_data['at_id'];
                            $at_data_ora = date("d/m/Y", $row_data['at_data_attivita'])." ".$row_data['at_ora_attivita'];

                            echo "<tr>";
                            echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                            echo "<td>".$row_data['at_tipologia']."</td>";
                            echo "<td>".$row_data['at_luogo']."</td>";
                            echo "<td>".$row_data['at_esito']."</td>";
                            echo "<td>$at_data_ora</td>";

                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-primary btn-sm modale' href='javascript:;' data-href='../ajax/attivita-view.php?at_id=$at_id' title='Dettaglio'>dettaglio</a>&nbsp;";
                            echo "</td>";
                            echo "</tr>";

                        };

                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono attività</td></tr>";

                        $result->close();

                        $paginazione = "";

                        $varget = "?";
                        foreach ($_GET as $k => $v)
                            if($k != 'page') $varget .= "&$k=$v";

                        for ($i = $current_page - 5; $i <= $current_page + 5; $i++) {

                            if($i < 1 || $i > $tot_pages) continue;

                            if ($i == $current_page)
                                $paginazione .= "<a href='javascript:;' title='Vai alla pagina $i' class='btn btn-info'>$i</a>";
                            else
                                $paginazione .= "<a href='$varget&page=$i' title='Vai alla pagina $i' class='btn btn-secondary'>$i</a>";
                        }
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
                <h4><a class='btn btn-success w-100' href='clienti-gst.php'>Elenco clienti</a></h4>
            </div>
        </div>
    </div>

</div>