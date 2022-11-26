<?php
$querySql = "SELECT * FROM ut_colori WHERE ut_id = $get_ut_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="set-colori-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica colore</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Colore modificato con successo.
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

        <div class="col-md-3 mb-3">
            <label for="ut_colore">Titolo *</label>
            <input type="text" class="form-control" id="ut_colore" name="ut_colore" value="<?php echo $row_data['ut_colore']; ?>" required>
            <span class="tooltips">Titolo Colore <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Colore" data-content="Assegna un titolo al colore che vuoi modificare, un nome riconoscibile. Es. Verde, Giallo, Rosso">[aiuto]</a></span>
        </div>

        <div class="col-md-3 mb-3">
            <label>Colore identificativo *</label>
            <div id="cp2" class="input-group colorpicker-component" title="Using input value">
                <input type="hidden" class="form-control input-lg" value="<?php echo strlen($row_data['ut_rgb']) ? $row_data['ut_rgb'] : "#000000"; ?>" name="ut_rgb">
                <span class="input-group-addon"><i></i></span>
            </div>
            <span class="tooltips">Colore <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Colore" data-content="Cliccando sul quadratino si aprirà una piccola finestra, utilizza il mouse per scegliere il colore che vuoi modificare cliccandoci sopra">[aiuto]</a></span>
        </div>

    </div>

    <input type="hidden" name="ut_id" value="<?php echo $get_ut_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="set-colori-gst.php" class="btn btn-success">Aggiungi colore</a>

</form>