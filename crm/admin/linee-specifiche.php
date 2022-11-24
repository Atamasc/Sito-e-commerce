<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>
            .content-wrapper {

                margin-left: 0!important;

            }
        </style>

    </head>

    <?php
    $get_pr_codice_linea = isset($_GET['pr_codice_linea']) ? $_GET['pr_codice_linea'] : '';

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_codice_linea = '$get_pr_codice_linea'  ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();
    ?>

    <body>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php //include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php //include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="mb-2"> Linea: <?php echo $row_data['pr_codice_linea']; ?> / <?php echo $row_data['pr_descrizione_linea']; ?> (Marchio: <?php echo $row_data['pr_descrizione_marchio']; ?>)</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <?php
                                    $querySql_ln = "SELECT * FROM ln_linee WHERE ln_codice = '".$get_pr_codice_linea."' ";
                                    $result_ln = $dbConn->query($querySql_ln);
                                    $rows = $dbConn->affected_rows;
                                    $row_data_ln = $result_ln->fetch_assoc();

                                    $ln_id = $row_data_ln["ln_id"];
                                    $ln_banner = $row_data_ln["ln_banner"];
                                    $ln_banner_path = "$upload_path_dir_linee/$ln_banner";
                                    ?>

                                    <?php if ($rows > 0) { ?>
                                        <form method="post" action="linee-specifiche-mod-do.php" enctype="multipart/form-data">

                                            <div class="form-row">

                                                <div class="col-md-5 mb-3">
                                                    <label for="ln_descrizione">Descrizione</label>
                                                    <textarea class="form-control" id="ln_descrizione" name="ln_descrizione" rows="5" ><?php echo $row_data_ln['ln_descrizione']; ?></textarea>
                                                </div>

                                                <div class="col-md-5 mb-3">
                                                    <label for="ps_video">Video (Es: https://www.youtube.com/embed/XN2afyco1vU)</label>
                                                    <textarea class="form-control" id="ln_video" name="ln_video" rows="5" ><?php echo $row_data_ln['ln_video']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-5 mb-3">
                                                    <label>Banner</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="ln_banner" id="ln_banner" class="custom-file-input" data-max-width="870" data-max-height="500">

                                                        <?php if(strlen($ln_banner) > 0) { ?>
                                                            <label class="custom-file-label"><?php echo $ln_banner; ?></label>
                                                        <?php } else { ?>
                                                            <label class="custom-file-label">Scegli un file</label>
                                                        <?php } ?>
                                                    </div>
                                                    <small class="text-muted">
                                                        formato jpg, png - dimensioni 845 x 145 pixel - peso max 2 Mb
                                                        <?php if(strlen($ln_banner) > 0) { ?>
                                                            | <a class="text-success popover-img" href="<?php echo $ln_banner_path; ?>" target="_blank">vedi immagine</a>
                                                        <?php } ?>
                                                    </small>
                                                </div>

                                            </div>

                                            <input type="hidden" name="ln_codice" value="<?php echo $get_pr_codice_linea; ?>">
                                            <input type="hidden" name="ln_id" value="<?php echo $ln_id; ?>">
                                            <button class="btn btn-primary mt-2" type="submit">Modifica</button>

                                        </form>
                                    <?php } else { ?>
                                        <form method="post" action="linee-specifiche-add-do.php" enctype="multipart/form-data">

                                            <div class="form-row">

                                                <div class="col-md-5 mb-3">
                                                    <label for="ln_descrizione">Descrizione</label>
                                                    <textarea class="form-control" id="ln_descrizione" name="ln_descrizione" rows="5" ></textarea>
                                                </div>

                                                <div class="col-md-5 mb-3">
                                                    <label for="ln_video">Video (Es: https://www.youtube.com/embed/XN2afyco1vU)</label>
                                                    <textarea class="form-control" id="ln_video" name="ln_video" rows="5" ></textarea>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-5 mb-3">
                                                    <label>Banner</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="ln_banner" name="ln_banner"
                                                               data-max-width="870" data-max-height="500" >
                                                        <label class="custom-file-label" for="ln_banner">Seleziona immagine</label>
                                                    </div>
                                                    <span class="text-muted">formato jpg, png - dimensioni 845 x 145 pixel - peso max 2 Mb</span>
                                                </div>

                                            </div>

                                            <input type="hidden" name="ln_codice" value="<?php echo $get_pr_codice_linea; ?>">
                                            <button class="btn btn-primary mt-2" type="submit">Inserisci</button>

                                        </form>
                                    <?php }  ?>
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

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>