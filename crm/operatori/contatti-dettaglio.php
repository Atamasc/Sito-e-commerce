<?php include "inc/autoloader.php"; ?>

<?php header('Content-Type: text/html; charset=ISO-8859-1');

$get_co_id = isset($_GET['co_id']) ? (int)$_GET['co_id'] : 0;

$querySql = "SELECT * FROM co_contatto 
             INNER JOIN py_privacy ON co_email = py_email 
             WHERE co_id = $get_co_id AND py_attivita = 'Contatto'
             GROUP BY co_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();

$class_privacy = $row_data['py_checkbox_privacy'] > 0 ? 'btn-success' : 'btn-danger';
$class_marketing = $row_data['py_checkbox_marketing'] > 0 ? 'btn-success' : 'btn-danger';
$class_cessione = $row_data['py_checkbox_cessione'] > 0 ? 'btn-success' : 'btn-danger';
?>


<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Dettaglio contatto #<?php echo $get_co_id; ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 pb-0">Informazioni contatto</h5>

                        <div class="table-responsive">
                            <table class="table table-1 table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nome</th>
                                        <th class="text-center">Cognome</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Data e ora</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td class='text-center'><?php echo $row_data['co_nome']; ?></td>
                                        <td class='text-center'><?php echo $row_data['co_cognome']; ?></td>
                                        <td class='text-center'><?php echo $row_data['co_email']; ?></td>
                                        <td class='text-center'><?php echo $row_data['co_telefono']; ?></td>
                                        <td class="text-center"><?php echo date('d/m/Y - H:i', $row_data['co_data']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title">Messaggio</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $row_data['co_messaggio']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <h5 class="card-title border-0 mb-0">Informazioni privacy</h5>
                    <div class="table-responsive">
                        <table class="table table-1 table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">Indirizzo IP</th>
                                    <th class="text-center">Opzioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><?php echo $row_data['py_ip']; ?></td>
                                    <td class="text-center">
                                        <button class="btn <?php echo $class_privacy; ?> btn-sm">Privacy</button>&nbsp;
                                        <button class="btn <?php echo $class_marketing; ?> btn-sm">Marketing</button>&nbsp;
                                        <button class="btn <?php echo $class_cessione; ?> btn-sm">Cessione</button>&nbsp;
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>

</div>

<?php include('../inc/db-close.php'); ?>