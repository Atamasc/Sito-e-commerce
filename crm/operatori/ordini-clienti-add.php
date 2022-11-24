<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

        <style>
            .content-wrapper {

                margin-left: 0!important;

            }
        </style>

    </head>

    <body>

    <?php
    //$get_cc_ct_id = isset($_GET['cc_ct_id']) ? (int)$_GET['cc_ct_id'] : 0;
    $get_cl_ragione_sociale = isset($_GET['cl_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_ragione_sociale']))) : "";
    $get_cl_email = isset($_GET['cl_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_email']))) : "";
    $get_cl_provincia = isset($_GET['cl_provincia']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_provincia']))) : "";
    $get_cl_comune = isset($_GET['cl_comune']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_comune']))) : "";
    $get_cl_cod_fiscale = isset($_GET['cl_cod_fiscale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_cod_fiscale']))) : "";
    $get_cl_partita_iva = isset($_GET['cl_partita_iva']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_partita_iva']))) : "";
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
                                                <label for="cl_ragione_sociale">Ragione sociale</label>
                                                <input type="text" name="cl_ragione_sociale" class="form-control" value="<?php echo $get_cl_ragione_sociale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_email">Email</label>
                                                <input name="cl_email" id="cl_email" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_cl_email; ?>">
                                            </div>

                                            <!--
                                            <div class="col-md-3 mb-3">
                                                <label for="cl_cod_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="cl_cod_fiscale" name="cl_cod_fiscale" placeholder="Codice fiscale"
                                                       value="<?php echo $get_cl_cod_fiscale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="cl_partita_iva" name="cl_partita_iva" placeholder="Partita IVA"
                                                       value="<?php echo $get_cl_partita_iva; ?>">
                                            </div>
                                            -->

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia</label>
                                                <select class="form-control" id="provincia" name="cl_provincia" onchange="getCitta();">
                                                    <option value="">Filtra per provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince($get_cl_provincia, "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Comune</label>
                                                <select class="form-control" id="citta" name="cl_comune">
                                                    <option value="">Filtra per comune</option>
                                                    <option value=""></option>
                                                    <?php selectComuni($get_cl_comune, $get_cl_provincia, $dbConn); ?>
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
                                            $querySql = "SELECT COUNT(cl_id) FROM cl_clienti WHERE cl_id > 0 ";
                                            if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                            if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                            if(strlen($get_cl_provincia) > 0) $querySql .= " AND cl_provincia = '$get_cl_provincia' ";
                                            if(strlen($get_cl_comune) > 0) $querySql .= " AND cl_comune = '$get_cl_comune' ";
                                            if(strlen($get_cl_cod_fiscale) > 0) $querySql .= " AND cl_cod_fiscale LIKE '%$get_cl_cod_fiscale%' ";
                                            if(strlen($get_cl_partita_iva) > 0) $querySql .= " AND cl_partita_iva LIKE '%$get_cl_partita_iva%' ";
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

                                            $querySql = "SELECT * FROM cl_clienti WHERE cl_id > 0 ";
                                            if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                            if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                            if(strlen($get_cl_provincia) > 0) $querySql .= " AND cl_provincia = '$get_cl_provincia' ";
                                            if(strlen($get_cl_comune) > 0) $querySql .= " AND cl_comune = '$get_cl_comune' ";
                                            if(strlen($get_cl_cod_fiscale) > 0) $querySql .= " AND cl_cod_fiscale LIKE '%$get_cl_cod_fiscale%' ";
                                            if(strlen($get_cl_partita_iva) > 0) $querySql .= " AND cl_partita_iva LIKE '%$get_cl_partita_iva%' ";
                                            $querySql .= " ORDER BY cl_ragione_sociale LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $cl_id = $row_data['cl_id'];
                                                $cl_codice = $row_data['cl_codice'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                                                echo "<td>".$row_data['cl_telefono']."</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-orange btn-sm' href='ordini-prodotti-add.php?cl_codice=$cl_codice&or_timestamp=".time()."&or_tipo=distribuzione' title='Ordini'><i class='fas fa-arrow-alt-right'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";

                                                echo "<tr>";
                                                echo "<td colspan='99'>".
                                                    "<p class='font-bold'>Indirizzo</p>".$row_data['cl_indirizzo'].", ".$row_data['cl_comune']." (".$row_data['cl_provincia'].")</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche presenti</td></tr>";
                                            }

                                            $result->close();

                                            $paginazione = "";

                                            $varget = "?";
                                            foreach ($_GET as $k => $v)
                                                if($k != 'page') $varget .= "&$k=$v";

                                            for ($i = $current_page - 5; $i <= $current_page + 5; $i++) {

                                                if($i < 1 || $i > $tot_pages) continue;

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