<?php
$querySql = "SELECT * FROM ct_categorie WHERE ct_id = $get_ct_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="prodotti-categorie-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica categoria</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Categoria modificata con successo.
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
            <label for="ct_categoria">Titolo *</label>
            <input type="text" class="form-control" id="ct_categoria" name="ct_categoria" placeholder="Titolo *"
                   value="<?php echo $row_data['ct_categoria']; ?>" required>
        </div>

    </div>

    <input type="hidden" name="ct_id" value="<?PHP ECHO $get_ct_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="prodotti-categorie-gst.php" class="btn btn-success">Aggiungi categoria</a>

</form>