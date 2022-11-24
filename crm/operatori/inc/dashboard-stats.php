<div class="row">

    <?php
    $count_clienti = countClienti($dbConn);
    ?>
    <div class="col-xl-3 col-lg-6 col-md-6 col-6 mb-10">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-danger"><i class="fa fa-user highlight-icon" aria-hidden="true"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <!--<p class="card-text text-dark">Clienti</p>-->
                        <h4><?php echo $count_clienti; ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top font-bold">Clienti</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-6 mb-10">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                  <span class="text-warning">
                    <i class="fas fa-box highlight-icon" aria-hidden="true"></i>
                  </span>
                    </div>
                    <div class="float-right text-right">
                        <!--<p class="card-text text-dark">Prodotti</p>-->
                        <h4><?php echo countProdotti($dbConn);?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top font-bold">Prodotti</p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-6 mb-10">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                  <span class="text-success">
                    <i class="fa fa-store-alt highlight-icon" aria-hidden="true"></i>
                  </span>
                    </div>
                    <div class="float-right text-right">
                        <!--<p class="card-text text-dark">Ordini evasi</p>-->
                        <h4><?php echo countOrdiniEvasiOggi($session_id); ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top font-bold">Ordini evasi oggi</p>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-6 mb-10">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                  <span class="text-primary">
                    <i class="fa fa-box-check highlight-icon" aria-hidden="true"></i>
                  </span>
                    </div>
                    <div class="float-right text-right">
                        <!--<p class="card-text text-dark">Operatori</p>-->
                        <h4><?php echo countProdottiOperatore($session_id); ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top font-bold">Prodotti caricati</p>
            </div>
        </div>
    </div>

</div>