<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

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
                                <h4 class="mb-0"> Aggiungi fornitore</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione fornitore</a></li>
                                    <li class="breadcrumb-item active">Aggiungi fornitore</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="fornitori-add-do.php">

                                        <?php
                                        if(@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Fornitore inserito con successo.
                                            </div>
                                            <?php

                                        } else if(@$_GET['insert'] == 'false') {

                                            ?>
                                            <div class="alert alert-error" role="alert">
                                                Si è verificato un errore, riprova.
                                            </div>
                                            <?php

                                        }
                                        ?>

                                        <h6 class="card-title">Dati anagrafici</h6>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_codice">Codice *</label>
                                                <input type="text" class="form-control" id="fr_codice" name="fr_codice"
                                                       value="<?php echo time(); ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_ragione_sociale">Ragione sociale *</label>
                                                <input type="text" class="form-control" id="fr_ragione_sociale" name="fr_ragione_sociale" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_cod_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="fr_cod_fiscale" name="fr_cod_fiscale">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="fr_partita_iva" name="fr_partita_iva">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_sdi">SDI</label>
                                                <input type="text" class="form-control" id="fr_sdi" name="fr_sdi" >
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_telefono">Telefono</label>
                                                <input type="text" class="form-control" id="fr_telefono" name="fr_telefono" >
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_cellulare">Cellulare</label>
                                                <input type="text" class="form-control pattern_number" id="fr_cellulare" name="fr_cellulare" >
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_email">Email *</label>
                                                <input type="email" class="form-control" id="fr_email" name="fr_email" required>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia</label>
                                                <select class="form-control" id="provincia" name="fr_provincia" onchange="getCitta();">
                                                    <option value="">Seleziona una provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince("", "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Comune</label>
                                                <select class="form-control" id="citta" name="fr_comune">
                                                    <option value="">Seleziona un comune</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_indirizzo">Indirizzo</label>
                                                <input type="text" class="form-control" id="fr_indirizzo" name="fr_indirizzo">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_cap">CAP</label>
                                                <input type="text" class="form-control" id="fr_cap" name="fr_cap" autocomplete="off">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="fr_note">Note</label>
                                                <textarea class="form-control" id="fr_note" name="fr_note" rows="3"></textarea>
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