<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_rc_voto = isset($_GET['rc_voto']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['rc_voto']))) : "";
    $get_rc_cl_codice = isset($_GET['rc_cl_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['rc_cl_codice']))) : "";
    $get_rc_pr_codice = isset($_GET['rc_pr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['rc_pr_codice']))) : "";

    ?>

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
                                <h4 class="mb-0"> Gestione recensioni </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione recensioni</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra recensioni</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="rc_cl_codice">Cliente</label>
                                                <select class="form-control" id="cl_codice" name="rc_cl_codice">
                                                    <option value="">Seleziona un cliente</option>
                                                    <option value=""></option>
                                                    <?php selectCliente($get_rc_cl_codice, $dbConn) ?>
                                                </select>
                                                <span class="tooltips">Cliente Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Cliente Recensione" data-content="Seleziona qui il nome del cliente che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="rc_pr_codice">Prodotto</label>
                                                <select class="form-control" id="pr_codice" name="rc_pr_codice">
                                                    <option value="">Seleziona un prodotto</option>
                                                    <option value=""></option>
                                                    <?php selectProdotto($get_rc_pr_codice, $dbConn) ?>
                                                </select>
                                                <span class="tooltips">Prodotto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Prodotto Recensione" data-content="Seleziona qui il titolo del prodotto che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-1 mb-3">
                                                <label>Voto recensione</label>
                                                <input type="text" name="rc_voto" class="form-control" value="<?php echo $get_rc_voto; ?>">
                                                <span class="tooltips">Voto Recensione <a tabindex="0" class="popup-a" role="button" data-toggle="popover" data-trigger="focus" title="Voto Recensione" data-content="Inserisci qui il voto della recensione che stai cercando">[aiuto]</a></span>
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

                                    <h5 class="card-title border-0 pb-0">Lista recensioni</h5>

                                    <?php
                                    if(@$_GET['delete'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Eliminazione avvenuta con successo.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Cliente</th>
                                                <th>Prodotto</th>
                                                <th>Voto</th>
                                                <th>Data</th>
                                                <th style="text-align: center; width: 150px;">Stato</th>
                                                <th style="text-align: center; width: 250px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(rc_id) FROM rc_recensioni INNER JOIN cl_clienti ON cl_codice=rc_cl_codice INNER JOIN pr_prodotti ON pr_codice=rc_pr_codice  WHERE rc_id > 0 ";
                                            if(strlen($get_rc_cl_codice) > 0) $querySql .= " AND rc_cl_codice LIKE '%$get_rc_cl_codice%' ";
                                            if(strlen($get_rc_pr_codice) > 0) $querySql .= " AND rc_pr_codice LIKE '%$get_rc_pr_codice%' ";
                                            if(strlen($get_rc_voto) > 0) $querySql .= " AND rc_voto = '$get_rc_voto' ";
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


                                            $querySql = "SELECT * FROM rc_recensioni INNER JOIN cl_clienti ON cl_codice=rc_cl_codice INNER JOIN pr_prodotti ON pr_codice=rc_pr_codice WHERE rc_id > 0 ";
                                            if(strlen($get_rc_cl_codice) > 0) $querySql .= " AND rc_cl_codice LIKE '%$get_rc_cl_codice%' ";
                                            if(strlen($get_rc_pr_codice) > 0) $querySql .= " AND rc_pr_codice LIKE '%$get_rc_pr_codice%' ";
                                            if(strlen($get_rc_voto) > 0) $querySql .= " AND rc_voto = '$get_rc_voto' ";
                                            $querySql .= " ORDER BY rc_id LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $rc_id = $row_data['rc_id'];
                                                $cl_id = $row_data['cl_id'];
                                                $pr_id = $row_data['pr_id'];

                                                echo "<tr>";
                                                echo "<td>$rc_id</td>";
                                                echo "<td>" . $row_data['cl_nome'] . "</td>";
                                                echo "<td>" . $row_data['pr_titolo'] . "</td>";
                                                echo "<td>" . $row_data['rc_voto'] ."</td>";
                                                echo "<td>" . date("d/m/Y", $row_data['rc_timestamp']) ."</td>";

                                                //Stato
                                                echo "<td align='center'>";
                                                if ($row_data['rc_stato'] == 0) {

                                                    ?>
                <div class="checkbox checbox-switch switch-success">
                    <label>
                        <input type="checkbox" class="stato"
                               title="recensioni-stato-do.php?rc_id=<?php echo $rc_id; ?>"><span></span>
                    </label>
                </div>
                                                    <?php

                                                } else {

                                                    ?>
                <div class="checkbox checbox-switch switch-success">
                    <label>
                        <input type="checkbox" class="stato"
                               title="recensioni-stato-do.php?rc_id=<?php echo $rc_id; ?>"
                               checked><span></span>
                    </label>
                </div>
                                                    <?php
                                                }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='recensioni-mod.php?rc_id=$rc_id' title='Modifica anagrafica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='recensioni-del-do.php?rc_id=$rc_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };


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