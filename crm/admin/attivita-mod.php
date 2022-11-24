<?php include "inc/autoloader.php"; ?>
<?php
$get_at_id = isset($_GET['at_id']) ? (int)$_GET['at_id'] : 0;

$querySql = "SELECT * FROM at_attivita INNER JOIN cl_clienti ON cl_id = at_cl_id WHERE at_id = '$get_at_id' ";
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
                            <h4 class="mb-0"> Modifica attività</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="attivita-gst.php" class="default-color">Gestione attività</a></li>
                                <li class="breadcrumb-item active">Modifica attività</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <?php include "../inc/alerts.php"; ?>

                                <form method="post" action="attivita-mod-do.php">
                                    <input type="hidden" name="at_id" value="<?php echo $get_at_id; ?>">

                                    <?php include "../inc/form/attivita.php"; ?>

                                    <button class="btn btn-success mt-2" type="submit">Modifica</button>

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