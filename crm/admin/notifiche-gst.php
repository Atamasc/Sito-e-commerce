<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_np_id = isset($_GET['np_id']) ? (int)$_GET['np_id'] : 0;
    $get_np_pr_codice = isset($_GET['np_pr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['np_pr_codice']))) : "";
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
                                <h4 class="mb-0"> Gestione notifiche </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione notifiche prodotti</li>
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

                                        <h5 class="card-title">Filtra richieste di notifica</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Codice prodotto</label>
                                                <input type="text" name="np_pr_codice" class="form-control" value="<?php echo $get_np_pr_codice; ?>">
                                                <span class="tooltips">Codice Notifica <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Notifica" data-content="Inserisci qui il codice delle notifiche che stai cercando">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <!--<a href="coupon-add.php" class="btn btn-success">Aggiungi coupon</a>-->

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista richieste di notifica</h5>

                                    <?php
                                    if(@$_GET['insert'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Notifica inviata con successo.
                                        </div>
                                        <?php

                                    }

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
                                                <th>Prodotto</th>
                                                <th>Email</th>
                                                <th>Data richiesta</th>
                                                <th style="text-align: center;" width="200">Notificato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(np_id) FROM np_notifiche_prodotti INNER JOIN pr_prodotti ON pr_codice = np_pr_codice WHERE np_id > 0 ";
                                            if(strlen($get_np_pr_codice) > 0) $querySql .= " AND np_pr_codice LIKE '%$get_np_pr_codice%' ";
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

                                            $querySql = "SELECT * FROM np_notifiche_prodotti INNER JOIN pr_prodotti ON pr_codice = np_pr_codice WHERE np_id > 0 ";
                                            if(strlen($get_np_pr_codice) > 0) $querySql .= " AND np_pr_codice LIKE '%$get_np_pr_codice%' ";
                                            $querySql .= " ORDER BY np_timestamp DESC LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $np_id = $row_data['np_id'];
                                            $np_pr_codice = $row_data['np_pr_codice'];
                                            $np_timestamp = $row_data['np_timestamp'];
                                            $np_link = $row_data['np_link'];
                                            $pr_titolo = $row_data['pr_titolo'];
                                            $np_email = $row_data['np_email'];

                                            echo "<tr>";
                                            echo "<td>$np_id</td>";
                                            echo "<td>".$np_pr_codice." / ".$pr_titolo."</td>";
                                            echo "<td>".$np_email."</td>";
                                            echo "<td>".date('d/m/Y - H:i', $np_timestamp)."</td>";

                                            //Stato
                                            echo "<td align='center'>";
                                            if ($row_data['np_notificato'] == 0) { ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input disabled type="checkbox" class="stato" title="notifiche-stato-do.php?np_id=<?php echo $np_id; ?>"><span></span>
                                                    </label>
                                                </div>
                                            <?php } else { ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input disabled type="checkbox" class="stato" title="notifiche-stato-do.php?np_id=<?php echo $np_id; ?>" checked><span></span>
                                                    </label>
                                                </div>
                                            <?php }

                                            echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-orange btn-sm' href='$np_link' title='Link prodotto' target='_blank'>Link Pubblico</a>&nbsp;";
                                                echo "<a class='btn btn-primary btn-sm' href='notifiche-send-do.php?np_id=$np_id' title='Notifica'><i class='fa fa-mailbox'></i> Notifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='notifiche-del-do.php?np_id=$np_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono richieste presenti</td></tr>";
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