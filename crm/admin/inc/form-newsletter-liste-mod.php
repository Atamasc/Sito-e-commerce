<form method="post" action="newsletter-liste-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica lista email</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Modifica avvenuta con successo.
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

    <?php
    if(@$_GET['import'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            Importazione avvenuta con successo.
        </div>
        <?php

    } else if(@$_GET['import'] == 'false') {

        ?>
        <div class="alert alert-danger" role="alert">
            Si è verificato un errore, riprova.
        </div>
        <?php

    }
    ?>

    <?php
    $querySql = "SELECT * FROM ns_newsletter_liste WHERE ns_id = '$get_ns_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();
    ?>

    <div class="form-row">

        <div class="col-md-3 mb-3">
            <label for="ns_lista">Titolo *</label>
            <input type="text" class="form-control" id="ns_lista" name="ns_lista" placeholder="Titolo *"
                   value="<?php echo $row_data['ns_lista']; ?>" required>
        </div>

    </div>

    <div class="form-row">

        <div class="col-md-6 mb-3">
            <label for="ns_descrizione">Descrizione</label>
            <textarea class="form-control" id="ns_descrizione" name="ns_descrizione" placeholder="Descrizione" rows="3"><?php echo $row_data['ns_descrizione']; ?></textarea>
        </div>

    </div>

    <input type="hidden" name="ns_id" value="<?php echo $get_ns_id; ?>">
    <button class="btn btn-success" type="submit">Modifica</button>
    <a class="btn btn-primary" href="newsletter-liste-gst.php">Crea nuova lista</a>

</form>