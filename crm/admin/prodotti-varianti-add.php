<?php include "inc/autoloader.php"; ?>
<?php
$get_pr_id = isset($_GET['pr_id']) ? (int)$_GET['pr_id'] : 0;

$querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$get_pr_id'  ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <script src="../ajax/regioni.js"></script>

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
                            <h4 class="mb-0"> Inserisci variante </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Elenco prodotti</a></li>
                                <li class="breadcrumb-item active">Aggiungi variante</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <?php include "inc/dataview-prodotto.php"; ?>

                    <div class="col-xl-12 mb-10">
                        <div class="card card-statistics mb-30">
                            <div class="card-body">
                                <form method="post" action="prodotti-varianti-add-do.php" enctype="multipart/form-data">

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Variante aggiunta con successo.
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
                                    <h6 class="card-title mt-3">Inserisci variante</h6>
                                    <div class="row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" value="<?php echo $row_data['pr_titolo']; ?>" required>
                                            <span class="tooltips">Inserisci qui il titolo del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Titolo prodotto" data-content="Assegna un nome(o titolo) specifico e facile da ricordare al tuo prodotto. Un titolo appropriato facilita l'inserimento e la ricerca del prodotto oltre a incrementarne le possibilità di vendita Es. Cappellino Rosa Neonato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_ct_id">Categoria *</label>
                                            <select class="form-control ajax-select" id="pr_ct_id"
                                                    data-href="../ajax/select-sottocategorie.php?ct_id=" data-target="#pr_st_id"
                                                    required disabled>
                                                <option value="">Seleziona una categoria</option>
                                                <option value=""></option>
                                                <?php selectCategorieProdotti($row_data['pr_ct_id'], $dbConn); ?>
                                            </select>
                                            <input type="hidden" name="pr_ct_id" value="<?php echo $row_data['pr_ct_id']; ?>">
                                            <span class="tooltips">Inserisci qui la categoria del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Categoria Prodotto" data-content="Assegna una categoria al tuo prodotto. Una categoria appropriata facilita l'inserimento e la ricerca del prodotto. Es. Neonato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_st_id">Sottocategoria</label>
                                            <select class="form-control" id="pr_st_id" disabled>
                                                <option value="">Seleziona una sottocategoria</option>
                                                <option value=""></option>
                                                <?php selectSottocategorieProdotti($row_data['pr_st_id'], $dbConn, $row_data['pr_ct_id']); ?>
                                            </select>
                                            <input type="hidden" name="pr_st_id" value="<?php echo $row_data['pr_st_id']; ?>">
                                            <span class="tooltips">Inserisci qui la sottocategoria del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Sottocategoria prodotto" data-content="Assegna una categoria pi&ugrave; specifica al tuo prodotto. Una sottocategoria appropriata facilita l'inserimento e la ricerca del prodotto. Es. Cappellini">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_mr_id">Marchio *</label>
                                            <select class="form-control" id="pr_mr_id" name="pr_mr_id" required disabled>
                                                <option value="">Seleziona un marchio</option>
                                                <option value=""></option>
                                                <?php selectMarchio($row_data['pr_mr_id']); ?>
                                            </select>
                                            <input type="hidden" name="pr_mr_id" value="<?php echo $row_data['pr_mr_id']; ?>">
                                            <span class="tooltips">Inserisci qui il marchio del prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Marchio Prodotto" data-content="Inserisci qui il marchio del prodotto che vuoi modificare">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_codice_rif">Codice Riferimento </label>
                                            <input type="text" class="form-control" id="pr_codice_rif" name="pr_codice_rif" value="<?php echo $row_data['pr_codice_rif']; ?>" readonly>
                                            <span class="tooltips">Inserisci qui il codice di riferimento dell'articolo associato al prodotto da magazzino <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Codice Riferimento" data-content="In questo campo devi inserire il codice associato all'articolo da magazzino giacenza">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_codice_ean">Codice EAN </label>
                                            <input type="text" class="form-control" id="pr_codice_ean" name="pr_codice_ean" value="<?php echo $row_data['pr_codice_ean']; ?>">
                                            <span class="tooltips">Inserisci qui il codice EAN del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Codice EAN" data-content="Sul prodotto è presente un codice a barre. oltre alle consuete linee nere verticali è presente un codice formto da numeri, quello è definito codice EAN. Inseriscilo qui per identificarlo">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <h6 class="card-title mt-3">Dettagli di acquisto/vendita</h6>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pr_prezzo">Prezzo &euro; (Es formato: 5.70 ) *</label>
                                            <input type="text" class="form-control" id="pr_prezzo" name="pr_prezzo" value="<?php echo formatPrice($row_data['pr_prezzo']); ?>" required>
                                            <span class="tooltips">Inserisci qui il prezzo del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Prodotto" data-content="Indica qui la cifra necessaria per comprare il prodotto. ">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_prezzo_scontato">Prezzo scontato &euro; (Es formato: 5.70 )</label>
                                            <input type="text" class="form-control" id="pr_prezzo_scontato" name="pr_prezzo_scontato" value="<?php echo formatPrice($row_data['pr_prezzo_scontato']); ?>">
                                            <span class="tooltips">Inserisci qui il prezzo scontato del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Prezzo Scontato Prodotto" data-content="Indica qui la cifra necessaria per comprare il prodotto, in questo campo andrà inserito il prezzo già scontato">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_sconto">Sconto (%)</label>
                                            <input type="text" class="form-control" id="pr_sconto" name="pr_sconto" value="<?php echo $row_data['pr_sconto']; ?>">
                                            <span class="tooltips">Inserisci qui la percentuale dello sconto che intendi applicare <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Sconto sul Prodotto" data-content="Indica qui quanto sconto vuoi applicare al prodotto,">[aiuto]</a></span>
                                        </div>
                                    </div>

                                    <h6 class="card-title mt-3">Caratteristiche fisiche</h6>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="pr_peso">Peso kg (Es formato: 5.70 ) </label>
                                            <input type="text" class="form-control" id="pr_peso" name="pr_peso" value="<?php echo $row_data['pr_peso']; ?>">
                                            <span class="tooltips">Inserisci qui il peso del tuo prodotto<a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Peso Prodotto" data-content="Indica qui il peso del tuo prodotto.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_giacenza">Giacenza totale *</label>
                                            <input type="text" class="form-control" id="pr_giacenza" name="pr_giacenza" required>
                                            <span class="tooltips">Inserisci qui quanti pezzi restano in magazzino del tuo prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Giacenza Prodotto" data-content="Indica qui la quantità di pezzi presenti in magazzino del prodotto.">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_si_id">Sistema</label>
                                            <select class="form-control" id="pr_si_id" disabled>
                                                <option value="">Seleziona un'opzione</option>
                                                <option value=""></option>
                                                <?php selectSistema($row_data['pr_si_id']); ?>
                                            </select>
                                            <input type="hidden" name="pr_si_id" value="<?php echo $row_data['pr_si_id']; ?>">
                                            <span class="tooltips">Sistema Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Sistema Prodotto" data-content="Inserisci qui il sistema del prodotto che vuoi modificare">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_formato">Formato</label>
                                            <input type="text" class="form-control" id="pr_formato" name="pr_formato">
                                            <span class="tooltips">Formato Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Formato Prodotto" data-content="Inserisci qui il formato del prodotto che vuoi modificare">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="pr_abstract">Abstract</label>
                                            <textarea class="form-control" id="pr_abstract" name="pr_abstract" rows="2"><?php echo $row_data['pr_abstract']; ?></textarea>
                                            <span class="tooltips">Descrizione breve Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione breve Prodotto" data-content="Inserisci qui una descrizione breve del prodotto che vuoi modificare">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="summernote">Descrizione</label>
                                            <textarea class="form-control" id="summernote" name="pr_descrizione" rows="3"><?php echo $row_data['pr_descrizione']; ?></textarea>
                                            <span class="tooltips">Descrizione Prodotto <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Prodotto" data-content="Inserisci qui la descrizione del prodotto che vuoi modificare">[aiuto]</a></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <p>Immagine</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pr_immagine" name="pr_immagine">
                                                <label class="custom-file-label" for="pr_immagine">Seleziona immagine</label>
                                                <span class="tooltips">Inserisci qui l'immagine del prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Specifica immagine" data-content="Inserisci una immagine in formato jpg/png/gif di peso non superiore a 2MB e di dimensioni minime di 600x600 pixel e proporzioni consigliate 1:1 (quadrata). In questo modo sarà visibile al meglio su tutti i dispositivi">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <p>Allegato</p>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="pr_allegato" name="pr_allegato">
                                                <label class="custom-file-label" for="pr_allegato">Seleziona allegato</label>
                                                <span class="tooltips">Inserisci qui il file allegato al prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Specifica allegato" data-content="Inserisci un file allegato in formato pdf/zip/txt di peso non superiore a 2MB. Puoi usare questo file come scheda tecnica, istruzioni o altro. Se hai bisogno di allegare più file puoi zipparli per permettere il download all'utente">[aiuto]</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="pr_note">Note</label>
                                            <textarea class="form-control" id="pr_note" name="pr_note" rows="3"></textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <input type="hidden" name="pr_id" value="<?php echo $get_pr_id; ?>">
                                            <button class="btn btn-success" type="submit">Inserisci</button>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                    <?php //include "inc/datalist-varianti.php"; ?>

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