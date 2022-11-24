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
                                    <li class="breadcrumb-item active">Modifica newsletter immagine</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <?php
                                    $get_nl_id = isset($_GET["nl_id"]) ? (int)$_GET["nl_id"] : 0;

                                    $querySql = "SELECT * FROM nl_newsletter WHERE nl_id = $get_nl_id ";
                                    $result = $dbConn->query($querySql);
                                    $row_data = $result->fetch_assoc();

                                    $nl_id = $row_data["nl_id"];

                                    $result->close();
                                    ?>

                                    <form method="post" action="newsletter-immagine-mod-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Modifica newsletter in formato immagine</h5>

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
                                                       required value="<?php echo $row_data['nl_titolo']; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="nl_ns_id">Lista *</label>
                                                <select class="form-control" id="nl_ns_id" name="nl_ns_id" required>
                                                    <option value="">Seleziona una lista</option>
                                                    <option value=""></option>
                                                    <?php selectListeEmail($row_data['nl_ns_id'], $dbConn) ?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="nl_oggetto">Oggetto *</label>
                                                <input type="text" class="form-control" id="nl_oggetto" name="nl_oggetto" placeholder="Oggetto *"
                                                       required value="<?php echo $row_data['nl_oggetto']; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="nl_mittente">Mittente *</label>
                                                <input type="text" class="form-control" id="nl_mittente" name="nl_mittente" placeholder="Mittente *"
                                                       required value="<?php echo $row_data['nl_mittente']; ?>">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">

                                                <label for="nl_descrizione">Descrizione</label>
                                                <textarea class="form-control" name="nl_descrizione" id="nl_descrizione" rows="2"><?php echo $row_data['nl_descrizione']; ?></textarea>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">

                                                <label for="summernote">Testo della mail *</label>
                                                <textarea name="nl_testo" id="summernote" required><?php echo $row_data['nl_testo']; ?></textarea>
                                                <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <p>Immagine</p>

                                                <div class="custom-file">

                                                    <input type="file" class="custom-file-input" id="nl_immagine" name="nl_immagine">
                                                    <?php if (strlen($row_data['nl_immagine']) > 0) { ?>
                                                        <label class="custom-file-label" for="nl_immagine"><?php echo $row_data['nl_immagine']; ?></label><br>
                                                        <a class="modale-img" href="<?php echo "$upload_path_dir_newsletter/".$row_data['nl_immagine']; ?>" target="_blank">vedi immagine</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" title='newsletter-immagine-file-del-do.php?nl_id=<?php echo $get_nl_id; ?>&file=nl_immagine'>elimina</a>
                                                    <?php } else {
                                                        ?><label class="custom-file-label" for="nl_immagine">Seleziona immagine</label><?php
                                                    } ?>
                                                    <p style="margin-top: 10px;">Dimensioni consigliate: 1200 x 628*<br> Peso max: 2 MB*<br> Formato file: jpg, jpeg, gif, png<br> Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare<a href="https://www.iloveimg.com/it/ritagliare-immagine" target="_blank" style="color: #28a745; text-decoration: underline;"> questo tool*</a></p>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="nl_link">Link immagine</label>
                                                <input type="url" class="form-control" id="nl_link" name="nl_link" placeholder="Link"
                                                       value="<?php echo $row_data['nl_link']; ?>">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <p>Allegato 1</p>

                                                <div class="custom-file">

                                                    <input type="file" class="custom-file-input" id="nl_allegato" name="nl_allegato">
                                                    <?php if (strlen($row_data['nl_allegato']) > 0) { ?>
                                                        <label class="custom-file-label" for="nl_allegato"><?php echo $row_data['nl_allegato']; ?></label><br>
                                                        <a href="<?php echo "$upload_path_dir_newsletter/".$row_data['nl_allegato']; ?>" target="_blank">vedi allegato</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" title='newsletter-immagine-file-del-do.php?nl_id=<?php echo $get_nl_id; ?>&file=nl_allegato'>elimina</a>
                                                    <?php } else {
                                                        ?><label class="custom-file-label" for="nl_allegato">Seleziona allegato</label><?php
                                                    } ?>
                                                    <p style="margin-top: 20px;">Peso max: 2 MB*<br>Formato file: zip, pdf, doc, docx, xls, xlsx, xml, txt, csv</p>
                                                </div>

                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <p>Allegato 2</p>

                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="nl_allegato_2" name="nl_allegato_2">
                                                    <?php if (strlen($row_data['nl_allegato_2']) > 0) { ?>
                                                        <label class="custom-file-label" for="nl_allegato_2"><?php echo $row_data['nl_allegato_2']; ?></label><br>
                                                        <a href="<?php echo "$upload_path_dir_newsletter/".$row_data['nl_allegato_2']; ?>" target="_blank">vedi allegato</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" title='newsletter-immagine-file-del-do.php?nl_id=<?php echo $get_nl_id; ?>&file=nl_allegato_2'>elimina</a>
                                                    <?php } else {
                                                        ?><label class="custom-file-label" for="nl_allegato_2">Seleziona allegato</label><?php
                                                    } ?>
                                                    <p style="margin-top: 20px;">Peso max: 2 MB*<br>Formato file: zip, pdf, doc, docx, xls, xlsx, xml, txt, csv</p>
                                                </div>

                                            </div>

                                        </div>

                                        <input type="hidden" name="nl_id" value="<?php echo $get_nl_id; ?>">
                                        <button class="btn btn-success" type="submit">Modifica</button>

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