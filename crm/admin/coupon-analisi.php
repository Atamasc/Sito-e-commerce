<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_uc_id = isset($_GET['uc_id']) ? (int)$_GET['uc_id'] : 0;
    $get_uc_coupon = isset($_GET['uc_coupon']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['uc_coupon']))) : "";
    $get_uc_timestamp_da = isset($_GET['uc_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['uc_timestamp_da']))) : "";
    $get_uc_timestamp_a = isset($_GET['uc_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['uc_timestamp_a']))) : "";

    if(strlen($get_uc_timestamp_da) > 0) {

        list($day, $month, $year) = explode("/", $get_uc_timestamp_da);
        $get_uc_timestamp_da = mktime(0, 0, 0, $month, $day, $year);

    }

    if(strlen($get_uc_timestamp_a) > 0) {

        list($day, $month, $year) = explode("/", $get_uc_timestamp_a);
        $get_uc_timestamp_a = mktime(23, 59, 59, $month, $day, $year);

    }
    ?>

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
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Gestione coupon </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione coupon</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra coupon</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Coupon</label>
                                                <input type="text" name="uc_coupon" class="form-control" value="<?php echo $get_uc_coupon; ?>">
                                                <span class="tooltips">Codice Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Coupon" data-content="Inserisci qui il codice del coupon che stai modificando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label>Data utilizzo dal/al</label>
                                                <div class="input-group" data-date="">
                                                    <input name="uc_timestamp_da" class="form-control range-from" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_uc_timestamp_da) > 0) echo date("d/m/Y", $get_uc_timestamp_da); ?>">
                                                    <span class="input-group-addon">A</span>
                                                    <input name="uc_timestamp_a" class="form-control range-to" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_uc_timestamp_a) > 0) echo date("d/m/Y", $get_uc_timestamp_a); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a href="coupon-add.php" class="btn btn-success">Aggiungi coupon</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista coupon ricercati</h5>

                                    <?php
                                    if(@$_GET['delete'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Eliminazione avvenuta con successo.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Coupon</th>
                                                <th>N. Utilizzi</th>
                                                <th>Importo totale</th>
                                                <!--
                                                <th style="text-align: center;" width="200">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                                -->
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $querySql = "SELECT COUNT(uc_id) FROM uc_utilizzo_coupon WHERE uc_id > 0 ";
                                                if (strlen($get_uc_coupon) > 0) $querySql .= " AND uc_coupon = '$get_uc_coupon' ";
                                                if (strlen($get_uc_timestamp_da) > 0) $querySql .= " AND uc_data >= '$get_uc_timestamp_da' ";
                                                if (strlen($get_uc_timestamp_a) > 0) $querySql .= " AND uc_data <= '$get_uc_timestamp_a' ";
                                                $result = $dbConn->query($querySql);
                                                $row = $result->fetch_row();

                                                $row_cnt = $row[0];

                                                $querySql = "SELECT * FROM uc_utilizzo_coupon WHERE uc_id > 0 ";
                                                if (strlen($get_uc_coupon) > 0) $querySql .= " AND uc_coupon = '$get_uc_coupon' ";
                                                if (strlen($get_uc_timestamp_da) > 0) $querySql .= " AND uc_data >= '$get_uc_timestamp_da' ";
                                                if (strlen($get_uc_timestamp_a) > 0) $querySql .= " AND uc_data <= '$get_uc_timestamp_a' ";
                                                $querySql .= " GROUP BY uc_coupon ";
                                                $result = $dbConn->query($querySql);
                                                $rows = $dbConn->affected_rows;

                                                $totale_importo = 0;
                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                    $uc_id = $row_data['uc_id'];
                                                    $uc_coupon = $row_data['uc_coupon'];

                                                    $querySql_inner = "SELECT * FROM uc_utilizzo_coupon WHERE uc_coupon = '".$uc_coupon."' ";
                                                    if (strlen($get_uc_coupon) > 0) $querySql_inner .= " AND uc_coupon = '$get_uc_coupon' ";
                                                    if (strlen($get_uc_timestamp_da) > 0) $querySql_inner .= " AND uc_data >= '$get_uc_timestamp_da' ";
                                                    if (strlen($get_uc_timestamp_a) > 0) $querySql_inner .= " AND uc_data <= '$get_uc_timestamp_a' ";
                                                    $result_inner = $dbConn->query($querySql_inner);
                                                    $rows_inner = $dbConn->affected_rows;

                                                    $totale_importo = 0;
                                                    while (($rows_inner = $result_inner->fetch_assoc()) !== NULL) {

                                                        $uc_ordine = $rows_inner['uc_ordine'];

                                                        $querySql_importo = "SELECT * FROM or_ordini WHERE or_codice = '".$uc_ordine."' AND or_stato_pagamento > 0 ";
                                                        $result_importo = $dbConn->query($querySql_importo);
                                                        $rows_importo = $dbConn->affected_rows;

                                                        $totale_ordine = 0;
                                                        while (($rows_importo = $result_importo->fetch_assoc()) !== NULL) {

                                                            $or_importo_totale = $rows_importo['or_pr_quantita'] * $rows_importo['or_pr_prezzo'];
                                                            $totale_ordine += $or_importo_totale;

                                                        };

                                                        $totale_importo += $totale_ordine;

                                                    };

                                                    echo "<tr>";
                                                    echo "<td>" . $row_data['uc_coupon'] . "</td>";
                                                    if (strlen($get_uc_coupon) > 0) {
                                                        echo "<td>" . $row_cnt . "</td>";
                                                        echo "<td>&euro; " . formatPrice($totale_importo) . "</td>";
                                                    } else {
                                                        echo "<td>".get_numero_utilizzi_by_code($row_data['uc_coupon'],$dbConn)."</td>";
                                                        echo "<td>&euro; ".get_importo_utilizzi_by_code($row_data['uc_coupon'],$dbConn)."</td>";
                                                    }
                                                    echo "</tr>";

                                                };

                                            ?>

                                            </tbody>
                                        </table>

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