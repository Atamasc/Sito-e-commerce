<?php include "inc/autoloader.php"; ?>
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
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Aggiungi corriere</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="corrieri-gst.php" class="default-color">Gestione corriere</a></li>
                                    <li class="breadcrumb-item active">Aggiungi corriere</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="post" action="corrieri-add-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Aggiungi corriere</h5>

                                        <?php
                                        if (@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Corriere inserito con successo.
                                            </div>
                                            <?php

                                        } else if (@$_GET['insert'] == 'false') {

                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                Si è verificato un errore, riprova.
                                            </div>
                                            <?php

                                        }
                                        ?>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ci_titolo">Titolo *</label>
                                                <input type="text" class="form-control" id="ci_titolo" name="ci_titolo" required>
                                                <span class="tooltips">Titolo Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Corriere" data-content="Inserisci qui il titolo dello corriere che stai aggiungendo">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-2 mb-3">
                                                <label for="ci_costo_standard">Costo spedizione standard </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ci_costo_standard" name="ci_costo_standard"
                                                            aria-describedby="ci_costo_standard_add" placeholder="Esempio: 15,50">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ci_costo_standard_add">&euro;</span>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Spedizione Standard Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Standard Corriere" data-content="Inserisci qui il costo della spedizione standard">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ci_costo_espressa">Costo spedizione espressa </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ci_costo_espressa" name="ci_costo_espressa"
                                                            aria-describedby="ci_costo_espressa_add" placeholder="Esempio: 15,50">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ci_costo_espressa_add">&euro;</span>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Spedizione Espressa Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Espressa Corriere" data-content="Inserisci qui il costo della spedizione espressa">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ci_costo_estera">Costo spedizione estera </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ci_costo_estera" name="ci_costo_estera"
                                                            aria-describedby="ci_costo_estera_add" placeholder="Esempio: 15,50">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ci_costo_estera_add">&euro;</span>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Spedizione Estera Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Estera Corriere" data-content="Inserisci qui il costo della spedizione estera">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-2 mb-3">
                                                <label for="ci_ordine_minimo">Prezzo ordine minimo </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ci_ordine_minimo" name="ci_ordine_minimo"
                                                            aria-describedby="ci_ordine_minimo_add" placeholder="Esempio: 15,50">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ci_ordine_minimo_add">&euro;</span>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Ordine Minimo Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ordine Minimo Corriere" data-content="Inserisci qui il costo dell'ordine minimo oltre il quale la spedizione &egrave; gratuita">[aiuto]</a></span>
                                            </div>

                                        </div>


                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ci_tempi_standard">Tempi di consegna standard</label>
                                                <input type="text" class="form-control" id="ci_tempi_standard" name="ci_tempi_standard">
                                                <span class="tooltips">Consegna Standard Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Consegna Standard Corriere" data-content="Inserisci qui i tempi di consegna standard">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ci_tempi_espressa">Tempi di consegna espressa</label>
                                                <input type="text" class="form-control" id="ci_tempi_espressa" name="ci_tempi_espressa">
                                                <span class="tooltips">Consegna Espressa Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Consegna Espressa Corriere" data-content="Inserisci qui i tempi di consegna espressa">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="ci_descrizione">Descrizione</label>
                                                <textarea class="form-control" id="ci_descrizione" name="ci_descrizione" rows="5"></textarea>
                                                <span class="tooltips">Descrizione Corriere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Corriere" data-content="Inserisci qui la descrizione dello corriere che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="ci_spedizione_estera" name="ci_spedizione_estera">
                                                <label class="custom-control-label" for="ci_spedizione_estera" style="margin-bottom: 30px;">Spedizione estera</label>
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

    <script>
        $("#co_tipo").change(function () {
            let sym = $('#co_tipo option:selected').data('value');
            $('#co_valore_add').html(sym);

        });
    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>