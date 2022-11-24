<?php include "inc/autoloader.php"; ?>
<?php
$get_al_tab_id = isset($_GET['al_tab_id']) ? (int)$_GET['al_tab_id'] : 0;
$get_al_tipo = isset($_GET['al_tipo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET["al_tipo"]))) : "";

$get_al_id = isset($_GET['al_id']) ? (int)$_GET['al_id'] : 0;

$querySql = "SELECT * FROM al_allegati WHERE al_id = '$get_al_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

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
                                <h4 class="mb-0"> Gestione allegati per <?php echo "$get_al_tipo #$get_al_tab_id"; ?></h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione allegati</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $get_al_id > 0 ? "Modifica allegato" : "Aggiungi allegato"; ?></h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <form method="post" action="allegati-do.php" enctype="multipart/form-data">
                                        <input type="hidden" name="al_tab_id" value="<?php echo $get_al_tab_id; ?>">
                                        <input type="hidden" name="al_tipo" value="<?php echo $get_al_tipo; ?>">
                                        <input type="hidden" name="al_id" value="<?php echo $get_al_id; ?>">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="al_titolo">Titolo *</label>
                                                <input type="text" class="form-control" id="al_titolo" name="al_titolo"
                                                       value="<?php echo $row_data['al_titolo']; ?>" required>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="al_descrizione">Descrizione</label>
                                                <textarea class="form-control" id="al_descrizione" name="al_descrizione"
                                                          rows="3"><?php echo $row_data['al_descrizione']; ?></textarea>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <p>Allegato</p>

                                                <div class="custom-file">

                                                    <input type="file" class="custom-file-input" id="al_allegato" name="al_allegato">
                                                    <?php if (strlen($row_data['al_allegato']) > 0) { ?>
                                                        <label class="custom-file-label" for="al_allegato"><?php echo $row_data['al_allegato']; ?></label><br>
                                                        <a href="<?php echo "$upload_path_dir_allegati/".$row_data['al_allegato']; ?>" target="_blank">vedi allegato</a>
                                                    <?php } else {
                                                        ?><label class="custom-file-label" for="al_allegato">Seleziona allegato</label><?php
                                                    } ?>
                                                    <p>Peso max: 2 MB</p>
                                                </div>

                                            </div>

                                        </div>

                                        <?php
                                        echo $get_al_id > 0
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

                                    <h5 class="card-title border-0 pb-0">Lista allegati associati</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Titolo</th>
                                                <!--<th>Allegato</th>-->
                                                <th style="text-align: center; width: 400px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(al_id) FROM al_allegati WHERE al_tab_id = '$get_al_tab_id' AND al_tipo = '$get_al_tipo' ";
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
                                                "SELECT * FROM al_allegati WHERE al_tab_id = '$get_al_tab_id' AND al_tipo = '$get_al_tipo' ".
                                                "ORDER BY al_titolo LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $al_id = $row_data['al_id'];
                                                $al_allegato = $row_data['al_allegato'];
                                                echo "<tr>";
                                                echo "<td>".$row_data['al_titolo']."</td>";
                                                //echo "<td>$al_allegato</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo strlen($al_allegato) > 0 ? "<a class='btn btn-primary btn-sm' href='$upload_path_dir_allegati/$al_allegato' title='view' target='_blank'>allegato</a>&nbsp;" : "<a class='btn btn-secondary disabled btn-sm' href='' title='view' target='_blank'>Bozza</a>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='allegati-gst.php?al_id=$al_id&al_tab_id=$get_al_tab_id&al_tipo=$get_al_tipo' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='allegati-del-do.php?al_id=$al_id&al_tab_id=$get_al_tab_id&al_tipo=$get_al_tipo'><i class='fas fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono allegati associati</td></tr>";

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

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>