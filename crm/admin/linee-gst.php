<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_pr_fm_codice = isset($_GET['pr_fm_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_fm_codice']))) : "";
    $get_pr_codice_marche = isset($_GET['pr_codice_marche']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_codice_marche']))) : "";
    $get_pr_codice_linea = isset($_GET['pr_codice_linea']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_codice_linea']))) : "";
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
                                <h4 class="mb-0"> Gestione catalogo
                                    <i class="fas fa-chevron-double-right"></i> Lista linee
                                </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Lista linee</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">
                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra prodotti</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_fm_codice">Famiglia</label>
                                                <select class="form-control" id="pr_fm_codice" name="pr_fm_codice">
                                                    <option value="">Filtra per famiglia</option>
                                                    <option value=""></option>
                                                    <?php selectFamiglie($get_pr_fm_codice); ?>
                                                </select>
                                                <span class="tooltips">Famiglia Linea Prodotti <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Famiglia Linea Prodotti" data-content="Inserisci qui la Famiglia della line di prodotti che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_marche">Marca</label>
                                                <select class="form-control" id="pr_codice_marche" name="pr_codice_marche">
                                                    <option value="">Filtra per marca</option>
                                                    <option value=""></option>
                                                    <?php selectMarca($get_pr_codice_marche); ?>
                                                </select>
                                                <span class="tooltips">Marca Linea Prodotti <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Marca Linea Prodotti" data-content="Inserisci qui la marca della linea di prodotti che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_codice_linea">Linea</label>
                                                <select class="form-control" id="pr_codice_linea" name="pr_codice_linea">
                                                    <option value="">Filtra per linea</option>
                                                    <option value=""></option>
                                                    <?php selectLinea($get_pr_codice_linea); ?>
                                                </select>
                                                <span class="tooltips">Nome Linea Prodotti<a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Linea Prodotti" data-content="Inserisci qui il nome della linea di prodotti che stai cercando">[aiuto]</a></span>
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

                                    <h5 class="card-title border-0 pb-0">Lista linee</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Codice</th>
                                                <th>Descrizione</th>
                                                <th>Marca</th>
                                                <th>Prodotti</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(DISTINCT pr_codice_linea) FROM pr_prodotti WHERE LENGTH(pr_codice_linea) > 0 ";
                                            if (strlen($get_pr_fm_codice) > 0) $querySql .= " AND pr_fm_codice = '$get_pr_fm_codice' ";
                                            if (strlen($get_pr_codice_marche) > 0) $querySql .= " AND pr_codice_marche = '$get_pr_codice_marche' ";
                                            if (strlen($get_pr_codice_linea) > 0) $querySql .= " AND pr_codice_linea = '$get_pr_codice_linea' ";
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();

                                            // numero totale del count
                                            $row_cnt = $row[0];
                                            // risultati per pagina(secondo parametro di LIMIT)
                                            $per_page = 100;
                                            // numero totale di pagine
                                            $tot_pages = ceil($row_cnt / $per_page);
                                            // pagina corrente
                                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                            // primo parametro di LIMIT
                                            $primo = ($current_page - 1) * $per_page;

                                            $querySql =
                                                "SELECT DISTINCT pr_codice_linea, pr_descrizione_linea, pr_descrizione_marche FROM pr_prodotti " .
                                                "WHERE LENGTH(pr_codice_linea) > 0 ";
                                            if (strlen($get_pr_fm_codice) > 0) $querySql .= " AND pr_fm_codice = '$get_pr_fm_codice' ";
                                            if (strlen($get_pr_codice_marche) > 0) $querySql .= " AND pr_codice_marche = '$get_pr_codice_marche' ";
                                            if (strlen($get_pr_codice_linea) > 0) $querySql .= " AND pr_codice_linea = '$get_pr_codice_linea' ";
                                            $querySql .= " ORDER BY pr_codice_linea LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $pr_codice_linea = $row_data['pr_codice_linea'];

                                                echo "<tr>";
                                                echo "<td>" . $row_data['pr_codice_linea'] . "</td>";
                                                echo "<td>" . $row_data['pr_descrizione_linea'] . "</td>";
                                                echo "<td>" . $row_data['pr_descrizione_marche'] . "</td>";
                                                echo "<td>" . countProdottiLinea($pr_codice_linea, $dbConn) . "</td>";
                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-primary btn-sm popup-custom' data-pop-width='1200' href='javascript:;' data-href='linee-specifiche.php?pr_codice_linea=$pr_codice_linea' title='Dettaglio'>specifiche</a>&nbsp;";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono linee</td></tr>";

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