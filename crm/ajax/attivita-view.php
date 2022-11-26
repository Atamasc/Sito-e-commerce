<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<?php include('../inc/db-conn.php'); ?>
<?php include('../bin/function.php'); ?>
<?php include('../inc/config.php'); ?>
<?php
$get_at_id = isset($_GET['at_id']) ? (int)$_GET['at_id'] : 0;

$querySql = "SELECT * FROM at_attivita INNER JOIN ut_utenti ON ut_id = at_ut_id WHERE at_id = '$get_at_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Dettaglio attività #<?php echo $get_at_id; ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Informazioni cliente</h5>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            Cliente: <b><?php echo $row_data['ut_ragione_sociale']; ?></b>
                        </div>

                        <div class="col-md-6 mb-3">
                            Email: <b><?php echo $row_data['ut_email']; ?></b>
                        </div>

                    </div>

                    <h5 class="card-title border-0 pb-0">Informazioni attività</h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            Tipologia: <b><?php echo $row_data['at_tipologia']; ?></b>
                        </div>

                        <div class="col-md-4 mb-3">
                            Luogo: <b><?php echo $row_data['at_luogo']; ?></b>
                        </div>

                        <div class="col-md-4 mb-3">
                            Esito: <b><?php echo $row_data['at_esito']; ?></b>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            Data e ora attività: <b><?php echo date("d/m/Y", $row_data['at_data_attivita'])." ".$row_data['at_ora_attivita']; ?></b>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            Note: <?php echo $row_data['at_note']; ?>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>

</div>

<?php include "../inc/db-close.php"; ?>