<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Distribuzioni odierne </h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <td style="width: 120px;">Stato uscita</td>
                            <td>Operatore</td>
                            <td>Targa</td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $op_array = array();

                        $querySql =
                            "SELECT * FROM op_operatori INNER JOIN di_distribuzione ON di_op_id = op_id ".
                            "WHERE di_timestamp = '".dateToTimestamp(date("d/m/Y"))."' ORDER BY op_cognome ";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $op_id = $row_data['op_id'];
                            $di_id = $row_data['di_id'];
                            $di_uscita = $row_data['di_uscita'];

                            $op_array[] = $op_id;

                            echo "<tr>";
                            echo $di_uscita > 0
                                ? "<td><span class='badge badge-success'>In uscita</span></td>"
                                : "<td><span class='badge badge-danger'>Rientrato</span></td>";
                            echo "<td>".$row_data['op_nome']." ".$row_data['op_cognome']."</td>";
                            echo "<td>".$row_data['di_targa']."</td>";

                            echo "</tr>";

                        }

                        if ($rows == 0) {
                            echo "<tr><td colspan='99' align='center'>Non ci sono uscite</td></tr>";
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
                <h5 class="card-title">Gestione rapida magazzino</h5>
                <h4><a class='btn btn-primary w-100' href='magazzino-dashboard.php'>Dashboard magazzino</a></h4>
                <h4><a class='btn btn-orange w-100' href='giacenze-gst.php'>Giacenze</a></h4>
                <h4><a class='btn btn-success w-100' href='distribuzione-gst.php'>Distribuzione</a></h4>
            </div>
        </div>
    </div>

</div>