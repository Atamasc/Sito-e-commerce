<form method="post" action="set-colori-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi colore</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Colore inserito con successo.
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
            <label for="cl_colore">Titolo *</label>
            <input type="text" class="form-control" id="cl_colore" name="cl_colore" required>
            <span class="tooltips">Titolo Colore <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Colore" data-content="Assegna un titolo al colore che vuoi aggiungere, un nome riconoscibile. Es. Verde, Giallo, Rosso">[aiuto]</a></span>
        </div>

        <div class="col-md-3 mb-3">
            <label>Colore identificativo *</label>
            <div id="cp2" class="input-group colorpicker-component" title="Using input value">
                <input type="hidden" class="form-control input-lg" value="#000000" name="cl_rgb">
                <span class="input-group-addon"><i></i></span>
            </div>
            <span class="tooltips">Colore <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Colore" data-content="Cliccando sul quadratino si aprirà una piccola finestra, utilizza il mouse per scegliere il colore che vuoi aggiungere cliccandoci sopra">[aiuto]</a></span>
        </div>

    </div>

    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>