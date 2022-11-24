<?php include "inc/autoloader.php"; ?>
<?php
$get_si_id = isset($_GET['si_id']) ? (int)$_GET['si_id'] : 0;

$querySql = "SELECT * FROM si_sistemi WHERE si_id = '$get_si_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$si_immagine = $row_data['si_immagine'];
$si_banner = $row_data['si_banner'];
$si_immagine_path = "$upload_path_dir_sistemi/$si_immagine";
$si_banner_path = "$upload_path_dir_sistemi/$si_banner";
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
                            <h4 class="mb-0"> Modifica sistema</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="sistemi-gst.php" class="default-color">Gestione sistemi</a></li>
                                <li class="breadcrumb-item active">Modifica sistema</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="sistemi-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica sistema</h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="si_titolo">Codice *</label>
                                            <input type="text" class="form-control" id="si_codice" name="si_codice"
                                                   value="<?php echo $row_data['si_codice']; ?>" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="si_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="si_sistema" name="si_sistema"
                                                   value="<?php echo $row_data['si_sistema']; ?>" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>Immagine</label>
                                            <div class="custom-file">
                                                <input type="file" name="si_immagine" id="si_immagine" class="custom-file-input">

                                                <?php if(strlen($si_immagine) > 0) { ?>
                                                    <label class="custom-file-label"><?php echo $si_immagine; ?></label>
                                                <?php } else { ?>
                                                    <label class="custom-file-label">Scegli un file</label>
                                                <?php } ?>
                                            </div>
                                            <small class="text-muted">
                                                formato jpg, png - dimensioni 600 x 600 pixel - peso max 2 Mb
                                                <?php if(strlen($si_immagine) > 0) { ?>
                                                    <br><a class="text-success popover-img" target="_blank" href="<?php echo $si_immagine_path; ?>">vedi immagine</a>
                                                <?php } ?>
                                            </small>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label>Banner</label>
                                            <div class="custom-file">
                                                <input type="file" name="si_banner" id="si_banner" class="custom-file-input">

                                                <?php if(strlen($si_banner) > 0) { ?>
                                                    <label class="custom-file-label"><?php echo $si_banner; ?></label>
                                                <?php } else { ?>
                                                    <label class="custom-file-label">Scegli un file</label>
                                                <?php } ?>
                                            </div>
                                            <small class="text-muted">
                                                formato jpg, png - dimensioni 450 x 170 pixel - peso max 2 Mb
                                                <?php if(strlen($si_banner) > 0) { ?>
                                                    <br><a class="text-success popover-img" target="_blank" href="<?php echo $si_banner_path; ?>">vedi immagine</a>
                                                <?php } ?>
                                            </small>
                                        </div>

                                    </div>

                                    <h5 class="card-title">Gestione Info SEO</h5>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="si_title">Title</label>
                                            <textarea class="form-control" id="si_title" name="si_title" rows="3"><?php echo @$row_data['si_title']; ?></textarea>
                                            <span class="tooltips">Title Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Title Categoria" data-content="Inserisci qui il title della categoria per la parte SEO">[aiuto]</a></span>
                                        </div>

                                    </div>


                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="si_meta_keywords">META Keywords</label>
                                            <textarea class="form-control" id="si_meta_keywords" name="si_meta_keywords" rows="3"><?php echo @$row_data['si_meta_keywords']; ?></textarea>
                                            <span class="tooltips">>META Keywords Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title=">META Keywords Categoria" data-content="Inserisci qui le keywords della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="si_meta_desc">META Description </label>
                                            <textarea class="form-control" id="si_meta_desc" name="si_meta_desc" rows="3"><?php echo @$row_data['si_meta_desc']; ?></textarea>
                                            <span class="tooltips">META Description Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="META Description Categoria" data-content="Inserisci qui la description della categoria per la parte SEO">[aiuto]</a></span>

                                        </div>

                                        <div class="col-md-8 mb-3">

                                            <label for="summernote">Descrizione</label>
                                            <textarea name="si_descrizione" id="summernote" rows="20"><?php echo @$row_data['si_descrizione']; ?></textarea>
                                            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>
                                            <span class="tooltips">Descrizione Categoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Categoria" data-content="Inserisci qui una descrizione della categoria che stai aggiungendo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <input type="hidden" name="si_id" value="<?php echo $get_si_id; ?>">
                                    <button class="btn btn-primary" type="submit">Modifica</button>
                                    <a href="sistemi-add.php" class="btn btn-success">Aggiungi sistema</a>

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