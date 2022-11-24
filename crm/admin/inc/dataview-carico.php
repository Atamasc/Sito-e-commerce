<div class="col-xl-12 mb-10">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Codice carico</th>
                        <th>Fornitore</th>
                        <th>Data inserimento</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    viewCarico();
                    function viewCarico() {

                        global $dbConn, $lt_cr_id;

                        $querySql = "SELECT * FROM cr_carichi INNER JOIN fr_fornitori ON fr_id = cr_fr_id WHERE cr_id = '$lt_cr_id' ";
                        $result = $dbConn->query($querySql);
                        $row_data = $result->fetch_assoc();

                        echo "<tr>";
                        echo "<td>".$row_data['cr_codice']."</td>";
                        echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                        echo "<td>".date("d/m/Y", $row_data['cr_timestamp'])."</td>";

                        echo "</tr>";

                        $result->close();

                    }
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>