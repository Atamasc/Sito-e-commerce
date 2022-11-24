<?php include "inc/autoloader.php"; ?>

<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<div class="wrapper">
    <!--================================= preloader -->
    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--================================= preloader -->
    <!--================================= header start-->

    <?php include "inc/header.php"; ?>

    <!--================================= header End-->
    <!--================================= Main content -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar -->
            <?php include "inc/sidebar.php"; ?>
            <!-- Left Sidebar End-->

            <!--================================= Main content -->
            <!--================================= wrapper -->
            <div class="content-wrapper profile-page">

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-danger rounded-circle">
                                        <span class="text-white"><i class="fas fa-inventory highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Valore giacenza magazzino</p>
                                        <?php
                                        function pageGetValGiacenze() {

                                            global $dbConn;
                                            $querySql = "SELECT SUM(gi_quantita * lt_prezzo) FROM gi_giacenze INNER JOIN lt_lotti ON lt_id = gi_lt_id ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }
                                        ?>
                                        <h4><?php echo formatPrice(pageGetValGiacenze()); ?>&euro;</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-warning rounded-circle">
                                        <span class="text-white"><i class="fas fa-box highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Valore rinfuse</p>
                                        <?php
                                        /*function pageGetValGiacenzeMercato() {

                                            global $dbConn;
                                            $querySql = "SELECT SUM(mg_quantita * lt_prezzo) FROM mg_mercato_giacenze ".
                                                "INNER JOIN gi_giacenze ON gi_id = mg_gi_id INNER JOIN lt_lotti ON lt_id = gi_lt_id ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }*/
                                        function pageGetValRinfuse() {

                                            global $dbConn;
                                            $querySql =
                                                "SELECT SUM(gi_quantita * lt_prezzo) FROM gi_giacenze ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE pr_tipologia = 'Rinfusa' ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }
                                        ?>
                                        <h4><?php echo formatPrice(pageGetValRinfuse()); ?>&euro;</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-primary rounded-circle">
                                        <span class="text-white"><i class="fas fa-conveyor-belt-alt highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Valore produzioni</p>
                                        <?php
                                        function pageGetValProduzioni() {

                                            global $dbConn;
                                            $querySql =
                                                "SELECT SUM(gi_quantita * lt_prezzo) FROM gi_giacenze ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE pr_tipologia = 'Produzione' ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }
                                        ?>
                                        <h4><?php echo formatPrice(pageGetValProduzioni()); ?>&euro;</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-dark rounded-circle">
                                        <span class="text-white"><i class="fas fa-shipping-fast highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Valore distribuzione in uscita</p>
                                        <?php
                                        function pageGetValDistribuzione() {

                                            global $dbConn;
                                            $querySql =
                                                "SELECT SUM(dp_quantita * lt_prezzo) FROM gi_giacenze ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "INNER JOIN dp_distribuzione_prodotti ON dp_gi_id = gi_id ".
                                                "INNER JOIN di_distribuzione ON di_id = dp_di_id ".
                                                "WHERE di_timestamp = '".dateToTimestamp(date("d/m/Y"))."' AND di_uscita > 0 ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }
                                        ?>
                                        <h4><?php echo formatPrice(pageGetValDistribuzione()); ?>&euro;</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-10">

                        <div class="card mb-30 about-me">
                            <div class="card-body">
                                <h5 class="card-title"> Gestioni rapide</h5>

                                <a class="btn btn-primary w-100" href="giacenze-gst.php">Giacenze</a>
                                <a class="btn btn-success w-100 mt-10" href="distribuzione-gst.php">Distribuzione</a>

                            </div>
                        </div>

                        <div class="card card-statistics mb-10" style="display: none;">
                            <div class="card-body">

                                <h5 class="card-title">Gestione mercato</h5>
                                <!-- action group -->
                                <div class="btn-group info-drop">
                                    <a class="btn btn-sm btn-outline-success popup-custom" href="javascript:;" data-pop-width="1200" data-pop-height="800" data-href="mercato-add.php">Aggiungi nuovo prodotto</a>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Descrizione</th>
                                            <th>Giacenza</th>
                                            <th style="text-align: center; width: 100px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT *, SUM(mg_quantita) AS mg_quantita FROM pr_prodotti ".
                                            "INNER JOIN gi_giacenze ON gi_pr_id = pr_id ".
                                            "INNER JOIN mg_mercato_giacenze ON mg_gi_id = gi_id ".
                                            "WHERE mg_quantita > 0 GROUP BY pr_id ORDER BY pr_descrizione ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $pr_id = $row_data['pr_id'];
                                            $mg_quantita = $row_data['mg_quantita'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>$mg_quantita ".$row_data['pr_um']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            ?>
                                            <a class='btn btn-success btn-sm popup-custom' href='javascript:;' data-pop-width='1200' data-href='mercato-add-2.php?pr_id=<?php echo $pr_id; ?>' title='Carico'><i class="fas fa-plus"></i></a>
                                            <a class='btn btn-danger btn-sm popup-custom' href='javascript:;' data-pop-width='1200' data-href='mercato-del.php?pr_id=<?php echo $pr_id; ?>' title='Scarico'><i class="fas fa-minus"></i></a>
                                            <?php
                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono prodotti al mercato</td></tr>";

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="card card-statistics" style="display: none;">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista attività</h5>

                                <div class="scrollbar max-h-350">
                                    <ul class="list-unstyled">

                                        <?php
                                        //pageGetAttivita($row_data['cl_id']);
                                        function pageGetAttivita($cl_id) {

                                            global $dbConn;

                                            $querySql =
                                                "SELECT * FROM at_attivita INNER JOIN cl_clienti ON cl_id = at_cl_id WHERE at_cl_id = '$cl_id' ".
                                                "ORDER BY at_data_attivita, at_ora_attivita ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $at_data_ora = date("d/m/Y", $row_data['at_data_attivita'])." ".$row_data['at_ora_attivita'];

                                                $badge = "";
                                                switch ($row_data['at_esito']) {

                                                    case "In corso": $badge = "bg-warning"; break;
                                                    case "Positivo": $badge = "bg-success"; break;
                                                    case "Negativo": $badge = "bg-danger"; break;

                                                }

                                                ?>
                                                <li class="mb-15">
                                                    <div class="media">
                                                        <div class="position-relative">
                                                            <!--<img class="img-fluid mr-15 avatar-small" src="../images/team/07.jpg" alt="">-->
                                                            <i class="img-fluid mr-15 avatar-small fa fa-book fa-3x"></i>
                                                            <i class="avatar-online <?php echo $badge; ?>" title="<?php echo $row_data['at_esito']; ?>"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mt-0 ">
                                                                <?php echo $row_data['at_tipologia']; ?>
                                                                <small class="float-right"><?php echo $at_data_ora; ?></small>
                                                            </h6>
                                                            <p><?php echo $row_data['at_note']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="divider mt-15"></div>
                                                </li>
                                                <?php

                                            };

                                            if ($rows == 0) echo "<p>Non ci sono attività presenti</p>";

                                            $result->close();

                                        }
                                        ?>

                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-8 mb-30">
                        <!--
                        <div class="card mb-30">
                            <div class="card-body">
                                <div class="comment-block">
                                    <div class="form-group mb-0">
                                        <div id="summernote"><p>Hello Webmin</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Rinfusi</h5>
                                <!-- action group -->
                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="giacenze-gst.php?pr_tipologia=Rinfusa"><i class="text-success fa fa-list"></i> Vedi tutti</a>
                                        <!--<a class="dropdown-item" href="omologa-add.php?cl_id=<?php echo $get_cl_id; ?>"><i class="text-success fa fa-plus"></i> Nuova omologa</a>-->
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th style="width: 100px;">Codice</th>
                                            <th>Descrizione</th>
                                            <th>Giacenza</th>
                                            <th>Lotti</th>
                                            <th style="text-align: center; width: 230px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT * FROM pr_prodotti ".
                                            "WHERE pr_id > 0 AND pr_tipologia = 'Rinfusa' ORDER BY pr_timestamp ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $pr_id = $row_data['pr_id'];
                                            $gi_quantita = countGiacenze($pr_id, $dbConn);

                                            echo "<tr>";
                                            echo "<td>".$row_data['pr_codice']."</td>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>$gi_quantita ".$row_data['pr_um']."</td>";
                                            echo "<td>".countLottiProdotto($pr_id, $dbConn)."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            ?>
                                            <a class='btn btn-orange btn-sm popup-custom' href='javascript:;' data-pop-width='1200' data-href='magazzino-produzione-gst.php?pr_id=<?php echo $pr_id; ?>' title='Produzione'>Produzione</a>
                                            <?php
                                            if ($gi_quantita > 0) {
                                                ?><a class='btn btn-primary btn-sm popup-custom' href='javascript:;' data-pop-width='1200' data-href='magazzino-produzione-add.php?pr_id=<?php echo $pr_id; ?>' title='Produzione'>Produzione <i class="fas fa-plus"></i></a><?php
                                            } else {
                                                ?><a class='btn btn-secondary btn-sm disabled' href='javascript:;' title='Produzione'>Produzione <i class="fas fa-plus"></i></a><?php
                                            }

                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono lotti presenti</td></tr>";

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <!--
                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Ultime 5 produzioni</h5>

                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="qiacenze-gst.php?pr_tipologia=Produzione"><i class="text-success fa fa-list"></i> Vedi tutte</a>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Descrizione</th>
                                            <th>Totale giacenza</th>
                                            <th>Totale lotti</th>
                                            <th style="text-align: center; width: 150px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT *, SUM(gi_quantita) AS gi_quantita, COUNT(gi_lt_id) AS count_lotti FROM pr_prodotti ".
                                            "INNER JOIN gi_giacenze ON gi_pr_id = pr_id WHERE pr_tipologia = 'Produzione' ".
                                            "GROUP BY pr_id ORDER BY pr_id LIMIT 0, 5";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $pr_id = $row_data['pr_id'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>".$row_data['gi_quantita']." ".$row_data['pr_um']."</td>";
                                            echo "<td>".$row_data['count_lotti']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-orange btn-sm modale' href='javascript:;' data-href='giacenze-lotti-modale.php?pr_id=$pr_id' title='Lotti'>lotti</a>&nbsp;";
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
                           -->
                    </div>
                </div>


                <?php include "inc/footer.php"; ?>

                <!--=================================
                 footer -->
            </div>
        </div>
    </div>
</div>

<!--=================================
footer -->

<?php include "inc/javascript.php"; ?>

</body>

</html>
<?php include "../inc/db-close.php"; ?>
