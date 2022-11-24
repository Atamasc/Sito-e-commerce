<?php include "inc/autoloader.php"; ?>
<?php
$get_di_timestamp = isset($_GET['di_timestamp'])
    ? dateToTimestamp($dbConn->real_escape_string(stripslashes(trim($_GET['di_timestamp']))))
    : dateToTimestamp(date("d/m/Y"));
?>
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
                <div class="content-wrapper">
                    <div class="page-title mb-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="mt-2"> Dashboard distribuzione</h4>
                            </div>
                            <div class="col-sm-12">
                                <p class="font-bold mt-15" style="display: inline;">Seleziona la data:&nbsp;&nbsp;</p>
                                <input type="text" class="form-control date-picker-default w-100" id="di_timestamp" name="di_timestamp" style="width: 200px; display: inline;"
                                       value="<?php echo date("d/m/Y", $get_di_timestamp); ?>" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-10">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left icon-box bg-info rounded-circle">
                                            <span class="text-white"><i class="fas fa-box highlight-icon mt-15" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="float-right text-right">
                                            <p class="card-text text-dark">Valore prodotti in distribuzione</p>
                                            <?php
                                            function pageGetValUscite() {

                                                global $dbConn, $get_di_timestamp, $session_id;
                                                $querySql =
                                                    "SELECT SUM(dp_quantita * pr_prezzo_vendita) FROM di_distribuzione ".
                                                    "INNER JOIN dp_distribuzione_prodotti ON dp_di_id = di_id ".
                                                    "INNER JOIN gi_giacenze ON gi_id = dp_gi_id ".
                                                    "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                    "WHERE di_timestamp = '$get_di_timestamp' AND di_op_id = '$session_id' AND di_uscita > 0 ";
                                                $result = $dbConn->query($querySql);
                                                $total = $result->fetch_array()[0];
                                                $result->close();

                                                return $total;

                                            }
                                            ?>
                                            <h4><?php echo formatPrice(pageGetValUscite()); ?>&euro;</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-10">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left icon-box bg-success rounded-circle">
                                            <span class="text-white"><i class="fas fa-box-usd highlight-icon mt-15" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="float-right text-right">
                                            <p class="card-text text-dark">Valore prodotti venduti</p>
                                            <?php
                                            function pageGetValOrdini() {

                                                global $dbConn, $get_di_timestamp, $session_id;
                                                $querySql =
                                                    "SELECT SUM(or_pr_quantita * or_pr_prezzo) FROM or_ordini ".
                                                    "WHERE or_op_id = '$session_id' AND or_timestamp >= '$get_di_timestamp' AND or_timestamp <= '".strtotime("+1 day", $get_di_timestamp)."' ";
                                                $result = $dbConn->query($querySql);
                                                $total = $result->fetch_array()[0];
                                                $result->close();

                                                return $total;

                                            }
                                            ?>
                                            <h4><?php echo formatPrice(pageGetValOrdini()); ?>&euro;</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-10">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="clearfix">
                                        <div class="float-left icon-box bg-warning rounded-circle">
                                            <span class="text-white"><i class="fas fa-times-circle highlight-icon mt-15" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="float-right text-right">
                                            <p class="card-text text-dark">Valore prodotti rientrati</p>
                                            <?php
                                            function pageGetValRientrati() {

                                                global $dbConn, $get_di_timestamp, $session_id;
                                                $querySql =
                                                    "SELECT SUM(dp_quantita * pr_prezzo_vendita) FROM di_distribuzione ".
                                                    "INNER JOIN dp_distribuzione_prodotti ON dp_di_id = di_id ".
                                                    "INNER JOIN gi_giacenze ON gi_id = dp_gi_id ".
                                                    "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                    "WHERE di_timestamp = '$get_di_timestamp' AND di_op_id = '$session_id' AND di_uscita = 0 ";
                                                $result = $dbConn->query($querySql);
                                                $total = $result->fetch_array()[0];
                                                $result->close();

                                                return $total;

                                            }
                                            ?>
                                            <h4><?php echo formatPrice(pageGetValRientrati()); ?>&euro;</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <h5 class="card-title pb-0 border-0">La tua uscita</h5>

                                    <div class="table-responsive">
                                        <table class="table center-aligned-table mb-0">
                                            <thead>
                                            <tr class="text-dark font-bold">
                                                <td>Stato</td>
                                                <td>Targa</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $op_array = array();

                                            $querySql =
                                                "SELECT * FROM di_distribuzione WHERE di_timestamp = '$get_di_timestamp' AND di_op_id = '$session_id' LIMIT 0, 1 ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $di_id = $row_data['di_id'];
                                                $di_uscita = $row_data['di_uscita'];

                                                echo "<tr>";
                                                echo $di_uscita > 0
                                                    ? "<td><span class='badge badge-success'>In uscita</span></td>"
                                                    : "<td><span class='badge badge-danger'>Rientrato</span></td>";
                                                echo "<td>".$row_data['di_targa']."</td>";
                                                echo "</tr>";


                                                //Gestione
                                                echo "<tr>";
                                                echo "<td colspan='99'>";

                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) {

                                                ?>
                                                <tr><td colspan='99' align='center'>In questa data non hai effettuato un'uscita</td></tr>
                                                <tr>
                                                    <td colspan="99">
                                                        <p class="font-bold">Aggiungi uscita</p>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Targa" aria-label="Targa" aria-describedby="basic-addon2"
                                                                   autocomplete="off" style="height: 40px;">
                                                            <input type="hidden" value="<?php echo $session_id; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-primary btn-uscita" style="width: 40px;" type="button"><i class="fas fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            $result->close();
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <?php
                        if ($rows > 0) {

                            ?>
                            <div class="col-xl-4 mb-10">
                                <div class="card card-statistics h-100">
                                    <!-- action group -->
                                    <div class="card-body">
                                        <h5 class="card-title">Gestione rapida</h5>
                                        <h4>
                                            <?php
                                            echo $di_uscita > 0
                                                ? "<a class='btn btn-primary w-100' href='distribuzioni-stato-do.php?di_id=$di_id'>Imposta stato rientrato</a>"
                                                : "<a class='btn btn-danger w-100' href='distribuzioni-stato-do.php?di_id=$di_id'>Imposta stato in uscita</a>";
                                            ?>
                                        </h4>
                                        <h4><a class='btn btn-success w-100 popup-custom' href='javascript:;' data-pop-width='1200'
                                               data-pop-height='800' data-href='distribuzione-prodotti-add.php?di_id=<?php echo $di_id; ?>'>Gestione prodotti</a></h4>
                                        <h4><a class='btn btn-orange w-100 popup-custom' href='javascript:;' data-pop-width='1200'
                                               data-pop-height='800' data-href='ordini-clienti-add.php'>Crea ordine distribuzione</a></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 mb-10">
                                <div class="card card-statistics h-100">
                                    <div class="card-body">

                                        <h5 class="card-title border-0 pb-0">Prodotti caricati</h5>

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
                                                    "SELECT * FROM dp_distribuzione_prodotti INNER JOIN pr_prodotti ON pr_id = dp_pr_id ".
                                                    "INNER JOIN gi_giacenze ON gi_id = dp_gi_id INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                    "WHERE dp_di_id = '$di_id' ORDER BY pr_descrizione, lt_timestamp DESC ";
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
                            <?php

                        }
                        ?>

                    </div>

                    <!--================================= wrapper -->

                    <!--================================= footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    <script>
        $('#di_timestamp').change(function () {

            window.location.replace("distribuzione-gst.php?di_timestamp=" + $(this).val());

        });

        $('.btn-uscita').click(function () {

            let di_targa = $(this).parents('.input-group').find('input[type=text]').val();
            let di_op_id = $(this).parents('.input-group').find('input[type=hidden]').val();

            if (di_targa.length === 0) {

                alert("Inserisci una targa.");
                return 0;

            }

            window.location.replace("distribuzione-add-do.php?di_op_id=" + di_op_id + "&di_targa=" + di_targa
                + "&di_timestamp=<?php echo $get_di_timestamp; ?>");

        });
    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>