<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">
<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<div class="wrapper">

    <!--=================================
     preloader -->

    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
     preloader -->


    <!--=================================
     header start-->

    <?php include "inc/header.php"; ?>

    <!--=================================
     header End-->

    <!--=================================
     Main content -->

    <div class="container-fluid">
        <div class="row">

            <!-- Left Sidebar start-->
            <?php include "inc/sidebar.php"; ?>
            <!-- Left Sidebar End-->

            <!--=================================
           wrapper -->

            <div class="content-wrapper">
                <div class="page-title mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="mb-0"><?php echo getOperatore($session_id); ?></h4>
                        </div>
                        <!--
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        -->
                    </div>
                </div>

                <!-- widgets -->
                <?php include "inc/dashboard-stats.php"; ?>

                <!-- Orders Status widgets-->
                <div class="row">

                    <div class="col-xl-12 mb-10">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-block d-md-flexx justify-content-between">
                                    <div class="d-block">
                                        <h5 class="card-title">Ordini da consegnare</h5>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <!--
                                        <thead>
                                        <tr>
                                            <th>Denominazione</th>
                                            <th class="text-center" width="100">Importo</th>
                                            <th class="text-center" width="450">Stato di lavorazione</th>
                                            <th class="text-center">Gestione</th>
                                        </tr>
                                        </thead>
                                        -->
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini ".
                                            "INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_op_id = '$session_id' AND or_stato_conferma > 0 AND or_stato = 0 ".
                                            "GROUP BY or_codice ORDER BY or_codice DESC ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $or_id = $row_data['or_id'];
                                            $or_codice = $row_data['or_codice'];
                                            
                                            echo "<tr>";
                                            echo "<td colspan='99'><b>Cliente</b><br>".$row_data['ut_ragione_sociale']."</td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo "<td class='text-center'>&euro; ".formatPrice($row_data['or_totale_importo'])."</td>";

                                            //Stato di evasione
                                            echo "<td align='center'>";

                                            if ($row_data['or_stato_pagamento'] < 1)
                                                echo "<a class='btn btn-sm btn-danger' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-money-bill-alt'></i></a>&nbsp;";
                                            else
                                                echo "<a class='btn btn-sm btn-success' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-money-bill-alt'></i></a>&nbsp;";

                                            if ($row_data['or_stato_spedizione'] == 0)
                                                echo "<a class='btn btn-sm btn-danger' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";
                                            else if ($row_data['or_stato_spedizione'] == 1)
                                                echo "<button class='btn btn-sm btn-orange alert-2' data-text=\"Continuando l'ordine verrà evaso e non potrai tornare ad uno stato precedente.\" ".
                                                    "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'><i class='fas fa-shipping-fast'></i></button>&nbsp;";
                                            else
                                                echo "<a class='btn btn-sm btn-success' href='javascript:;' title='Attiva'><i class='fas fa-shipping-fast'></i></a>&nbsp;";

                                            echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'>dettaglio</button>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                        };

                                        if ($rows == '0') {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono ordini presenti</td></tr>";
                                        }

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                                <p class="mt-2"><i class='fas fa-money-bill-alt'></i> <span class="text-danger">Non pagato</span> / <span class="text-success">Pagato</span></p>
                                <p><i class='fas fa-shipping-fast'></i> <span class="text-danger">Non consegnato</span> / <span class="text-warning">In consegna</span> / <span class="text-success">Consegnato</span></p>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8 mb-10">
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
                                            <th>Descrizione</th>
                                            <th>Cod. lotto</th>
                                            <th>Quantità</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT * FROM dp_distribuzione_prodotti ".
                                            "INNER JOIN di_distribuzione ON di_id = dp_di_id INNER JOIN pr_prodotti ON pr_id = dp_pr_id ".
                                            "INNER JOIN gi_giacenze ON gi_id = dp_gi_id INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                            "WHERE di_timestamp = '".dateToTimestamp(date("d/m/Y"))."' AND di_op_id = '$session_id' ORDER BY pr_descrizione, lt_timestamp DESC ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $dp_id = $row_data['dp_id'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>".$row_data['lt_codice']."</td>";
                                            echo "<td>".$row_data['dp_quantita']." ".$row_data['pr_um']."</td>";

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

                    <div class="col-xl-4 mb-10">
                        <div class="card card-statistics h-100">
                            <!-- action group -->
                            <div class="card-body">
                                <h5 class="card-title">Gestione rapida</h5>
                                <h4><a class='btn btn-purple w-100' href='distribuzione-gst.php'>Distribuzione</a></h4>
                                <h4><a class='btn btn-primary w-100' href='ordini-gst.php'>Ordini</a></h4>
                                <h4><a class='btn btn-success w-100' href='clienti-gst.php'>Clienti</a></h4>
                                <h4><a class='btn btn-orange w-100' href='giacenze-gst.php'>Giacenze</a></h4>
                            </div>
                        </div>
                    </div>

                </div>

                <!--=================================
                 wrapper -->

                <!--=================================
                 footer -->

                <?php include "inc/footer.php"; ?>

            </div><!-- main content wrapper end-->
        </div>
    </div>
</div>

<!--=================================
 footer -->

<?php include "inc/javascript.php"; ?>

<script>

    $(function () {

        if ($('#custom-chart').exists()) {

            var config_chart = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: $('#custom-chart').data('value'),
                        backgroundColor: [
                            window.chartColors.red,
                            window.chartColors.orange,
                            window.chartColors.yellow,
                            window.chartColors.green,
                            window.chartColors.blue,
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: $('#custom-chart').data('label')
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        text: 'Doughnut Chart'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };

            var ctx3 = document.getElementById("custom-chart").getContext("2d");
            window.myLine3 = new Chart(ctx3, config_chart);

        }

    });

</script>

</body>
</html>
<?php include "../inc/db-close.php"; ?>