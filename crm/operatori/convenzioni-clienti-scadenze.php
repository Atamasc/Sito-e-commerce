<?php include "inc/autoloader.php"; ?>
<?php
$get_cl_ragione_sociale = isset($_GET['cl_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_ragione_sociale']))) : "";
$get_cl_email = isset($_GET['cl_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_email']))) : "";
$get_cv_titolo = isset($_GET['cv_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cv_titolo']))) : "";
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>

            .lw-ac-list {

                display: none;
                z-index: 99999;
                position: absolute;
                top: 0;
                background-color: white;
                max-height: 200px;
                width: 100%;
                overflow-y: auto;

                -webkit-box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.1);
                box-shadow: 1px 1px 15px rgba(0,0,0,0.1);


            }

            .lw-ac-list > p {

                padding: 15px 15px 15px 20px;

            }

            .lw-ac-list > p:hover {

                background-color: #f6f7f8;
                cursor: pointer;

            }

        </style>

    </head>

    <body>

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
                                <h4 class="mb-0"> Gestione convenzioni in scadenza</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="convenzioni-gst.php" class="default-color">Gestione convenzioni</a></li>
                                    <li class="breadcrumb-item active">Gestione convenzioni in scadenza</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <h5 class="card-title">Filtra convenzioni</h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <form method="get" action="?">
                                        <input type="hidden" name="ca_cv_id" value="<?php echo $get_cv_id; ?>">
                                        <input type="hidden" name="ca_id" value="<?php echo $get_ca_id; ?>">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_ragione_sociale">Ragione sociale</label>
                                                <input type="text" name="cl_ragione_sociale" class="form-control" value="<?php echo $get_cl_ragione_sociale; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cl_email">Email</label>
                                                <input name="cl_email" id="cl_email" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_cl_email; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cv_titolo">Titolo convenzione</label>
                                                <input name="cv_titolo" id="cv_titolo" class="form-control" type="text" autocomplete="off"
                                                       value="<?php echo $get_cv_titolo; ?>">
                                            </div>

                                        </div>

                                        <button class='btn btn-primary mt-2' type='submit'>Cerca</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista convenzioni in ordine di scadenza</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Convenzione</th>
                                                <th>Cliente</th>
                                                <th>Data attivazione</th>
                                                <th>Data scadenza</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql =
                                                "SELECT COUNT(ca_id) FROM ca_convenzioni_clienti INNER JOIN cv_convenzioni ON cv_id = ca_cv_id ".
                                                "INNER JOIN cl_clienti ON cl_id = ca_cl_id  WHERE ca_cv_id > 0 ";
                                            if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                            if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                            if(strlen($get_cv_titolo) > 0) $querySql .= " AND cv_titolo LIKE '%$get_cv_titolo%' ";
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

                                            $querySql =
                                                "SELECT * FROM ca_convenzioni_clienti INNER JOIN cv_convenzioni ON cv_id = ca_cv_id ".
                                                "INNER JOIN cl_clienti ON cl_id = ca_cl_id ".
                                                "WHERE ca_cv_id > 0 ";
                                            if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                            if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                            if(strlen($get_cv_titolo) > 0) $querySql .= " AND cv_titolo LIKE '%$get_cv_titolo%' ";
                                            $querySql .= "ORDER BY ca_timestamp_scadenza LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ca_id = $row_data['ca_id'];
                                                $cv_id = $row_data['cv_id'];
                                                $ca_timestamp_scadenza = $row_data['ca_timestamp_scadenza'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['cv_titolo']."</td>";
                                                echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['ca_timestamp_attivazione'])."</td>";
                                                if($ca_timestamp_scadenza <= time()) echo "<td><span class='badge badge-big badge-danger'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";
                                                else if($ca_timestamp_scadenza <= strtotime("+7 days")) echo "<td><span class='badge badge-big badge-warning'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";
                                                else echo "<td><span class='badge badge-big badge-info'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='convenzioni-clienti.php?ca_id=$ca_id&cv_id=$cv_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='convenzioni-clienti-del-do.php?ca_id=$ca_id&cv_id=$cv_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono convenzioni</td></tr>";

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

                                        <div class="col-md-12">
                                            <span class="badge badge-big badge-danger">&nbsp;</span> Convenzioni scadute
                                            &nbsp;|&nbsp;
                                            <span class="badge badge-big badge-warning">&nbsp;</span> Convenzioni in scadenza entro 7 giorni
                                        </div>

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

                    <!--================================= wrapper -->

                    <!--================================= footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        $(".lw-ac-input input[type='text']").on('keypress change keyup',function () {

            let searchInputValue = $(this).val();

            if(searchInputValue.length > 0) {

                $('.lw-ac-list p').hide();
                $('.lw-ac-list').show().find('p:contains_ci(' + searchInputValue + ')').show();

            } else {

                $('.lw-ac-list').hide();

            }

        });

        $('.lw-ac-list p').click(function () {

            $(".lw-ac-input input[type='text']").val($(this).text());
            $(".lw-ac-input input[type='hidden']").val($(this).data('value'));

            $('.lw-ac-list').hide();

        })

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>