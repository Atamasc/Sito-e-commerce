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
                            <h4 class="mb-0"> Gestione Importazioni </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione importazioni</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Importazioni</h5>

                                <?php
                                if(@$_GET['delete'] == 'true') {

                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        Eliminazione avvenuta con successo.
                                    </div>
                                    <?php

                                }
                                ?>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th class="text-center" width="200">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>Importa clienti</td>
                                            <td class="text-center">
                                                <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/import-clienti-add-do.php'> <!-- alert-link -->
                                                    <i class="fa fa-sync"></i>sincronizza
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Importa fornitori</td>
                                            <td class="text-center">
                                                <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/import-fornitori-add-do.php'> <!-- alert-link -->
                                                    <i class="fa fa-sync"></i>sincronizza
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Importa prodotti</td>
                                            <td class="text-center">
                                                <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/import-prodotti-add-do.php'> <!-- alert-link -->
                                                    <i class="fa fa-sync"></i>sincronizza
                                                </button>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

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