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

if(@$_GET['delete'] == 'true') {

    ?>
    <div class="alert alert-success" role="alert">
        Eliminazione avvenuta con successo.
    </div>
    <?php

}
?>