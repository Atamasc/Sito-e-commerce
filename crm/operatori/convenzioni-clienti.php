<?php include "inc/autoloader.php"; ?>
<?php
$get_cv_id = isset($_GET['cv_id']) ? (int)$_GET['cv_id'] : 0;
$get_ca_id = isset($_GET['ca_id']) ? (int)$_GET['ca_id'] : 0;

$querySql = "SELECT cv_titolo FROM cv_convenzioni WHERE cv_id = '$get_cv_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$cv_titolo = $result->fetch_array()[0];
$result->close();

$querySql = "SELECT * FROM ca_convenzioni_clienti INNER JOIN ut_utenti ON ut_id = ca_ut_id WHERE ca_id = '$get_ca_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
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
                                <h4 class="mb-0"> Gestione clienti per "<?php echo $cv_titolo; ?>"</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="convenzioni-gst.php" class="default-color">Gestione convenzioni</a></li>
                                    <li class="breadcrumb-item active">Gestione clienti associati</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $get_ca_id > 0 ? "Modifica associazione" : "Aggiungi associazione"; ?></h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <form method="post" action="convenzioni-clienti-do.php">
                                        <input type="hidden" name="ca_cv_id" value="<?php echo $get_cv_id; ?>">
                                        <input type="hidden" name="ca_id" value="<?php echo $get_ca_id; ?>">

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">

                                                <label for="ut_ragione_sociale">Cliente *</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="ut_ragione_sociale" value="<?php echo @$row_data['ut_ragione_sociale']; ?>" required readonly>
                                                    <input type="hidden" id="ut_id" name="ca_ut_id" value="<?php echo @$row_data['ca_ut_id']; ?>" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary popup-custom" data-href="attivita-clienti-add.php" type="button">Associa</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="ca_timestamp_attivazione">Data attivazione *</label>
                                                <input type="text" class="form-control date-picker-default" id="ca_timestamp_attivazione" name="ca_timestamp_attivazione"
                                                       value="<?php echo strlen(@$row_data['ca_timestamp_attivazione']) > 0
                                                           ? date("d/m/Y", $row_data['ca_timestamp_attivazione']) : date("d/m/Y"); ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ca_timestamp_scadenza">Data scadenza *</label>
                                                <input type="text" class="form-control date-picker-default" id="ca_timestamp_scadenza" name="ca_timestamp_scadenza"
                                                       value="<?php echo strlen(@$row_data['ca_timestamp_scadenza']) > 0
                                                           ? date("d/m/Y", $row_data['ca_timestamp_scadenza']) : ""; ?>" required>
                                            </div>

                                        </div>

                                        <a href="convenzioni-gst.php?cv_id=<?php echo $get_cv_id; ?>" class="btn btn-orange mt-2">Torna alla convenzione</a>
                                        <?php echo $get_ca_id > 0
                                            ? "<button class='btn btn-success mt-2' type='submit'>Modifica</button>"
                                            : "<button class='btn btn-primary mt-2' type='submit'>Aggiungi</button>";
                                        ?>

                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista clienti associati</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Data attivazione</th>
                                                <th>Data scadenza</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ca_id) FROM ca_convenzioni_clienti WHERE ca_cv_id = '$get_cv_id' ";
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
                                                "SELECT * FROM ca_convenzioni_clienti INNER JOIN ut_utenti ON ut_id = ca_ut_id ".
                                                "WHERE ca_cv_id = '$get_cv_id' ORDER BY ca_timestamp_scadenza LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ca_id = $row_data['ca_id'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['ut_ragione_sociale']."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['ca_timestamp_attivazione'])."</td>";
                                                echo "<td>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='convenzioni-clienti.php?ca_id=$ca_id&cv_id=$get_cv_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='convenzioni-clienti-del-do.php?ca_id=$ca_id&cv_id=$get_cv_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono clienti associati</td></tr>";

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