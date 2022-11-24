<?php
$querySql = "SELECT * FROM bc_blog_categorie WHERE bc_id = $get_bc_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="blog-categorie-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Aggiungi categoria</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Categoria inserita con successo.
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
            <label for="bc_titolo">Titolo *</label>
            <input type="text" class="form-control" id="bc_titolo" name="bc_titolo" placeholder="Titolo *"
                   value="<?php echo $row_data['bc_titolo']; ?>" required>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-6 mb-3">
            <label for="summernote">Descrizione</label>
            <textarea class="form-control" id="summernote" name="bc_descrizione" placeholder="Descrizione" rows="3">
                <?php echo $row_data['bc_descrizione']; ?>
            </textarea>
        </div>

    </div>

    <input type="hidden" name="bc_id" value="<?PHP ECHO $get_bc_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="../blog-categorie-gst.php" class="btn btn-success">Aggiungi categoria</a>

</form>