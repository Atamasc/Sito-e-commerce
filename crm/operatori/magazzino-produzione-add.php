<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <style>
        .content-wrapper {

            margin-left: 0!important;

        }

        #step-2{

            display: none;

        }

    </style>

</head>

<body>

<?php
$get_pr_id = (int)$_GET['pr_id'];
$get_pr_id_prod = (int)$_GET['pr_id_prod'];

$querySql = "SELECT * FROM pr_prodotti WHERE pr_id = $get_pr_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$pr_um = $row_data['pr_um'];
$pr_ct_id = $row_data['pr_ct_id'];
?>

<div class="wrapper">
    <!--================================= preloader -->
    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--================================= preloader -->
    <!--================================= Main content -->

    <div class="container-fluid">
        <div class="row">

            <!--================================= Main content -->
            <!--================================= wrapper -->
            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="mb-10"> Produzione da Rinfusa: <?php echo $row_data['pr_descrizione']; ?> - Codice: <?php echo $row_data['pr_codice']; ?> </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10" id="step-1">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Seleziona il lotto da cui produrre</h5>

                                <?php
                                if ($_GET['insert'] == 'true') {

                                    ?>
                                    <div class="alert alert-success">
                                        Sono rimasti <b><?php echo countGiacenze($get_pr_id, $dbConn); ?> kg</b> per questa rinfusa.<br>
                                        Attualmente ci sono <b><?php echo countGiacenze($get_pr_id_prod, $dbConn); ?> pz</b> per <?php echo getProdottoById($get_pr_id_prod, $dbConn); ?>.<br>
                                    </div>
                                    <?php

                                }
                                ?>

                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th>Data</th>
                                            <th>Prezzo d'acquisto</th>
                                            <th>Quantità disponibile</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        pageGetLotti($get_pr_id);
                                        function pageGetLotti($pr_id) {

                                            global $dbConn;

                                            $querySql =
                                                "SELECT * FROM gi_giacenze ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE gi_pr_id = '$pr_id' AND gi_quantita > 0 ORDER BY gi_timestamp DESC ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($rows = $result->fetch_assoc()) !== NULL) {

                                                $gi_id = $rows['gi_id'];
                                                $lt_id = $rows['lt_id'];
                                                $gi_quantita = getQntGiacenzaDisponibile($gi_id);
                                                $lt_prezzo = formatPrice($rows['lt_prezzo'])."&euro;/".$rows['pr_um'];
                                                $lt_desc = $rows['lt_codice']." del ".date("d/m/Y", $rows['lt_timestamp'])
                                                    ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Qnt. disp. $gi_quantita ".$rows['pr_um'].") $lt_prezzo";

                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['lt_codice']; ?></td>
                                                    <td><?php echo date("d/m/Y", $rows['lt_timestamp']); ?></td>
                                                    <td><?php echo $lt_prezzo; ?></td>
                                                    <td><?php echo $gi_quantita." ".$rows['pr_um']; ?></td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm btn-step"
                                                                data-lotto="<?php echo $lt_id; ?>" data-giacenza="<?php echo $gi_id; ?>">
                                                            <i class="fas fa-arrow-alt-right fa-2x"></i></button>
                                                    </td>
                                                </tr>
                                                <?php

                                            }
                                            $result->close();


                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 mb-10" id="step-2">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Seleziona cosa produrre</h5>

                                <form method="post" action="magazzino-produzione-add-do.php">

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="gi_pr_id">Prodotto *</label>
                                            <select class="form-control" name="gi_pr_id" id="gi_pr_id">
                                                <option value="">Seleziona un prodotto</option>
                                                <option value=""></option>
                                                <?php
                                                pageSelectProdotti($pr_ct_id);
                                                function pageSelectProdotti($ct_id) {

                                                    global $dbConn;

                                                    $querySql =
                                                        "SELECT * FROM pr_prodotti WHERE pr_ct_id = '$ct_id' AND pr_tipologia = 'Produzione' ".
                                                        "ORDER BY pr_descrizione";
                                                    $result = $dbConn->query($querySql);

                                                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                        $pr_id = $row_data['pr_id'];
                                                        $pr_descrizione = $row_data['pr_descrizione'];
                                                        $pr_um = $row_data['pr_um'];
                                                        $pr_prezzo_acquisto = formatPrice($row_data['pr_prezzo_acquisto']);

                                                        echo "<option value='$pr_id'>$pr_descrizione</option>";

                                                    }

                                                    $result->close();

                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="gi_quantita">Quantità prodotta *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control pattern-number" id="gi_quantita" name="gi_quantita" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="lb_lt_quantita">pz</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="gi_quantita_refuso">Quantità utilizzata *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control pattern-number" id="gi_quantita_refuso" name="gi_quantita_refuso" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="lb_lt_quantita">kg</span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <input type="hidden" name="gi_pr_id_refuso" value="<?php echo $get_pr_id; ?>">
                                    <input type="hidden" name="gi_lt_id" id="gi_lt_id">
                                    <input type="hidden" name="gi_id_refuso" id="gi_id_refuso">
                                    <button class="btn btn-primary" type="submit">Inserisci</button>

                                </form>
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

<script>
    window.opener.location.reload();

    $('.btn-step').click(function () {

        let lt_id = $(this).data('lotto');
        let gi_id = $(this).data('giacenza');

        $('#gi_id_refuso').val(gi_id);
        $('#gi_lt_id').val(lt_id);

        $('#step-1').hide('slow');
        $('#step-2').show('slow');


    });
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>