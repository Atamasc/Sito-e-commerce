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
                                <h4 class="mb-0"> Aggiungi cliente</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="utenti-gst.php" class="default-color">Gestione clienti</a></li>
                                    <li class="breadcrumb-item active">Aggiungi cliente</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="utenti-add-do.php">

                                        <?php
                                        if (@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Utente inserito con successo.
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

                                        <h6 class="card-title">Dati anagrafici</h6>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_nome">Codice *</label>
                                                <input type="text" class="form-control" id="ut_codice" name="ut_codice" placeholder="Codice *"
                                                        value="<?php echo time(); ?>" required> <span class="tooltips">Codice Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Utente" data-content="Qui è mostrato il codice dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_nome">Nome *</label>
                                                <input type="text" class="form-control" id="ut_nome" name="ut_nome" placeholder="Nome *" required>
                                                <span class="tooltips">Nome Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Utente" data-content="Inserisci qui il nome dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_cognome">Cognome *</label>
                                                <input type="text" class="form-control" id="ut_cognome" name="ut_cognome" placeholder="Cognome *" required>
                                                <span class="tooltips">Cognome Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Utente" data-content="Inserisci qui il cognome dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_provincia">Provincia</label>
                                                <input type="text" class="form-control" id="ut_provincia" name="ut_provincia" placeholder="Provincia">
                                                <span class="tooltips">Provincia Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Provincia Utente" data-content="Inserisci qui la provincia dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_citta">Città</label>
                                                <input type="text" class="form-control" id="ut_citta" name="ut_citta" placeholder="Città">
                                                <span class="tooltips">Citt&agrave; Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Citt&agrave; Utente" data-content="Inserisci qui la citt&agrave; dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_indirizzo">Indirizzo</label>
                                                <input type="text" class="form-control" id="ut_indirizzo" name="ut_indirizzo" placeholder="Indirizzo">
                                                <span class="tooltips">Indirizzo Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Utente" data-content="Inserisci qui l'indirizzo dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label for="ut_cap">CAP</label>
                                                <input type="text" class="form-control" id="ut_cap" name="ut_cap" placeholder="CAP" autocomplete="off">
                                                <span class="tooltips">C.A.P. Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="C.A.P. Utente" data-content="Inserisci qui il C.A.P. (Codice Avviamento Postale) dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <h6 class="card-title mt-3">Contatti e altro</h6>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_email">Email *</label>
                                                <input type="email" class="form-control" id="ut_email" name="ut_email" placeholder="Email *" required>
                                                <span class="tooltips">E-mail Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="E-mail Utente" data-content="Inserisci qui l'indirizzo e-mail dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_password">Password</label>
                                                <input type="text" class="form-control" id="ut_password" name="ut_password" placeholder="Password">
                                                <span class="tooltips">Password Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Password Utente" data-content="Inserisci qui la password di accesso dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_telefono">Telefono</label>
                                                <input type="text" class="form-control" id="ut_telefono" name="ut_telefono" placeholder="Telefono">
                                                <span class="tooltips">Telefono Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Telefono Utente" data-content="Inserisci qui il numero di telefono dell'utente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="ut_note">Note</label>
                                                <textarea class="form-control" id="ut_note" name="ut_note" placeholder="Note" rows="3"></textarea>
                                            </div>

                                        </div>

                                        <!--   <div class="form-group">

                                               <div class="custom-control custom-checkbox">
                                                   <input class="custom-control-input" type="checkbox" id="ut_newsletter" name="ut_newsletter">
                                                   <label class="custom-control-label" for="ut_newsletter">Newsletter</label>
                                               </div>

                                           </div>-->


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