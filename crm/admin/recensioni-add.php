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
                                <h4 class="mb-0"> Aggiungi recensione</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="recensioni-gst.php" class="default-color">Gestione recensioni</a></li>
                                    <li class="breadcrumb-item active">Aggiungi recensione</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <h6 class="card-title">Dati Recensione</h6>
                                    <form method="post" action="recensioni-add-do.php" enctype="multipart/form-data">

                                        <?php
                                        if(@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Recensione inserita con successo.
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



                                       <!-- <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="rc_titolo">Titolo *</label>
                                                <input type="text" class="form-control" id="rc_titolo" name="rc_titolo" placeholder="Titolo *" required>
                                                <span class="tooltips">Titolo Lavorazione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Lavorazione" data-content="Qui viene mostrato il titolo della recensione che vuoi aggiungere">[aiuto]</a></span>
                                            </div>

                                        </div>-->



                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="rc_ut_codice">Cliente *</label>

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ut_nome" value="<?php  @$row_data['ut_nome']; ?>"  readonly required>

                                                    <input type="hidden" id="ut_codice" name="rc_ut_codice" value="<?php  @$row_data['rc_ut_codice']; ?>" >
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="recensioni-clienti-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Cliente Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Cliente Recensione" data-content="Associa qui il nome del cliente a cui è riferita la recensione">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-3 mb-3">
                                                <label for="rc_pr_id">Prodotto *</label>

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="pr_titolo" value="<?php  @$row_data['pr_titolo']; ?>"  readonly required>

                                                    <input type="hidden" id="pr_id" name="rc_pr_id" value="<?php  @$row_data['rc_pr_id']; ?>" >
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="recensioni-prodotti-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Prodotto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prodotto Recensione" data-content="Associa qui il titolo del prodotto a cui è riferita la recensione">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="rc_voto">Voto *</label>
                                                <select class="form-control" id="rc_voto" name="rc_voto" required>
                                                    <option value="">Seleziona un voto</option>
                                                    <option value=""></option>
                                                    <option value="1">1 stella</option>
                                                    <option value="2">2 stelle</option>
                                                    <option value="3">3 stelle</option>
                                                    <option value="4">4 stelle</option>
                                                    <option value="5">5 stelle</option>
                                                </select>
                                                <span class="tooltips">Voto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Voto Recensione" data-content="Seleziona il voto della recensione">[aiuto]</a></span>
                                            </div>

                                            </div>


                                        <div class="form-row">

                                            <div class="col-md-5 mb-3">
                                                <label for="rc_descrizione">Descrizione</label>
                                                <textarea class="form-control" id="rc_descrizione" name="rc_descrizione" rows="10" placeholder="Descrizione"></textarea>
                                                <span class="tooltips">Descrizione Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Recensione" data-content="Inserisci qui la descrizione della recensione che vuoi aggiungere">[aiuto]</a></span>
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