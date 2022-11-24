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
                            <h4 class="mb-0"> Gestione newsletter </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="newsletter-gst.php" class="default-color">Gestione newsletter</a></li>
                                <li class="breadcrumb-item active">Inserimento newsletter immagine</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="post" action="newsletter-immagine-add-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Aggiungi newsletter in formato immagine</h5>

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Newsletter inserita con successo.
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

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="nl_titolo" name="nl_titolo" placeholder="Titolo *"
                                                   required>
                                            <span class="tooltips">Titolo Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Newsletter" data-content="Inserisci qui il titolo della newsletter che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_ns_id">Lista *</label>
                                            <select class="form-control" id="nl_ns_id" name="nl_ns_id" required>
                                                <option value="">Seleziona una lista</option>
                                                <option value=""></option>
                                                <?php selectListeEmail("", $dbConn) ?>
                                            </select>
                                            <span class="tooltips">Lista Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Lista Newsletter" data-content="Inserisci qui la lista della newsletter che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_oggetto">Oggetto *</label>
                                            <input type="text" class="form-control" id="nl_oggetto" name="nl_oggetto" placeholder="Oggetto *"
                                                   required>
                                            <span class="tooltips">Oggetto Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Oggetto Newsletter" data-content="Inserisci qui l'oggetto della newsletter che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_mittente">Mittente *</label>
                                            <input type="text" class="form-control" id="nl_mittente" name="nl_mittente" placeholder="Mittente *"
                                                   required>
                                            <span class="tooltips">Mittente Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Mittente Newsletter" data-content="Specifica qui il mittente della newsletter che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">

                                            <label for="nl_descrizione">Descrizione</label>
                                            <textarea class="form-control" name="nl_descrizione" id="nl_descrizione" rows="2"></textarea>
                                            <span class="tooltips">Descrizione Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Newsletter" data-content="Inserisci qui un descrizione della newsletter che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">

                                            <label for="summernote">Testo della mail *</label>
                                            <textarea name="nl_testo" id="summernote" required></textarea>
                                            <span class="tooltips">Testo Newsletter <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Testo Newsletter" data-content="Inserisci qui il testo della newsletter che stai aggiungendo">[aiuto]</a></span>
                                            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>

                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <p>Immagine</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="nl_immagine" name="nl_immagine">
                                                <label class="custom-file-label" for="nl_immagine">Seleziona immagine</label>
                                                <p class="tooltips">Dimensioni consigliate: 1200 x 628*<br> Peso max: 2 MB*<br> Formato file: jpg, jpeg, gif, png<br> Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare <a class="popup-a" href="https://www.iloveimg.com/it/ritagliare-immagine" target="_blank">questo tool*</a></p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="nl_link">Link immagine</label>
                                            <input type="url" class="form-control" id="nl_link" name="nl_link" placeholder="Link">
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <p>Allegato 1</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="nl_allegato" name="nl_allegato">
                                                <label class="custom-file-label" for="nl_allegato">Seleziona allegato</label>
                                                <p style="margin-top: 20px;">Peso max: 2 MB*<br>Formato file: zip, pdf, doc, docx, xls, xlsx, xml, txt, csv</p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <p>Allegato 2</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="nl_allegato_2" name="nl_allegato_2">
                                                <label class="custom-file-label" for="nl_allegato_2">Seleziona allegato</label>
                                                <p style="margin-top: 20px;">Peso max: 2 MB*<br>Formato file: zip, pdf, doc, docx, xls, xlsx, xml, txt, csv</p>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Inserisci</button>

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