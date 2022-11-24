<?php include "inc/autoloader.php"; ?>
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

<?php
$get_pr_id = (int)$_GET['pr_id'];

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
                            <h4 class="mb-10"> Scarico prodotto mercato: <?php echo $row_data['pr_descrizione']; ?> - Codice: <?php echo $row_data['pr_codice']; ?> </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10" id="step-1">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Seleziona il lotto da scaricare</h5>

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
                                                "SELECT * FROM mg_mercato_giacenze ".
                                                "INNER JOIN gi_giacenze ON gi_id = mg_gi_id ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "WHERE gi_pr_id = '$pr_id' AND mg_quantita > 0 ORDER BY gi_timestamp DESC ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($rows = $result->fetch_assoc()) !== NULL) {

                                                $gi_id = $rows['gi_id'];
                                                $mg_quantita = $rows['mg_quantita']." ".$rows['pr_um'];
                                                $lt_prezzo = formatPrice($rows['lt_prezzo'])."&euro;/".$rows['pr_um'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $rows['lt_codice']; ?></td>
                                                    <td><?php echo date("d/m/Y", $rows['lt_timestamp']); ?></td>
                                                    <td><?php echo $lt_prezzo; ?></td>
                                                    <td><?php echo $mg_quantita; ?></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Qnt. da scaricare" aria-label="Qnt. da scaricare"
                                                                   aria-describedby="basic-addon2" data-max="<?php echo $rows['mg_quantita']; ?>" autocomplete="off"
                                                                   style="height: 40px;">
                                                            <input type="hidden" value="<?php echo $gi_id; ?>">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-danger btn-del" type="button"><i class="fas fa-minus"></i></button>
                                                            </div>
                                                        </div>
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
    $('.btn-del').click(function () {

        let mg_quantita = $(this).parents('.input-group').find('input[type=text]').val();
        let mg_gi_id = $(this).parents('.input-group').find('input[type=hidden]').val();

        let max = $(this).parents('.input-group').find('input[type=text]').data('max');

        if (mg_quantita.length === 0) {

            alert("Inserisci la quantità.");
            return 0;

        } else if (mg_quantita > max) {

            alert("Non puoi superare la quantità disponibile.");
            return 0;

        }

        window.location.replace("mercato-del-do.php?mg_gi_id=" + mg_gi_id + "&mg_quantita=" + mg_quantita);

    });
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>