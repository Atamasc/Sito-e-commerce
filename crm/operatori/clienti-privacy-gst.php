<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_py_email = isset($_GET['py_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['py_email']))) : "";

    $get_py_timestamp_da = isset($_GET['py_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['py_timestamp_da']))) : "";
    $get_py_timestamp_a = isset($_GET['py_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['py_timestamp_a']))) : "";

    if(strlen($get_py_timestamp_da) > 0) {

        list($day, $month, $year) = explode("/", $get_py_timestamp_da);
        $get_py_timestamp_da = mktime(0, 0, 0, $month, $day, $year);

    }

    if(strlen($get_py_timestamp_a) > 0) {

        list($day, $month, $year) = explode("/", $get_py_timestamp_a);
        $get_py_timestamp_a = mktime(23, 59, 59, $month, $day, $year);

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
                                <h4 class="mb-0"> Gestione log Privacy</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione log privacy</li>
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

                                        <h5 class="card-title">Filtra log</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="py_email">Email</label>
                                                <input name="py_email" id="py_email" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_py_email; ?>">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Data</label>
                                                <div class="input-group" data-date="">
                                                    <input name="py_timestamp_da" class="form-control range-from" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_py_timestamp_da) > 0) echo date("d/m/Y", $get_py_timestamp_da); ?>">
                                                    <span class="input-group-addon">A</span>
                                                    <input name="py_timestamp_a" class="form-control range-to" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_py_timestamp_a) > 0) echo date("d/m/Y", $get_py_timestamp_a); ?>">
                                                </div>
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

                                    <h5 class="card-title border-0 pb-0">Lista log</h5>


                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nominativo</th>
                                                <th>Email</th>
                                                <th>Azione</th>
                                                <th>Attività</th>
                                                <th>Data e ora</th>
                                                <th style="text-align: center;">Autorizzazioni</th>
                                                <th style="text-align: center;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(py_id) FROM py_privacy WHERE py_id > 0 ";
                                            if(strlen($get_py_email) > 0) $querySql .= " AND py_email LIKE '%$get_py_email%' ";
                                            if(strlen($get_py_timestamp_da) > 0) $querySql .= " AND py_timestamp >= '$get_py_timestamp_da' ";
                                            if(strlen($get_py_timestamp_a) > 0) $querySql .= " AND py_timestamp <= '$get_py_timestamp_a' ";
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

                                            $querySql = "SELECT * FROM py_privacy WHERE py_id > 0 ";
                                            if(strlen($get_py_email) > 0) $querySql .= " AND py_email LIKE '%$get_py_email%' ";
                                            if(strlen($get_py_timestamp_da) > 0) $querySql .= " AND py_timestamp >= '$get_py_timestamp_da' ";
                                            if(strlen($get_py_timestamp_a) > 0) $querySql .= " AND py_timestamp <= '$get_py_timestamp_a' ";
                                            $querySql .= " ORDER BY py_id LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $py_id = $row_data['py_id'];

                                                echo "<tr>";
                                                echo "<td>$py_id</td>";
                                                echo "<td>".$row_data['py_nominativo']."</td>";
                                                echo "<td>".$row_data['py_email']."</td>";
                                                echo "<td>".$row_data['py_azione']."</td>";
                                                echo "<td>".$row_data['py_attivita']."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['py_timestamp'])."</td>";

                                                //Stato
                                                echo "<td align='center'>";

                                                // privacy
                                                if ($row_data['py_checkbox_privacy'] == 0) {
                                                    echo "<div class='btn btn-danger btn-sm'>Privacy</div>&nbsp;";
                                                }
                                                else {
                                                    echo "<div class='btn btn-success btn-sm'>Privacy</div>&nbsp;";
                                                }

                                                // marketing
                                                if ($row_data['py_checkbox_marketing'] == 0) {
                                                    echo "<div class='btn btn-danger btn-sm'>Marketing</div>&nbsp;";
                                                }
                                                else {
                                                    echo "<div class='btn btn-success btn-sm'>Marketing</div>&nbsp;";
                                                }

                                                // cessione
                                                if ($row_data['py_checkbox_cessione'] == 0) {
                                                    echo "<div class='btn btn-danger btn-sm'>Condizioni</div>&nbsp;";
                                                }
                                                else {
                                                    echo "<div class='btn btn-success btn-sm'>Condizioni</div>&nbsp;";
                                                }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-primary btn-sm' href='clienti-privacy-dettaglio.php?py_id=$py_id' title='Dettaglio'>Dettaglio</a>&nbsp;";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono log presenti</td></tr>";
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