
<form method="post" action="sottocategorie-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica sottocategoria</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Sottocategoria modificata con successo.
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

    <div class="form-row">

        <div class="col-md-3 mb-3">
            <label for="st_sottocategoria">Titolo *</label>
            <input type="text" class="form-control" id="st_sottocategoria" name="st_sottocategoria" placeholder="Titolo *"
                   value="<?php echo $row_data['st_sottocategoria']; ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <p>Immagine</p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="st_immagine" name="st_immagine">
                <?php if (strlen($row_data['st_immagine']) > 0) { ?>

                    <label class="custom-file-label" for="st_immagine"><?php echo $row_data['st_immagine']; ?></label>
                    <a class="modale-img" href="<?php echo "$upload_path_dir_sottocategorie/".$row_data['st_immagine'] ?>">vedi immagine</a>&nbsp;|&nbsp;
                    <a class="elimina" href="javascript:;" data-href='prodotti-cat-sot-immagine-del-do.php?st_id=<?php echo $get_st_id; ?>&ct_id=<?php echo $get_ct_id; ?>'>elimina</a>

                <?php } else { ?>

                    <label class="custom-file-label" for="st_immagine">Seleziona immagine</label>

                <?php } ?>
            </div>
            <p class="tooltips">Dimensioni consigliate: <b>1052px larghezza</b> </p>
            <!--<span class="tooltips"><a style="color: blue; cursor: pointer;" role="button" data-toggle="modal" data-target=".bd-example-modal-lg-file" title="Tutorial per le immagini" >[guarda il tutorial]</a></span> --> <!-- data-target="modale-immagine" -->
            <?php include ("inc/modali.php");?>
        </div>

    </div>

    <h5 class="card-title">Gestione Info SEO</h5>

    <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="st_title">Title</label>
            <textarea class="form-control" id="st_title" name="st_title" rows="3"><?php echo @$row_data['st_title']; ?></textarea>
            <span class="tooltips">Title Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Title Sottocategoria" data-content="Inserisci qui il title della sottocategoria per la parte SEO">[aiuto]</a></span>
        </div>

        <div class="col-md-3 mb-3">
            <p>Immagine Facebook 1200x628</p>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="st_immagine_fb" name="st_immagine_fb">
                <?php if (strlen($row_data['st_img_fb_1200_628']) > 0) { ?>

                    <label class="custom-file-label" for="st_immagine_fb"><?php echo $row_data['st_img_fb_1200_628']; ?></label>
                    <a class="modale-img" href="<?php echo "$upload_path_dir_sottocategorie/".$row_data['st_img_fb_1200_628'] ?>">vedi immagine</a>&nbsp;|&nbsp;
                    <a class="elimina" href="javascript:;" data-href='prodotti-cat-sot-immagine-del-do.php?st_id=<?php echo $get_st_id; ?>&ct_id=<?php echo $get_ct_id; ?>&st_immagine_fb=1'>elimina</a>

                <?php } else { ?>

                    <label class="custom-file-label" for="st_immagine_fb">Seleziona immagine</label>

                <?php } ?>
            </div>
            <p class="tooltips">Dimensioni consigliate: <b>1200x628</b> </p>

            <!--<span class="tooltips">Immagine Prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Specifica immagine" data-content="Inserisci una immagine in formato jpg/png/gif di peso non superiore a 2MB e di dimensioni minime di 500x500 pixel e proporzioni consigliate 1:1 (quadrata). In questo modo sarà visibile al meglio su tutti i dispositivi">[aiuto]</a></span>-->

            <!--<span class="tooltips"><a style="color: blue; cursor: pointer;" role="button" data-toggle="modal" data-target=".bd-example-modal-lg-file" title="Tutorial per le immagini" >[guarda il tutorial]</a></span> --> <!-- data-target="modale-immagine" -->
            <?php include ("inc/modali.php");?>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="st_meta_keywords">META Keywords</label>
            <textarea class="form-control" id="st_meta_keywords" name="st_meta_keywords" rows="3"><?php echo @$row_data['st_meta_keywords']; ?></textarea>
            <span class="tooltips">>META Keywords Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title=">META Keywords Sottocategoria" data-content="Inserisci qui le keywords della sottocategoria per la parte SEO">[aiuto]</a></span>

        </div>

        <div class="col-md-4 mb-3">
            <label for="st_meta_desc">META Description </label>
            <textarea class="form-control" id="st_meta_desc" name="st_meta_desc" rows="3"><?php echo @$row_data['st_meta_desc']; ?></textarea>
            <span class="tooltips">META Description Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="META Description Sottocategoria" data-content="Inserisci qui la description della sottocategoria per la parte SEO">[aiuto]</a></span>

        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="st_h1">Testo H1</label>
            <textarea class="form-control" id="st_h1" name="st_h1" rows="3"><?php echo @$row_data['st_h1']; ?></textarea>
            <span class="tooltips">Testo H1 Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Testo H1 Sottocategoria" data-content="Inserisci qui il testo h1 della sottocategoria per la parte SEO">[aiuto]</a></span>

        </div>

        <div class="col-md-4 mb-3">
            <label for="st_h2">Testo H2</label>
            <textarea class="form-control" id="st_h2" name="st_h2" rows="3"><?php echo @$row_data['st_h2']; ?></textarea>
            <span class="tooltips">Testo H2 Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Testo H2 Sottocategoria" data-content="Inserisci qui il testo h2 della sottocategoria per la parte SEO">[aiuto]</a></span>

        </div>

        <div class="col-md-8 mb-3">

            <label for="summernote">Descrizione</label>
            <textarea name="st_descrizione" id="summernote" rows="20"><?php echo @$row_data['st_descrizione']; ?></textarea>
            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>
            <span class="tooltips">Descrizione Sottocategoria <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Sottocategoria" data-content="Inserisci qui una descrizione della sottocategoria che stai aggiungendo">[aiuto]</a></span>
        </div>

    </div>

    <input type="hidden" name="ct_id" value="<?PHP ECHO $get_ct_id; ?>">
    <input type="hidden" name="st_id" value="<?PHP ECHO $get_st_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>

</form>