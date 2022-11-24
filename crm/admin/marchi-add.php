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
                            <h4 class="mb-0"> Aggiungi marchio</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="marchi-gestione.php" class="default-color">Gestione marchi</a></li>
                                <li class="breadcrumb-item active">Aggiungi marchio</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="marchi-add-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Aggiungi marchio</h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pc_titolo">Codice *</label>
                                            <input type="text" class="form-control" id="mr_codice" name="mr_codice"
                                                   required>
                                            <span class="tooltips">Codice Marchio <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Marchio" data-content="Inserisci qui il codice del marchio che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pc_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="mr_marchio" name="mr_marchio"
                                                   required>
                                            <span class="tooltips">Nome Marchio <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Marchio" data-content="Inserisci qui il nome del marchio che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>Immagine</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="mr_immagine" name="mr_immagine"> <!-- data-max-width="870" data-max-height="500"  -->
                                                <label class="custom-file-label" for="mr_immagine">Seleziona immagine</label>
                                            </div>
                                            <p class="tooltips">Dimensioni consentite: <b>600 x 600 px</b> </p>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="mr_descrizione">Descrizione</label>
                                            <textarea class="form-control" id="mr_descrizione" name="mr_descrizione" rows="3"></textarea>
                                            <span class="tooltips">Descrizione Marchio <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Marchio" data-content="Inserisci qui una descrizione del marchio che stai aggiungendo">[aiuto]</a></span>
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