<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <h5 class="card-title border-0 pb-0">Lista richieste di offerta</h5>

                <?php
                if(@$_GET['delete'] == 'true') {

                    ?>
                    <div class="alert alert-success" role="alert">
                        Eliminazione avvenuta con successo.
                    </div>
                    <?php

                }
                ?>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Codice CER</th>
                            <th>Classificazione</th>
                            <th>Stato Fisico</th>
                            <th>Classe Pericolo</th>
                            <th style="text-align: center; width: 300px;">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql =
                            "SELECT * FROM ro_richiesta_offerta INNER JOIN cl_clienti ON ro_le_id = cl_id ".
                            "INNER JOIN cc_codici_cer on cc_id = ro_cc_id WHERE ro_id > 0 AND cl_id = '$get_cl_id' ORDER BY ro_id ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $ro_id = $row_data['ro_id'];

                            echo "<tr>";
                            echo "<td>".$row_data['cc_codice']."</td>";
                            echo "<td>".$row_data['ro_classificazione']."</td>";
                            echo "<td>".$row_data['ro_stato_fisico']."</td>";
                            echo "<td>".$row_data['ro_classe_pericolo']."</td>";

                            ?>
                            <?php

                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-success btn-sm' href='richiesta-offerta-mod.php?ro_id=$ro_id' title='Modifica'>modifica</a>&nbsp;";
                            echo "<button class='btn btn-danger btn-sm elimina' data-href='richiesta-offerta-del-do.php?ro_id=$ro_id'>elimina</button>";
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
</div>