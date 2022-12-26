<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <?php
    $get_pr_id = isset($_GET['pr_id']) ? (int)$_GET['pr_id'] : 0;

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$get_pr_id'  ";
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
                                <h4 class="mb-0"> Modifica prodotto</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item">
                                        <a href="prodotti-gst.php" class="default-color">Gestione prodotti</a></li>
                                    <li class="breadcrumb-item active">Modifica prodotti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="prodotti-mod-do.php" enctype="multipart/form-data">

                                        <?php
                                        if (@$_GET['update'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Modifica avvenuta con successo.
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

                                        <?php
                                        if (@$_GET['insert'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                Il tuo prodotto è stato correttamente inserito,
                                                <a href="prodotti-copy-do.php?pr_id=<?php echo $get_pr_id; ?>" style="font-weight: bold;">clicca qui</a> per inserire una variante partendo da questo prodotto.
                                            </div>
                                            <?php

                                        }

                                        if (@$_GET['copy'] == 'true') {

                                            ?>
                                            <div class="alert alert-success" role="alert">
                                                La variante è stata correttamente creata ed impostata in modalità offline. Ora puoi modificarla.
                                            </div>
                                            <?php

                                        }
                                        ?>

                                        <h6 class="card-title mt-3">Identificazione</h6>
                                        <div class="row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice">Codice </label>
                                                <input type="text" class="form-control" id="pr_codice" name="pr_codice" value="<?php echo $row_data['pr_codice']; ?>">
                                                <span class="tooltips">Codice Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Codice Prodotto" data-content="Questo codice viene generato automaticamente">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_titolo">Titolo *</label>
                                                <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" value="<?php echo $row_data['pr_titolo']; ?>" required>
                                                <span class="tooltips">Titolo Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Prodotto" data-content="Inserisci qui il titolo del prodotto che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_ct_id">Categoria *</label>
                                                <select class="form-control ajax-select" id="pr_ct_id" name="pr_ct_id" data-href="../ajax/select-sottocategorie.php?ct_id=" data-target="#pr_st_id" required>
                                                    <option value="">Seleziona una categoria</option>
                                                    <option value=""></option>
                                                    <?php selectCategorieProdotti($row_data['pr_ct_id'], $dbConn); ?>
                                                </select>
                                                <span class="tooltips">Categoria Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Categoria Prodotto" data-content="Inserisci qui la categoria del prodotto che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_mr_id">Marca *</label>
                                                <select class="form-control" id="pr_mr_id" name="pr_mr_id" required>
                                                    <option value="">Seleziona una marca</option>
                                                    <option value=""></option>
                                                    <?php selectMarca($row_data['pr_mr_id']); ?>
                                                </select>
                                                <span class="tooltips">Marca Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Marca Prodotto" data-content="Inserisci qui la marca del prodotto che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <h6 class="card-title mt-3">Dettagli Di Acquisto/Vendita</h6>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo">Prezzo &euro; (Es formato: 5,70 ) *</label>
                                                <input type="text" class="form-control" id="pr_prezzo" name="pr_prezzo" value="<?php echo strlen(@$row_data['pr_prezzo']) > 0 ? formatPrice(@$row_data['pr_prezzo']) : ""; ?>" required>
                                                <span class="tooltips">Prezzo Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Prodotto" data-content="Inserisci qui il prezzo di vendita del prodotto visibile online compreso di iva">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo_scontato">Prezzo scontato &euro; (Es formato: 5,70 )</label>
                                                <input type="text" class="form-control" id="pr_prezzo_scontato" name="pr_prezzo_scontato" value="<?php echo @$row_data['pr_prezzo_scontato'] > 0 ? formatPrice(@$row_data['pr_prezzo_scontato']) : ""; ?>">
                                                <span class="tooltips">Prezzo Prodotto Scontato <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Prodotto Scontato" data-content="Inserisci qui il prezzo di vendita scontato del prodotto visibile online compreso di iva">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_sconto">Sconto (%)</label>
                                                <input type="text" class="form-control" id="pr_sconto" name="pr_sconto" value="<?php echo @$row_data['pr_sconto']; ?>">
                                                <span class="tooltips">Sconto Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Sconto Prodotto" data-content="Inserisci qui la percentuale di sconto visibile online che vuoi applicare sul prodotto">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <h6 class="card-title mt-3">Caratteristiche fisiche</h6>

                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_peso">Peso Kg (Es formato: 5.70 )</label>
                                                <input type="text" class="form-control" id="pr_peso" name="pr_peso" placeholder="Solo numeri e punti (vedi formato)" value="<?php echo @$row_data['pr_peso'] > 0 ? formatPrice(@$row_data['pr_peso']) : ""; ?>">
                                                <span class="tooltips">Peso Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Peso Prodotto" data-content="Inserisci qui il peso del prodotto">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_giacenza">Giacenza totale *</label>
                                                <input type="text" class="form-control" id="pr_giacenza" name="pr_giacenza" value="<?php echo $row_data['pr_giacenza']; ?>" required>
                                                <span class="tooltips">Giacenza Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Giacenza Prodotto" data-content="Inserisci qui il numero di pezzi rimasti in magazzino del prodotto">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pr_abstract">Abstract</label>
                                                <textarea class="form-control" id="pr_abstract" name="pr_abstract" rows="2"><?php echo $row_data['pr_abstract']; ?></textarea>
                                                <span class="tooltips">Descrizione breve Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione breve Prodotto" data-content="Inserisci qui una descrizione breve del prodotto che vuoi modificare">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-7 mb-3">
                                                <label for="summernote">Descrizione</label>
                                                <textarea class="form-control" id="summernote" name="pr_descrizione" rows="3"><?php echo $row_data['pr_descrizione']; ?></textarea>
                                                <span class="tooltips">Descrizione Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Prodotto" data-content="Inserisci qui la descrizione del prodotto che vuoi modificare">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3 mb-3">
                                                <p>Immagine</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="pr_immagine" name="pr_immagine">
                                                    <?php if (strlen($row_data['pr_immagine']) > 0) { ?>

                                                        <label class="custom-file-label" for="pr_immagine"><?php echo $row_data['pr_immagine']; ?></label>
                                                        <a class="modale-img" href="<?php echo "$upload_path_dir_prodotti/" . $row_data['pr_immagine'] ?>">vedi immagine</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" data-href='prodotti-immagine-del-do.php?pr_id=<?php echo $get_pr_id; ?>'>elimina</a>

                                                    <?php } else { ?>

                                                        <label class="custom-file-label" for="pr_immagine">Seleziona immagine</label>

                                                    <?php } ?>
                                                </div>
                                                <p class="tooltips">Dimensioni consigliate: 1000x1000
                                                </p>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <p>Allegato</p>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="pr_allegato" name="pr_allegato">
                                                    <?php if (strlen($row_data['pr_allegato']) > 0) { ?>

                                                        <label class="custom-file-label" for="pr_allegato"><?php echo $row_data['pr_allegato']; ?></label>
                                                        <a target="_blank" href="<?php echo "$upload_path_dir_prodotti/" . $row_data['pr_allegato'] ?>">vedi allegato</a>&nbsp;|&nbsp;
                                                        <a class="elimina" href="javascript:;" data-href='prodotti-allegato-del-do.php?pr_id=<?php echo $get_pr_id; ?>'>elimina</a>

                                                    <?php } else { ?>

                                                        <label class="custom-file-label" for="pr_allegato">Seleziona allegato</label>

                                                    <?php } ?>
                                                </div>
                                                <p>Peso massimo 2 MB</p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="pr_note">Note</label>
                                                <textarea class="form-control" id="pr_note" name="pr_note" rows="3"><?php echo $row_data['pr_note']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-bottom: 10px">
                                            <div class="checkbox checbox-switch switch-success" style="padding-left: 15px">
                                                <label style="margin-top: 35px;">
                                                    <input type="checkbox" class="stato" name="pr_stato" <?php if ($row_data['pr_stato'] == 1) echo "checked"; ?> >
                                                    <span></span>&nbsp;Visibilità</label>
                                            </div>

                                            <div class="checkbox checbox-switch switch-success" style="padding-left: 15px">
                                                <label style="margin-top: 35px;">
                                                    <input type="checkbox" class="stato" name="best_seller" <?php if ($row_data['pr_best_seller'] == 1) echo "checked"; ?> >
                                                    <span></span>&nbsp;BestSeller</label>
                                            </div>
                                        </div>


                                        <input type="hidden" name="pr_id" value="<?php echo $get_pr_id; ?>">
                                        <button class="btn btn-primary mt-2" type="submit">Modifica</button>

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

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function (arg) {
            return function (elem) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>