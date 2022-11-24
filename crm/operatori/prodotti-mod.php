<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <?php
    $get_pr_id = isset($_GET['pr_id']) ? (int)$_GET['pr_id'] : 0;

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = '$get_pr_id'  ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    ?>

    <body>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="mb-0"> Modifica prodotto</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="prodotti-gst.php" class="default-color">Gestione prodotti</a></li>
                                    <li class="breadcrumb-item active">Modifica prodotti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="prodotti-mod-do.php">

                                        <?php
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
                                        ?>

                                        <div class="form-row">
                                            <div class="col-md-1 mb-3">
                                                <label for="pr_codice">Codice *</label>
                                                <input type="text" class="form-control" id="pr_codice" name="pr_codice" value="<?php echo $row_data['pr_codice']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_barcode">Barcode *</label>
                                                <input type="text" class="form-control" id="pr_barcode" name="pr_barcode" value="<?php echo $row_data['pr_barcode']; ?>" required>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label for="pr_iva">Iva *</label>
                                                <input type="text" class="form-control pattern-price" id="pr_iva" name="pr_iva" value="<?php echo $row_data['pr_iva']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="pr_descrizione">Titolo *</label>
                                                <input type="text" class="form-control" id="pr_descrizione" name="pr_descrizione" value="<?php echo $row_data['pr_descrizione']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_ct_id">Categoria *</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="pr_ct_id" id="pr_ct_id" class="medium">
                                                        <option value="">[Seleziona categoria]</option>
                                                        <option value=""></option>
                                                        <?php selectCategorie($row_data['pr_ct_id'], $dbConn); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo_acquisto">Prezzo acquisto (Es formato: 5.70 ) *</label>
                                                <input type="text" class="form-control" id="pr_prezzo_acquisto" name="pr_prezzo_acquisto" placeholder="Solo numeri e punti (vedi formato)" value="<?php echo strlen(@$row_data['pr_prezzo_acquisto']) > 0 ? formatPrice(@$row_data['pr_prezzo_acquisto']) : ""; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_prezzo_vendita">Prezzo vendita (Es formato: 5.70 ) *</label>
                                                <input type="text" class="form-control" id="pr_prezzo_vendita" name="pr_prezzo_vendita" placeholder="Solo numeri e punti (vedi formato)" value="<?php echo strlen(@$row_data['pr_prezzo_vendita']) > 0 ? formatPrice(@$row_data['pr_prezzo_vendita']) : ""; ?>" required>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="pr_um">Unita di misura *</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="pr_um" id="pr_um">
                                                        <option value="">[Seleziona unita di misura]</option>
                                                        <option value=""></option>
                                                        <option value="pz" <?php if ($row_data['pr_um'] == 'pz') echo "selected" ?>>Pezzi</option>
                                                        <option value="kg" <?php if ($row_data['pr_um'] == 'kg') echo "selected" ?>>KG</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="pr_tipologia">Tipologia *</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="pr_tipologia" id="pr_tipologia">
                                                        <option value="">[Seleziona la tipologia]</option>
                                                        <option value=""></option>
                                                        <option value="Rinfusa" <?php if ($row_data['pr_tipologia'] == 'Rinfusa') echo "selected" ?>>Rinfusa</option>
                                                        <option value="Produzione" <?php if ($row_data['pr_tipologia'] == 'Produzione') echo "selected" ?>>Produzione</option>
                                                        <option value="Semplice" <?php if ($row_data['pr_tipologia'] == 'Semplice') echo "selected" ?>>Semplice</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="pr_id" value="<?php echo $get_pr_id; ?>">
                                        <button class="btn btn-primary mt-2" type="submit">Modifica</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>

                    <!--================================= wrapper -->

                    <!--================================= footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>