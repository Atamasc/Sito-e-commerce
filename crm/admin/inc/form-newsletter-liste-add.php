<form method="post" action="newsletter-liste-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi lista email</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Lista inserita con successo.
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
            <label for="ns_lista">Titolo *</label>
            <input type="text" class="form-control" id="ns_lista" name="ns_lista" placeholder="Titolo *"
                   required>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-6 mb-3">
            <label for="ns_descrizione">Descrizione</label>
            <textarea class="form-control" id="ns_descrizione" name="ns_descrizione" placeholder="Descrizione" rows="3"></textarea>
        </div>

    </div>

    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>