<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Lista prodotti associati all'uscita</h5>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Descrizione</th>
                        <th>Cod. lotto</th>
                        <th>Quantità</th>
                        <th style="text-align: center; width: 200px;">Gestione</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $querySql =
                        "SELECT * FROM dp_distribuzione_prodotti INNER JOIN pr_prodotti ON pr_id = dp_pr_id ".
                        "INNER JOIN gi_giacenze ON gi_id = dp_gi_id INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                        "WHERE dp_di_id = '$get_di_id' ORDER BY pr_descrizione, lt_timestamp DESC ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                        $dp_id = $row_data['dp_id'];

                        echo "<tr>";
                        echo "<td>".$row_data['pr_descrizione']."</td>";
                        echo "<td>".$row_data['lt_codice']."</td>";
                        echo "<td>".$row_data['dp_quantita']." ".$row_data['pr_um']."</td>";

                        //Gestione
                        echo "<td align='center'>";
                        echo "<a class='btn btn-success btn-sm' href='distribuzione-prodotti-mod.php?dp_id=$dp_id' title='Modifica'>modifica</a>&nbsp;";
                        echo "<button class='btn btn-danger btn-sm elimina' data-href='distribuzione-prodotti-del-do.php?di_id=$get_di_id&dp_id=$dp_id'><i class='fas fa-trash-alt'></i></button>";
                        echo "</td>";
                        echo "</tr>";

                    }

                    if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";

                    $result->close();
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>