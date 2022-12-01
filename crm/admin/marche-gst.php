<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_mr_id = isset($_GET['mr_id']) ? (int)$_GET['mr_id'] : 0;
    $get_mr_titolo = isset($_GET['mr_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['mr_titolo']))) : "";
    $get_mr_codice = isset($_GET['mr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['mr_codice']))) : "";
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
                                <h4 class="mb-0"> Gestione marche </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione marche</li>
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

                                        <h5 class="card-title">Filtra marche</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Titolo</label>
                                                <input type="text" name="mr_titolo" class="form-control" value="<?php echo $get_mr_titolo; ?>">
                                                <span class="tooltips">Nome Marca <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Marca" data-content="Inserisci qui il nome della marca che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label>Codice</label>
                                                <input type="text" name="mr_codice" class="form-control" value="<?php echo $get_mr_codice; ?>">
                                                <span class="tooltips">Codice Marca <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Marca" data-content="Inserisci qui il codice della marca che stai cercando">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a href="marche-add.php" class="btn btn-success">Aggiungi marca</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista marche</h5>

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
                                                <th>Marca</th>
                                                <th>Codice</th>
                                                <th>N. Prodotti</th>
                                                <th style="text-align: center;" width="200">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(mr_id) FROM mr_marche WHERE mr_id > 0 ";
                                            if (strlen($get_mr_titolo) > 0) $querySql .= " AND mr_titolo LIKE '%$get_mr_titolo%' ";
                                            if (strlen($get_mr_codice) > 0) $querySql .= " AND mr_codice LIKE '%$get_mr_codice%' ";
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

                                            $querySql = "SELECT * FROM mr_marche WHERE mr_id > 0 ";
                                            if (strlen($get_mr_titolo) > 0) $querySql .= " AND mr_titolo LIKE '%$get_mr_titolo%' ";
                                            if (strlen($get_mr_codice) > 0) $querySql .= " AND mr_codice LIKE '%$get_mr_codice%' ";
                                            $querySql .= " ORDER BY mr_titolo LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $mr_id = $row_data['mr_id'];

                                                echo "<tr>";
                                                echo "<td>$mr_id</td>";
                                                echo "<td>" . $row_data['mr_titolo'] . "</td>";
                                                echo "<td>" . $row_data['mr_codice'] . "</td>";
                                                echo "<td><a style='text-decoration: underline; color: #0c5460;' href='prodotti-gst.php?pr_mr_id=$mr_id'>" . countProdottiMarca($mr_id, $dbConn) . "</a></td>";

                                                //Stato
                                                echo "<td align='center'>";
                                                if ($row_data['mr_stato'] == 0) { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label> <input type="checkbox" class="stato"
                                                                    title="marche-stato-do.php?mr_id=<?php echo $mr_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label> <input type="checkbox" class="stato"
                                                                    title="marche-stato-do.php?mr_id=<?php echo $mr_id; ?>"
                                                                    checked><span></span> </label>
                                                    </div>
                                                <?php }
                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='marche-mod.php?mr_id=$mr_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='marche-del-do.php?mr_id=$mr_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono marche presenti</td></tr>";
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