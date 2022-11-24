<div class="form-row">

    <div class="col-md-3 mb-3">
        <label for="cv_codice">Codice *</label>
        <input type="text" class="form-control" id="cv_codice" name="cv_codice"
               value="<?php echo strlen(@$row_data['cv_codice']) > 0 ? @$row_data['cv_codice'] : time(); ?>" required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="cv_titolo">Titolo *</label>
        <input type="text" class="form-control" id="cv_titolo" name="cv_titolo"
               value="<?php echo @$row_data['cv_titolo']; ?>" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="cv_canone">Canone *</label>
        <input type="text" class="form-control pattern-price" id="cv_canone" name="cv_canone" aria-describedby="cv_canone_help"
               value="<?php echo strlen(@$row_data['cv_canone']) > 0 ? formatPrice(@$row_data['cv_canone']) : ""; ?>" required>
        <small id="cv_canone_help" class="form-text text-muted">Inserisci 0 se vuoi rendere il canone gratuito.</small>
    </div>

</div>

<div class="form-row">

    <div class="col-md-6 mb-3">
        <label for="cv_abstract">Abstract *</label>
        <textarea class="form-control" id="cv_abstract" name="cv_abstract"
                  required rows="5"><?php echo @$row_data['cv_abstract']; ?></textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label for="cv_intestazione">Intestazione *</label>
        <textarea class="form-control" id="cv_intestazione" name="cv_intestazione"
                  required rows="5"><?php echo @$row_data['cv_intestazione']; ?></textarea>
    </div>

</div>

<div class="form-row">

    <div class="col-md-12 mb-3">
        <label for="cv_descrizione">Descrizione *</label>
        <textarea class="form-control" id="summernote" name="cv_descrizione"
                  required><?php echo @$row_data['cv_descrizione']; ?></textarea>
    </div>

</div>

<div class="form-row">

    <div class="col-md-6 mb-3">
        <label for="cv_specifiche_legali">Specifiche legali *</label>
        <textarea class="form-control" id="cv_specifiche_legali" name="cv_specifiche_legali"
                  required rows="5"><?php echo @$row_data['cv_specifiche_legali']; ?></textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label for="cv_condizioni">Condizioni generali *</label>
        <textarea class="form-control" id="cv_condizioni" name="cv_condizioni"
                  required rows="5"><?php echo @$row_data['cv_condizioni']; ?></textarea>
    </div>

</div>

<div class="form-row">

    <div class="col-md-3 mb-3">

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="cv_personalizzato" name="cv_personalizzato"
                <?php echo $row_data['cv_personalizzato'] > 0 ? "checked": ""; ?>>
            <label class="custom-control-label" for="cv_personalizzato">Personalizzato</label>
        </div>

    </div>

</div>