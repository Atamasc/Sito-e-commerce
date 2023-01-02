<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_cr_codice = isset($_GET['cr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_codice']))) : "";
    $get_cr_email = isset($_GET['cr_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_email']))) : "";

    $get_cr_timestamp_da = isset($_GET['cr_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_timestamp_da']))) : "";
    $get_cr_timestamp_a = isset($_GET['cr_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_timestamp_a']))) : "";

    if (strlen($get_cr_timestamp_da) > 0) {

        list($day, $month, $year) = explode("/", $get_cr_timestamp_da);
        $get_cr_timestamp_da = mktime(0, 0, 0, $month, $day, $year);

    }

    if (strlen($get_cr_timestamp_a) > 0) {

        list($day, $month, $year) = explode("/", $get_cr_timestamp_a);
        $get_cr_timestamp_a = mktime(23, 59, 59, $month, $day, $year);

    }
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
                                <h4 class="mb-0"> Gestione carrelli </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione carrelli</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra carrelli</h5>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="cr_codice">Codice cliente</label>
                                                <input name="cr_codice" id="cr_codice" class="form-control" type="text" autocomplete="off"
                                                        value="<?php echo $get_cr_codice; ?>"> <span class="tooltips">Codice Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice CLiente" data-content="Inserisci qui il codice dell'utente associato al carrello che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cr_email">Email</label>
                                                <input name="cr_email" id="cr_email" class="form-control" type="text" autocomplete="off"
                                                        value="<?php echo $get_cr_email; ?>"> <span class="tooltips">Email Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Email CLiente" data-content="Inserisci qui l'email dell'utente associato al del carrello che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cr_data">Data</label>
                                                <div id="data-carrello" class="input-group" data-date="">
                                                    <span class="input-group-addon">Da</span>
                                                    <input name="cr_timestamp_da" class="form-control range-from" type="text" data-date-format="dd/mm/yyyy" autocomplete="off" value="<?php if (strlen($get_cr_timestamp_da) > 0) echo date("d/m/Y", $get_cr_timestamp_da); ?>">
                                                    <span class="input-group-addon">A</span>
                                                    <input name="cr_timestamp_a" class="form-control range-to" type="text" data-date-format="dd/mm/yyyy" autocomplete="off" value="<?php if (strlen($get_cr_timestamp_a) > 0) echo date("d/m/Y", $get_cr_timestamp_a); ?>">
                                                </div>
                                                <span class="tooltips">Data Carrello <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Data Carrello" data-content="Inserisci qui l'intervallo di tempo in cui è stato creato il carrello che stai cercando">[aiuto]</a></span>
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

                                    <h5 class="card-title border-0 pb-0">Lista carrelli</h5>

                                    <?php
                                    if (@$_GET['delete'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Eliminazione avvenuta con successo.
                                        </div>
                                        <?php

                                    }

                                    if (@$_GET['mail'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Mail inviata con successo.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th class="text-right" width="120">Importo</th>
                                                <th class="text-left" width="180">Data</th>
                                                <th class="text-center" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(DISTINCT cr_timestamp) FROM cr_carrello " .
                                                "INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice " .
                                                "LEFT JOIN ut_utenti ON ut_codice = cr_ut_codice WHERE cr_id > 0 ";
                                            if (strlen($get_cr_codice) > 0) $querySql .= " AND cr_ut_codice LIKE '%$get_cr_codice%' ";
                                            if (strlen($get_cr_email) > 0) $querySql .= " AND ut_email LIKE '%$get_cr_email%' ";
                                            if (strlen($get_cr_timestamp_da) > 0) $querySql .= " AND cr_timestamp >= '$get_cr_timestamp_da' ";
                                            if (strlen($get_cr_timestamp_a) > 0) $querySql .= " AND cr_timestamp <= '$get_cr_timestamp_a' ";
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();

                                            // numero totale del count
                                            $row_cnt = $row[0];
                                            // risultati per pagina(secondo parametro di LIMIT)
                                            $per_page = 40;
                                            // numero totale di pagine
                                            $tot_pages = ceil($row_cnt / $per_page);
                                            // pagina corrente
                                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                            // primo parametro di LIMIT
                                            $primo = ($current_page - 1) * $per_page;

                                            $querySql =
                                                "SELECT * FROM cr_carrello " .
                                                "INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice " .
                                                "LEFT JOIN ut_utenti ON ut_codice = cr_ut_codice WHERE cr_id > 0  ";

                                            if (strlen($get_cr_codice) > 0) $querySql .= " AND cr_ut_codice LIKE '%$get_cr_codice%' ";
                                            if (strlen($get_cr_email) > 0) $querySql .= " AND ut_email LIKE '%$get_cr_email%' ";
                                            if (strlen($get_cr_timestamp_da) > 0) $querySql .= " AND cr_timestamp >= '$get_cr_timestamp_da' ";
                                            if (strlen($get_cr_timestamp_a) > 0) $querySql .= " AND cr_timestamp <= '$get_cr_timestamp_a' ";
                                            $querySql .= " ORDER BY cr_timestamp DESC LIMIT $primo, $per_page ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            $i = 1;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $cr_id = $row_data['cr_id'];
                                                $cr_timestamp = $row_data['cr_timestamp'];
                                                $ut_id = $row_data['ut_id'];
                                                $ut_codice = $row_data['ut_codice'];
                                                $pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];
                                                $cr_pr_quantita = $row_data['cr_pr_quantita'];

                                                $cr_totale_importo = $pr_prezzo * $cr_pr_quantita;

                                                //Righe di colore alternato sulla tabella
                                                $stripe_tr_bg = "fff";
                                                $mod_i = $i % 2;
                                                if ($mod_i == 0) $stripe_tr_bg = "#eee";

                                                echo "<tr style='background-color: " . $stripe_tr_bg . "'>";
                                                echo "<td><a style='color: #0881a3; text-decoration: underline;' href='utenti-mod.php?ut_id=$ut_id'>" . $row_data['ut_nome'] . " " . $row_data['ut_cognome'] . "</a> - " . $row_data['ut_email'] . " / " . $row_data['cr_ut_codice'] . "</td>";
                                                echo "<td class='text-right'>&euro; " . formatPrice($cr_totale_importo) . "</td>";
                                                echo "<td class='text-left'>" . date('d/m/Y - H:i', $cr_timestamp) . "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<button class='btn btn-info btn-sm modale' data-href='carrelli-view.php?cr_id=$cr_id' title='Dettaglio'>dettaglio</button>&nbsp;";
//                                                echo $ut_id > 0
//                                                    ? "<a class='btn btn-orange btn-sm btn-cart-mail' href='javascript:;' data-href='carrello-mail-do.php?ut_codice=$ut_codice&cr_id=$cr_id' title='Mail'>mail <i></i></a>&nbsp;"
//                                                    : "<a class='btn btn-orange btn-sm disabled' href='javascript:;' title='Mail'>mail</a>&nbsp;";
//                                                echo "<button class='btn btn-purple btn-sm detail-show'>log <i></i></button>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='carrelli-del-do.php?cr_timestamp=$cr_timestamp' title='Elimina'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                echo "<tr class='prod-detail'>";
                                                echo "<td colspan='7'>";
                                                echo "<table class='details-table'>";
                                                echo "<tr>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Email</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Stato Invio</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Stato Lettura</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Click</th>";
                                                echo "<th colspan='3' style='background-color: #c6c8ca;'>Data e ora invio</th>";
                                                echo "</tr>";


                                                echo "</table>";
                                                echo "</td>";
                                                echo "</tr>";


                                                $i++;

                                            };

                                            if ($rows == '0') {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono carrelli presenti</td></tr>";
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