<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_co_id = isset($_GET['co_id']) ? (int)$_GET['co_id'] : 0;
    $get_co_coupon = isset($_GET['co_coupon']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['co_coupon']))) : "";
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
                                <h4 class="mb-0"> Gestione coupon </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione coupon</li>
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

                                        <h5 class="card-title">Filtra coupon</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Coupon</label>
                                                <input type="text" name="co_coupon" class="form-control" value="<?php echo $get_co_coupon; ?>">
                                                <span class="tooltips">Codice Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Coupon" data-content="Inserisci qui il codice del coupon che stai modificando">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a href="coupon-add.php" class="btn btn-success">Aggiungi coupon</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista coupon</h5>

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
                                                <th>Coupon</th>
                                                <th>Marca</th>
                                                <th>Valore</th>
                                                <th>N. Utilizzi</th>
                                                <th style="text-align: center;" width="200">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(co_id) FROM co_coupon WHERE co_id > 0 ";
                                            if (strlen($get_co_coupon) > 0) $querySql .= " AND co_coupon LIKE '%$get_co_coupon%' ";
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

                                            $querySql = "SELECT * FROM co_coupon WHERE co_id > 0 ";
                                            if (strlen($get_co_coupon) > 0) $querySql .= " AND co_coupon LIKE '%$get_co_coupon%' ";
                                            $querySql .= " ORDER BY co_coupon LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $co_id = $row_data['co_id'];
                                                $co_coupon = $row_data['co_coupon'];

                                                echo "<tr>";
                                                echo "<td>$co_id</td>";
                                                echo "<td>" . $row_data['co_coupon'] . "</td>";
                                                echo strlen($row_data['co_mr_codice']) > 0
                                                    ? "<td>" . getMarca($row_data['co_mr_codice']) . "</td>"
                                                    : "<td>Valido su tutti i prodotti</td>";
                                                echo $row_data['co_tipo'] == 'importo'
                                                    ? "<td>" . formatPrice($row_data['co_valore']) . "&euro;</td>"
                                                    : "<td>" . $row_data['co_valore'] . "%</td>";
                                                echo "<td>" . get_numero_utilizzi_by_code($row_data['co_coupon'], $dbConn) . "</td>";

                                                //Stato
                                                echo "<td align='center'>";
                                                if ($row_data['co_stato'] == 0) { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="coupon-stato-do.php?co_id=<?php echo $co_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="coupon-stato-do.php?co_id=<?php echo $co_id; ?>" checked><span></span>
                                                        </label>
                                                    </div>
                                                <?php }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='coupon-mod.php?co_id=$co_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='coupon-del-do.php?co_id=$co_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono coupon presenti</td></tr>";
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