<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

    </head>

    <?php
    $get_rc_id = isset($_GET['rc_id']) ? (int)$_GET['rc_id'] : 0;
    //$get_ut_id = isset($_GET['ut_id']) ? (int)$_GET['ut_id'] : 0;
    //$get_pr_id = isset($_GET['pr_id']) ? (int)$_GET['pr_id'] : 0;

    $querySql = "SELECT * FROM rc_recensioni WHERE rc_id = '$get_rc_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();

    $ut_codice = $row_data['rc_ut_codice'];
    $pr_codice = $row_data['rc_pr_codice'];

    $querySql2 = "SELECT ut_nome FROM ut_utenti  WHERE ut_codice = '$ut_codice'";
    $result2 = $dbConn->query($querySql2);
    $rows = $dbConn->affected_rows;
    $row_data2 = $result2->fetch_assoc();

    $nome = $row_data2['ut_nome'];

    $querySql3 = "SELECT pr_titolo FROM pr_prodotti  WHERE pr_codice = '$pr_codice'";
    $result3 = $dbConn->query($querySql3);
    $rows = $dbConn->affected_rows;
    $row_data3 = $result3->fetch_assoc();

    $titolo = $row_data3['pr_titolo'];

    $result->close();
    $result2->close();
    $result3->close();

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
                                <h4 class="mb-0"> Modifica recensione</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="preventivi-gst.php" class="default-color">Gestione recensioni</a></li>
                                    <li class="breadcrumb-item active">Modifica recensione</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="recensioni-mod-do.php" enctype="multipart/form-data">

                                        <?php include "../inc/alerts.php"; ?>

                                        <div class="form-row">


                                            <div class="col-md-3 mb-3">
                                                <label for="rc_ut_codice">Cliente *</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ut_nome" value="<?php echo $nome; ?>" readonly required>

                                                    <input type="hidden" id="ut_codice" name="rc_ut_codice" value="<?php echo @$row_data['rc_ut_codice']; ?>">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="recensioni-utenti-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Cliente Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Cliente Recensione" data-content="Associa qui il nome dell'utente a cui è riferita la recensione">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-3 mb-3">
                                                <label for="rc_pr_id">Prodotto *</label>

                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="pr_titolo" value="<?php echo $titolo; ?>" readonly required>

                                                    <input type="hidden" id="pr_id" name="rc_pr_id" value="<?php echo @$row_data['rc_pr_id']; ?>">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="recensioni-prodotti-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>
                                                <span class="tooltips">Prodotto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prodotto Recensione" data-content="Associa qui il titolo del prodotto a cui è riferita la recensione">[aiuto]</a></span>
                                            </div>


                                            <div class="col-md-2 mb-3">
                                                <label for="rc_voto">Voto *</label>
                                                <select class="form-control" id="rc_voto" name="rc_voto" required>
                                                    <option value="">Seleziona un voto</option>
                                                    <option value=""></option>
                                                    <option value="1" <?php echo @$row_data['rc_voto'] == "1" ? "selected" : ""; ?>>1 stella</option>
                                                    <option value="2" <?php echo @$row_data['rc_voto'] == "2" ? "selected" : ""; ?>>2 stelle</option>
                                                    <option value="3" <?php echo @$row_data['rc_voto'] == "3" ? "selected" : ""; ?>>3 stelle</option>
                                                    <option value="4" <?php echo @$row_data['rc_voto'] == "4" ? "selected" : ""; ?>>4 stelle</option>
                                                    <option value="5" <?php echo @$row_data['rc_voto'] == "5" ? "selected" : ""; ?>>5 stelle</option>
                                                </select>
                                                <span class="tooltips">Voto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Voto Recensione" data-content="Seleziona il voto della recensione">[aiuto]</a></span>
                                            </div>

                                        </div>


                                        <div class="form-row">

                                            <div class="col-md-5 mb-3">
                                                <label for="rc_descrizione">Descrizione</label>
                                                <textarea class="form-control" id="rc_descrizione" name="rc_descrizione" rows="10" placeholder="Descrizione"><?php echo @$row_data['rc_testo'] ?></textarea>
                                                <span class="tooltips">Descrizione Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Recensione" data-content="Inserisci qui la descrizione della recensione che vuoi aggiungere">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <input type="hidden" name="rc_id" value="<?php echo $get_rc_id; ?>">

                                        <button class="btn btn-primary" type="submit">Modifica</button>

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

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>