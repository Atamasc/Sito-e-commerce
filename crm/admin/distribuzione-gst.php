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
                        <div class="col-sm-6">
                            <h4 class="mt-2"> Dashboard distribuzione</h4>
                        </div>
                        <div class="col-sm-6 text-right">
                            <!--
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestisci distribuzione</li>
                            </ol>
                            -->
                            <!--<i class="fas fa-arrow-alt-left fa-2x"></i>-->
                            <p class="font-bold mt-15" style="display: inline;">Seleziona la data:&nbsp;&nbsp;</p>
                            <input type="text" class="form-control date-picker-default" id="di_timestamp" name="di_timestamp" style="width: 200px; display: inline;"
                                   value="<?php echo date("d/m/Y", $get_di_timestamp); ?>" readonly required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-primary rounded-circle">
                                        <span class="text-white"><i class="fas fa-shipping-fast highlight-icon mt-15" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Operatori in uscita</p>
                                        <?php
                                        function pageGetUscite() {

                                            global $dbConn, $get_di_timestamp;
                                            $querySql = "SELECT COUNT(di_id) FROM di_distribuzione WHERE di_timestamp = '$get_di_timestamp' AND di_uscita > 0 ";
                                            $result = $dbConn->query($querySql);
                                            $total = $result->fetch_array()[0];
                                            $result->close();

                                            return $total;

                                        }
                                        ?>
                                        <h4><?php echo pageGetUscite(); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
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

                                            global $dbConn, $get_di_timestamp;
                                            $querySql =
                                                "SELECT SUM(dp_quantita * pr_prezzo_vendita) FROM di_distribuzione ".
                                                "INNER JOIN dp_distribuzione_prodotti ON dp_di_id = di_id ".
                                                "INNER JOIN gi_giacenze ON gi_id = dp_gi_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE di_timestamp = '$get_di_timestamp' AND di_uscita > 0 ";
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
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
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

                                            global $dbConn, $get_di_timestamp;
                                            $querySql =
                                                "SELECT SUM(or_pr_quantita * or_pr_prezzo) FROM or_ordini ".
                                                "WHERE or_op_id > 0 AND or_timestamp >= '$get_di_timestamp' AND or_timestamp <= '".strtotime("-1 day", $get_di_timestamp)."' ";
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
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
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

                                            global $dbConn, $get_di_timestamp;
                                            $querySql =
                                                "SELECT SUM(dp_quantita * pr_prezzo_vendita) FROM di_distribuzione ".
                                                "INNER JOIN dp_distribuzione_prodotti ON dp_di_id = di_id ".
                                                "INNER JOIN gi_giacenze ON gi_id = dp_gi_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE di_timestamp = '$get_di_timestamp' AND di_uscita = 0 ";
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

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title pb-0 border-0">Lista uscite</h5>

                                <div class="table-responsive">
                                    <table class="table center-aligned-table mb-0">
                                        <thead>
                                        <tr class="text-dark font-bold">
                                            <td style="width: 120px;">Stato uscita</td>
                                            <td>Operatore</td>
                                            <td>Targa</td>
                                            <td class="text-center" style="width: 200px;">Gestione</td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $op_array = array();

                                        $querySql =
                                            "SELECT * FROM op_operatori INNER JOIN di_distribuzione ON di_op_id = op_id ".
                                            "WHERE di_timestamp = '$get_di_timestamp' ORDER BY op_cognome ";
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


                                            //Gestione
                                            echo "<td align='center'>";
                                            echo $di_uscita > 0
                                                ? "<a class='btn btn-primary btn-sm' href='distribuzioni-stato-do.php?di_id=$di_id'>rientrato</a>&nbsp;"
                                                : "<a class='btn btn-danger btn-sm' href='distribuzioni-stato-do.php?di_id=$di_id'>uscito</a>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm popup-custom' href='javascript:;' data-pop-width='1200' data-pop-height='800' ".
                                                "data-href='distribuzione-prodotti-add.php?di_id=$di_id' title='Prodotti'>prodotti</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono uscite in questa data</td></tr>";
                                        }

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 mb-10">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista operatori liberi</h5>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th>Nominativo</th>
                                            <th>Telefono</th>
                                            <th style="text-align: center; width: 300px;">Aggiungi uscita</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $count = count($op_array);
                                        $op_array = implode(",", $op_array);

                                        $querySql = $count > 0
                                            ? "SELECT * FROM op_operatori WHERE op_id NOT IN ($op_array) ORDER BY op_cognome "
                                            : "SELECT * FROM op_operatori WHERE op_id > 0 ORDER BY op_cognome ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $op_id = $row_data['op_id'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['op_codice']."</td>";
                                            echo "<td>".$row_data['op_nome']." ".$row_data['op_cognome']."</td>";
                                            echo "<td>".$row_data['op_telefono']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            ?>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Targa" aria-label="Targa" aria-describedby="basic-addon2"
                                                       autocomplete="off" style="height: 40px;">
                                                <input type="hidden" value="<?php echo $op_id; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-primary btn-uscita" type="button"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <?php
                                            //echo "<a class='btn btn-primary btn-sm' href='distribuzione-add-do.php?di_op_id=$op_id&di_timestamp=$get_di_timestamp' title='Aggiungi'>aggiungi</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono operatori liberi</td></tr>";
                                        }

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

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