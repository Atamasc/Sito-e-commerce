<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
    $get_or_timestamp_da = isset($_GET['or_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_timestamp_da']))) : "";
    $get_or_timestamp_a = isset($_GET['or_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_timestamp_a']))) : "";
    
    if(strlen($get_or_timestamp_da) > 0) {
    
        list($day, $month, $year) = explode("/", $get_or_timestamp_da);
        $get_or_timestamp_da = mktime(0, 0, 0, $month, $day, $year);
    
    }
    
    if(strlen($get_or_timestamp_a) > 0) {
    
        list($day, $month, $year) = explode("/", $get_or_timestamp_a);
        $get_or_timestamp_a = mktime(23, 59, 59, $month, $day, $year);
    
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
                            <h4 class="mb-0"> Gestione ordini </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione ordini</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra per data</h5>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <div class="input-group" data-date="">
                                                <input name="or_timestamp_da" class="form-control range-from" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_or_timestamp_da) > 0) echo date("d/m/Y", $get_or_timestamp_da); ?>">
                                                <span class="input-group-addon">A</span>
                                                <input name="or_timestamp_a" class="form-control range-to" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_or_timestamp_a) > 0) echo date("d/m/Y", $get_or_timestamp_a); ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Cerca</button>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Storico ordini</h5>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <tbody>

                                        <?php
                                            //$querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) AS or_totale FROM or_ordini INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_id > 0 AND or_eliminato = 0 ";
                                            $querySql = "SELECT SUM(or_pr_prezzo * or_pr_quantita) AS or_totale FROM or_ordini WHERE or_id > 0 AND or_eliminato = 0 ";
                                            if(strlen($get_or_timestamp_da) > 0) $querySql .= " AND or_timestamp >= '$get_or_timestamp_da' ";
                                            if(strlen($get_or_timestamp_a) > 0) $querySql .= " AND or_timestamp <= '$get_or_timestamp_a' ";
                                            //echo "<br>querySql:".$querySql;
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();
    
                                            $or_totale = $row[0];

                                            $or_sconto = getScontoByData($get_or_timestamp_da, $get_or_timestamp_a);
                                            $or_totale_acquisto = formatPrice(getTotAcquistiByData($get_or_timestamp_da, $get_or_timestamp_a));
                                            $pr_no_prezzo_acquisto = countProdottiSenzaPrezzoAcquisto($dbConn);

                                            $or_spese = 0;
                                            //$or_sconto = 0;
                                            //echo "<br>or_sconto:".$or_sconto;
    
                                            $or_totale = $or_totale - $or_sconto;

                                            $or_imponibile = $or_totale / 1.22;
                                            $or_iva = $or_totale - $or_imponibile;
    
                                            $or_totale = formatPrice($or_totale);
                                            $or_imponibile = formatPrice($or_imponibile);
                                            $or_sconto = formatPrice($or_sconto);
                                            $or_spese = formatPrice($or_spese);
                                            $or_iva = formatPrice($or_iva);
    
                                            echo "<tr>";
                                            echo "<td width='200'>Valore imponibile</td>";
                                            echo "<td class='text-left'>&euro; $or_imponibile</td>";
                                            echo "<td class='text-left'><em>importo imponibile totale sul periodo</em></td>";
                                            echo "</tr>";
                                            
                                            echo "<tr>";
                                            echo "<td>Valore IVA</td>";
                                            echo "<td class='text-left'>&euro; $or_iva</td>";
                                            echo "<td class='text-left'><em>importo iva totale sul periodo</em></td>";
                                            echo "</tr>";
                                            
                                            echo "<tr>";
                                            echo "<td>Sconti</td>";
                                            echo "<td class='text-left'>&euro; $or_sconto</td>";
                                            echo "<td class='text-left'><em>valore totale degli sconti sul periodo</em></td>";
                                            echo "</tr>";
                                            
                                            echo "<tr>";
                                            echo "<td>Spese</td>";
                                            echo "<td class='text-left'>&euro; $or_spese</td>";
                                            echo "<td class='text-left'><em>valore totale delle spese di contrassegni e pagamento sul periodo</em></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo "<td>Totale con spese</td>";
                                            echo "<td class='text-left'>&euro; $or_totale</td>";
                                            echo "<td class='text-left'><em>valore totale dei ricavi sul periodo</em></td>";
                                            echo "</tr>";

                                            echo "<tr>";
                                            echo "<td>Totale acquisto</td>";
                                            echo "<td class='text-left'>&euro; $or_totale_acquisto</td>";
                                            echo "<td class='text-left'><em>valore totale di acquisto dei prodotti sul periodo (<b>$pr_no_prezzo_acquisto</b> articoli non hanno il prezzo di acquisto)</em></td>";
                                            echo "</tr>";


    
                                            $result->close();
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