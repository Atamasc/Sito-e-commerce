<?php include "inc/autoloader.php"; ?>
<?php
$get_ut_codice = $dbConn->real_escape_string(stripslashes(trim($_GET['ut_codice'])));
$get_or_timestamp = (int)$_GET['or_timestamp'];
$get_or_tipo = isset($_GET['or_tipo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_tipo']))) : "";
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>
            .content-wrapper {

                margin-left: 0!important;

            }
        </style>

    </head>

    <body>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php //include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php //include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-10"> Inserimento prodotti ordine </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <h5 class="card-title">Aggiungi prodotto</h5>

                                    <form method="post" action="ordini-prodotti-add-do.php">

                                        <?php include "../inc/alerts.php"; ?>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="lw-ac-input">Prodotto *</label>
                                                <div class="lw-ac-input">
                                                    <input type="text" class="form-control" id="lw-ac-input" name="lw-ac-input" required>
                                                    <input type="hidden" name="or_pr_id" required>
                                                </div>

                                                <div style="position: relative;">

                                                    <div class="lw-ac-list ac-ordine-operatore">
                                                        <?php
                                                        pageSelectProdotti();
                                                        function pageSelectProdotti() {

                                                            global $dbConn, $get_or_tipo, $session_id;

                                                            if ($get_or_tipo == "distribuzione") {

                                                                $querySql =
                                                                    "SELECT * FROM dp_distribuzione_prodotti ".
                                                                    "INNER JOIN di_distribuzione ON di_id = dp_di_id INNER JOIN pr_prodotti ON pr_id = dp_pr_id ".
                                                                    "INNER JOIN gi_giacenze ON gi_id = dp_gi_id INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                                    "WHERE di_timestamp = '".dateToTimestamp(date("d/m/Y"))."' AND di_op_id = '$session_id' ".
                                                                    "ORDER BY pr_descrizione, lt_timestamp DESC ";
                                                                $result = $dbConn->query($querySql);

                                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                                    $pr_id = $row_data['pr_id'];
                                                                    $gi_id = $row_data['gi_id'];
                                                                    $pr_descrizione = $row_data['pr_descrizione'];
                                                                    $lt_codice = $row_data['lt_codice'];
                                                                    $pr_um = $row_data['pr_um'];
                                                                    $pr_prezzo_vendita = formatPrice($row_data['pr_prezzo_vendita']);
                                                                    $dp_quantita = $row_data['dp_quantita'];
                                                                    $disabled = $dp_quantita > 0 ? "" : "disabled";

                                                                    echo "<p data-value='$pr_id' data-giacenza='$gi_id' data-um='$pr_um' data-price='$pr_prezzo_vendita' $disabled>".
                                                                        "$pr_descrizione | Lotto: $lt_codice <span style='float: right;'>(Qnt. disp. $dp_quantita $pr_um)</span></p>";


                                                                }

                                                                $result->close();

                                                            } else {

                                                                $querySql =
                                                                    "SELECT *, (SELECT SUM(gi_quantita) FROM gi_giacenze WHERE gi_pr_id = pr_id) AS gi_quantita FROM pr_prodotti ".
                                                                    "WHERE pr_id > 0 ORDER BY pr_descrizione";
                                                                $result = $dbConn->query($querySql);

                                                                while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                                    $pr_id = $row_data['pr_id'];
                                                                    $pr_descrizione = $row_data['pr_descrizione'];
                                                                    $pr_um = $row_data['pr_um'];
                                                                    $pr_prezzo_vendita = formatPrice($row_data['pr_prezzo_vendita']);
                                                                    $gi_quantita = getQntProdottoDisponibile($row_data['pr_id']);
                                                                    $disabled = $gi_quantita > 0 ? "" : "disabled";

                                                                    echo "<p data-value='$pr_id' data-um='$pr_um' data-price='$pr_prezzo_vendita' $disabled>".
                                                                        "$pr_descrizione <span style='float: right;'>(Qnt. disp. $gi_quantita $pr_um)</span></p>";

                                                                }

                                                                $result->close();

                                                            }

                                                        }
                                                        ?>
                                                    </div>

                                                </div>

                                            </div>

                                            <?php
                                            if ($get_or_tipo == "distribuzione") {

                                                ?><input type="hidden" name="or_gi_id" id="or_gi_id" value="" required><?php

                                            } else {

                                                ?>
                                                <div class="col-md-6 mb-3">
                                                    <label for="or_gi_id">Lotto *</label>
                                                    <select class="form-control" id="or_gi_id" name="or_gi_id" required>
                                                        <option value="">Seleziona prima il prodotto</option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <?php

                                            }
                                            ?>

                                            <div class="col-md-6 mb-3">
                                                <label for="or_quantita">Quantità *</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control pattern-number" id="or_quantita" name="or_quantita" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="lb_or_quantita" style="display: none;"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="or_prezzo">Prezzo per unità (Es formato: 5,70) *</label>
                                                <input type="text" class="form-control pattern-price" id="or_prezzo" name="or_prezzo" required>
                                            </div>

                                        </div>

                                        <input type="hidden" name="or_ut_codice" value="<?php echo $get_ut_codice; ?>">
                                        <input type="hidden" name="or_timestamp" value="<?php echo $get_or_timestamp; ?>">
                                        <input type="hidden" name="or_tipo" value="<?php echo $get_or_tipo; ?>">
                                        <input type="hidden" name="or_op_id" id="or_op_id" value="<?php echo $session_id; ?>">
                                        <button class="btn btn-primary" type="submit">Inserisci</button>
                                        <a class="btn btn-orange" href="javascript:window.close();">Concludi</a>

                                    </form>
                                </div>
                            </div>

                        </div>

                        <?php include "inc/datalist-ordini-prodotti.php"; ?>

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

    <script>
        window.opener.location.reload();

        $('.btn-step').click(function () {

            let op_id = $(this).data('operatore');

            $('#or_op_id').val(op_id);

            $('#step-1').hide('slow');
            $('#step-2').show('slow');


        });
    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>