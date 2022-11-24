<?php
$querySql = "SELECT * FROM tg_tag WHERE tg_id = $get_tg_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
?>

<form method="post" action="tag-mod-do.php" enctype="multipart/form-data">

    <h5 class="card-title">Modifica TAG</h5>

    <?php
    if(@$_GET['update'] == 'true') {

        ?>
        <div class="alert alert-success" role="alert">
            TAG modificato con successo.
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
            <label for="tg_tag">TAG *</label>
            <input type="text" class="form-control" id="tg_tag" name="tg_tag" placeholder="Titolo *"
                   value="<?php echo $row_data['tg_tag']; ?>" required>
        </div>

        <div class="col-md-3 mb-3">
            <label for="op_note">Note</label>
            <textarea class="form-control" id="tg_note" name="tg_note" rows="2"><?php echo $row_data['tg_note']; ?></textarea>
        </div>

    </div>

    <input type="hidden" name="tg_id" value="<?PHP ECHO $get_tg_id; ?>">
    <button class="btn btn-primary" type="submit">Modifica</button>
    <a href="tag-gst.php" class="btn btn-success">Aggiungi TAG</a>

</form>