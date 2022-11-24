<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

    </head>

    <?php
    $get_op_id = isset($_GET['op_id']) ? (int)$_GET['op_id'] : 0;

    $querySql = "SELECT * FROM op_operatori WHERE op_id = '$get_op_id' ";
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
                            <div class="col-sm-12">
                                <h4 class="mb-2"> I tuoi dati</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">
                                    <form method="post">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="op_nome">Nome *</label>
                                                <input type="text" class="form-control" id="op_nome" name="op_nome" value="<?php echo $row_data['op_nome']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_cognome">Cognome *</label>
                                                <input type="text" class="form-control" id="op_cognome" name="op_cognome" value="<?php echo $row_data['op_cognome']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="op_codice">Codice / Username *</label>
                                                <input type="text" class="form-control" id="op_codice" name="op_codice" value="<?php echo $row_data['op_codice']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_password">Password *</label>
                                                <input type="text" class="form-control" id="op_password" name="op_password" value="<?php echo $row_data['op_password']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="op_telefono">Telefono</label>
                                                <input type="text" class="form-control pattern_number" id="op_telefono" name="op_telefono" value="<?php echo $row_data['op_telefono']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="op_email">Email</label>
                                                <input type="email" class="form-control" id="op_email" name="op_email" value="<?php echo $row_data['op_email']; ?>" readonly>
                                            </div>
                                        </div>

                                        <h6 class="card-title mt-3">Altro</h6>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="op_note">Note</label>
                                                <textarea class="form-control" id="op_note" name="op_note" rows="3" readonly><?php echo $row_data['op_note']; ?></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="op_id" value="<?php echo $get_op_id; ?>">

                                    </form>
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