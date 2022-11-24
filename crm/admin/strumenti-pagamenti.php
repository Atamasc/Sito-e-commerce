<?php include "inc/autoloader.php"; ?>

<?php
function pageGetDato($dp_nome) {

    global $dbConn;

    $querySql = "SELECT dp_valore FROM dp_dati_pagamenti WHERE dp_nome = '$dp_nome' ";
    $result = $dbConn->query($querySql);
    $dp_valore = $result->fetch_array()[0];
    $result->close();

    return $dp_valore;

}
?>
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
                                <h4 class="mb-0"> Gestione dati pagamenti </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Modifica dati pagamenti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Modifica avvenuta com successo.
                                        </div>
                                        <?php

                                    }

                                    if(@$_GET['update'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Si &egrave; verificato un errore. Riprova!
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <form method="post" action="strumenti-pagamenti-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Modifica dati PayPal</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="dp_array[email_paypal]">Email Paypal *</label>
                                                <input type="text" class="form-control" id="dp_array[email_paypal]" name="dp_array[email_paypal]"
                                                       value="<?php echo pageGetDato("email_paypal"); ?>" required>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="dp_array">Percentuale di ricarico *</label>
                                                <input type="text" class="form-control" id="dp_array[perc_paypal]" name="dp_array[perc_paypal]"
                                                       value="<?php echo pageGetDato("perc_paypal"); ?>" required>
                                            </div>

                                        </div>

                                        <h5 class="card-title">Modifica dati contrassegno</h5>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="dp_array">Costo in euro di ricarico *</label>
                                                <input type="text" class="form-control" id="dp_array[costo_contrassegno]" name="dp_array[costo_contrassegno]"
                                                       value="<?php echo pageGetDato("costo_contrassegno"); ?>" required>
                                            </div>

                                        </div>

                                        <h5 class="card-title">Modifica dati bonifico</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="dp_array[int_bonifico]">Intestatario conto *</label>
                                                <input type="text" class="form-control" id="dp_array[int_conto]" name="dp_array[int_conto]"
                                                       value="<?php echo pageGetDato("int_conto"); ?>" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dp_array[banca_bonifico]">Banca</label>
                                                <input type="text" class="form-control" id="dp_array[banca_bonifico]" name="dp_array[banca_bonifico]"
                                                       value="<?php echo pageGetDato("banca_bonifico"); ?>">
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dp_array[iban_bonifico]">Iban *</label>
                                                <input type="text" class="form-control" id="dp_array[iban_bonifico]" name="dp_array[iban_bonifico]"
                                                       value="<?php echo pageGetDato("iban_bonifico"); ?>" required>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="dp_array[bic_bonifico]">Bic/swift</label>
                                                <input type="text" class="form-control" id="dp_array[bic_bonifico]" name="dp_array[bic_bonifico]"
                                                       value="<?php echo pageGetDato("bic_bonifico"); ?>">
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="dp_array">Percentuale di ricarico *</label>
                                                <input type="text" class="form-control" id="dp_array[perc_bonifico]" name="dp_array[perc_bonifico]"
                                                       value="<?php echo pageGetDato("perc_bonifico"); ?>" required>
                                            </div>

                                        </div>

                                        <hr>

                                        <button class="btn btn-success" type="submit">Modifica</button>

                                    </form>

                                </div>
                            </div>

                        </div>


                    </div>

                    <?php include "inc/footer.php"; ?>

                    <!--=================================
                     footer -->
                </div>
            </div>
        </div>
    </div>

    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>