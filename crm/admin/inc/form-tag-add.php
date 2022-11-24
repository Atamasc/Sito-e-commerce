<form method="post" action="tag-add-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi tag</h5>

    <?php
    if(@$_GET['insert'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Tag inserito con successo.
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
            <label for="tg_tag">TAG *</label>
            <input type="text" class="form-control" id="tg_tag" name="tg_tag" placeholder="TAG *"
                   required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="tg_note">Note</label>
            <textarea class="form-control" id="tg_note" name="tg_note" rows="2"></textarea>
        </div>

    </div>

    <button class="btn btn-primary" type="submit">Inserisci</button>

</form>