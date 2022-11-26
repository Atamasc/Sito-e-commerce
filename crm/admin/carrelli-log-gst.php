<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_ol_email = isset($_GET["ol_email"]) ? $dbConn->real_escape_string($_GET["ol_email"]) : "";
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
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="carrelli-gst.php" class="default-color">Gestione carrelli</a></li>
                                    <li class="breadcrumb-item active">Log e report carrelli</li>
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

                                        <h5 class="card-title">Filtra log</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="ol_email">Filtra per email</label>
                                                <input type="text" class="form-control" id="ol_email" name="ol_email" value="<?php echo $get_ol_email; ?>">
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

                                    <h5 class="card-title border-0 pb-0">Elenco report</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th width="50">ID</th>
                                                <th>Cliente</th>
                                                <th>Email</th>
                                                <th>Stato invio</th>
                                                <th>Stato lettura</th>
                                                <th>Click</th>
                                                <th width="150">Data e ora invio</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ol_id) FROM ol_ordini_log INNER JOIN ut_utenti ON ut_email = ol_email WHERE ol_cr_id > 0 ";

                                            if(strlen(@$_GET['ol_timestamp_dal']) > 0) $querySql .= "AND ol_timestamp >= '".strtotime($_GET['ol_timestamp_dal'])."' ";
                                            if(strlen(@$_GET['ol_timestamp_al']) > 0) $querySql .= "AND ol_timestamp <= '".strtotime($_GET['ol_timestamp_al'])."' ";

                                            if(strlen($get_ol_email) > 0) $querySql .= " AND ol_email LIKE '%$get_ol_email%' ";

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

                                            $querySql = "SELECT * FROM ol_ordini_log INNER JOIN ut_utenti ON ut_email = ol_email WHERE ol_cr_id > 0 ";

                                            if(strlen(@$_GET['ol_timestamp_dal']) > 0) $querySql .= "AND ol_timestamp >= '".strtotime($_GET['ol_timestamp_dal'])."' ";
                                            if(strlen(@$_GET['ol_timestamp_al']) > 0) $querySql .= "AND ol_timestamp <= '".strtotime($_GET['ol_timestamp_al'])."' ";

                                            if(strlen($get_ol_email) > 0) $querySql .= " AND ol_email LIKE '%$get_ol_email%' ";

                                            $querySql .= " ORDER BY ol_timestamp DESC LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ol_id = $row_data['ol_id'];
                                                $ol_cr_id = $row_data['ol_cr_id'];
                                                $ol_timestamp = $row_data['ol_timestamp'];

                                                echo "<tr>";

                                                echo "<tr>";
                                                echo "<td>".$ol_id."</td>";
                                                echo "<td>".$row_data['ut_nome']." ".$row_data['ut_cognome']."</td>";
                                                echo "<td>".$row_data['ol_email']."</td>";
                                                echo "<td>".$row_data['ol_stato_invio']."</td>";
                                                if($row_data['ol_stato_lettura'] == 1) echo "<td style='color: green;'>Letta</td>";
                                                else echo "<td>Non letta</td>";
                                                echo "<td>".$row_data['ol_click']."</td>";
                                                echo "<td>".date("H:i d/m/Y", $row_data['ol_timestamp'])."</td>";

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