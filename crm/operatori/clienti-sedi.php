<?php include "inc/autoloader.php"; ?>
<?php
$get_ut_id = isset($_GET['ut_id']) ? (int)$_GET['ut_id'] : 0;
$get_sd_id = isset($_GET['sd_id']) ? (int)$_GET['sd_id'] : 0;

$querySql = "SELECT * FROM sd_sedi INNER JOIN ut_utenti ON ut_id = sd_ut_id WHERE sd_id = '$get_sd_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <script src="../ajax/regioni.js"></script>

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
                                <h4 class="mb-0"> Gestione sedi</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="clienti-gst.php" class="default-color">Gestione clienti</a></li>
                                    <li class="breadcrumb-item active">Gestione sedi</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php include "inc/dataview-cliente.php"; ?>

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $get_sd_id > 0 ? "Modifica sede" : "Aggiungi sede"; ?></h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <form method="post" action="<?php echo $get_sd_id > 0 ? "clienti-sedi-mod-do.php" : "clienti-sedi-add-do.php"; ?>">
                                        <input type="hidden" name="sd_ut_id" value="<?php echo $get_ut_id; ?>">
                                        <input type="hidden" name="sd_id" value="<?php echo $get_sd_id; ?>">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_sede">Nome sede *</label>
                                                <input type="text" class="form-control" id="sd_sede" name="sd_sede"
                                                       value="<?php echo @$row_data['sd_sede']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_email">Email</label>
                                                <input type="email" class="form-control" id="sd_email" name="sd_email"
                                                       value="<?php echo @$row_data['sd_email']; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_telefono">Telefono</label>
                                                <input type="text" class="form-control pattern-number" id="sd_telefono" name="sd_telefono"
                                                       value="<?php echo @$row_data['sd_telefono']; ?>">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_fax">Fax</label>
                                                <input type="text" class="form-control pattern-number" id="sd_fax" name="sd_fax"
                                                       value="<?php echo @$row_data['sd_fax']; ?>">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="provincia">Provincia *</label>
                                                <select class="form-control" id="provincia" name="sd_provincia" onchange="getCitta();" required>
                                                    <option value="">Seleziona una provincia</option>
                                                    <option value=""></option>
                                                    <?php selectProvince(@$row_data['sd_provincia'], "", $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="citta">Città *</label>
                                                <select class="form-control" id="citta" name="sd_citta" required>
                                                    <option value="">Seleziona una citta</option>
                                                    <option value=""></option>
                                                    <?php if(strlen(@$row_data['sd_provincia']) > 0) selectComuni(@$row_data['sd_citta'], @$row_data['sd_provincia'], $dbConn); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_indirizzo">Indirizzo *</label>
                                                <input type="text" class="form-control" id="sd_indirizzo" name="sd_indirizzo" placeholder="Indirizzo"
                                                       value="<?php echo @$row_data['sd_indirizzo']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="sd_cap">CAP *</label>
                                                <input type="text" class="form-control" id="sd_cap" name="sd_cap" placeholder="CAP" autocomplete="off"
                                                       value="<?php echo @$row_data['sd_cap']; ?>" required>
                                            </div>

                                        </div>

                                        <?php echo $get_sd_id > 0
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

                                    <h5 class="card-title border-0 pb-0">Lista sedi collegate</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Sede</th>
                                                <th>Email</th>
                                                <th>Indirizzo</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(sd_id) FROM sd_sedi WHERE sd_ut_id = '$get_ut_id' ";
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
                                                "SELECT * FROM sd_sedi WHERE sd_ut_id = '$get_ut_id' ORDER BY sd_sede LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $sd_id = $row_data['sd_id'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['sd_sede']."</td>";
                                                echo "<td>".$row_data['sd_email']."</td>";
                                                echo "<td>".$row_data['sd_indirizzo']." - ".$row_data['sd_citta']." (".$row_data['sd_provincia'].")</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='clienti-sedi.php?sd_id=$sd_id&ut_id=$get_ut_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='convenzioni-cer-del-do.php?sd_id=$sd_id&ut_id=$get_ut_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono sedi collegate</td></tr>";

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