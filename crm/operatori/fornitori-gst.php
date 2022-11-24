<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_fr_ragione_sociale = isset($_GET['fr_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_ragione_sociale']))) : "";
    $get_fr_email = isset($_GET['fr_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_email']))) : "";
    $get_fr_provincia = isset($_GET['fr_provincia']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_provincia']))) : "";
    $get_fr_comune = isset($_GET['fr_comune']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_comune']))) : "";
    $get_fr_cod_fiscale = isset($_GET['fr_cod_fiscale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_cod_fiscale']))) : "";
    $get_fr_partita_iva = isset($_GET['fr_partita_iva']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['fr_partita_iva']))) : "";
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
                                <h4 class="mb-0"> Gestione fornitori </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione fornitori</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra fornitori</h5>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="fr_ragione_sociale">Ragione sociale</label>
                                                <input type="text" name="fr_ragione_sociale" class="form-control" value="<?php echo $get_fr_ragione_sociale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_email">Email</label>
                                                <input name="fr_email" id="fr_email" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_fr_email; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_cod_fiscale">Codice fiscale</label>
                                                <input type="text" class="form-control" id="fr_cod_fiscale" name="fr_cod_fiscale" placeholder="Codice fiscale"
                                                       value="<?php echo $get_fr_cod_fiscale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="fr_partita_iva">Partita IVA</label>
                                                <input type="text" class="form-control" id="fr_partita_iva" name="fr_partita_iva" placeholder="Partita IVA"
                                                       value="<?php echo $get_fr_partita_iva; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia</label>
                                                <select class="form-control" id="provincia" name="fr_provincia" onchange="getCitta();">
                                                    <option value="">Filtra per provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince($get_fr_provincia, "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Comune</label>
                                                <select class="form-control" id="citta" name="fr_comune">
                                                    <option value="">Filtra per comune</option>
                                                    <option value=""></option>
                                                    <?php selectComuni($get_fr_comune, $get_fr_provincia, $dbConn); ?>
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

                                    <h5 class="card-title border-0 pb-0">Lista fornitori</h5>

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
                                                <th>Ragione sociale</th>
                                                <th>Email</th>
                                                <th>Comune / Provincia</th>
                                                <th style="text-align: center;">Stato</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(fr_id) FROM fr_fornitori WHERE fr_id > 0 ";
                                            if(strlen($get_fr_ragione_sociale) > 0) $querySql .= " AND fr_ragione_sociale LIKE '%$get_fr_ragione_sociale%' ";
                                            if(strlen($get_fr_email) > 0) $querySql .= " AND fr_email LIKE '%$get_fr_email%' ";
                                            if(strlen($get_fr_provincia) > 0) $querySql .= " AND fr_provincia = '$get_fr_provincia' ";
                                            if(strlen($get_fr_comune) > 0) $querySql .= " AND fr_comune = '$get_fr_comune' ";
                                            if(strlen($get_fr_cod_fiscale) > 0) $querySql .= " AND fr_cod_fiscale LIKE '%$get_fr_cod_fiscale%' ";
                                            if(strlen($get_fr_partita_iva) > 0) $querySql .= " AND fr_partita_iva LIKE '%$get_fr_partita_iva%' ";
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

                                            $querySql = "SELECT * FROM fr_fornitori WHERE fr_id > 0 ";
                                            if(strlen($get_fr_ragione_sociale) > 0) $querySql .= " AND fr_ragione_sociale LIKE '%$get_fr_ragione_sociale%' ";
                                            if(strlen($get_fr_email) > 0) $querySql .= " AND fr_email LIKE '%$get_fr_email%' ";
                                            if(strlen($get_fr_provincia) > 0) $querySql .= " AND fr_provincia = '$get_fr_provincia' ";
                                            if(strlen($get_fr_comune) > 0) $querySql .= " AND fr_comune = '$get_fr_comune' ";
                                            if(strlen($get_fr_cod_fiscale) > 0) $querySql .= " AND fr_cod_fiscale LIKE '%$get_fr_cod_fiscale%' ";
                                            if(strlen($get_fr_partita_iva) > 0) $querySql .= " AND fr_partita_iva LIKE '%$get_fr_partita_iva%' ";
                                            $querySql .= " ORDER BY fr_ragione_sociale LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $fr_id = $row_data['fr_id'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                                                echo "<td>".$row_data['fr_email']."</td>";
                                                echo "<td>".$row_data['fr_comune']." (".$row_data['fr_provincia'].")</td>";

                                                //Stato
                                                $checked = $row_data['fr_stato'] > 0 ? "checked" : "";
                                                ?>
                                                <td align='center'>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato"
                                                                   title="fornitori-stato-do.php?fr_id=<?php echo $fr_id; ?>" <?php echo $checked;?>><span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <?php

                                                //Gestione
                                                echo "<td align='center'>";
                                                //echo "<button class='btn btn-primary btn-sm modale' data-href='clienti-scheda-modale.php?fr_id=$fr_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='fornitori-mod.php?fr_id=$fr_id' title='Modifica'>modifica</a>&nbsp;";
                                                //echo "<button class='btn btn-danger btn-sm elimina' data-href='fornitori-del-do.php?fr_id=$fr_id'>elimina</button>";
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