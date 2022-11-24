<form method="post" action="prodotti-categorie-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi categoria</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Categoria inserita con successo.
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
            <label for="ct_categoria">Titolo *</label>
            <input type="text" class="form-control" id="ct_categoria" name="ct_categoria" placeholder="Titolo *"
                   required>
        </div>

    </div>

    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>