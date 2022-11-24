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
    $get_lt_descrizione = isset($_GET['lt_descrizione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['lt_descrizione']))) : "";
    ?>

    <?php
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
                                <h4 class="mb-2"> Lotti - Prodotto: <?php echo $row_data['pr_descrizione']; ?> / <?php echo $row_data['pr_codice']; ?> </h4>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra Lotti</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="lt_codice">Codice</label>
                                                <input type="text" name="lt_codice" id="lt_codice" class="form-control"
                                                       value="<?php echo $get_lt_codice; ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="lt_descrizione">Descrizione</label>
                                                <input name="lt_descrizione" id="lt_descrizione" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_lt_descrizione; ?>">
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

                                    <h5 class="card-title border-0 pb-0">Lista lotti</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Codice lotto</th>
                                                <th>Data lotto</th>
                                                <th>Codice Carico</th>
                                                <th>Allegato Carico</th>
                                                <th>Fornitore</th>
                                                <th>Giacenza</th>
                                                <!--<th style="text-align: center; width: 150px;">Gestione</th>-->
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySqlcount = "SELECT COUNT(lt_id) FROM lt_lotti ";
                                            $querySqlcount .= "INNER JOIN cr_carichi ON lt_lotti.lt_cr_id = cr_carichi.cr_id ";
                                            $querySqlcount .= "INNER JOIN fr_fornitori ON cr_carichi.cr_fr_id = fr_fornitori.fr_id ";
                                            $querySqlcount .= "WHERE lt_pr_id = '$get_pr_id' ";
                                            if(strlen($get_lt_codice) > 0) $querySqlcount .= " AND lt_codice LIKE '%$get_lt_codice%' ";
                                            if(strlen($get_lt_descrizione) > 0) $querySqlcount .= " AND lt_descrizione LIKE '%$get_lt_descrizione%' ";
                                            $result = $dbConn->query($querySqlcount);
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

                                            $querySql  = "SELECT * FROM lt_lotti ";
                                            $querySql .= "INNER JOIN cr_carichi ON lt_lotti.lt_cr_id = cr_carichi.cr_id ";
                                            $querySql .= "INNER JOIN fr_fornitori ON cr_carichi.cr_fr_id = fr_fornitori.fr_id ";
                                            $querySql .= "WHERE lt_pr_id = '$get_pr_id' ";
                                            $querySql .= "ORDER BY lt_timestamp DESC ";

                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $pr_id = $row_data['pr_id'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['lt_codice']."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['lt_timestamp'])."</td>";
                                                echo "<td>".$row_data['cr_codice']."</td>";
                                                echo "<td><a href=".$upload_path_dir_carichi."/".$row_data['cr_allegato']." target='_blank'>vedi allegato</a></td>";
                                                echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                                                echo "<td>".$row_data['lt_quantita']." $pr_um</td>";


                                                //Gestione
                                                //echo "<td align='center'>";
                                                //echo "<a class='btn btn-primary btn-sm' href='#' title='Produzione'>produzione</a>&nbsp;";
                                                //echo "</td>";
                                                echo "</tr>";

                                            };

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono lotti</td></tr>";

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

    <script>
        function pageAddFornitore(fr_id, fr_ragione_sociale) {

            window.opener.$("#fr_id").val(fr_id);
            window.opener.$("#fr_ragione_sociale").val(fr_ragione_sociale);
            window.close();

        }
    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>