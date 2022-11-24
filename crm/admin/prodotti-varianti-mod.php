<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <?php
    $get_vr_id = isset($_GET['vr_id']) ? (int)$_GET['vr_id'] : 0;

    $querySql = "SELECT * FROM vr_varianti WHERE vr_id = '$get_vr_id' ";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();

    $get_pr_id = $row_data['vr_pr_id'];
    $vr_colore = $row_data['vr_colore'];
    $vr_misura = $row_data['vr_misura'];
    $vr_giacenza = $row_data['vr_giacenza'];
    $vr_immagine = $row_data['vr_immagine'];
    $vr_stato = $row_data['vr_stato'];

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
                                <h4 class="mb-0"> Modifica variante</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Gestione prodotti</a></li>
                                    <li class="breadcrumb-item active">Modifica variante</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php include "inc/dataview-prodotto.php"; ?>

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="prodotti-varianti-mod-do.php" enctype="multipart/form-data">

                                        <?php
                                        if(@$_GET['update'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Modifica avvenuta con successo.
                                            </div>
                                            <?php

                                        } else if(@$_GET['update'] == 'false') {

                                            ?>
                                            <div class="alert alert-danger" role="alert">
                                                Si è verificato un errore, riprova.
                                            </div>
                                            <?php

                                        }
                                        ?>

                                        <h6 class="card-title mt-3">Dettagli variante</h6>
                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="vr_codice">Codice *</label>
                                                <input type="text" class="form-control" id="vr_codice" name="vr_codice" value="<?php echo $row_data['vr_codice']; ?>" required>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="vr_colore">Colore *</label>
                                                <select class="form-control" id="vr_colore" name="vr_colore" required>
                                                    <option value="">Seleziona un colore</option>
                                                    <option value=""></option>
                                                    <?php selectColori($vr_colore, $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="vr_misura">Misura *</label>
                                                <select class="form-control" id="vr_misura" name="vr_misura" required>
                                                    <option value="">Seleziona una misura</option>
                                                    <option value=""></option>
                                                    <?php selectTaglie($vr_misura, $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="vr_giacenza">Giacenza *</label>
                                                <input type="text" class="form-control pattern-number" id="vr_giacenza" name="vr_giacenza"
                                                       value="<?php echo $vr_giacenza; ?>" required>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <p>Immagine</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="vr_immagine" name="vr_immagine">
                                                    <?php if (strlen($vr_immagine) > 0) { ?>

                                                        <label class="custom-file-label" for="vr_immagine"><?php echo $vr_immagine; ?></label>
                                                        <a class="modale-img" href="<?php echo "$upload_path_dir_prodotti/".$vr_immagine ?>">vedi immagine</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" data-href='prodotti-variante-immagine-del-do.php?vr_id=<?php echo $get_vr_id; ?>'>elimina</a>

                                                    <?php } else { ?>

                                                        <label class="custom-file-label" for="vr_immagine">Seleziona immagine</label>

                                                    <?php } ?>
                                                </div>
                                                <p>Dimensioni consigliate 1000x1000 / Formato .jpg o .png / Peso massimo 2 MB</p>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="vr_stato">Visibilità *</label>
                                                <select class="form-control" id="vr_stato" name="vr_stato" required>
                                                    <option value="">Seleziona visibilità</option>
                                                    <option value=""></option>
                                                    <option value="1" <?php if($vr_stato == '1') echo "selected"; ?>>Online</option>
                                                    <option value="0" <?php if($vr_stato == '0') echo "selected"; ?>>Offline</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="pr_id" value="<?php echo $get_pr_id; ?>">
                                        <input type="hidden" name="vr_id" value="<?php echo $get_vr_id; ?>">
                                        <button class="btn btn-primary mt-2" type="submit">Modifica</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <?php include "inc/datalist-varianti.php"; ?>

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