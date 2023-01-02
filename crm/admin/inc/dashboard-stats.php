<div class="row">

    <?php
    $count_clienti = countClienti($dbConn);
    ?>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <span class="text-danger"><i class="fas fa-users highlight-icon" aria-hidden="true"></i></span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">Clienti</p>
                        <h4><?php echo $count_clienti; ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    <a href="utenti-gst.php">Gestisci i clienti</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                  <span class="text-warning">
                    <i class="fas fa-file highlight-icon" aria-hidden="true"></i>
                  </span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">Prodotti</p>
                        <h4><?php echo countProdotti($dbConn); ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    <a href="prodotti-gst.php">Gestisci i prodotti</a>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                  <span class="text-success">
                    <i class="fas fa-box-check highlight-icon" aria-hidden="true"></i>
                  </span>
                    </div>
                    <div class="float-right text-right">
                        <p class="card-text text-dark">Ordini</p>
                        <h4><?php echo countOrdini(); ?></h4>
                    </div>
                </div>
                <p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                    <b><?php echo countOrdiniEvasi(); ?></b>
                    <a href="ordini-gst.php?or_stato=1" title="Ordini Evasi" style="color: #257BEB;">Evasi</a> |
                    <b><?php echo countOrdiniSospesi(); ?></b>
                    <a href="ordini-gst.php?or_stato_pagamento=0" title="Ordini non pagati" style="color: #257BEB;">Sospesi (Non Pagati)</a> |
                    <a href="ordini-gst.php" title="Tutti gli ordini" style="color: #17a2b8;">Vedi tutti</a>
                </p>
                <!--<p class="text-muted pt-3 mb-0 mt-2 border-top">
                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i> <a href="ordini-gst.php">Gestisci gli ordini</a>
                </p>-->
            </div>
        </div>
    </div>

    <!--    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">-->
    <!--        <div class="card card-statistics h-100">-->
    <!--            <div class="card-body">-->
    <!--                <div class="clearfix">-->
    <!--                    <div class="float-left">-->
    <!--                  <span class="text-primary">-->
    <!--                    <i class="fas fa-calculator-alt highlight-icon" aria-hidden="true"></i>-->
    <!--                  </span>-->
    <!--                    </div>-->
    <!--                    <div class="float-right text-right">-->
    <!--                        <p class="card-text text-dark">Totale Ordini</p>-->
    <!--                        --><?php
    //                        $totale_ordini = countTotaleOrdini($dbConn);
    //                        $totale_ordini_pagati = countTotaleOrdiniPagati($dbConn);
    //                        $totale_ordini_sospesi = countTotaleOrdiniSospesi($dbConn);
    //                        $totale_ordini_non_spediti = countTotaleOrdiniNonSpediti($dbConn);
    //                        ?>
    <!--                        <h4>--><?php //echo formatPrice($totale_ordini); ?><!-- &euro;</h4>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <p class="text-muted pt-3 mb-0 mt-2 border-top">-->
    <!--                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>-->
    <!--                    <b>--><?php //echo formatPrice($totale_ordini_pagati); ?><!--</b> &euro; Pagati |-->
    <!--                    <b>--><?php //echo formatPrice($totale_ordini_sospesi); ?><!--</b> &euro; Sospesi (Non pagati) |-->
    <!--                    <b>--><?php //echo formatPrice($totale_ordini_non_spediti); ?><!--</b> &euro; Non spediti-->
    <!--                </p>-->
    <!---->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->


</div>