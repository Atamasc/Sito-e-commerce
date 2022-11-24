<?php include "inc/autoloader.php"; ?>

<?php
$get_nb_id = isset($_GET['nb_id']) ? (int)$_GET['nb_id'] : 0;

$querySql = "SELECT * FROM nb_newsletter_blog WHERE nb_id = '$get_nb_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$nb_tipo = $row_data['nb_tipo'];
$nb_bl_prim = $row_data['nb_bl_prim'];
$nb_bl_sec = explode("|" ,$row_data['nb_bl_sec']);
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
                            <h4 class="mb-0"> Gestione newsletter </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="newsletter-blog-gst.php" class="default-color">Gestione campagne blog</a></li>
                                <li class="breadcrumb-item active">Modifica campagna blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Modifica campagna blog</h5>

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
                                        Si � verificato un errore, riprova.
                                    </div>
                                    <?php

                                }
                                ?>

                                <div class="table-responsive">

                                    <form id="form" method="post" action="newsletter-blog-mod-do.php">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Titolo</th>
                                                <th width="150">Data Inserimento</th>
                                                <th style="text-align: center;" width="100">Articolo primario</th>
                                                <th style="text-align: center;" width="100">Articoli secondari</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT * FROM bl_blog WHERE bl_id > 0 ORDER BY bl_id";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $bl_id = $row_data["bl_id"];
                                                $bl_titolo = $row_data["bl_titolo"];
                                                $bl_data = date("d/m/Y", $row_data["bl_data"]);

                                                echo "<tr>";
                                                echo "<td>$bl_titolo</td>";
                                                echo "<td class='text-center'>$bl_data</td>";

                                                $stato = $nb_bl_prim == $bl_id ? "checked" : "";
                                                echo "<td class='text-center'><input type='radio' name='nb_bl_prim' id='nb_bl_prim' value='$bl_id' $stato></td>";
                                                $stato = in_array($bl_id, $nb_bl_sec) ? "checked" : "";
                                                echo "<td class='text-center'><input type='checkbox' name='nb_bl_sec[$bl_id]' id='nb_bl_sec[$bl_id]' $stato></td>";

                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono post presenti</td></tr>";
                                            }

                                            $result->close();
                                            ?>

                                            <input type="hidden" name="nb_tipo" id="nb_tipo" value="<?php echo $nb_tipo;?>">
                                            <input type="hidden" name="nb_id" id="nb_id" value="<?php echo $get_nb_id;?>">

                                            <tr>
                                                <td colspan="2"></td>
                                                <td style="text-align: center;"><a class="btn btn-primary" href="javascript:checkNewsletterBlog(1);">Modifica in campagna singola</a></td>
                                                <td style="text-align: center;"><a class="btn btn-primary" href="javascript:checkNewsletterBlog(2);">Modifica in campagna lista</a></td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2" style="text-align: center;"><a class="btn btn-primary" href="javascript:checkNewsletterBlog(3);">Modifica in campagna ibrida</a></td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </form>

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