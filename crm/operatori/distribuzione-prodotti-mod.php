<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

    <style>
        .content-wrapper {

            margin-left: 0!important;

        }
    </style>

</head>

<body>

<?php
$get_dp_id = (int)$_GET['dp_id'];

$querySql = "SELECT * FROM dp_distribuzione_prodotti INNER JOIN pr_prodotti ON pr_id = dp_pr_id WHERE dp_id = '$get_dp_id'";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$get_di_id = $row_data['dp_di_id'];
?>

<div class="wrapper">
    <!--================================= preloader -->
    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--================================= preloader -->
    <!--================================= header start-->

    <?php //include "inc/header.php"; ?>

    <!--================================= header End-->
    <!--================================= Main content -->

    <div class="container-fluid">
        <div class="row">
            <!-- Left Sidebar -->
            <?php //include "inc/sidebar.php"; ?>
            <!-- Left Sidebar End-->

            <!--================================= Main content -->
            <!--================================= wrapper -->
            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="mb-10"> Modifica prodotti caricati </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <?php include "inc/dataview-distribuzione.php"; ?>

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Modifica prodotto</h5>

                                <form method="post" action="distribuzione-prodotti-mod-do.php">

                                    <?php include "../inc/alerts.php"; ?>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="lw-ac-input">Prodotto *</label>
                                            <div class="lw-ac-input">
                                                <input type="text" class="form-control" id="lw-ac-input" name="lw-ac-input" value="<?php echo $row_data['pr_descrizione']; ?>" required>
                                                <input type="hidden" name="dp_pr_id" value="<?php echo $row_data['pr_id']; ?>" required>
                                            </div>

                                            <div style="position: relative;">

                                                <div class="lw-ac-list ac-distribuzione">
                                                    <?php
                                                    pageSelectProdotti();
                                                    function pageSelectProdotti() {

                                                        global $dbConn;

                                                        $querySql =
                                                            "SELECT *, (SELECT SUM(gi_quantita) FROM gi_giacenze WHERE gi_pr_id = pr_id) AS gi_quantita FROM pr_prodotti ".
                                                            "WHERE pr_id > 0 ORDER BY pr_descrizione";
                                                        $result = $dbConn->query($querySql);

                                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                            $pr_id = $row_data['pr_id'];
                                                            $pr_descrizione = $row_data['pr_descrizione'];
                                                            $pr_um = $row_data['pr_um'];
                                                            $gi_quantita = (int)$row_data['gi_quantita'];
                                                            $disabled = $gi_quantita > 0 ? "" : "disabled";

                                                            echo "<p data-value='$pr_id' data-um='$pr_um' $disabled>".
                                                                "$pr_descrizione <span style='float: right;'>(Qnt. disp. $gi_quantita $pr_um)</span></p>";

                                                        }

                                                        $result->close();

                                                    }
                                                    ?>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="dp_gi_id">Lotto *</label>
                                            <select class="form-control" id="dp_gi_id" name="dp_gi_id" required>
                                                <option value="">Seleziona il lotto</option>
                                                <option value=""></option>
                                                <?php
                                                pageGetSelect($row_data['pr_id'], $row_data['dp_gi_id']);
                                                function pageGetSelect($get_pr_id, $get_gi_id){

                                                    global $dbConn;

                                                    $querySql =
                                                        "SELECT gi_id, lt_codice, lt_timestamp, gi_quantita, pr_um FROM gi_giacenze ".
                                                        "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                        "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                        "WHERE gi_pr_id = '$get_pr_id' ORDER BY gi_timestamp DESC ";
                                                    $result = $dbConn->query($querySql);
                                                    $rows = $dbConn->affected_rows;

                                                    while (($rows = $result->fetch_assoc()) !== NULL) {

                                                        $gi_id = $rows['gi_id'];
                                                        $gi_quantita = $rows['gi_quantita']." ".$rows['pr_um'];
                                                        $lt_desc = $rows['lt_codice']." del ".date("d/m/Y", $rows['lt_timestamp'])." (Qnt. disp. $gi_quantita)";
                                                        $status = ($get_gi_id == $gi_id) ? "selected" : "";

                                                        echo "<option value='$gi_id' $status>$lt_desc</option>";

                                                    }
                                                    $result->close();

                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="dp_quantita">Quantità *</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control pattern-number" id="dp_quantita" name="dp_quantita"
                                                       value="<?php echo $row_data['dp_quantita']; ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="lb_dp_quantita"><?php echo $row_data['pr_um']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" name="dp_id" value="<?php echo $get_dp_id; ?>">
                                    <button class="btn btn-success" type="submit">Modifica</button>

                                </form>
                            </div>
                        </div>

                    </div>

                    <?php include "inc/datalist-distribuzione-prodotti.php"; ?>

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