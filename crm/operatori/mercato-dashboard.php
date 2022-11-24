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
                                        <p class="card-text text-dark">Valore giacenza</p>
                                        <?php
                                        function pageGetValGiacenze() {

                                            global $dbConn;
                                            $querySql =
                                                "SELECT SUM(mg_quantita * pr_prezzo_vendita) FROM mg_mercato_giacenze ".
                                                "INNER JOIN gi_giacenze ON gi_id = mg_gi_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ";
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
                                        function pageGetValRinfuse() {

                                            global $dbConn;
                                            $querySql =
                                                "SELECT SUM(mg_quantita * pr_prezzo_vendita) FROM mg_mercato_giacenze ".
                                                "INNER JOIN gi_giacenze ON gi_id = mg_gi_id ".
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
                                            $querySql =
                                                "SELECT SUM(mg_quantita * pr_prezzo_vendita) FROM mg_mercato_giacenze ".
                                                "INNER JOIN gi_giacenze ON gi_id = mg_gi_id ".
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
                                        <span class="text-white"><i class="fas fa-store highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Vendite totali</p>
                                        <?php
                                        /*function pageGetValDistribuzione() {

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

                                        }*/
                                        ?>
                                        <h4><?php echo formatPrice(0.00); ?>&euro;</h4>
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

                                <a class="btn btn-outline-success w-100 popup-custom" href="javascript:;" data-pop-width="1200" data-pop-height="800" data-href="mercato-add.php">Aggiungi nuovo prodotto</a>

                            </div>
                        </div>

                    </div>
                    <div class="col-xl-8 mb-30">

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Gestione mercato</h5>
                                <!-- action group -->
                                <!--
                                <div class="btn-group info-drop">
                                    <a class="btn btn-sm btn-outline-success popup-custom" href="javascript:;" data-pop-width="1200" data-pop-height="800" data-href="mercato-add.php">Aggiungi nuovo prodotto</a>
                                </div>
                                -->

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Descrizione</th>
                                            <th>Giacenza</th>
                                            <th>Prezzo di vendita</th>
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
                                            echo "<td>".formatPrice($row_data['pr_prezzo_vendita'])." &euro;</td>";

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

                        <div class="card card-statistics">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista ordini</h5>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th width="250">Codice ordine</th>
                                            <th>Denominazione</th>
                                            <th>Operatore</th>
                                            <th class="text-center" width="150">Importo</th>
                                            <th class="text-center" style="width: 450px">Stato di lavorazione</th>
                                            <th class="text-center" style="width: 300px">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr><td colspan='99' align='center'>Non ci sono ordini presenti</td></tr>

                                        </tbody>
                                    </table>

                                </div>

                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        <div class="text-center text-md-left">
                                            Pagine totali: <?php echo $tot_pages; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="btn-group mr-2" role="group" aria-label="Paginazione">
                                            <?php echo $paginazione; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

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
