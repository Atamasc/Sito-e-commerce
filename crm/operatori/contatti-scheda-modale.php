<?php include "inc/autoloader.php"; ?>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');

$get_co_id = (int)$_GET['co_id'];

$querySql = "SELECT * FROM co_contatto 
             INNER JOIN py_privacy ON co_email = py_email 
             WHERE co_id = $get_co_id AND py_attivita = 'Contatto' 
             GROUP BY co_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$privacy = $row_data['py_checkbox_privacy'] > 0 ? 'Si' : 'No';
$marketing = $row_data['py_checkbox_marketing'] > 0 ? 'Si' : 'No';
$cessione = $row_data['py_checkbox_cessione'] > 0 ? 'Si' : 'No';
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Scheda Contatto #<?php echo $get_co_id; ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row" id="scheda">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h6 class="card-title">Dati contatto</h6>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <b>Nome: </b>&nbsp;
                            <?php echo $row_data['co_nome'];  ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Cognome: </b>&nbsp;
                            <?php echo $row_data['co_cognome'];  ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Email: </b>&nbsp;
                            <?php echo $row_data['co_email']; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Telefono: </b>&nbsp;
                            <?php echo $row_data['co_telefono']; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Oggetto: </b>&nbsp;
                            <?php echo $row_data['co_oggetto']; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Data e ora: </b>&nbsp;
                            <?php echo strftime('%A %e %B %Y - %H:%m', (int)$row_data['co_data']); ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <b>Indirizzo IP: </b>&nbsp;
                            <?php echo $row_data['py_ip'];  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100" id="scheda">
                <div class="card-body">
                    <h6 class="card-title">Messaggio</h6>
                    <div class="row">
                       <div class="col-md-12">
                           <?php echo $row_data['co_messaggio']; ?>
                       </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100" id="scheda">
                <div class="card-body">
                    <h6 class="card-title">Dati privacy</h6>
                    <div class="row">

                        <div class="col-md-4">
                            <b>Privacy: </b>&nbsp;
                            <?php echo $privacy; ?>
                        </div>

                        <div class="col-md-4">
                            <b>Marketing: </b>&nbsp;
                            <?php echo $marketing; ?>
                        </div>

                        <div class="col-md-4">
                            <b>Cessione: </b>&nbsp;
                            <?php echo $cessione; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <button class="btn btn-primary" onclick="PrintElem('scheda');">Stampa&nbsp;&nbsp;<i class="fa fa-print"></i></button>
        </div>
    </div>

</div>