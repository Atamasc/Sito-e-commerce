<?php
$querySql = "SELECT * FROM sl_slide WHERE sl_id = $get_sl_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="slide-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica slide</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Slide modificata con successo.
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

        <!--
        <div class="col-md-3 mb-3">
            <label for="sl_tipologia">Tipologia *</label>
            <select class="form-control" id="sl_tipologia" name="sl_tipologia" required>
                <option value="">Seleziona una tipologia</option>
                <option value=""></option>
                <option value="Generica" <?php echo $row_data['sl_tipologia'] == "Generica" ? "selected" : ""; ?>>Generica</option>
                <option value="Edile" <?php echo $row_data['sl_tipologia'] == "Edile" ? "selected" : ""; ?>>Edile</option>
                <option value="Industria" <?php echo $row_data['sl_tipologia'] == "Industria" ? "selected" : ""; ?>>Industria</option>
            </select>
        </div>
        -->

        <div class="col-md-3 mb-3">
            <label for="sl_titolo">Titolo *</label>
            <input type="text" class="form-control" id="sl_titolo" name="sl_titolo" placeholder="Titolo *"
                   value="<?php echo $row_data['sl_titolo']; ?>" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="sl_link">Link *</label>
            <input type="url" class="form-control" id="sl_link" name="sl_link" placeholder="Link *"
                   value="<?php echo $row_data['sl_link']; ?>" required>
        </div>

        <div class="col-md-12 mb-3">
            <label for="sl_testo">Testo <a data-toggle="tooltip" data-placement="right" title="Inserisci qui il testo che comparirà nella slide"><i class="fal fa-question"></i></a></label>
            <textarea class="form-control" id="sl_testo" name="sl_testo" rows="3"><?php echo $row_data['sl_testo']; ?></textarea>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-3">
            <p>Immagine *</p>

            <div class="input-group">
                <?php if (strlen($row_data['sl_immagine']) > 0) { ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sl_immagine" name="sl_immagine">
                        <label class="custom-file-label" for="sl_immagine"><?php echo $row_data['sl_immagine']; ?></label>
                    </div>
                    <div class="input-group-append">
                        <a class="btn btn-info modale-img" href="<?php echo "$upload_path_dir_slide/".$row_data['sl_immagine'] ?>"><i class="fas fa-external-link"></i></a>
                        <a class="btn btn-danger elimina" href="javascript:;" data-href='slide-file-del-do.php?sl_file=<?php echo $row_data['sl_immagine']; ?>'><i class="fas fa-trash-alt"></i></a>
                    </div>

                <?php } else { ?>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="sl_immagine" name="sl_immagine">
                        <label class="custom-file-label" for="sl_immagine">Seleziona immagine</label>
                    </div>

                <?php } ?>
            </div>
            <small>Dimensioni consigliate 1920x690 | Peso massimo 2MB</small>
        </div>

        <div class="col-md-12 mb-3">
            <small class="font-bold">Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare <a href="strumenti-cropping.php" target="_blank" style="color: #28a745; text-decoration: underline;">il nostro tool</a></small>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-1 mb-3">
            <label>Stato</label>
            <div class="checkbox checbox-switch switch-success">
                <label>
                    <input type="checkbox" name="sl_stato" <?php echo $row_data['sl_stato'] > 0 ? "checked" : ""; ?>>
                    <span></span>
                </label>
            </div>
        </div>

    </div>

    <input type="hidden" name="sl_id" value="<?php echo $get_sl_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="slide-gst.php" class="btn btn-success">Aggiungi slide</a>

</form>