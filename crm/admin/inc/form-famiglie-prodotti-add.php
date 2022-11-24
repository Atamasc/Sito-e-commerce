<form method="post" action="prodotti-famiglie-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi famiglia</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Inserimento avvenuto con successo.
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
            <label for="fm_codice">Codice *</label>
            <input type="text" class="form-control" id="fm_codice" name="fm_codice" placeholder="Codice *" required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="fm_descrizione">Titolo *</label>
            <input type="text" class="form-control" id="fm_descrizione" name="fm_descrizione" placeholder="Titolo *" required>
        </div>

    </div>

    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>