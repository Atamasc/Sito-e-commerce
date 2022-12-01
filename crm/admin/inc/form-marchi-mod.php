<?php
$querySql = "SELECT * FROM mr_marche WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();

$mr_immagine = $row_data['mr_immagine'];
$mr_banner = $row_data['mr_banner'];
$mr_immagine_path = "$upload_path_dir_marche/$mr_immagine";
$mr_banner_path = "$upload_path_dir_marche/$mr_banner";
?>

<form method="post" action="marche-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica marca</h5>

    <?php
    if (@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Marca modificato con successo.
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

    <div class="form-row">

        <div class="col-md-2 mb-3">
            <label for="mr_titolo">Marca *</label>
            <input type="text" class="form-control" id="mr_marche" name="mr_marche"
                    value="<?php echo $row_data['mr_marche']; ?>" required>
        </div>

        <div class="col-md-1 mb-3">
            <label for="mr_titolo">Codice *</label>
            <input type="text" class="form-control" id="mr_codice" name="mr_codice"
                    value="<?php echo $row_data['mr_codice']; ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <label>Immagine</label>
            <div class="custom-file">
                <input type="file" name="mr_immagine" id="mr_immagine" class="custom-file-input" data-max-width="870" data-max-height="500">

                <?php if (strlen($mr_immagine) > 0) { ?>
                    <label class="custom-file-label"><?php echo $mr_immagine; ?></label>
                <?php } else { ?>
                    <label class="custom-file-label">Scegli un file</label>
                <?php } ?>
            </div>
            <small class="text-muted"> formato jpg, png - dimensioni 600 x 600 pixel - peso max 2 Mb
                <?php if (strlen($mr_immagine) > 0) { ?>
                    | <a class="text-success popover-img" href="<?php echo $mr_immagine_path; ?>">vedi immagine</a>
                <?php } ?>
            </small>
        </div>

        <div class="col-md-3 mb-3">
            <label>Banner</label>
            <div class="custom-file">
                <input type="file" name="mr_banner" id="mr_banner" class="custom-file-input" data-max-width="870" data-max-height="500">

                <?php if (strlen($mr_banner) > 0) { ?>
                    <label class="custom-file-label"><?php echo $mr_banner; ?></label>
                <?php } else { ?>
                    <label class="custom-file-label">Scegli un file</label>
                <?php } ?>
            </div>
            <small class="text-muted"> formato jpg, png - dimensioni 845 x 145 pixel - peso max 2 Mb
                <?php if (strlen($mr_banner) > 0) { ?>
                    | <a class="text-success popover-img" href="<?php echo $mr_banner_path; ?>">vedi immagine</a>
                <?php } ?>
            </small>
        </div>

        <div class="col-md-2 mb-3">
            <label for="mr_riservato">Visibilità</label>
            <select class="form-control" id="mr_riservato" name="mr_riservato" required>
                <option value="">Seleziona un tipo</option>
                <option value=""></option>
                <option value="1" <?php if ($row_data['mr_riservato'] == '1') echo "selected"; ?>>Riservato</option>
                <option value="0" <?php if ($row_data['mr_riservato'] == '0') echo "selected"; ?>>Pubblico</option>
            </select>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-4 mb-3">
            <label for="mr_video">Video (Es: https://www.youtube.com/embed/E3QiD99jPAg)</label>
            <textarea class="form-control" id="mr_video" name="mr_video" rows="3"><?php echo $row_data['mr_video']; ?></textarea>
        </div>

        <div class="col-md-4 mb-3">
            <label for="mr_descrizione">Descrizione</label>
            <textarea class="form-control" id="mr_descrizione" name="mr_descrizione" rows="3"><?php echo $row_data['mr_descrizione']; ?></textarea>
        </div>

    </div>

    <input type="hidden" name="mr_id" value="<?PHP echo $get_mr_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="marche-add.php" class="btn btn-success">Aggiungi marca</a>

</form>