<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ultime richieste di conferimento</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>N. offerta</th>
                            <th>Trasportatore</th>
                            <th>Produttore</th>
                            <th style="text-align: center;">Stato</th>
                            <th style="text-align: center; width: 300px;">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql = "SELECT * FROM cn_conferimento INNER JOIN cl_clienti ON cl_id = cn_om_id WHERE cn_id > 0 ORDER BY cn_id LIMIT 0, 10";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $cn_id = $row_data['cn_id'];

                            echo "<tr>";
                            echo "<td>$cn_id</td>";
                            echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                            echo "<td>".$row_data['cn_offerta']."</td>";
                            echo "<td>".$row_data['cn_tr_ragione_sociale']."</td>";
                            echo "<td>".$row_data['cn_pr_ragione_sociale']."</td>";

                            //Stato
                            $checked = $row_data['cn_stato'] > 0 ? "checked" : "";
                            ?>
                            <td align='center'>
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" class="stato"
                                               title="conferimento-stato-do.php?cn_id=<?php echo $cn_id; ?>" <?php echo $checked;?>><span></span>
                                    </label>
                                </div>
                            </td>
                            <?php

                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-success btn-sm' href='conferimento-mod.php?cn_id=$cn_id' title='Modifica'>modifica</a>&nbsp;";
                            echo "<button class='btn btn-danger btn-sm elimina' data-href='conferimento-del-do.php?cn_id=$cn_id'>elimina</button>";
                            echo "</td>";
                            echo "</tr>";

                            $i += 1;
                        };

                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono richieste presenti</td></tr>";

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

                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Rifiuti gestiti</h5>
                    </div>
                </div>

                <div class="chart-wrapper">

                    <div id="canvas-holder" style="width: 100%; margin: 0 auto; height: 300px;">
                        <canvas id="custom-chart" width="550" data-value="[10,20,30]" data-label='["Metalli","Batterie","Scorie radioattive"]'></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>