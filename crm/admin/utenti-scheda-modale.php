<?php include "inc/autoloader.php"; ?>

<?php
$get_ut_id = (int)$_GET['ut_id'];

$querySql = "SELECT * FROM ut_utenti WHERE ut_id = $get_ut_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
?>

<div class="modal-header">
    <div class="modal-title">
        <div class="mb-30">
            <h6>Dettaglio Utente #<?php echo $get_ut_id; ?></h6>
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

                        <h6 class="card-title mb-0 border-0">Dati cliente</h6>
                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <b>Codice: </b>&nbsp;
                                <?php echo $row_data['ut_codice']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Nome e Cognome: </b>&nbsp;
                                <?php echo $row_data['ut_nome'] . ' ' . $row_data['ut_cognome']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Telefono: </b>&nbsp;
                                <?php echo $row_data['ut_telefono']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Indirizzo: </b>&nbsp;
                                <?php echo $row_data['ut_indirizzo'] . ', ' .
                                    $row_data['ut_cap'] . ', ' .
                                    $row_data['ut_citta'] . ' (' .
                                    $row_data['ut_provincia'] . ')';
                                ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Email: </b>&nbsp;
                                <?php echo $row_data['ut_email']; ?>
                            </div>

                            <div class="col-md-6 mb-2">
                                <b>Password: </b>&nbsp;
                                <?php echo $row_data['ut_password']; ?>
                            </div>

                            <div class="col-md-12 mb-3">
                                <b>Note: </b>&nbsp;
                                <?php echo $row_data['ut_note']; ?>
                            </div>

                        </div>

                    </div>

                </div>

                <!--  <div class="row mt-3">
                      <div class="col-md-3">
                          <button onclick="PrintElem('scheda');" class="btn btn-primary">Stampa&nbsp;&nbsp;<i class="fa fa-print"></i>
                          </button>
                      </div>
                  </div>-->

            </div>

        </div>

    </div>

</div>