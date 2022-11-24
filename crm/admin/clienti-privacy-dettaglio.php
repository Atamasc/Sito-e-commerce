<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

    </head>

    <?php
    $get_py_id = isset($_GET['py_id']) ? (int)$_GET['py_id'] : 0;

    $querySql = "SELECT * FROM py_privacy WHERE py_id = '$get_py_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();
    ?>

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
                                <h4 class="mb-0"> Dettaglio log</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="clienti-privacy-gst.php" class="default-color">Log privacy</a></li>
                                    <li class="breadcrumb-item active">Dettaglio log</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <div>
                                        <h6 class="card-title">Dettaglio</h6>
                                        <div class="form-row">

                                            <div class="col-md-4 mb-3">
                                                <label for="py_id">ID</label>
                                                <div class="form-control" id="py_id"><?php echo $row_data['py_id']; ?></div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="py_nominativo">Nominativo </label>
                                                <div class="form-control" id="py_nominativo"><?php echo $row_data['py_nominativo']; ?></div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="py_email">Email </label>
                                                <div class="form-control" id="py_email"><?php echo $row_data['py_email']; ?></div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="py_azione">Azione </label>
                                                <div class="form-control" id="py_azione"><?php echo $row_data['py_azione']; ?></div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="py_attività">Attività </label>
                                                <div class="form-control" id="py_attività"><?php echo $row_data['py_attivita']; ?></div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="py_timestamp">Data e ora </label>
                                                <div class="form-control" id="py_timestamp"><?php echo date("d/m/Y H:i", $row_data['py_timestamp']); ?></div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="py_timestamp">Indirizzo IP </label>
                                                <div class="form-control" id="py_ip"><?php echo $row_data['py_ip']; ?></div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="py_timestamp">Dati completi </label>
                                                <textarea class="form-control" id="py_ip" rows="20" readonly disabled><?php echo $row_data['py_dati']; ?></textarea>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <?php

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

                                            ?>

                                        </div>

                                    </div>

                                    <input type="hidden" name="py_id" value="<?php echo $get_py_id; ?>">

                                </div>
                            </div>
                        </div>

                    </div>

                    <?php include "inc/footer.php"; ?>

                </div>
            </div><!-- main content wrapper end-->
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>