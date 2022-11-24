<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <script src="../ajax/regioni.js"></script>

</head>

<?php

$pr_ct_id = @$_GET["pr_ct_id"];
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
                            <h4 class="mb-0"> Aggiungi prodotto</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Elenco prodotti</a></li>
                                <li class="breadcrumb-item active">Aggiungi prodotto</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics mb-30">
                            <div class="card-body">
                                <form method="post" action="prodotti-add-do.php">

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Aggiunta avvenuta con successo.
                                        </div>
                                        <?php

                                    } else if(@$_GET['insert'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Si è verificato un errore, riprova.
                                        </div>
                                        <?php

                                    }
                                    ?>
                                    <div class="form-row">
                                        <div class="col-md-1 mb-3">
                                            <label for="pr_codice">Codice *</label>
                                            <input type="text" class="form-control" id="pr_codice" name="pr_codice" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_barcode">Barcode *</label>
                                            <input type="text" class="form-control" id="pr_barcode" name="pr_barcode" required>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <label for="pr_iva">Iva *</label>
                                            <input type="text" class="form-control pattern-price" id="pr_iva" name="pr_iva" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="pr_descrizione">Titolo *</label>
                                            <input type="text" class="form-control" id="pr_descrizione" name="pr_descrizione" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_ct_id">Categoria *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="pr_ct_id" id="pr_ct_id" class="medium">
                                                    <option value="">[Seleziona categoria]</option>
                                                    <option value=""></option>
                                                    <?php selectCategorie($pr_ct_id, $dbConn); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pr_prezzo_acquisto">Prezzo acquisto (Es formato: 5.70 ) *</label>
                                            <input type="text" class="form-control" id="pr_prezzo_acquisto" name="pr_prezzo_acquisto" placeholder="Solo numeri e punti (vedi formato)" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_prezzo_vendita">Prezzo vendita (Es formato: 5.70 ) *</label>
                                            <input type="text" class="form-control" id="pr_prezzo_vendita" name="pr_prezzo_vendita" placeholder="Solo numeri e punti (vedi formato)" required>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_um">Unita di Misura *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="pr_um" id="pr_um" required>
                                                    <option value="">Seleziona unita di misura</option>
                                                    <option value=""></option>
                                                    <option value="pz">Pezzi</option>
                                                    <option value="kg">KG</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pr_tipologia">Tipologia *</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="pr_tipologia" id="pr_tipologia" required>
                                                    <option value="">Seleziona tipologia</option>
                                                    <option value=""></option>
                                                    <option value="Rinfusa">Rinfusa</option>
                                                    <option value="Produzione">Produzione</option>
                                                    <option value="Semplice">Semplice</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Inserisci</button>

                                </form>

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

</body>

</html>
<?php include "../inc/db-close.php"; ?>