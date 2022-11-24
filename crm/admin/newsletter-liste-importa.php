<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Importazione lista da file CSV</h6>
            <h2>Importa una lista email</h2>
            <p>Seleziona un file CSV contenente una lista di email da importare.</p>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body">

    <form method="post" action="newsletter-liste-importa-do.php" enctype="multipart/form-data">

        <div class="form-row">

            <div class="col-md-3 mb-3">
                <input type="file" class="inputfile inputfile-2" id="file" name="file">
                <label for="file"><span class="btn btn-secondary">Seleziona un file</span></label>
            </div>

        </div>

        <input type="hidden" name="ns_id" value="<?php echo (int)$_GET['ns_id']; ?>">
        <button class="btn btn-primary" type="submit">Carica</button>

    </form>

</div>

<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>
</div>