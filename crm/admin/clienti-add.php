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
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione clienti</a></li>
                                    <li class="breadcrumb-item active">Aggiungi cliente</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="clienti-add-do.php">

                                        <?php
                                        if(@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Cliente inserito con successo.
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

                                        <h6 class="card-title">Dati anagrafici</h6>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_nome">Codice *</label>
                                                <input type="text" class="form-control" id="cl_codice" name="cl_codice" placeholder="Codice *"
                                                       value="<?php echo time(); ?>" required>
                                                <span class="tooltips">Codice Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Cliente" data-content="Qui è mostrato il codice del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_nome">Nome *</label>
                                                <input type="text" class="form-control" id="cl_nome" name="cl_nome" placeholder="Nome *" required>
                                                <span class="tooltips">Nome Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Cliente" data-content="Inserisci qui il nome del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_cognome">Cognome *</label>
                                                <input type="text" class="form-control" id="cl_cognome" name="cl_cognome" placeholder="Cognome *" required>
                                                <span class="tooltips">Cognome Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Cliente" data-content="Inserisci qui il cognome del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_codice_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="cl_codice_fiscale" name="cl_codice_fiscale" placeholder="Codice fiscale">
                                                <span class="tooltips">Codice Fiscale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Fiscale Cliente" data-content="Inserisci qui il codice fiscale del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_provincia">Provincia</label>
                                                <input type="text" class="form-control" id="cl_provincia" name="cl_provincia" placeholder="Provincia">
                                                <!--<select class="form-control" id="cl_provincia" name="cl_provincia" onchange="getCitta();">
                                                    <option value="">Seleziona una provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince("", "", $dbConn); ?>
                                                </select>-->
                                                <span class="tooltips">Provincia Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Provincia Cliente" data-content="Inserisci qui la provincia del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_citta">Città</label>
                                                <input type="text" class="form-control" id="cl_citta" name="cl_citta" placeholder="Città">

                                                <!--<select class="form-control" id="citta" name="cl_citta">
                                                    <option value="">Seleziona una citta'</option>
                                                    <option value=""></option>
                                                </select>-->
                                                <span class="tooltips">Citt&agrave; Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Citt&agrave; Cliente" data-content="Inserisci qui la citt&agrave; del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_indirizzo">Indirizzo</label>
                                                <input type="text" class="form-control" id="cl_indirizzo" name="cl_indirizzo" placeholder="Indirizzo">
                                                <span class="tooltips">Indirizzo Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Cliente" data-content="Inserisci qui l'indirizzo del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label for="cl_cap">CAP</label>
                                                <input type="text" class="form-control" id="cl_cap" name="cl_cap" placeholder="CAP" autocomplete="off">
                                                <span class="tooltips">C.A.P. Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="C.A.P. Cliente" data-content="Inserisci qui il C.A.P. (Codice Avviamento Postale) del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <h6 class="card-title mt-3">Campi Business</h6>
                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_ragione_sociale">Ragione Sociale</label>
                                                <input class="form-control" id="cl_ragione_sociale" name="cl_ragione_sociale">
                                                <span class="tooltips">Ragione Sociale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ragione Sociale Cliente" data-content="Inserisci qui la ragione sociale del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="cl_partita_iva" name="cl_partita_iva" placeholder="Partita IVA">
                                                <span class="tooltips">Partita Iva Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Partita Iva Cliente" data-content="Inserisci qui la Partita Iva del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_telefono_aziendale">Telefono aziendale</label>
                                                <input type="text" class="form-control" id="cl_telefono_aziendale" name="cl_telefono_aziendale">
                                                <span class="tooltips">Telefono Aziendale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Telefono Aziendale Cliente" data-content="Inserisci qui il numero di telefono aziendale del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_sdi">SDI</label>
                                                <input type="text" class="form-control" id="cl_sdi" name="cl_sdi">
                                                <span class="tooltips">SDI Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="SDI Cliente" data-content="Inserisci qui il codice SDI del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_pec">Email PEC</label>
                                                <input type="text" class="form-control" id="cl_pec" name="cl_pec">
                                                <span class="tooltips">Email PEC Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Email PEC Cliente" data-content="Inserisci qui l'email PEC del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_provincia_fatturazione">Provincia fatturazione</label>
                                                <input type="text" class="form-control" id="cl_provincia_fatturazione" name="cl_provincia_fatturazione">

                                                <!--<select class="form-control" id="cl_provincia_fatturazione" name="cl_provincia_fatturazione" onchange="getCitta2();">
                                                    <option value="">Seleziona una provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince("", "", $dbConn); ?>
                                                </select>-->
                                                <span class="tooltips">Provincia Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Provincia Fatturazione Cliente" data-content="Inserisci qui la provincia di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_citta_fatturazione">Città fatturazione</label>
                                                <input type="text" class="form-control" id="cl_citta_fatturazione" name="cl_citta_fatturazione">

                                                <!--<select class="form-control" id="cl_citta_fatturazione" name="cl_citta_fatturazione">
                                                    <option value="">Seleziona una citta'</option>
                                                    <option value=""></option>
                                                </select>-->
                                                <span class="tooltips">Ragione Sociale Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ragione Sociale Cliente" data-content="Inserisci qui la citt&agrave; di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_indirizzo_fatturazione">Indirizzo fatturazione</label>
                                                <input type="text" class="form-control" id="cl_indirizzo_fatturazione" name="cl_indirizzo_fatturazione" placeholder="Indirizzo">
                                                <span class="tooltips">Indirizzo Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Indirizzo Fatturazione Cliente" data-content="Inserisci qui l'indirizzo di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label for="cl_cap_fatturazione">CAP fatturazione</label>
                                                <input type="text" class="form-control" id="cl_cap_fatturazione" name="cl_cap_fatturazione" placeholder="CAP" autocomplete="off">
                                                <span class="tooltips">C.A.P. Fatturazione Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="C.A.P. Fatturazione Cliente" data-content="Inserisci qui il C.A.P. di fatturazione del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <h6 class="card-title mt-3">Contatti e altro</h6>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_tel">Telefono</label>
                                                <input type="text" class="form-control" id="cl_tel" name="cl_tel" placeholder="Telefono">
                                                <span class="tooltips">Telefono Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Telefono Cliente" data-content="Inserisci qui il numero di telefono del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-2 mb-3">
                                                <label for="cl_fax">Fax</label>
                                                <input type="text" class="form-control" id="cl_fax" name="cl_fax" placeholder="Fax">
                                                <span class="tooltips">Fax Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Fax Cliente" data-content="Inserisci qui il numero di fax del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                           <!-- <div class="col-md-2 mb-3">
                                                <label for="cl_tipo">Tipo *</label>
                                                <select class="form-control" id="cl_tipo" name="cl_tipo" required>
                                                    <option value="">Seleziona un tipo</option>
                                                    <option value=""></option>
                                                    <option value="Rivenditore">Rivenditore</option>
                                                    <option value="Cliente" selected>Cliente</option>
                                                </select>
                                                <span class="tooltips">Tipo Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Tipo Cliente" data-content="Inserisci qui la tipologia del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>-->

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_email">Email *</label>
                                                <input type="email" class="form-control" id="cl_email" name="cl_email" placeholder="Email *" required>
                                                <span class="tooltips">E-mail Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="E-mail Cliente" data-content="Inserisci qui l'indirizzo e-mail del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_password">Password</label>
                                                <input type="text" class="form-control" id="cl_password" name="cl_password" placeholder="Password">
                                                <span class="tooltips">Password Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Password Cliente" data-content="Inserisci qui la password di accesso del cliente che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="cl_note">Note</label>
                                                <textarea class="form-control" id="cl_note" name="cl_note" placeholder="Note" rows="3"></textarea>
                                            </div>

                                        </div>

                                        <!--   <div class="form-group">

                                               <div class="custom-control custom-checkbox">
                                                   <input class="custom-control-input" type="checkbox" id="cl_newsletter" name="cl_newsletter">
                                                   <label class="custom-control-label" for="cl_newsletter">Newsletter</label>
                                               </div>

                                           </div>

                                       <!--<h6 class="card-title">Tessera Ethos</h6>

                                           <div class="form-row">

                                               <div class="col-md-3 mb-3">
                                                   <label for="cl_codice_tessera">Codice tessera</label>
                                                   <input type="text" class="form-control" id="cl_codice_tessera" name="cl_codice_tessera" placeholder="Codice tessera">
                                                   <span class="tooltips">Numero Tessera Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Numero Tessera Cliente" data-content="Inserisci qui il numero di tessera Ethos del cliente che stai aggiungendo">[aiuto]</a></span>
                                               </div>

                                               <div class="col-md-3 mb-3">
                                                   <label for="cl_attivazione_tessera">Data attivazione tessera</label>
                                                   <input type="text" class="form-control date-picker-default" id="cl_attivazione_tessera" name="cl_attivazione_tessera"
                                                          placeholder="Data attivazione tessera">
                                                   <span class="tooltips">Data Attivazione Tessera Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Data Attivazione Tessera Cliente" data-content="Inserisci qui la data di attivazione della tessera Ethos del cliente che stai aggiungendo">[aiuto]</a></span>
                                               </div>

                                               <div class="col-md-3 mb-3">
                                                   <label for="cl_saldo_punti">Saldo punti</label>
                                                   <input type="text" class="form-control pattern-number" id="cl_saldo_punti" name="cl_saldo_punti" placeholder="Saldo punti">
                                                   <span class="tooltips">Saldo Punti Tessera Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Saldo Punti Tessera Cliente" data-content="Inserisci qui il saldo dei punti sulla tessera del cliente che stai aggiungendo">[aiuto]</a></span>
                                               </div>

                                               <div class="col-md-3 mb-3">
                                                   <label for="cl_stato_tessera">Stato tessera</label>
                                                   <select class="form-control" id="cl_stato_tessera" name="cl_stato_tessera">
                                                       <option value="">Seleziona lo stato</option>
                                                       <option value=""></option>
                                                       <option value="1">Attiva</option>
                                                       <option value="0">Non attiva</option>
                                                   </select>
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