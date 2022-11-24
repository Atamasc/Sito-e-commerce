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
                            <h4 class="mb-0"> Aggiungi sistema</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="sistemi-gestione.php" class="default-color">Gestione sistemi</a></li>
                                <li class="breadcrumb-item active">Aggiungi sistema</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="sistemi-add-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Aggiungi sistema</h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pc_titolo">Codice *</label>
                                            <input type="text" class="form-control" id="si_codice" name="si_codice"
                                                   required>
                                            <span class="tooltips">Codice Marchio <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Marchio" data-content="Inserisci qui il codice del sistema che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pc_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="si_sistema" name="si_sistema"
                                                   required>
                                            <span class="tooltips">Nome Marchio <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Marchio" data-content="Inserisci qui il nome del sistema che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>Immagine</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="si_immagine" name="si_immagine"> <!-- data-max-width="870" data-max-height="500"  -->
                                                <label class="custom-file-label" for="si_immagine">Seleziona immagine</label>
                                            </div>
                                            <p class="tooltips">Dimensioni consentite: <b>600 x 600 px</b> </p>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>Banner</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="si_banner" name="si_banner"> <!-- data-max-width="870" data-max-height="500"  -->
                                                <label class="custom-file-label" for="si_banner">Seleziona immagine</label>
                                            </div>
                                            <p class="tooltips">Dimensioni consentite: <b>450 x 170 px</b> </p>
                                        </div>

                                    </div>

                                    <h5 class="card-title">Gestione Info SEO</h5>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="si_title">Title</label>
                                            <textarea class="form-control" id="si_title" name="si_title" rows="3"></textarea>
                                            <span class="tooltips">Title Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Title Categoria" data-content="Inserisci qui il title della categoria per la parte SEO">[aiuto]</a></span>
                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="si_meta_keywords">META Keywords</label>
                                            <textarea class="form-control" id="si_meta_keywords" name="si_meta_keywords" rows="3"></textarea>
                                            <span class="tooltips">>META Keywords Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title=">META Keywords Categoria" data-content="Inserisci qui le keywords della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="si_meta_desc">META Description </label>
                                            <textarea class="form-control" id="si_meta_desc" name="si_meta_desc" rows="3"></textarea>
                                            <span class="tooltips">META Description Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="META Description Categoria" data-content="Inserisci qui la description della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-8 mb-3">

                                            <label for="summernote">Descrizione</label>
                                            <textarea name="si_descrizione" id="summernote" rows="20"></textarea>
                                            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>
                                            <span class="tooltips">Descrizione Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Categoria" data-content="Inserisci qui una descrizione della categoria che stai aggiungendo">[aiuto]</a></span>
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