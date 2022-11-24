<?php include "inc/autoloader.php"; ?>
<?php
$get_ba_id = isset($_GET['ba_id']) ? (int)$_GET['ba_id'] : 0;

$querySql = "SELECT * FROM ba_beauty_assistant WHERE ba_id = '$get_ba_id' ";
$result = $dbConn->query($querySql);
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
                            <h4 class="mb-0"> Modifica beauty assistant</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="beauty-gst.php" class="default-color">Gestione numeri</a></li>
                                <li class="breadcrumb-item active">Modifica numero</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">
                                <?php
                                $querySql = "SELECT * FROM ba_beauty_assistant WHERE ba_id = $get_ba_id";
                                $result = $dbConn->query($querySql);
                                $row_data = $result->fetch_assoc();
                                ?>

                                <form method="post" action="beauty-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica numero</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Numero modificato con successo.
                                        </div>
                                        <?php

                                    } else if(@$_GET['update'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Si è verificato un errore, riprova.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <label for="ba_numero">Numero *</label>
                                            <input type="text" class="form-control" id="ba_numero" name="ba_numero" value="<?php echo $row_data['ba_numero']; ?>" required>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="ba_orari">Orari</label>
                                            <textarea class="form-control" id="ba_orari" name="ba_orari" rows="2"><?php echo @$row_data['ba_orari']; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label for="ba_stato">Visibilità</label>
                                            <select class="form-control" id="ba_stato" name="ba_stato" required>
                                                <option value="">Seleziona uno stato</option>
                                                <option value=""></option>
                                                <option value="1" <?php if($row_data['ba_stato'] == '1') echo "selected"; ?>>Attivo</option>
                                                <option value="0" <?php if($row_data['ba_stato'] == '0') echo "selected"; ?>>Non attivo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="ba_id" value="<?PHP ECHO $get_ba_id; ?>">
                                    <button class="btn btn-primary" type="submit">Modifica</button>
                                    <a href="beauty-add.php" class="btn btn-success">Aggiungi numero</a>

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