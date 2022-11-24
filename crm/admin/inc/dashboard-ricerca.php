<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-block d-md-flexx justify-content-between">
                    <div class="d-block">
                        <h5 class="card-title">Ricerca ricambio</h5>
                    </div>
                </div>

                <form method="get" action="prodotti-gst.php" enctype="multipart/form-data">

                    <div class="form-row">

                        <div class="col-md-3 mb-3">
                            <label for="md_tipo">Tipo veicolo</label>
                            <select class="form-control" id="md_tipo" name="pr_tipo" onchange="getModelli();">
                                <option value="">Seleziona il tipo del veicolo</option>
                                <option value=""></option>
                                <option value="Automobile" selected>Automobile</option>
                                <option value="Motociclo">Motociclo</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="mr_id">Marca</label>
                            <select class="form-control" id="mr_id" name="pr_mr_id" onchange="getModelli();">
                                <option value="">Seleziona una marca</option>
                                <option value=""></option>
                                <?php selectMarcheProdotti("", $dbConn) ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="md_id">Modello</label>
                            <select class="form-control" id="md_id" name="pr_md_id">
                                <option value="">Seleziona un modello</option>
                                <option value=""></option>
                                <?php //selectModelliProdotti("", $dbConn) ?>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="pr_nome">Nome</label>
                            <input type="text" class="form-control" id="pr_nome" name="pr_nome" value="<?php echo $get_pr_nome; ?>" autocomplete="off">
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Cerca</button>

                </form>

            </div>
        </div>
    </div>

    <!--
    <div class="col-xl-4 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="card-title">Gestione rapida ordini</h5>
                <h4><a class='btn btn-secondary w-100' href='ordini-gst.php'>Lista completa</a></h4>
                <h4><a class='btn btn-info w-100' href='ordini-storico-gst.php'>Storico</a></h4>
                <h4><a class='btn btn-warning w-100' href='ordini-archivio-gst.php'>Archivio</a></h4>
            </div>
        </div>
    </div>
    -->

</div>