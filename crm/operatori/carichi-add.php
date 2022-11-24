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
                                <h4 class="mb-0"> Aggiungi carico</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione carichi</a></li>
                                    <li class="breadcrumb-item active">Aggiungi carico</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="carichi-add-do.php" enctype="multipart/form-data">

                                        <?php
                                        if(@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Carico inserito con successo.
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

                                        <h6 class="card-title">Dati carico</h6>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="fr_ragione_sociale">Fornitore *</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="fr_ragione_sociale" value="<?php echo @$row_data['fr_ragione_sociale']; ?>" required readonly>
                                                    <input type="hidden" id="fr_id" name="cr_fr_id" value="<?php echo @$row_data['cr_fr_id']; ?>" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="carichi-fornitori-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="cr_codice">Codice *</label>
                                                <input type="text" class="form-control" id="cr_codice" name="cr_codice" value="<?php echo time(); ?>" required>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Allegato</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="cr_allegato" name="cr_allegato">
                                                    <label class="custom-file-label" for="cr_allegato"><i class="far fa-file-alt"></i> Seleziona allegato</label>
                                                    <p>Peso max: 2 MB - Formato file: pdf, csv, doc</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="cr_note">Note</label>
                                                <textarea class="form-control" id="cr_note" name="cr_note" rows="3"></textarea>
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