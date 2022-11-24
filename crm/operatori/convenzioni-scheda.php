<?php include "inc/autoloader.php"; ?>
<?php
$get_cv_id = isset($_GET['cv_id']) ? (int)$_GET['cv_id'] : 0;

$querySql = "SELECT * FROM cv_convenzioni WHERE cv_id = '$get_cv_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
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
                                <h4 class="mb-0"> Scheda convenzione "<?php echo $row_data['cv_titolo']; ?>"</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="convenzioni-gst.php" class="default-color">Gestione convenzioni</a></li>
                                    <li class="breadcrumb-item active">Scheda convenzione</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-8 mb-30">
                            <div class="card card-statistics">
                                <div class="card-body">
                                    <div class="d-block d-md-flex justify-content-between border-bottom mb-10">
                                        <div class="d-block">
                                            <h5 class="mb-10 card-title border-0 pb-0">Statistiche</h5>
                                        </div>
                                        <!--
                                        <div class="d-block d-md-flex sm-mb-15">
                                            <div class="clearfix">
                                                <span class="badge badge-success">HTMl</span>
                                                <span class="badge badge-danger">Wordpress</span>
                                                <span class="badge badge-warning">ASP.net</span>
                                            </div>
                                        </div>
                                        -->
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 mb-30">
                                            <div class="clearfix">
                                                <div class="float-left icon-box bg-danger">
                                                      <span class="text-white">
                                                        <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                                      </span>
                                                </div>
                                                <div class="float-left pl-20">
                                                    <p class="card-text text-dark">Clienti associati</p>
                                                    <h4><?php echo countClientiAssociati($get_cv_id); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-30">
                                            <div class="clearfix">
                                                <div class="float-left icon-box bg-primary">
                                                      <span class="text-white">
                                                        <i class="fa fa-database highlight-icon" aria-hidden="true"></i>
                                                      </span>
                                                </div>
                                                <div class="float-left pl-20">
                                                    <p class="card-text text-dark">Convenzioni attive</p>
                                                    <h4><?php echo countConvenzioniAttive($get_cv_id); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-30">
                                            <div class="clearfix">
                                                <div class="float-left icon-box bg-facebook">
                                                      <span class="text-white">
                                                        <i class="fa fa-clock-o highlight-icon" aria-hidden="true"></i>
                                                      </span>
                                                </div>
                                                <div class="float-left pl-20">
                                                    <p class="card-text text-dark">In scadenza 30 giorni</p>
                                                    <h4><?php echo countConvenzioniInScadenza($get_cv_id); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-30">
                                            <div class="clearfix">
                                                <div class="float-left icon-box bg-warning">
                                                      <span class="text-white">
                                                        <i class="fa fa-calendar-o highlight-icon" aria-hidden="true"></i>
                                                      </span>
                                                </div>
                                                <div class="float-left pl-20">
                                                    <p class="card-text text-dark">Convenzioni scadute</p>
                                                    <h4><?php echo countConvenzioniScadute($get_cv_id); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-10">
                                        <div class="col-lg-12">
                                            <h5 class="card-title">Clienti associati</h5>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table center-aligned-table">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>Ragione sociale</th>
                                                        <th>Email</th>
                                                        <th>Scadenza</th>
                                                        <th class="text-center">Gestione</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    $querySql =
                                                        "SELECT * FROM ca_convenzioni_clienti ".
                                                        "INNER JOIN cl_clienti ON cl_id = ca_cl_id ".
                                                        "WHERE ca_cv_id = '$get_cv_id' ";
                                                    if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                                    if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                                    if(strlen($get_cv_titolo) > 0) $querySql .= " AND cv_titolo LIKE '%$get_cv_titolo%' ";
                                                    $querySql .= "ORDER BY ca_timestamp_scadenza LIMIT 0, 10";
                                                    $result = $dbConn->query($querySql);
                                                    $rows = $dbConn->affected_rows;

                                                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                        $ca_id = $row_data['ca_id'];
                                                        $cl_id = $row_data['cl_id'];
                                                        $ca_timestamp_scadenza = $row_data['ca_timestamp_scadenza'];

                                                        echo "<tr>";
                                                        echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                                                        echo "<td>".$row_data['cl_email']."</td>";
                                                        if($ca_timestamp_scadenza <= time()) echo "<td><span class='badge badge-big badge-danger'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";
                                                        else if($ca_timestamp_scadenza <= strtotime("+7 days")) echo "<td><span class='badge badge-big badge-warning'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";
                                                        else echo "<td><span class='badge badge-big badge-info'>".date("d/m/Y", $row_data['ca_timestamp_scadenza'])."</span></td>";

                                                        //Gestione
                                                        echo "<td align='center'>";
                                                        echo "<a class='btn btn-pistacho btn-sm' href='clienti-scheda.php?cl_id=$cl_id' title='Scheda'>scheda</a>&nbsp;";
                                                        echo "</td>";
                                                        echo "</tr>";

                                                    }

                                                    if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono convenzioni in scadenza / scadute</td></tr>";

                                                    $result->close();
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">

                                        <div class="col-md-12">
                                            <span class="badge badge-big badge-danger">&nbsp;</span> Convenzioni scadute
                                            &nbsp;|&nbsp;
                                            <span class="badge badge-big badge-warning">&nbsp;</span> Convenzioni in scadenza entro 7 giorni
                                        </div>

                                    </div>

                                    <!--
                                    <div class="row mt-30">
                                        <div class="col-lg-12">
                                            <h5 class="card-title">Project Status  </h5>
                                        </div>
                                        <div class="col-lg-6 mt-10 sm-mt-0">
                                            <div class="clearfix">
                                                <p class="mb-10 float-left">Tasks</p>
                                                <p class="mb-10 text-info float-right">801</p>
                                            </div>
                                            <div class="progress progress-small">
                                                <div class="skill2-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-10">
                                            <div class="clearfix">
                                                <p class="mb-10 float-left">Milestones</p>
                                                <p class="mb-10 text-success float-right">572</p>
                                            </div>
                                            <div class="progress progress-small">
                                                <div class="skill2-bar bg-success" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-10">
                                            <div class="clearfix">
                                                <p class="mb-10 float-left">TaskLists</p>
                                                <p class="mb-10 text-danger float-right">288</p>
                                            </div>
                                            <div class="progress progress-small">
                                                <div class="skill2-bar bg-danger" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mt-10 mb-10">
                                            <div class="clearfix">
                                                <p class="mb-10 float-left">Bugs</p>
                                                <p class="mb-10 text-warning float-right">766</p>
                                            </div>
                                            <div class="progress progress-small">
                                                <div class="skill2-bar bg-warning" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                </div>
                            </div>

                            <div class="card card-statistics mt-30">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 sm-mb-20 text-center">
                                            <h5 class="card-title">Convenzioni scadute / in scadenza</h5>
                                            <div class="chart-wrapper" style="width: 100%; margin: 0 auto;">
                                                <div id="canvas-holder">
                                                    <canvas id="chart-scadenze" width="550" data-value="[<?php echo countConvenzioniChart($get_cv_id); ?>]"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <!--
                                        <div class="col-md-6 text-center">
                                            <h5 class="card-title">Bug Progress </h5>
                                            <div id="morris-donut" style="height: 260px;"></div>
                                        </div>
                                        -->

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-4 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">
                                    <h5 class="card-title">Dettaglio</h5>
                                    <p>Codice: <b><?php echo $row_data['cv_codice']; ?></b></p>
                                    <p>Titolo: <b><?php echo $row_data['cv_titolo']; ?></b></p>
                                    <p>Canone: <b><?php echo strlen($row_data['cv_canone']) > 0 ? "&euro;".formatPrice(@$row_data['cv_canone']) : "Gratuito"; ?></b></p>

                                    <h6 class="mb-10 mt-20">Descrizione</h6>
                                    <p><?php echo $row_data['cv_descrizione']; ?></p>

                                    <h6 class="mb-10 mt-20">Codici CER</h6>
                                    <ul class="list list-unstyled">

                                        <?php
                                        $querySql =
                                            "SELECT * FROM cr_convenzioni_cer INNER JOIN cc_codici_cer ON cc_id = cr_cc_id ".
                                            "WHERE cr_cv_id = '$get_cv_id' ORDER BY cc_codice ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            echo "<li> <i class='fa fa-exclamation-triangle text-warning'></i> <b>".$row_data['cc_codice']."</b> / ".$row_data['cc_descrizione']."</li>";

                                        }

                                        $result->close();
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <!--
                            <div class="card card-statistics mt-30">
                                <div class="card-body">
                                    <h5 class="card-title">Project overview</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-20">
                                            <div class="media">
                                                <div class="position-relative">
                                                    <img class="img-fluid mr-15 avatar-small" src="images/team/05.jpg" alt="">
                                                    <i class="avatar-online bg-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 text-info">Martin smith </h6>
                                                    <p>@potenzauser</p>
                                                </div>
                                            </div>
                                            <div class="divider mt-20"></div>
                                        </li>
                                        <li class="mb-20">
                                            <div class="media">
                                                <div class="position-relative clearfix">
                                                    <img class="img-fluid mr-15 avatar-small" src="images/team/02.jpg" alt="">
                                                    <i class="avatar-online bg-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 text-warning">Paul Flavius </h6>
                                                    <p>@potenzauser</p>
                                                </div>
                                            </div>
                                            <div class="divider mt-20"></div>
                                        </li>
                                        <li class="mb-20">
                                            <div class="media">
                                                <div class="position-relative">
                                                    <img class="img-fluid mr-15 avatar-small" src="images/team/03.jpg" alt="">
                                                    <i class="avatar-online bg-danger"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 text-danger">Anne Smith</h6>
                                                    <p>@potenzauser</p>
                                                </div>
                                            </div>
                                            <div class="divider mt-20"></div>
                                        </li>
                                        <li class="mb-20">
                                            <div class="media">
                                                <div class="position-relative">
                                                    <img class="img-fluid mr-15 avatar-small" src="images/team/04.jpg" alt="">
                                                    <i class="avatar-online bg-success"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mt-0 text-info">Sara Lisbon </h6>
                                                    <p>@potenzauser</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            -->

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