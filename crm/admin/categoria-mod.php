<?php include "inc/autoloader.php"; ?>
<?php
$get_ct_id = isset($_GET['ct_id']) ? (int)$_GET['ct_id'] : 0;

$querySql = "SELECT * FROM ct_categorie WHERE ct_id = '$get_ct_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$checked = $row_data['ct_stato'] > 0 ? "checked" : "";

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
                                <h4 class="mb-0"> Modifica categoria</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="prodotti-categorie-gst.php" class="default-color">Gestione categorie</a>
                                    </li>
                                    <li class="breadcrumb-item active">Modifica categoria</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="post" action="prodotti-categorie-mod-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Modifica categoria</h5>

                                        <?php
                                        if (@$_GET['update'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Categoria modificata con successo.
                                            </div>
                                            <?php

                                        } else if (@$_GET['update'] == 'false') {

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
                                                <input type="text" class="form-control" id="ct_codice" name="ct_codice" placeholder="Codice *"
                                                        value="<?php echo $row_data['ct_codice']; ?>" required>
                                                <span class="tooltips">Codice Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Codice Categoria" data-content="Inserisci qui il codice della categoria che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ct_categoria">Titolo *</label>
                                                <input type="text" class="form-control" id="ct_categoria" name="ct_categoria" placeholder="Titolo *"
                                                        value="<?php echo $row_data['ct_categoria']; ?>" required>
                                                <span class="tooltips">Titolo Categoria <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Categoria" data-content="Inserisci qui il titolo della categoria che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <p>Immagine banner</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="ct_immagine" name="ct_immagine">
                                                    <?php if (strlen($row_data['ct_immagine']) > 0) { ?>

                                                        <label class="custom-file-label" for="ct_immagine"><?php echo $row_data['ct_immagine']; ?></label>
                                                        <a class="modale-img" href="<?php echo "$upload_path_dir_categorie/" . $row_data['ct_immagine'] ?>">vedi immagine</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" data-href='prodotti-cat-immagine-del-do.php?ct_id=<?php echo $get_ct_id; ?>&st_id=0ct_img_fb_1200_628=0'>elimina</a>

                                                    <?php } else { ?>

                                                        <label class="custom-file-label" for="ct_immagine">Seleziona immagine</label>

                                                    <?php } ?>
                                                </div>
                                                <p class="tooltips">Dimensioni consigliate: <b>1052px larghezza</b></p>
                                                <?php include("inc/modali.php"); ?>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Stato</label>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" name="ct_stato" <?php echo $checked; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span></span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-8 mb-3">

                                                <label for="summernote">Descrizione</label>
                                                <textarea name="ct_descrizione" id="summernote" rows="20"><?php echo @$row_data['ct_descrizione']; ?></textarea>
                                                <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>
                                                <span class="tooltips">Descrizione Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Categoria" data-content="Inserisci qui una descrizione della categoria che stai aggiungendo">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <input type="hidden" name="ct_id" value="<?php echo $get_ct_id; ?>">
                                        <button class="btn btn-primary" type="submit">Modifica</button>
                                        <a href="categoria-add.php" class="btn btn-success">Aggiungi categoria</a>

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