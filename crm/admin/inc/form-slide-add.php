<form method="post" action="slide-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi slide</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Slide inserita con successo.
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

        <!--
        <div class="col-md-3 mb-3">
            <label for="sl_tipologia">Tipologia *</label>
            <select class="form-control" id="sl_tipologia" name="sl_tipologia" required>
                <option value="">Seleziona una tipologia</option>
                <option value=""></option>
                <option value="Generica">Generica</option>
                <option value="Edile">Edile</option>
                <option value="Industria">Industria</option>
            </select>
        </div>
        -->

        <div class="col-md-3 mb-3">
            <label for="sl_titolo">Titolo *</label>
            <input type="text" class="form-control" id="sl_titolo" name="sl_titolo" placeholder="Titolo *"
                   required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="sl_link">Link *</label>
            <input type="url" class="form-control" id="sl_link" name="sl_link" placeholder="Link *"
                   required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="sl_testo">Testo <a data-toggle="tooltip" data-placement="right" title="Inserisci qui il testo che comparirà nella slide"><i class="fal fa-question"></i></a></label>
            <textarea class="form-control" id="sl_testo" name="sl_testo" rows="3"></textarea>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-3">
            <p>Immagine *</p>

            <div class="custom-file">
                <input type="file" class="custom-file-input" id="sl_immagine" name="sl_immagine" required>
                <label class="custom-file-label" for="sl_immagine">Seleziona immagine</label>
            </div>
            <small>Dimensioni consigliate 1920x690 | Peso massimo 2MB</small>
        </div>

        <div class="col-md-12 mb-3">
            <small class="font-bold">Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare <a href="strumenti-cropping.php" target="_blank" style="color: #28a745; text-decoration: underline;">il nostro tool</a></small>
        </div>

    </div>


    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>