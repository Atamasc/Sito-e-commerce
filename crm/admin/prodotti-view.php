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

    <?php
    $get_pr_id = isset($_GET['pr_id']) ? (int)$_GET['pr_id'] : 0;

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$get_pr_id'  ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();
    ?>

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
                            <div class="col-sm-12">
                                <h4 class="mb-2"> Dettaglio prodotto</h4>
                            </div>
                            <!--
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Gestione prodotti</a></li>
                                    <li class="breadcrumb-item active">Modifica prodotti</li>
                                </ol>
                            </div>
                            -->
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="#" enctype="multipart/form-data">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice">Codice</label>
                                                <input type="text" class="form-control" id="pr_codice" name="pr_codice"
                                                       value="<?php echo $row_data['pr_codice']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_posizione">Posizione</label>
                                                <input type="text" class="form-control" id="pr_posizione" name="pr_posizione"
                                                       value="<?php echo $row_data['pr_posizione']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_ean">Codice EAN</label>
                                                <input type="text" class="form-control" id="pr_codice_ean" name="pr_codice_ean"
                                                       value="<?php echo $row_data['pr_codice_ean']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_descrizione_breve">Descrizione breve</label>
                                                <input type="text" class="form-control" id="pr_descrizione_breve" name="pr_descrizione_breve"
                                                       value="<?php echo $row_data['pr_descrizione_breve']; ?>" readonly>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="pr_descrizione_estesa">Descrizione estesa</label>
                                                <textarea class="form-control" id="pr_descrizione_estesa" name="pr_descrizione_estesa"
                                                          rows="5" readonly><?php echo $row_data['pr_descrizione_estesa']; ?></textarea>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_formato">Formato</label>
                                                <input type="text" class="form-control" id="pr_formato" name="pr_formato"
                                                       value="<?php echo $row_data['pr_formato']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_fm_codice">Codice famiglia</label>
                                                <input type="text" class="form-control" id="pr_fm_codice" name="pr_fm_codice"
                                                       value="<?php echo $row_data['pr_fm_codice']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_fm_descrizione">Descrizione famiglia</label>
                                                <input type="text" class="form-control" id="pr_fm_descrizione" name="pr_fm_descrizione"
                                                       value="<?php echo $row_data['pr_fm_descrizione']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_marchio">Codice marchio</label>
                                                <input type="text" class="form-control" id="pr_codice_marchio" name="pr_codice_marchio"
                                                       value="<?php echo $row_data['pr_codice_marchio']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pt_descrizione_marchio">Descrizione marchio</label>
                                                <input type="text" class="form-control" id="pt_descrizione_marchio" name="pt_descrizione_marchio"
                                                       value="<?php echo $row_data['pt_descrizione_marchio']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_linea">Codice linea</label>
                                                <input type="text" class="form-control" id="pr_codice_linea" name="pr_codice_linea"
                                                       value="<?php echo $row_data['pr_codice_linea']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_descrizione_linea">Descrizione linea</label>
                                                <input type="text" class="form-control" id="pr_descrizione_linea" name="pr_descrizione_linea"
                                                       value="<?php echo $row_data['pr_descrizione_linea']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_merceologia">Codice merceologia</label>
                                                <input type="text" class="form-control" id="pr_codice_merceologia" name="pr_codice_merceologia"
                                                       value="<?php echo $row_data['pr_codice_merceologia']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_descrizione_merceologia">Descrizione merceologia</label>
                                                <input type="text" class="form-control" id="pr_descrizione_merceologia" name="pr_descrizione_merceologia"
                                                       value="<?php echo $row_data['pr_descrizione_merceologia']; ?>" readonly>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_reparto">Codice reparto</label>
                                                <input type="text" class="form-control" id="pr_codice_reparto" name="pr_codice_reparto"
                                                       value="<?php echo $row_data['pr_codice_reparto']; ?>" readonly>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_descrizione_reparto">Descrizione reparto</label>
                                                <input type="text" class="form-control" id="pr_descrizione_reparto" name="pr_descrizione_reparto"
                                                       value="<?php echo $row_data['pr_descrizione_reparto']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_iva">Codice iva</label>
                                                <input type="text" class="form-control" id="pr_codice_iva" name="pr_codice_iva"
                                                       value="<?php echo $row_data['pr_codice_iva']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo">Prezzo</label>
                                                <input type="text" class="form-control pattern-price" id="pr_prezzo" name="pr_prezzo"
                                                       value="<?php echo formatPrice($row_data['pr_prezzo']); ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_sconto">Sconto</label>
                                                <input type="text" class="form-control pattern-price" id="pr_sconto" name="pr_sconto"
                                                       value="<?php echo formatPrice($row_data['pr_sconto']); ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo_scontato">Prezzo scontato</label>
                                                <input type="text" class="form-control pattern-price" id="pr_prezzo_scontato" name="pr_prezzo_scontato"
                                                       value="<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_vetrina">Vetrina</label>
                                                <input type="text" class="form-control" id="pr_vetrina" name="pr_vetrina"
                                                       value="<?php echo $row_data['pr_vetrina']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_novita">Novita</label>
                                                <input type="text" class="form-control" id="pr_novita" name="pr_novita"
                                                       value="<?php echo $row_data['pr_novita']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_promo">Promo</label>
                                                <input type="text" class="form-control" id="pr_promo" name="pr_promo"
                                                       value="<?php echo $row_data['pr_promo']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_ordinato">Ordinato</label>
                                                <input type="text" class="form-control" id="pr_ordinato" name="pr_ordinato" 
                                                       value="<?php echo $row_data['pr_ordinato']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_immagine">Immagine</label>
                                                <input type="text" class="form-control" id="pr_immagine" name="pr_immagine"
                                                       value="<?php echo $row_data['pr_immagine']; ?>" readonly>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="pr_esistenza" name="pr_esistenza"
                                                        <?php echo $row_data['pr_esistenza'] > 0 ? "checked" : ""; ?> disabled>
                                                    <label class="custom-control-label" for="pr_esistenza">Esistenza</label>
                                                </div>
                                            </div>

                                        </div>

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

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>