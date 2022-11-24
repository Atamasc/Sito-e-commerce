<div class="row">

    <div class="col-xl-8 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ultime campagne inviate</h5>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table table-1 table-bordered table-striped mb-0">
                        <thead>
                        <tr>
                            <th>Newsletter</th>
                            <th>Categorie</th>
                            <th>Email inviate</th>
                            <th>Email lette</th>
                            <th>Click totali</th>
                            <th>Tipo</th>
                            <th width="100">Inizio</th>
                            <th width="100">Fine</th>
                            <th style="text-align: center;" width="200">Gestione</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $querySql = "SELECT * FROM (";
                        $querySql .= "SELECT 'newsletter' AS no_tipo, no_id, nl_id AS sv_id, nl_titolo, no_timestamp, MAX(no_timestamp_fine) AS no_timestamp_fine, COUNT(no_id) AS no_totale_email, ns_newsletter_liste.* FROM no_newsletter_log INNER JOIN ns_newsletter_liste ON no_ns_id = ns_id INNER JOIN nl_newsletter ON nl_id = no_nl_id GROUP BY no_timestamp ";
                        $querySql .= "UNION ";
                        $querySql .= "SELECT 'blog' AS no_tipo, no_id, nb_id AS sv_id, 'News dal blog' as nl_titolo, no_timestamp, MAX(no_timestamp_fine) AS no_timestamp_fine, COUNT(no_id) AS no_totale_email, ns_newsletter_liste.* FROM no_newsletter_log INNER JOIN ns_newsletter_liste ON no_ns_id = ns_id INNER JOIN nb_newsletter_blog ON nb_id = no_nb_id GROUP BY no_timestamp ";
                        $querySql .= ") AS a WHERE no_id > 0 ";

                        if($get_no_ns_id > 0) $querySql .= "AND ns_id = '$get_no_ns_id' ";

                        if(strlen(@$_GET['no_timestamp_dal']) > 0) $querySql .= "AND no_timestamp >= '".strtotime($_GET['no_timestamp_dal'])."' ";
                        if(strlen(@$_GET['no_timestamp_al']) > 0) $querySql .= "AND no_timestamp <= '".strtotime($_GET['no_timestamp_al'])."' ";

                        if(strlen($no_tipo) > 0) $querySql .= " AND no_tipo = '$no_tipo' ";

                        $querySql .= " GROUP BY no_timestamp ORDER BY no_timestamp DESC LIMIT 0, 5";
                        $result = $dbConn->query($querySql);
                        $rows = $dbConn->affected_rows;

                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                            $no_id = $row_data['no_id'];
                            $sv_id = $row_data['sv_id'];
                            $no_ns_id = $row_data['no_ns_id'];
                            $ns_titolo = $row_data['ns_lista'];
                            $no_timestamp = $row_data['no_timestamp'];

                            if(strlen($row_data['no_totale_email']) == 0) $row_data['no_totale_email'] = $row_data['no_count_email'];

                            $querySql_count = "SELECT COUNT(no_id) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' AND no_stato_invio = 'Successo' ";
                            $result_count = $dbConn->query($querySql_count);
                            $row_data_count = $result_count->fetch_array();
                            $count_email = $row_data_count[0];
                            $result_count->close();

                            $querySql_count = "SELECT COUNT(no_id) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' AND no_stato_lettura = 1 ";
                            $result_count = $dbConn->query($querySql_count);
                            $row_data_count = $result_count->fetch_array();
                            $count_lette = $row_data_count[0];
                            $result_count->close();

                            $querySql_count = "SELECT SUM(no_click) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' ";
                            $result_count = $dbConn->query($querySql_count);
                            $row_data_count = $result_count->fetch_array();
                            $count_click = $row_data_count[0];
                            $result_count->close();

                            echo "<tr>";

                            echo "<tr>";
                            echo "<td>";
                            echo $row_data['nl_titolo'];

                            //echo "<em>".$row_data['nl_descrizione']."</em>";
                            echo "</td>";
                            echo "<td>".$ns_titolo."</td>";
                            echo "<td>".$count_email." di ".$row_data['no_totale_email']."</td>";
                            echo "<td>".$count_lette." su ".$row_data['no_totale_email']."</td>";
                            echo "<td>$count_click</td>";
                            echo "<td>".$row_data['no_tipo']."</td>";
                            echo "<td>".date("H:i d/m/Y", $row_data['no_timestamp'])."</td>";
                            if(strlen($row_data['no_timestamp_fine']) > 0) echo "<td>".date("H:i d/m/Y", $row_data['no_timestamp_fine'])."</td>";
                            else echo "<td></td>";

                            //Gestione
                            echo "<td align='center'>";

                            if($row_data['no_tipo'] == "blog")
                                echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-blog-view.php?nb_id=$sv_id'>anteprima</button>&nbsp;";
                            else
                                echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-immagine-view.php?nl_id=$sv_id'>anteprima</button>&nbsp;";
                            echo "<a class='btn btn-success btn-sm' href='newsletter-log-email.php?no_timestamp=$no_timestamp' title='Email'>email</a>&nbsp;";

                            echo "</td>";
                            echo "</tr>";

                            $i += 1;
                        };

                        if ($rows == 0) {
                            echo "<tr><td colspan='99' align='center'>Non ci sono log presenti</td></tr>";
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
                <?php
                include_once "../class/class.controllo-mail.php";
                $checkmail = new ControlloMail($dbConn);
                echo $checkmail->GetEmailInfo();
                ?>

                <hr>
                <h4><a class='btn btn-primary w-100' href='newsletter-immagine-add.php'>Crea una campagna</a></h4>
                <h4><a class='btn btn-primary w-100' href='newsletter-blo-add.php'>Crea una campagna blog</a></h4>
                <h4><a class='btn btn-secondary w-100' href='newsletter-gst.php'>Lista campagne</a></h4>
                <h4><a class='btn btn-secondary w-100' href='newsletter-blog-gst.php'>Lista campagne blog</a></h4>
            </div>
        </div>
    </div>

</div>