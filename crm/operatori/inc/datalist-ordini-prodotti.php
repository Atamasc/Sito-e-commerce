<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Lista prodotti associati all'ordine</h5>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Descrizione</th>
                        <th>Cod. lotto</th>
                        <th>Quantità</th>
                        <th>Prezzo unità</th>
                        <th>Prezzo totale</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $querySql =
                        "SELECT * FROM or_ordini INNER JOIN gi_giacenze ON gi_id = or_gi_id ".
                        "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                        "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                        "WHERE or_codice = '$get_or_timestamp' ORDER BY pr_descrizione, lt_timestamp DESC ";
                    $result = $dbConn->query($querySql);
                    $rows = $dbConn->affected_rows;

                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                        $or_id = $row_data['or_id'];

                        echo "<tr>";
                        echo "<td>".$row_data['pr_descrizione']."</td>";
                        echo "<td>".$row_data['lt_codice']."</td>";
                        echo "<td>".$row_data['or_pr_quantita']." ".$row_data['pr_um']."</td>";
                        echo "<td>".formatPrice($row_data['or_pr_prezzo'])."&euro;</td>";
                        echo "<td>".formatPrice($row_data['or_pr_prezzo'] * $row_data['or_pr_quantita'])."&euro;</td>";

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