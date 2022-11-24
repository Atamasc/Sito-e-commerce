<?php include "inc/autoloader.php"; ?>

<?php
$get_cl_id = (int)$_GET['cl_id'];

$querySql = "SELECT * FROM cl_clienti WHERE cl_id = $get_cl_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
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
                            <h4 class="mb-0"> Scheda cliente </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione clienti</a></li>
                                <li class="breadcrumb-item active">Scheda cliente</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100" id="scheda">
                                <div class="card-body">

                                    <h6 class="card-title mb-0 border-0">Dati di base</h6>
                                    <div class="row">

                                        <div class="col-md-6 mb-2">
                                            <b>Nome e Cognome: </b>&nbsp;
                                            <?php echo $row_data['cl_nome'].' '.$row_data['cl_cognome']; ?>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <b>Telefono: </b>&nbsp;
                                            <?php echo $row_data['cl_tel']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Indirizzo: </b>&nbsp;
                                            <?php echo $row_data['cl_indirizzo'].', '.
                                                $row_data['cl_cap'].', '.
                                                $row_data['cl_citta'].' ('.
                                                $row_data['cl_provincia'].')';
                                            ?>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <b>Cellulare: </b>&nbsp;
                                            <?php echo $row_data['cl_cell']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Codice fiscale: </b>&nbsp;
                                            <?php echo $row_data['cl_codice_fiscale']; ?>
                                        </div>

                                        <div class="col-md-4 mb-2">
                                            <b>Fax: </b>&nbsp;
                                            <?php echo $row_data['cl_fax']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Email: </b>&nbsp;
                                            <?php echo $row_data['cl_email']; ?>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <b>Password: </b>&nbsp;
                                            <?php echo $row_data['cl_password']; ?>
                                        </div>

                                    </div>

                                    <?php if($row_data['cl_tipo'] == 'Rivenditore' || $row_data['cl_business'] > 0) { ?>
                                        <h6 class="card-title mb-0 my-3 border-0">Dati aziendali</h6>
                                        <div class="row">

                                            <div class="col-md-6 mb-2">
                                                <b>Ragione sociale: </b>&nbsp;
                                                <?php echo $row_data['cl_ragione_sociale']; ?>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <b>Partita IVA: </b>&nbsp;
                                                <?php echo $row_data['cl_partita_iva']; ?>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <b>Telefono aziendale: </b>&nbsp;
                                                <?php echo $row_data['cl_telefono_aziendale']; ?>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <b>Indirizzo aziendale: </b>&nbsp;
                                                <?php echo $row_data['cl_indirizzo_fatturazione'].', '.
                                                    $row_data['cl_cap_fatturazione'].', '.
                                                    $row_data['cl_citta'].' ('.
                                                    $row_data['cl_provincia_fatturazione'].')';
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <a href="javascript:PrintElem('scheda');" class="btn btn-primary btn-sm">Stampa</a>
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
