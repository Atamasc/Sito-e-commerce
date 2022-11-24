<?php include "inc/autoloader.php"; ?>

<?php
$get_cl_id = (int)$_GET['cl_id'];

$querySql = "SELECT * FROM cl_clienti WHERE cl_id = $get_cl_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Dettaglio Cliente #<?php echo $get_cl_id; ?></h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">

        <div class="col-xl-12 mb-30">

            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100" id="scheda">
                    <div class="card-body">

                        <h6 class="card-title mb-0 border-0">Dati di base</h6>
                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <b>Nome e Cognome: </b>&nbsp;
                                <?php echo $row_data['cl_nome'].' '.$row_data['cl_cognome']; ?>
                            </div>

                            <div class="col-md-4 mb-2">
                                <b>Telefono: </b>&nbsp;
                                <?php echo $row_data['cl_tel']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Indirizzo: </b>&nbsp;
                                <?php echo $row_data['cl_indirizzo'].', '.
                                    $row_data['cl_cap'].', '.
                                    $row_data['cl_citta'].' ('.
                                    $row_data['cl_provincia'].')';
                                ?>
                            </div>

                            <div class="col-md-4 mb-2">
                                <b>Cellulare: </b>&nbsp;
                                <?php echo $row_data['cl_cell']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Codice fiscale: </b>&nbsp;
                                <?php echo $row_data['cl_codice_fiscale']; ?>
                            </div>

                            <div class="col-md-4 mb-2">
                                <b>Fax: </b>&nbsp;
                                <?php echo $row_data['cl_fax']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Email: </b>&nbsp;
                                <?php echo $row_data['cl_email']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Password: </b>&nbsp;
                                <?php echo $row_data['cl_password']; ?>
                            </div>

                        </div>

                        <?php if($row_data['cl_tipo'] == 'Rivenditore' || $row_data['cl_business'] > 0) { ?>
                            <h6 class="card-title mb-0 my-3 border-0">Dati aziendali</h6>
                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <b>Ragione sociale: </b>&nbsp;
                                    <?php echo $row_data['cl_ragione_sociale']; ?>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <b>Partita IVA: </b>&nbsp;
                                    <?php echo $row_data['cl_partita_iva']; ?>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <b>Telefono aziendale: </b>&nbsp;
                                    <?php echo $row_data['cl_telefono_aziendale']; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <b>Indirizzo aziendale: </b>&nbsp;
                                    <?php echo $row_data['cl_indirizzo_fatturazione'].', '.
                                        $row_data['cl_cap_fatturazione'].', '.
                                        $row_data['cl_citta'].' ('.
                                        $row_data['cl_provincia_fatturazione'].')';
                                    ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <button onclick="PrintElem('scheda');" class="btn btn-primary">Stampa&nbsp;&nbsp;<i class="fa fa-print"></i></button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>