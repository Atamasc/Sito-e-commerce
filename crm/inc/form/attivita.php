<div class="form-row">

    <div class="col-md-3 mb-3">
        <label for="at_tipologia">Tipologia *</label>
        <select class="form-control" id="at_tipologia" name="at_tipologia" required>
            <option value="">Seleziona una tipologia</option>
            <option value=""></option>
            <option value="Telefonata" <?php echo @$row_data['at_tipologia'] == "Telefonata" ? "selected" : ""; ?>>Telefonata</option>
            <option value="Invio email" <?php echo @$row_data['at_tipologia'] == "Invio email" ? "selected" : ""; ?>>Invio email</option>
            <option value="Appuntamento" <?php echo @$row_data['at_tipologia'] == "Appuntamento" ? "selected" : ""; ?>>Appuntamento</option>
        </select>
        <span class="tooltips">Tipologia Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Tipologia Attivit&agrave;" data-content="Inserisci qui la tipologia dell'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="at_luogo">Luogo</label>
        <input type="text" class="form-control" id="at_luogo" name="at_luogo" value="<?php echo @$row_data['at_luogo']; ?>">
        <span class="tooltips">Luogo Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Luogo Attivit&agrave;" data-content="Inserisci qui il luogo dove si svolger&agrave; l'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

    <div class="col-md-3 mb-3">

        <label for="cl_ragione_sociale">Cliente *</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="cl_ragione_sociale" value="<?php echo @$row_data['cl_ragione_sociale']; ?>" required readonly>
            <input type="hidden" id="cl_id" name="at_cl_id" value="<?php echo @$row_data['at_cl_id']; ?>" required>
            <div class="input-group-append">
                <button class="btn btn-primary popup-custom" data-href="attivita-clienti-add.php" type="button">Associa</button>
            </div>
        </div>
        <span class="tooltips">Cliente Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cliente Attivit&agrave;" data-content="Inserisci qui la ragione sociale del cliente che ha richiesto l'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>

    </div>

</div>

<div class="form-row">

    <div class="col-md-3 mb-3">
        <label for="at_data_attivita">Data attività *</label>
        <input type="text" class="form-control date-picker-default" id="at_data_attivita" name="at_data_attivita"
               value="<?php echo strlen(@$row_data['at_data_attivita']) > 0 ? date("d/m/Y", $row_data['at_data_attivita']) : ""; ?>" required>
        <span class="tooltips">Data Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Data Attivit&agrave;" data-content="Inserisci qui la data dell'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="at_ora_attivita">Ora attività *</label>
        <input type="text" class="form-control pattern-time" id="at_ora_attivita" name="at_ora_attivita" value="<?php echo @$row_data['at_ora_attivita']; ?>" required>
        <span class="tooltips">Ora Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ora Attivit&agrave;" data-content="Inserisci qui l'ora dell'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="at_esito">Esito *</label>
        <select class="form-control" id="at_esito" name="at_esito" required>
            <option value="">Seleziona un esito</option>
            <option value=""></option>
            <option value="In corso" <?php echo @$row_data['at_esito'] == "In corso" ? "selected" : ""; ?>>In corso</option>
            <option value="Positivo" <?php echo @$row_data['at_esito'] == "Positivo" ? "selected" : ""; ?>>Positivo</option>
            <option value="Negativo" <?php echo @$row_data['at_esito'] == "Negativo" ? "selected" : ""; ?>>Negativo</option>
        </select>
        <span class="tooltips">Esito Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Esito Attivit&agrave;" data-content="Inserisci qui l'esito dell'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

</div>

<div class="form-row">

    <div class="col-md-12 mb-3">
        <label for="at_note">Note</label>
        <textarea class="form-control" id="at_note" name="at_note" rows="3"><?php echo @$row_data['at_note']; ?></textarea>
        <span class="tooltips">Nota Attivit&agrave; <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cliente Attivit&agrave;" data-content="Inserisci qui una nota, un promemoria riguardo l'attivit&agrave; che stai aggiungendo">[aiuto]</a></span>
    </div>

</div>