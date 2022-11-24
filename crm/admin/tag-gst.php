<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_tm_id = isset($_GET['tm_id']) ? (int)$_GET['tm_id'] : 0;
    $get_tg_id = isset($_GET['tg_id']) ? (int)$_GET['tg_id'] : 0;

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
                                <h4 class="mb-0"> Gestione TAG  </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione TAG</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <?php
                                    if($get_tg_id > 0) include "inc/form-tag-mod.php";
                                    else include "inc/form-tag-add.php";
                                    ?>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista TAG</h5>

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
                                                <th width="40">ID</th>
                                                <th>TAG</th>
                                                <th style="text-align: center;" width="200">Stato</th>
                                                <th style="text-align: center;" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(tg_id) FROM tg_tag  ";
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

                                            $querySql = "SELECT * FROM tg_tag  ORDER BY tg_tag LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $tg_id = $row_data['tg_id'];

                                                echo "<tr>";
                                                echo "<td>$tg_id</td>";
                                                echo "<td>".$row_data['tg_tag']."</td>";
                                                //echo "<td>$count</td>";

                                                //Stato
                                                echo "<td align='center'>";

                                                if ($row_data['tg_stato'] == 0) {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="tag-stato-do.php?tg_id=<?php echo $tg_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                } else {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="tag-stato-do.php?tg_id=<?php echo $tg_id; ?>" checked><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='tag-gst.php?tg_id=$tg_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='tag-del-do.php?tg_id=$tg_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono tag presenti</td></tr>";
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