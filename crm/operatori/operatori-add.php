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
                                <h4 class="mb-0"> Aggiungi operatore</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="operatori-gst.php" class="default-color">Gestione operatori</a></li>
                                    <li class="breadcrumb-item active">Aggiungi operatore</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="operatori-add-do.php">

                                        <?php include "../inc/alerts.php"; ?>

                                        <h6 class="card-title">Dati operatore</h6>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="op_nome">Nome *</label>
                                                <input type="text" class="form-control" id="op_nome" name="op_nome" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_cognome">Cognome *</label>
                                                <input type="text" class="form-control" id="op_cognome" name="op_cognome" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="op_codice">Codice/Username *</label>
                                                <input type="text" class="form-control" id="op_codice" name="op_codice" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_password">Password *</label>
                                                <input type="text" class="form-control" id="op_password" name="op_password" required>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="op_telefono">Telefono</label>
                                                <input type="text" class="form-control" id="op_telefono" name="op_telefono">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_email">Email</label>
                                                <input type="email" class="form-control" id="op_email" name="op_email">
                                            </div>

                                        </div>

                                        <h6 class="card-title mt-3">Altro</h6>
                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="op_note">Note</label>
                                                <textarea class="form-control" id="op_note" name="op_note" rows="3"></textarea>
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