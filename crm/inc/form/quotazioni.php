<div class="form-row">

    <div class="col-md-3 mb-3">
        <label for="qt_tipo">Tipo *</label>
        <select class="form-control" name="qt_tipo" id="qt_tipo" required>
            <option value="">Seleziona un tipo</option>
            <option value=""></option>
            <option value="Convenzione" <?php echo @$row_data['qt_tipo'] == "Convenzione" ? "selected" : ""; ?>>Convenzione</option>
            <option value="Listino" <?php echo @$row_data['qt_tipo'] == "Listino" ? "selected" : ""; ?>>Listino</option>
            <option value="Preventivo" <?php echo @$row_data['qt_tipo'] == "Preventivo" ? "selected" : ""; ?>>Preventivo</option>
        </select>
    </div>

    <div class="col-md-3 mb-3">
        <label for="qt_codice">Codice *</label>
        <input type="text" class="form-control" id="qt_codice" name="qt_codice"
               value="<?php echo strlen(@$row_data['qt_codice']) > 0 ? @$row_data['qt_codice'] : time(); ?>" required>
    </div>

    <div class="col-md-6 mb-3">
        <label for="qt_titolo">Titolo *</label>
        <input type="text" class="form-control" id="qt_titolo" name="qt_titolo"
               value="<?php echo @$row_data['qt_titolo']; ?>" required>
    </div>

</div>

<div class="form-row">

    <div class="col-md-12 mb-3">
        <label for="qt_descrizione">Descrizione *</label>
        <textarea class="form-control" id="summernote" name="qt_descrizione"
                  required><?php echo @$row_data['qt_descrizione']; ?></textarea>
    </div>

</div>

<div class="form-row">

    <div class="col-md-12 mb-3">
        <label for="qt_condizioni">Condizioni *</label>
        <textarea class="form-control" id="qt_condizioni" name="qt_condizioni"
                  required rows="3"><?php echo @$row_data['qt_condizioni']; ?></textarea>
    </div>

</div>

<div class="form-row">

    <div class="col-md-3 mb-3">
        <label for="qt_data">Data *</label>
        <input type="text" class="form-control date-picker-default" id="qt_data" name="qt_data"
               value="<?php echo strlen(@$row_data['qt_data']) > 0 ? @date("d/m/Y", $row_data['qt_data']) : ""; ?>" required>
    </div>

    <div class="col-md-3 mb-3">
        <label for="qt_scadenza">Scadenza *</label>
        <input type="text" class="form-control date-picker-default" id="qt_scadenza" name="qt_scadenza"
               value="<?php echo strlen(@$row_data['qt_scadenza']) > 0 ? @date("d/m/Y", $row_data['qt_scadenza']) : ""; ?>" required>
    </div>

</div>

<div class="form-row">

    <div class="col-md-3 mb-3">
        <p>Allegato</p>
        <div class="custom-file">

            <input type="file" class="custom-file-input" id="qt_allegato" name="qt_allegato">
            <?php if (strlen($row_data['qt_allegato']) > 0) { ?>
                <label class="custom-file-label" for="qt_allegato"><?php echo $row_data['qt_allegato']; ?></label><br>
                <a href="<?php echo "$upload_path_dir_quotazioni/".$row_data['qt_allegato']; ?>" target="_blank">vedi allegato</a>
            <?php } else {
                ?><label class="custom-file-label" for="qt_allegato">Seleziona allegato</label><?php
            } ?>
            <p>Peso max: 2 MB</p>
        </div>

    </div>

</div>