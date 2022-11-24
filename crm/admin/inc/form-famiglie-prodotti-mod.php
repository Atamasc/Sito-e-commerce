<?php
$querySql = "SELECT * FROM fm_famiglie WHERE fm_id = $get_fm_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="prodotti-famiglie-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica famiglia</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Famiglia modificata con successo.
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

        <div class="col-md-3 mb-3">
            <label for="fm_codice">Codice *</label>
            <input type="text" class="form-control" id="fm_codice" name="fm_codice" placeholder="Codice *"
                   value="<?php echo $row_data['fm_codice']; ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="fm_descrizione">Titolo *</label>
            <input type="text" class="form-control" id="fm_descrizione" name="fm_descrizione" placeholder="Titolo *"
                   value="<?php echo $row_data['fm_descrizione']; ?>" required>
        </div>

    </div>

    <input type="hidden" name="fm_id" value="<?php echo $get_fm_id; ?>">
    <button class="btn btn-success" type="submit">Modifica</button>
    <a href="prodotti-famiglie-gst.php" class="btn btn-primary">Aggiungi famiglia</a>

</form>