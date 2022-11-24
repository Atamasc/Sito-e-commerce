<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<?php
$get_ct_id = isset($_GET['ct_id']) ? (int)$_GET['ct_id'] : 0;

$querySql = "SELECT * FROM ct_categoria WHERE ct_id = '$get_ct_id' ";
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
                            <h4 class="mb-0"> Modifica categoria</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="clienti-categorie-gst.php" class="default-color">Gestione categorie</a></li>
                                <li class="breadcrumb-item active">Modifica categoria</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">
                                <form method="post" action="clienti-categorie-mod-do.php">

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Modifica avvenuta con successo.
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

                                        <div class="col-md-3 mb-3">
                                            <label for="ct_titolo">Nome *</label>
                                            <input type="text" class="form-control" id="ct_titolo" name="ct_titolo" placeholder="Nome *"
                                                   value="<?php echo $row_data['ct_titolo']; ?>" required>
                                        </div>
                                        
                                    </div>
                                    
                                    <input type="hidden" name="ct_id" value="<?php echo $get_ct_id; ?>">
                                    <button class="btn btn-success" type="submit">Modifica</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <?php include "inc/datalist-clienti-categorie.php"; ?>

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