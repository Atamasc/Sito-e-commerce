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
$get_di_id = (int)$_GET['di_id'];
$get_pr_ct_id = isset($_GET["pr_ct_id"]) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_ct_id"]))) : "";
$get_pr_descrizione = isset($_GET["pr_descrizione"]) ? $dbConn->real_escape_string(stripslashes(trim($_GET["pr_descrizione"]))) : "";
?>

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
                            <h4 class="mb-10"> Inserimento prodotti caricati </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <?php include "inc/dataview-distribuzione.php"; ?>

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Aggiungi prodotto</h5>

                                <form method="post" action="distribuzione-prodotti-add-do.php">

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="lw-ac-input">Prodotto *</label>
                                            <div class="lw-ac-input">
                                                <input type="text" class="form-control" id="lw-ac-input" name="lw-ac-input" required>
                                                <input type="hidden" name="dp_pr_id" required>
                                            </div>

                                            <div style="position: relative;">

                                                <div class="lw-ac-list ac-distribuzione">
                                                    <?php
                                                    pageSelectProdotti();
                                                    function pageSelectProdotti() {

                                                        global $dbConn;

                                                        $querySql =
                                                            "SELECT *, (SELECT SUM(gi_quantita) FROM gi_giacenze WHERE gi_pr_id = pr_id) AS gi_quantita FROM pr_prodotti ".
                                                            "WHERE pr_id > 0 ORDER BY pr_descrizione";
                                                        $result = $dbConn->query($querySql);

                                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                            $pr_id = $row_data['pr_id'];
                                                            $pr_descrizione = $row_data['pr_descrizione'];
                                                            $pr_um = $row_data['pr_um'];
                                                            $gi_quantita = (int)$row_data['gi_quantita'];
                                                            $disabled = $gi_quantita > 0 ? "" : "disabled";

                                                            echo "<p data-value='$pr_id' data-um='$pr_um' $disabled>".
                                                                "$pr_descrizione <span style='float: right;'>(Qnt. disp. $gi_quantita $pr_um)</span></p>";

                                                        }

                                                        $result->close();

                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="dp_gi_id">Lotto *</label>
                                            <select class="form-control" id="dp_gi_id" name="dp_gi_id" required>
                                                <option value="">Seleziona prima il prodotto</option>
                                                <option value=""></option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="dp_quantita">Quantità *</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control pattern-number" id="dp_quantita" name="dp_quantita" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="lb_dp_quantita" style="display: none;"></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="dp_di_id" value="<?php echo $get_di_id; ?>">
                                    <button class="btn btn-primary" type="submit">Inserisci</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <?php include "inc/datalist-distribuzione-prodotti.php"; ?>

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