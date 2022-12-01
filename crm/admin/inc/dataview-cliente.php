<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            <h5 class="card-title border-0 pb-0">Cliente</h5>

            <div class="table-responsive">

                <table class="table table-1 table-bordered table-striped mb-0">
                    <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Ragione sociale</th>
                        <th>Partita IVA</th>
                        <th>Codice fiscale</th>
                        <th style="text-align: center; width: 400px;">Gestione</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    dataviewLoad();
                    function dataviewLoad()
                    {

                        global $dbConn, $get_ut_id;

                        $querySql = "SELECT * FROM ut_utenti WHERE ut_id = '$get_ut_id' ";
                        $result = $dbConn->query($querySql);

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $ut_id = $row_data['ut_id'];

                            echo "<tr>";
                            echo "<td>" . $row_data['ut_codice'] . "</td>";
                            echo "<td>" . $row_data['ut_ragione_sociale'] . "</td>";
                            echo "<td>" . $row_data['ut_partita_iva'] . "</td>";
                            echo "<td>" . $row_data['ut_cod_fiscale'] . "</td>";

                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-purple btn-sm' href='utenti-sedi.php?ut_id=$ut_id' title='Sedi'>sedi</a>&nbsp;";
                            echo "<a class='btn btn-success btn-sm' href='utenti-mod.php?ut_id=$ut_id' title='Modifica'>modifica</a>&nbsp;";
                            echo "</td>";
                            echo "</tr>";

                        }

                        $result->close();

                    }

                    ?>

                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>