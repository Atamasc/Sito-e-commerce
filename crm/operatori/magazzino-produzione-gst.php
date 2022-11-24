<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>
            .content-wrapper {

                margin-left: 0!important;

            }
        </style>

    </head>

    <body>

    <?php
    $get_pr_id = (int)$_GET['pr_id'];
    $get_lt_codice = isset($_GET['lt_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['lt_codice']))) : "";

    $querySql = "SELECT * FROM pr_prodotti WHERE pr_id = $get_pr_id";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $result->close();

    $pr_um = $row_data['pr_um'];
    ?>

    <div class="wrapper">
        <!--================================= preloader -->
        <div id="pre-loader">
            <img src="../images/pre-loader/loader-01.svg" alt="">
        </div>
        <!--================================= preloader -->
        <!--================================= Main content -->

        <div class="container-fluid">
            <div class="row">

                <!--================================= Main content -->
                <!--================================= wrapper -->
                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="mb-2"> Produzioni da Rinfusa: <?php echo $row_data['pr_descrizione']; ?> - Codice: <?php echo $row_data['pr_codice']; ?> </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra produzioni</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="lt_codice">Codice lotto</label>
                                                <input type="text" name="lt_codice" id="lt_codice" class="form-control"
                                                       value="<?php echo $get_lt_codice; ?>">
                                            </div>

                                        </div>
                                        <input type="hidden" name="pr_id" value="<?php echo $get_pr_id; ?>" />
                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista produzioni</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Codice lotto</th>
                                                <th>Data lotto</th>
                                                <th>Prodotto finale</th>
                                                <th>Qnt Rinfusa</th>
                                                <th>Qnt Prodotta</th>
                                                <th>Data e ora produzione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            function pageGetInfoProdotto($gl_timestamp) {

                                                global $dbConn;

                                                $querySql  =
                                                    "SELECT pr_descrizione, gl_quantita FROM gl_giacenze_log ".
                                                    "INNER JOIN gi_giacenze ON gi_id = gl_gi_id ".
                                                    "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                    "WHERE gl_timestamp = '$gl_timestamp' AND gl_tipologia = 'Carico da produzione' ";
                                                $result = $dbConn->query($querySql);
                                                list($pr_descrizione, $gl_quantita) = $result->fetch_array();
                                                $result->close();

                                                return array($pr_descrizione, $gl_quantita);

                                            }

                                            $querySql  =
                                                "SELECT COUNT(gl_id) FROM gl_giacenze_log ".
                                                "INNER JOIN gi_giacenze ON gi_id = gl_gi_id ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "WHERE gi_pr_id = '$get_pr_id' AND gl_tipologia = 'Scarico da produzione' ";
                                            if(strlen($get_lt_codice) > 0) $querySql .= " AND lt_codice = '".$get_lt_codice."' ";
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();

                                            // numero totale del count
                                            $row_cnt = $row[0];
                                            // risultati per pagina(secondo parametro di LIMIT)
                                            $per_page = 30;
                                            // numero totale di pagine
                                            $tot_pages = ceil($row_cnt / $per_page);
                                            // pagina corrente
                                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                            // primo parametro di LIMIT
                                            $primo = ($current_page - 1) * $per_page;

                                            $querySql  =
                                                "SELECT * FROM gl_giacenze_log ".
                                                "INNER JOIN gi_giacenze ON gi_id = gl_gi_id ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "WHERE gi_pr_id = '$get_pr_id' AND gl_tipologia = 'Scarico da produzione' ";
                                            if(strlen($get_lt_codice) > 0) $querySql .= " AND lt_codice = '".$get_lt_codice."' ";
                                            $querySql .= "ORDER BY gl_timestamp DESC ";

                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                list($pr_descrizione_prod,$gl_quantita_prod) = pageGetInfoProdotto($row_data['gl_timestamp']);

                                                echo "<tr>";
                                                echo "<td>".$row_data['lt_codice']."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['lt_timestamp'])."</td>";
                                                echo "<td>$pr_descrizione_prod</td>";
                                                echo "<td>".$row_data['gl_quantita']." Kg</td>";
                                                echo "<td>$gl_quantita_prod pz</td>";
                                                echo "<td>".date("d/m/Y H:i", $row_data['gl_timestamp'])."</td>";

                                                echo "</tr>";

                                            };

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono produzione per questa rinfusa</td></tr>";

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
                                        <div class="col-md-6">
                                            <div class="text-center text-md-left">
                                                Pagine totali: <?php echo $tot_pages; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
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