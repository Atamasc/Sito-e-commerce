<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_pr_id = isset($_GET["pr_id"]) ? (int)$_GET["pr_id"] : 0;
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
                                <h4 class="mb-0"> Gestione immagini varianti </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione immagine varianti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <form method="post" action="prodotti-varianti-immagini-add-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Aggiungi immagini</h5>

                                        <?php include "../inc/alerts.php"; ?>

                                        <div class="repeater-file">

                                            <?php
                                            for ($i = 0; $i < 5; $i++) {

                                                ?>

                                                <div class="form-row">

                                                    <div class="col-md-4 mb-3">
                                                        <label for="im_descrizione">Titolo</label>
                                                        <input type="text" name="im_descrizione[]" class="form-control">
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>&nbsp;</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="im_immagine[]">
                                                            <label class="custom-file-label" for="customFile">Scegli l'immagine</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            ?>

                                            <div class="clearfix">

                                                <input type="hidden" name="im_pr_id" value="<?php echo $get_pr_id; ?>" />

                                                <button class="btn btn-primary" type="submit">Inserisci</button>
                                            </div>

                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <?php //include "inc/datalist-galleria.php"; ?>



                        <div class="col-xl-12 mb-10">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista immagini</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th width="50">ID</th>
                                                <th>Titolo</th>
                                                <th width="200">Ultima modifica</th>
                                                <th style="text-align: center;" width="150">Anteprima</th>
                                                <th style="text-align: center;" width="150">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT * FROM pv_prodotti_varianti_immagini WHERE pv_pr_id = $get_pr_id ORDER BY pv_id ASC";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $pv_id = $row_data["pv_id"];
                                                $pv_immagine = $row_data["pv_immagine"];
                                                $pv_immagine_path = "$upload_path_dir_varianti_img/$pv_immagine";

                                                echo "<tr>";
                                                echo "<td>".$row_data['pv_id']."</td>";
                                                echo "<td>".$row_data['pv_descrizione']."</td>";
                                                echo "<td>".date('d/m/Y - H:i', $row_data["pv_data"])."</td>";

                                                // anteprima
                                                echo "<td align='center'>";
                                                echo "<img src='$pv_immagine_path' width='50' height='50' style='color: #fff; cursor:default;' />";
                                                echo "</td>";

                                                //Stato
                                                $checked = $row_data['pv_stato'] > 0 ? "checked" : "";
                                                echo "<td align='center'>";
                                                ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" title="prodotti-varianti-immagini-stato-do.php?pv_id=<?php echo $pv_id; ?>" <?php echo $checked; ?>><span></span>
                                                    </label>
                                                </div>
                                                <?php
                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-sm btn-info' href='$pv_immagine_path' target='_blank' title='Visualizza'>visualizza</a>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='prodotti-varianti-immagini-mod.php?pv_id=$pv_id&pr_id=$get_pr_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-varianti-immagini-del-do.php?pv_id=$pv_id&pr_id=$get_pr_id'><i class='fas fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono immagini</td></tr>";

                                            $result->close();
                                            ?>

                                            </tbody>
                                        </table>

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