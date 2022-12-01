<?php include "inc/autoloader.php"; ?>
<?php
$get_mr_id = isset($_GET['mr_id']) ? (int)$_GET['mr_id'] : 0;

$querySql = "SELECT * FROM mr_marche WHERE mr_id = '$get_mr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$mr_immagine = $row_data['mr_immagine'];
$mr_immagine_path = "$upload_path_dir_marche/$mr_immagine";
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
                                <h4 class="mb-0"> Modifica marca</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="marche-gst.php" class="default-color">Gestione marche</a></li>
                                    <li class="breadcrumb-item active">Modifica marca</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="post" action="marche-mod-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Modifica marca</h5>

                                        <?php include "../inc/alerts.php"; ?>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="mr_codice">Codice *</label>
                                                <input type="text" class="form-control" id="mr_codice" name="mr_codice"
                                                        value="<?php echo $row_data['mr_codice']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="mr_titolo">Titolo *</label>
                                                <input type="text" class="form-control" id="mr_titolo" name="mr_titolo"
                                                        value="<?php echo $row_data['mr_titolo']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label>Immagine</label>
                                                <div class="custom-file">
                                                    <input type="file" name="mr_immagine" id="mr_immagine" class="custom-file-input">

                                                    <?php if (strlen($mr_immagine) > 0) { ?>
                                                        <label class="custom-file-label"><?php echo $mr_immagine; ?></label>
                                                    <?php } else { ?>
                                                        <label class="custom-file-label">Scegli un file</label>
                                                    <?php } ?>
                                                </div>
                                                <small class="text-muted"> formato jpg, png - dimensioni 600 x 600 pixel - peso max 2 Mb
                                                    <?php if (strlen($mr_immagine) > 0) { ?>
                                                        <br>
                                                        <a class="text-success popover-img" target="_blank" href="<?php echo $mr_immagine_path; ?>">vedi immagine</a>
                                                    <?php } ?>
                                                </small>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="mr_descrizione">Descrizione</label>
                                                <textarea class="form-control" id="mr_descrizione" name="mr_descrizione" rows="3"><?php echo $row_data['mr_descrizione']; ?></textarea>
                                            </div>

                                        </div>

                                        <input type="hidden" name="mr_id" value="<?php echo $get_mr_id; ?>">
                                        <button class="btn btn-primary" type="submit">Modifica</button>
                                        <a href="marche-add.php" class="btn btn-success">Aggiungi marca</a>

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