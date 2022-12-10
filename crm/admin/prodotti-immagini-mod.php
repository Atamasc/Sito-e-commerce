<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $pi_id = isset($_GET["pi_id"]) ? (int)$_GET["pi_id"] : 0;
    $pi_pr_id = isset($_GET["pr_id"]) ? (int)$_GET["pr_id"] : 0;

    $querySql_im = "SELECT * FROM pi_prodotti_immagini WHERE pi_id = $pi_id ";
    $result = $dbConn->query($querySql_im);
    $row_data = $result->fetch_assoc();
    $result->close();
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
                                <h4 class="mb-0"> Gestione immagini prodotti </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione immagine prodotti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <form method="post" action="prodotti-immagini-mod-do.php" enctype="multipart/form-data">

                                        <h5 class="card-title">Modifica immagine</h5>

                                        <?php include "../inc/alerts.php"; ?>


                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pi_descrizione">Titolo</label>
                                                <input type="text" name="pi_descrizione" class="form-control" value="<?php echo $row_data['pi_descrizione']; ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>&nbsp;</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile" name="pi_immagine">
                                                    <label class="custom-file-label" for="customFile"><?php echo $row_data['pi_immagine']; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix">

                                            <input type="hidden" name="pi_id" value="<?php echo $pi_id; ?>"/>
                                            <input type="hidden" name="pi_pr_id" value="<?php echo $pi_pr_id; ?>"/>

                                            <button class="btn btn-success" type="submit">Modifica</button>
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
                                            $querySql = "SELECT * FROM pi_prodotti_immagini WHERE pi_pr_id = $pi_pr_id ORDER BY pi_id ASC";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $pi_id = $row_data["pi_id"];
                                                $pi_immagine = $row_data["pi_immagine"];
                                                $pi_immagine_path = "$upload_path_dir_prodotti_img/$pi_immagine";

                                                echo "<tr>";
                                                echo "<td>" . $row_data['pi_id'] . "</td>";
                                                echo "<td>" . $row_data['pi_descrizione'] . "</td>";
                                                echo "<td>" . date('d/m/Y - H:i', $row_data["pi_data"]) . "</td>";

                                                // anteprima
                                                echo "<td align='center'>";
                                                echo "<img src='$pi_immagine_path' width='50' height='50' style='color: #fff; cursor:default;' />";
                                                echo "</td>";

                                                //Stato
                                                $checked = $row_data['pi_stato'] > 0 ? "checked" : "";
                                                echo "<td align='center'>";
                                                ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" title="prodotti-immagini-stato-do.php?pi_id=<?php echo $pi_id; ?>" <?php echo $checked; ?>><span></span>
                                                    </label>
                                                </div>
                                                <?php
                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-sm btn-info' href='$pi_immagine_path' target='_blank' title='Visualizza'>visualizza</a>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='prodotti-immagini-mod.php?pi_id=$pi_id&pr_id=$pi_pr_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-immagini-del-do.php?pi_id=$pi_id&pr_id=$pi_pr_id'><i class='fas fa-trash-alt'></i></button>";
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