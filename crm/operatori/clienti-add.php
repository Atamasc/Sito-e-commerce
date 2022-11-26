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
                                        <a href="clienti-gst.php" class="default-color">Gestione clienti</a></li>
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
                                        if (@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Cliente inserito con successo.
                                            </div>
                                            <?php

                                        } else if (@$_GET['insert'] == 'false') {

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
                                                <label for="ut_codice">Codice *</label>
                                                <input type="text" class="form-control" id="ut_codice" name="ut_codice"
                                                        value="<?php echo time(); ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_nome">Nome *</label>
                                                <input type="text" class="form-control" id="ut_nome" name="ut_nome" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cognome">Cognome *</label>
                                                <input type="text" class="form-control" id="ut_cognome" name="ut_cognome" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_ragione_sociale">Ragione sociale *</label>
                                                <input type="text" class="form-control" id="ut_ragione_sociale" name="ut_ragione_sociale" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cod_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="ut_cod_fiscale" name="ut_cod_fiscale">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="ut_partita_iva" name="ut_partita_iva">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_sdi">SDI</label>
                                                <input type="text" class="form-control" id="ut_sdi" name="ut_sdi">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_telefono">Telefono</label>
                                                <input type="text" class="form-control" id="ut_telefono" name="ut_telefono">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cellulare">Cellulare</label>
                                                <input type="text" class="form-control pattern_number" id="ut_cellulare" name="ut_cellulare">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_email">Email *</label>
                                                <input type="email" class="form-control" id="ut_email" name="ut_email" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_pec">Email PEC</label>
                                                <input type="email" class="form-control" id="ut_pec" name="ut_pec">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia</label>
                                                <select class="form-control" id="provincia" name="ut_provincia" onchange="getCitta();">
                                                    <option value="">Seleziona una provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince("", "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Comune</label>
                                                <select class="form-control" id="citta" name="ut_citta">
                                                    <option value="">Seleziona un comune</option>
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_indirizzo">Indirizzo</label>
                                                <input type="text" class="form-control" id="ut_indirizzo" name="ut_indirizzo">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cap">CAP</label>
                                                <input type="text" class="form-control" id="ut_cap" name="ut_cap" placeholder="CAP" autocomplete="off">
                                            </div>

                                        </div>

                                        <!--
                                        <h6 class="card-title mt-3">Dati d'accesso</h6>
                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_email">Email *</label>
                                                <input type="email" class="form-control" id="ut_email" name="ut_email" placeholder="Email *" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_password">Password *</label>
                                                <input type="text" class="form-control" id="ut_password" name="ut_password" placeholder="Password *" required>
                                            </div>
                                        </div>
                                        -->

                                        <h6 class="card-title mt-3">Altro</h6>
                                        <!--
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="cc_ct_id">Categoria</label>
                                                <select class="form-control" id="cc_ct_id" name="cc_ct_id">
                                                    <option value="">Seleziona una categorie</option>
                                                    <option value=""></option>
                                                    <?php //selectClientiCategorie(""); ?>
                                                </select>
                                            </div>
                                        </div>
                                        -->

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="ut_note">Note</label>
                                                <textarea class="form-control" id="ut_note" name="ut_note" rows="3"></textarea>
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