<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ultimi clienti registrati</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                            <th style="text-align: center;">Stato</th>
                            <th style="text-align: center;">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql = "SELECT * FROM cl_clienti WHERE cl_id > 0 ORDER BY cl_id DESC LIMIT 0, 5";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $cl_id = $row_data['cl_id'];

                            echo "<tr>";
                            echo "<td>$cl_id</td>";
                            echo "<td>".$row_data['cl_nome']."</td>";
                            echo "<td>".$row_data['cl_cognome']."</td>";
                            echo "<td>".$row_data['cl_email']."</td>";

                            //Stato
                            echo "<td align='center'>";

                            if ($row_data['cl_stato'] == 0) {

                                ?>
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" class="stato" title="clienti-stato-do.php?cl_id=<?php echo $cl_id; ?>"><span></span>
                                    </label>
                                </div>
                                <?php

                            } else {

                                ?>
                                <div class="checkbox checbox-switch switch-success">
                                    <label>
                                        <input type="checkbox" class="stato" title="clienti-stato-do.php?cl_id=<?php echo $cl_id; ?>" checked><span></span>
                                    </label>
                                </div>
                                <?php

                            }

                            echo "</td>";

                            //Gestione
                            echo "<td align='center'>";
                            echo "<a class='btn btn-success btn-sm' href='clienti-mod.php?cl_id=$cl_id' title='Modifica anagrafica'>modifica</a>&nbsp;";
                            echo "<button class='btn btn-danger btn-sm elimina' data-href='clienti-del-do.php?cl_id=$cl_id'>elimina</button>";
                            echo "</td>";
                            echo "</tr>";

                            $i += 1;
                        };

                        if ($rows == 0) {
                            echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche presenti</td></tr>";
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
                <h5 class="card-title">Gestione contatti</h5>
                <h4><a href="#"><i class="fa fa-facebook-official"></i></a>&nbsp;<a href="#"><i class="fa fa-instagram"></i></a></h4>
                <h4><a class='btn btn-primary w-100' href='contatti-gst.php'>Elenco contatti</a></h4>
                <h4><a class='btn btn-primary w-100' href='ticket-gst.php'>Elenco ticket</a></h4>
                <h4><a class='btn btn-primary w-100' href='blog-gst.php'>Gestione blog</a></h4>
            </div>
        </div>
    </div>

</div>