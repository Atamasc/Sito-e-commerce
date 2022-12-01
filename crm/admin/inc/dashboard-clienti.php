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
                        $querySql = "SELECT * FROM ut_utenti WHERE ut_id > 0 ORDER BY ut_id DESC LIMIT 0, 5";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $ut_id = $row_data['ut_id'];

                            echo "<tr>";
                            echo "<td>$ut_id</td>";
                            echo "<td>" . $row_data['ut_nome'] . "</td>";
                            echo "<td>" . $row_data['ut_cognome'] . "</td>";
                            echo "<td>" . $row_data['ut_email'] . "</td>";

                            //Tipo
                            /*echo "<td align='center'>";

                            if ($row_data['ut_business'] == 0 || $row_data['ut_tipo'] == 'Cliente') {
                                echo "<div class='btn btn-primary btn-sm'>Standard</div>";

                            } else {
                                echo "<div class='btn btn-dark btn-sm'>Business</div>";
                            }
                            echo "</td>";*/

                            //Stato
                            $checked = $row_data['ut_stato'] > 0 ? "checked" : "";
                            echo "<td align='center'>";
                            ?>
                            <div class="checkbox checbox-switch switch-success">
                                <label>
                                    <input type="checkbox" class="stato" title="utenti-stato-do.php?ut_id=<?php echo $ut_id; ?>" <?php echo $checked; ?>><span></span>
                                </label>
                            </div>
                            <?php
                            echo "</td>";

                            //Gestione
                            echo "<td align='center'>";
                            echo "<button class='btn btn-primary btn-sm modale' data-href='utenti-scheda-modale.php?ut_id=$ut_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                            echo "<a class='btn btn-success btn-sm' href='utenti-mod.php?ut_id=$ut_id' title='Modifica anagrafica'>modifica</a>&nbsp;";
                            echo "<button class='btn btn-danger btn-sm elimina' data-href='utenti-del-do.php?ut_id=$ut_id'><i class='fas fa-trash-alt'></i></button>";
                            echo "</td>";
                            echo "</tr>";

                        }

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
                <h5 class="card-title">Link rapidi</h5>
                <!--<h4><a href="#"><i class="fa fa-facebook-official"></i></a>&nbsp;<a href="#"><i class="fa fa-instagram"></i></a></h4>-->
                <!--<h4><a class='btn btn-primary w-100' href='contatti-gst.php'>Elenco contatti</a></h4>-->
                <h4><a class='btn btn-primary w-100' href='blog-gst.php'>Gestione blog</a></h4>
                <h4><a class='btn btn-primary w-100' href='newsletter-gst.php'>Gestione campagne immagine</a></h4>
                <h4><a class='btn btn-primary w-100' href='newsletter-blog-gst.php'>Gestione campagne blog</a></h4>
            </div>
        </div>
    </div>

</div>