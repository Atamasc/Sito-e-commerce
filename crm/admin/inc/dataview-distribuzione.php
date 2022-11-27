<div class="col-xl-12 mb-10">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Dettaglio uscita</h5>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <td style="width: 120px;">Stato uscita</td>
                        <td>Operatore</td>
                        <td>Targa</td>
                        <td>Data</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    pageDettaglioUscita();
                    function pageDettaglioUscita() {

                        global $dbConn, $get_di_id;

                        $querySql =
                            "SELECT * FROM op_operatori INNER JOIN di_distribuzione ON di_op_id = op_id WHERE di_id = '$get_di_id' ";
                        $result = $dbConn->query($querySql);
                        $row_data = $result->fetch_assoc();
                        $result->close();

                        $op_id = $row_data['op_id'];
                        $di_id = $row_data['di_id'];
                        $di_uscita = $row_data['di_uscita'];

                        echo "<tr>";
                        echo $di_uscita > 0
                            ? "<td><span class='badge badge-success'>In uscita</span></td>"
                            : "<td><span class='badge badge-danger'>Rientrato</span></td>";
                        echo "<td>".$row_data['op_nome']." ".$row_data['op_cognome']."</td>";
                        echo "<td>".$row_data['di_targa']."</td>";
                        echo "<td>".date("d/m/Y", $row_data['di_timestamp'])."</td>";

                        echo "</tr>";

                    }
                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>