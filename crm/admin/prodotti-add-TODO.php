<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

    </head>

    <?php
    $pr_ct_id = @$_GET["pr_ct_id"];
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
                                <h4 class="mb-0"> Aggiungi prodotto</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Elenco prodotti</a></li>
                                    <li class="breadcrumb-item active">Aggiungi prodotto</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <form method="post" action="prodotti-add-do.php" enctype="multipart/form-data">

                            <?php
                            if(@$_GET['insert'] == 'true') {

                                ?>
                                <div class="alert alert-success" role="alert">
                                    Aggiunta avvenuta con successo.
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

                            <div class="col-xl-9 mb-30 fl">
                                <div id="CB1" class="card-body">

                                    <h6 class="card-title mt-3">Identificazione</h6>

                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pr_ct_id">Categoria *</label>
                                            <select class="form-control ajax-select" id="pr_ct_id" name="pr_ct_id" data-href="../ajax/select-sottocategorie.php?ct_id=" data-target="#pr_st_id" required>
                                                <option value="">Seleziona una categoria</option>
                                                <option value=""></option>
                                                <?php selectCategorieProdotti($pr_ct_id, $dbConn); ?>
                                            </select>
                                            <span class="tooltips">Inserisci qui la categoria del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Categoria Prodotto" data-content="Assegna una categoria al tuo prodotto. Una categoria appropriata facilita l'inserimento e la ricerca del prodotto. Es. Neonato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_st_id">Sottocategoria *</label>
                                            <select class="form-control" id="pr_st_id" name="pr_st_id" required>
                                                <option value="">Seleziona prima una categoria</option>
                                                <option value=""></option>
                                                <?php //selectCategorieProdotti($pr_ct_id, $dbConn); ?>
                                            </select>
                                            <span class="tooltips">Inserisci qui la sottocategoria del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Sottocategoria prodotto" data-content="Assegna una categoria pi&ugrave; specifica al tuo prodotto. Una sottocategoria appropriata facilita l'inserimento e la ricerca del prodotto. Es. Cappellini">[aiuto]</a></span>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" required>
                                            <span class="tooltips">Inserisci qui il titolo del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Titolo prodotto" data-content="Assegna un nome(o titolo) specifico e facile da ricordare al tuo prodotto. Un titolo appropriato facilita l'inserimento e la ricerca del prodotto oltre a incrementarne le possibilità di vendita Es. Cappellino Rosa Neonato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-1 mb-3">
                                            <label for="pr_codice">Codice *</label>
                                            <input type="text" class="form-control" id="pr_codice" name="pr_codice" required>
                                            <span class="tooltips">Inserisci qui il codice inventario del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Codice Inventario" data-content="Quando si inserisce un prodotto nell'inventario questo riceve un codice identificativo usa quello.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_codice_ean">Codice EAN </label>
                                            <input type="text" class="form-control" id="pr_codice_ean" name="pr_codice_ean" >
                                            <span class="tooltips">Inserisci qui il codice EAN del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Codice EAN" data-content="Sul prodotto è presente un codice a barre. oltre alle consuete linee nere verticali è presente un codice formto da numeri, quello è definito codice EAN. Inseriscilo qui per identificarlo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_colore">Colore *</label>
                                            <select class="form-control" id="pr_colore" name="pr_colore" required>
                                                <option value="">Seleziona un colore</option>
                                                <option value=""></option>
                                                <?php selectColori("", $dbConn); ?>
                                            </select>
                                            <span class="tooltips">Inserisci qui il colore del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Colore prodotto" data-content="In questo cmpo va specificato il colore del prodotto. Nel caso un prodotto possiede più di un colore, solitamente si utilizza il predominante, cioè quello più riconoscibile. In alternativa, se il prodotto di una collezione si diversifica per un determinato colore, può essere specificato anche quello.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_misura">Misura</label>
                                            <select class="form-control" id="pr_misura" name="pr_misura">
                                                <option value="">Seleziona una misura</option>
                                                <option value=""></option>
                                                <?php selectTaglie("", $dbConn); ?>
                                            </select>
                                            <span class="tooltips">Inserisci qui la taglia del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Taglia prodotto" data-content="Qui va specificata la taglia del prodotto.">[aiuto]</a></span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-3 mb-30 fl">

                                <div id="CB2" class="card-body">

                                    <h5 class="card-title">Giacenza Misure</h5>
                                    <div id="accordion">
                                                    <div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    Bambino
                                                                </button>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body">

                                                                <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" required>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingTwo">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Neonato
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" id="headingThree">
                                                            <h5 class="mb-0">
                                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Adulto
                                                                </button>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-xl-12 mb-30">
                                <div id="CB3" class="card-body">

                                    <h6 class="card-title mt-3">Dettagli di acquisto/vendita</h6>

                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label for="pr_prezzo">Prezzo &euro; (Es formato: 5.70 ) *</label>
                                            <input type="text" class="form-control" id="pr_prezzo" name="pr_prezzo" required>
                                            <span class="tooltips">Inserisci qui il prezzo del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Prodotto" data-content="Indica qui la cifra necessaria per comprare il prodotto. ">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_prezzo_scontato">Prezzo scontato &euro; (Es formato: 5.70 )</label>
                                            <input type="text" class="form-control" id="pr_prezzo_scontato" name="pr_prezzo_scontato" >
                                            <span class="tooltips">Inserisci qui il prezzo scontato del tuo prodotto <a tabindex="0" class="popup-a"" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Scontato Prodotto" data-content="Indica qui la cifra necessaria per comprare il prodotto, in questo campo andrà inserito il prezzo già scontato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_sconto">Sconto (%)</label>
                                            <input type="text" class="form-control" id="pr_sconto" name="pr_sconto" >
                                            <span class="tooltips">Inserisci qui la percentuale dello sconto che intendi applicare <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Sconto sul Prodotto" data-content="Indica qui quanto sconto vuoi applicare al prodotto,">[aiuto]</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 mb-30">

                                <div id="CB3" class="card-body">

                                    <h6 class="card-title mt-3">Caratteristiche fisiche</h6>

                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_peso">Peso kg (Es formato: 5.70 ) </label>
                                            <input type="text" class="form-control" id="pr_peso" name="pr_peso" >
                                            <span class="tooltips">Inserisci qui il peso del tuo prodotto<a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Peso Prodotto" data-content="Indica qui il peso del tuo prodotto.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_giacenza">Giacenza totale</label>
                                            <input type="text" class="form-control" id="pr_giacenza" name="pr_giacenza">
                                            <span class="tooltips">Inserisci qui quanti pezzi restano in magazzino del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Giacenza Prodotto" data-content="Indica qui la quantità di pezzi presenti in magazzino del prodotto.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_colli">Quantita per colli</label>
                                            <input type="text" class="form-control" id="pr_colli" name="pr_colli" >
                                            <span class="tooltips">Quantit&agrave; Colli Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Quantit&agrave; Colli Prodotto" data-content="Inserisci qui il numero di pezzi in ogni collo, cioè in ogni scatolo in arrivo dalla fabbrica, del prodotto che vuoi aggiungere">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="pr_materiale">Materiale</label>
                                            <input type="text" class="form-control" id="pr_materiale" name="pr_materiale" >
                                            <span class="tooltips">Inserisci qui il materiale del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Materiale Prodotto" data-content="Indica qui il materiale di fabricazione del tuo prodotto. Es. Cotone, Lino, Acrilico ecc.">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-8 mb-3">
                                            <label for="summernote">Descrizione</label>
                                            <textarea class="form-control" id="summernote" name="pr_descrizione" rows="10"></textarea>
                                            <span class="tooltips">Inserisci qui il prezzo scontato del tuo prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Prodotto" data-content="Scrivi una piccola descrizione del prodotto, Il colore, il modello, eventuali dettagli di colorazione o di stampa ecc. Più la descrizione è dettagliata maggiori saranno le probabilità di interessare il cliente">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <p>Immagine</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pr_immagine" name="pr_immagine">
                                                <label class="custom-file-label" for="pr_immagine">Seleziona immagine</label>
                                            </div>
                                            <a class="popup-a" data-toggle="modal" data-target="#modale-immagine">aiuto</a>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <p>Allegato</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pr_allegato" name="pr_allegato">
                                                <label class="custom-file-label" for="pr_allegato">Seleziona allegato</label>
                                            </div>
                                            <p>Peso massimo 2 MB</p>
                                            <a class="popup-a" data-toggle="modal" data-target="#modale-allegato">aiuto</a>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_note">Note</label>
                                            <textarea class="form-control" id="pr_note" name="pr_note" rows="3"></textarea>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xl-12 mb-30">
                                <div id="CB3" class="card-body">

                                    <button class="btn btn-primary" type="submit">Inserisci</button>

                                </div>
                            </div>

                        </form>

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


    <?php include "inc/modali.php"; ?>


    </html>
<?php include "../inc/db-close.php"; ?>