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
                            <h4 class="mb-0"> Aggiungi numero</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="beauty-gst.php" class="default-color">Gestione beauty assistant</a></li>
                                <li class="breadcrumb-item active">Aggiungi numero</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="beauty-add-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Aggiungi numero</h5>

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Numero inserito con successo.
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

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="ba_numero">Numero *</label>
                                            <input type="text" class="form-control" id="ba_numero" name="ba_numero" required>
                                            <span class="tooltips">Password Cliente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Password Cliente" data-content="Inserisci qui la password del cliente che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="ba_orari">Orari</label>
                                            <textarea class="form-control" id="ba_orari" name="ba_orari" rows="2"></textarea>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Inserisci</button>
                                    <a href="beauty-gst.php" class="btn btn-success">Modifica numeri</a>

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