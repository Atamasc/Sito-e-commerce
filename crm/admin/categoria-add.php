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
                            <h4 class="mb-0"> Aggiungi categoria</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="prodotti-categorie-gst.php" class="default-color">Gestione categorie</a></li>
                                <li class="breadcrumb-item active">Aggiungi categoria</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="prodotti-categorie-add-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Aggiungi categoria</h5>

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Categoria inserita con successo.
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
                                            <label for="ct_codice">Codice *</label>
                                            <input type="text" class="form-control" id="ct_codice" name="ct_codice" placeholder="Codice *" required>
                                            <span class="tooltips">Codice Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Codice Categoria" data-content="Inserisci qui il codice della categoria che vuoi creare">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="ct_categoria">Titolo *</label>
                                            <input type="text" class="form-control" id="ct_categoria" name="ct_categoria" placeholder="Titolo *" required>
                                            <span class="tooltips">Titolo Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Categoria" data-content="Inserisci qui il titolo della categoria che vuoi creare">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3">
                                            <p>Immagine banner</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ct_immagine" name="ct_immagine">
                                                <label class="custom-file-label" for="ct_immagine">Seleziona immagine</label>
                                                <p class="tooltips">Dimensioni consigliate: <b>1052px larghezza</b> </p>

                                                <!--<span class="tooltips">Immagine Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Specifica immagine" data-content="Inserisci una immagine in formato jpg/png/gif di peso non superiore a 2MB e di dimensioni minime di 500x500 pixel e proporzioni consigliate 1:1 (quadrata). In questo modo sarà visibile al meglio su tutti i dispositivi">[aiuto]</a></span>-->
                                                <!--<span class="tooltips"><a style="color: blue; cursor: pointer;" role="button" data-toggle="modal" data-target=".bd-example-modal-lg-file" title="Tutorial per le immagini" >[guarda il tutorial]</a></span>--> <!-- data-target="modale-immagine" -->
                                                <?php include ("inc/modali.php");?>
                                            </div>
                                        </div>

                                        <!--<div class="col-md-3 mb-3">
                                            <p>Immagine 2</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ct_immagine_2" name="ct_immagine_2">
                                                <?php if (strlen($row_data['ct_immagine_2']) > 0) { ?>

                                                    <label class="custom-file-label" for="ct_immagine_2"><?php echo $row_data['ct_immagine_2']; ?></label>
                                                    <a class="modale-img" href="<?php echo "$upload_path_dir_categorie/".$row_data['ct_immagine_2'] ?>">vedi immagine</a>&nbsp;|&nbsp;
                                                    <a class="elimina" href="javascript:;" data-href='prodotti-cat-sot-immagine-del-do.php?ct_id=<?php echo $get_ct_id; ?>&st_id=0'>elimina</a>

                                                <?php } else { ?>

                                                    <label class="custom-file-label" for="ct_immagine_2">Seleziona immagine categoria</label>

                                                <?php } ?>
                                            </div>
                                            <span class="tooltips">Immagine Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Specifica immagine" data-content="Inserisci una immagine in formato jpg/png/gif di peso non superiore a 2MB e di dimensioni minime di 450x170 pixel e proporzioni consigliate 3:1 (rettangolare). In questo modo sarà visibile al meglio su tutti i dispositivi">[aiuto]</a></span>
                                            <?php include ("inc/modali.php");?>
                                        </div>-->

                                        <div class="col-md-1 mb-3">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Stato</label>
                                            <div class="checkbox checbox-switch switch-success">
                                                <label>
                                                    <input type="checkbox" class="stato" name="ct_stato" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                    <h5 class="card-title">Gestione Info SEO</h5>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="ct_title">Title</label>
                                            <textarea class="form-control" id="ct_title" name="ct_title" rows="3"></textarea>
                                            <span class="tooltips">Title Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Title Categoria" data-content="Inserisci qui il title della categoria per la parte SEO">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3">
                                            <p>Immagine Facebook 1200x628</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="ct_img_fb_1200_628" name="ct_img_fb_1200_628">
                                                <label class="custom-file-label" for="ct_img_fb_1200_628">Seleziona immagine</label>
                                                <p class="tooltips">Dimensioni consigliate: <b>1200x628</b> </p>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="ct_meta_keywords">META Keywords</label>
                                            <textarea class="form-control" id="ct_meta_keywords" name="ct_meta_keywords" rows="3"></textarea>
                                            <span class="tooltips">>META Keywords Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title=">META Keywords Categoria" data-content="Inserisci qui le keywords della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="ct_meta_desc">META Description </label>
                                            <textarea class="form-control" id="ct_meta_desc" name="ct_meta_desc" rows="3"></textarea>
                                            <span class="tooltips">META Description Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="META Description Categoria" data-content="Inserisci qui la description della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="ct_h1">Testo H1</label>
                                            <textarea class="form-control" id="ct_h1" name="ct_h1" rows="3"></textarea>
                                            <span class="tooltips">Testo H1 Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Testo H1 Categoria" data-content="Inserisci qui il testo h1 della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="ct_h2">Testo H2</label>
                                            <textarea class="form-control" id="ct_h2" name="ct_h2" rows="3"></textarea>
                                            <span class="tooltips">Testo H2 Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Testo H2 Categoria" data-content="Inserisci qui il testo h2 della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-8 mb-3">

                                            <label for="summernote">Descrizione</label>
                                            <textarea name="ct_descrizione" id="summernote" rows="20"></textarea>
                                            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>
                                            <span class="tooltips">Descrizione Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Categoria" data-content="Inserisci qui una descrizione della categoria che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Inserisci</button>
                                    <a href="prodotti-categorie-gst.php" class="btn btn-success">Modifica categoria</a>

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