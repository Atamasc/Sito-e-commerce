<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <script src="../ajax/regioni.js"></script>

</head>

<?php
$get_cr_id = isset($_GET['cr_id']) ? (int)$_GET['cr_id'] : 0;

$querySql = "SELECT * FROM cr_carichi WHERE cr_id = '$get_cr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();

$lt_cr_id = $get_cr_id;
?>

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
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-0"> Aggiunta lotto / Carico cod. <?php echo $row_data['cr_codice']; ?></h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="carichi-gst.php" class="default-color">Gestione carichi</a></li>
                                <li class="breadcrumb-item active">Aggiunta lotto</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php include "inc/dataview-carico.php"; ?>

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">
                                <form method="post" action="lotti-add-do.php">

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="lt_codice">Codice *</label>
                                            <input type="text" class="form-control" id="lt_codice" name="lt_codice" required>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="lw-ac-input">Prodotto *</label>
                                            <div class="lw-ac-input">
                                                <input type="text" class="form-control" id="lw-ac-input" name="lw-ac-input" required>
                                                <input type="hidden" name="lt_pr_id" required>
                                            </div>

                                            <div style="position: relative;">

                                                <div class="lw-ac-list ac-lotti">
                                                    <?php
                                                    pageSelectProdotti();
                                                    function pageSelectProdotti() {

                                                        global $dbConn;

                                                        $querySql =
                                                            "SELECT * FROM pr_prodotti WHERE pr_id > 0 AND pr_tipologia REGEXP 'Rinfusa|Semplice' ".
                                                            "ORDER BY pr_descrizione";
                                                        $result = $dbConn->query($querySql);

                                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                            $pr_id = $row_data['pr_id'];
                                                            $pr_descrizione = $row_data['pr_descrizione'];
                                                            $pr_um = $row_data['pr_um'];
                                                            $pr_prezzo_acquisto = formatPrice($row_data['pr_prezzo_acquisto']);

                                                            echo "<p data-value='$pr_id' data-prezzo='$pr_prezzo_acquisto' data-um='$pr_um'>".
                                                                "$pr_descrizione</p>";

                                                        }

                                                        $result->close();

                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="lt_quantita">Quantità *</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control pattern-number" id="lt_quantita" name="lt_quantita" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="lb_lt_quantita" style="display: none;"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="lt_prezzo">Prezzo d'acquisto *</label>
                                            <input type="text" class="form-control pattern-price" id="lt_prezzo" name="lt_prezzo" required>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="lt_refuso">Refuso</label>
                                            <input type="text" class="form-control" id="lt_refuso" name="lt_refuso" required>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="lt_descrizione">Descrizione</label>
                                            <textarea class="form-control" id="lt_descrizione" name="lt_descrizione" rows="3"></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="lt_note">Note</label>
                                            <textarea class="form-control" id="lt_note" name="lt_note" rows="3"></textarea>
                                        </div>

                                    </div>

                                    <input type="hidden" name="lt_cr_id" value="<?php echo $get_cr_id; ?>">
                                    <button class="btn btn-primary" type="submit">Inserisci</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <?php include "inc/datalist-lotti.php"; ?>

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

</body>

</html>
<?php include "../inc/db-close.php"; ?>