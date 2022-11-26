<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

        <style>
            .content-wrapper {

                margin-left: 0 !important;

            }
        </style>

    </head>

    <body>

    <?php
    //$get_cc_ct_id = isset($_GET['cc_ct_id']) ? (int)$_GET['cc_ct_id'] : 0;
    $get_ut_ragione_sociale = isset($_GET['ut_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_ragione_sociale']))) : "";
    $get_ut_email = isset($_GET['ut_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_email']))) : "";
    $get_ut_provincia = isset($_GET['ut_provincia']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_provincia']))) : "";
    $get_ut_citta = isset($_GET['ut_citta']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_citta']))) : "";
    $get_ut_cod_fiscale = isset($_GET['ut_cod_fiscale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_cod_fiscale']))) : "";
    $get_ut_partita_iva = isset($_GET['ut_partita_iva']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_partita_iva']))) : "";
    ?>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= header start-->

        <?php //include "inc/header.php"; ?>

        <!--================================= header End-->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">
                <!-- Left Sidebar -->
                <?php //include "inc/sidebar.php"; ?>
                <!-- Left Sidebar End-->

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="mb-2"> Aggiungi ordine: seleziona il cliente </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra clienti</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_ragione_sociale">Ragione sociale</label>
                                                <input type="text" name="ut_ragione_sociale" class="form-control" value="<?php echo $get_ut_ragione_sociale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_email">Email</label>
                                                <input name="ut_email" id="ut_email" class="form-control" type="text" autocomplete="off"
                                                        value="<?php echo $get_ut_email; ?>">
                                            </div>

                                            <!--
                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cod_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="ut_cod_fiscale" name="ut_cod_fiscale" placeholder="Codice fiscale"
                                                       value="<?php echo $get_ut_cod_fiscale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="ut_partita_iva" name="ut_partita_iva" placeholder="Partita IVA"
                                                       value="<?php echo $get_ut_partita_iva; ?>">
                                            </div>
                                            -->

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia</label>
                                                <select class="form-control" id="provincia" name="ut_provincia" onchange="getCitta();">
                                                    <option value="">Filtra per provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince($get_ut_provincia, "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Comune</label>
                                                <select class="form-control" id="citta" name="ut_citta">
                                                    <option value="">Filtra per comune</option>
                                                    <option value=""></option>
                                                    <?php selectComuni($get_ut_citta, $get_ut_provincia, $dbConn); ?>
                                                </select>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista clienti</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Ragione sociale</th>
                                                <th>Telefono</th>
                                                <th style="text-align: center;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ut_id) FROM ut_utenti WHERE ut_id > 0 ";
                                            if (strlen($get_ut_ragione_sociale) > 0) $querySql .= " AND ut_ragione_sociale LIKE '%$get_ut_ragione_sociale%' ";
                                            if (strlen($get_ut_email) > 0) $querySql .= " AND ut_email LIKE '%$get_ut_email%' ";
                                            if (strlen($get_ut_provincia) > 0) $querySql .= " AND ut_provincia = '$get_ut_provincia' ";
                                            if (strlen($get_ut_citta) > 0) $querySql .= " AND ut_citta = '$get_ut_citta' ";
                                            if (strlen($get_ut_cod_fiscale) > 0) $querySql .= " AND ut_cod_fiscale LIKE '%$get_ut_cod_fiscale%' ";
                                            if (strlen($get_ut_partita_iva) > 0) $querySql .= " AND ut_partita_iva LIKE '%$get_ut_partita_iva%' ";
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();

                                            // numero totale del count
                                            $row_cnt = $row[0];
                                            // risultati per pagina(secondo parametro di LIMIT)
                                            $per_page = 20;
                                            // numero totale di pagine
                                            $tot_pages = ceil($row_cnt / $per_page);
                                            // pagina corrente
                                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                            // primo parametro di LIMIT
                                            $primo = ($current_page - 1) * $per_page;

                                            $querySql = "SELECT * FROM ut_utenti WHERE ut_id > 0 ";
                                            if (strlen($get_ut_ragione_sociale) > 0) $querySql .= " AND ut_ragione_sociale LIKE '%$get_ut_ragione_sociale%' ";
                                            if (strlen($get_ut_email) > 0) $querySql .= " AND ut_email LIKE '%$get_ut_email%' ";
                                            if (strlen($get_ut_provincia) > 0) $querySql .= " AND ut_provincia = '$get_ut_provincia' ";
                                            if (strlen($get_ut_citta) > 0) $querySql .= " AND ut_citta = '$get_ut_citta' ";
                                            if (strlen($get_ut_cod_fiscale) > 0) $querySql .= " AND ut_cod_fiscale LIKE '%$get_ut_cod_fiscale%' ";
                                            if (strlen($get_ut_partita_iva) > 0) $querySql .= " AND ut_partita_iva LIKE '%$get_ut_partita_iva%' ";
                                            $querySql .= " ORDER BY ut_ragione_sociale LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ut_id = $row_data['ut_id'];
                                                $ut_codice = $row_data['ut_codice'];

                                                echo "<tr>";
                                                echo "<td>" . $row_data['ut_ragione_sociale'] . "</td>";
                                                echo "<td>" . $row_data['ut_telefono'] . "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-orange btn-sm' href='ordini-prodotti-add.php?ut_codice=$ut_codice&or_timestamp=" . time() . "&or_tipo=distribuzione' title='Ordini'><i class='fas fa-arrow-alt-right'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";

                                                echo "<tr>";
                                                echo "<td colspan='99'>" .
                                                    "<p class='font-bold'>Indirizzo</p>" . $row_data['ut_indirizzo'] . ", " . $row_data['ut_citta'] . " (" . $row_data['ut_provincia'] . ")</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche presenti</td></tr>";
                                            }

                                            $result->close();

                                            $paginazione = "";

                                            $varget = "?";
                                            foreach ($_GET as $k => $v)
                                                if ($k != 'page') $varget .= "&$k=$v";

                                            for ($i = $current_page - 5; $i <= $current_page + 5; $i++) {

                                                if ($i < 1 || $i > $tot_pages) continue;

                                                if ($i == $current_page)
                                                    $paginazione .= "<a href='javascript:;' title='Vai alla pagina $i' class='btn btn-info'>$i</a>";
                                                else
                                                    $paginazione .= "<a href='$varget&page=$i' title='Vai alla pagina $i' class='btn btn-secondary'>$i</a>";
                                            }
                                            ?>

                                            </tbody>
                                        </table>

                                    </div>

                                    <div class="row pt-4">
                                        <div class="col-md-6 col-6">
                                            <div class="text-center text-md-left">
                                                Pagine totali: <?php echo $tot_pages; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6 text-right">
                                            <div class="btn-group mr-2" role="group" aria-label="Paginazione">
                                                <?php echo $paginazione; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <?php include "inc/footer.php"; ?>

                    <!--=================================
                     footer -->
                </div>
            </div>
        </div>
    </div>

    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>