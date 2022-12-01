<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_ci_id = isset($_GET['ci_id']) ? (int)$_GET['ci_id'] : 0;
    $get_ci_titolo = isset($_GET['ci_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ci_titolo']))) : "";
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
                                <h4 class="mb-0"> Gestione spedizionieri </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione spedizionieri</li>
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

                                        <h5 class="card-title">Filtra spedizionieri</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Titolo</label>
                                                <input type="text" name="ci_titolo" class="form-control" value="<?php echo $get_ci_titolo; ?>">
                                                <span class="tooltips">Titolo Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Spedizioniere" data-content="Inserisci qui il titolo dello spedizioniere che stai cercando">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a href="spedizionieri-add.php" class="btn btn-success">Aggiungi spedizioniere</a>
                                        <a href="spedizionieri-utenti-do.php" class="btn btn-orange">Genera CSV clienti</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista spedizionieri</h5>

                                    <?php
                                    if (@$_GET['delete'] == 'true') {

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
                                                <th width="40">ID</th>
                                                <th>Titolo</th>
                                                <th>Costo Spedizione Standard</th>
                                                <th>Costo Spedizione Espressa</th>
                                                <th>Costo Spedizione Estera</th>
                                                <th style="text-align: center;" width="200">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ci_id) FROM ci_corrieri WHERE ci_id > 0 ";
                                            if (strlen($get_ci_titolo) > 0) $querySql .= " AND ci_titolo LIKE '%$get_ci_titolo%' ";
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

                                            $querySql = "SELECT * FROM ci_corrieri WHERE ci_id > 0 ";
                                            if (strlen($get_ci_titolo) > 0) $querySql .= " AND ci_titolo LIKE '%$get_ci_titolo%' ";
                                            $querySql .= " ORDER BY ci_titolo LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ci_id = $row_data['ci_id'];
                                                $ci_titolo = $row_data['ci_titolo'];
                                                $ci_costo_standard = $row_data['ci_costo_standard'];
                                                $ci_costo_espressa = $row_data['ci_costo_espressa'];
                                                $ci_costo_estera = $row_data['ci_costo_estera'];

                                                //echo "<br>".$ci_costo_standard;
                                                //echo "<br>".number_format($ci_costo_standard, 2, ",", ".");

                                                echo "<tr>";
                                                echo "<td>$ci_id</td>";
                                                echo "<td>$ci_titolo</td>";
                                                echo "<td>" . formatPrice($ci_costo_standard) . "&euro;</td>";
                                                echo "<td>" . formatPrice($ci_costo_espressa) . "&euro;</td>";
                                                echo "<td>" . formatPrice($ci_costo_estera) . "&euro;</td>";


                                                //Stato
                                                echo "<td align='center'>";
                                                if ($row_data['ci_stato'] == 0) { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="spedizionieri-stato-do.php?ci_id=<?php echo $ci_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="spedizionieri-stato-do.php?ci_id=<?php echo $ci_id; ?>" checked><span></span>
                                                        </label>
                                                    </div>
                                                <?php }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='spedizionieri-mod.php?ci_id=$ci_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='spedizionieri-del-do.php?ci_id=$ci_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono spedizionieri presenti</td></tr>";
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