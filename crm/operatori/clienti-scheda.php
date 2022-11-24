<?php include "inc/autoloader.php"; ?>

<?php
$get_cl_id = (int)$_GET['cl_id'];

$querySql = "SELECT * FROM cl_clienti WHERE cl_id = $get_cl_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$querySql = "SELECT ct_titolo FROM cc_clienti_categorie INNER JOIN ct_categoria ON ct_id = cc_ct_id WHERE cc_cl_codice = '".$row_data['cl_codice']."' ";
$result = $dbConn->query($querySql);
$ct_titolo = $result->fetch_array()[0];
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
            <div class="content-wrapper profile-page">

                <div class="row">
                    <div class="col-lg-12 mb-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="user-bg" style="background: url(../../img/slides/corporate/slide1.jpg); background-position: center;">
                                    <div class="user-info">
                                        <div class="row">
                                            <div class="col-lg-6 align-self-center">
                                                <div class="user-dp" style="background-color:#80b701;; width: 50px; height: 50px; border: 3px #fff solid; border-radius: 50%; margin-right: 40px; overflow: hidden;">
                                                    <!--<img src="../images/team/11.jpg" alt="">-->
                                                    <i class="fa fa-user fa-5x" style=" margin-right:30px; color:#fff; font-size:104px!important; transform: translateX(16px) "></i>
                                                </div>
                                                <div class="user-detail" style="padding-left: 20px">
                                                    <h2 class="name"><?php echo $row_data['cl_ragione_sociale']; ?></h2>
                                                    <p class="designation mb-0"><?php echo $row_data['cl_indirizzo'].", ".$row_data['cl_comune']." (".$row_data['cl_provincia'].")"; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-right align-self-center">
                                                <button type="button" class="btn btn-sm btn-danger"><i class="ti-user pr-1"></i>Follow</button>
                                                <button type="button" class="btn btn-sm btn-success"><i class="ti-email pr-1"></i>Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-danger rounded-circle">
                                        <span class="text-white"><i class="fa fa-random highlight-icon" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Richieste</p>
                                        <?php
                                        function pageGetClienteRichieste($cl_email) {

                                            global $dbConn;
                                            $querySql = "SELECT COUNT(ro_id) FROM ro_richiesta_offerta INNER JOIN le_lead ON le_id = ro_le_id WHERE le_email = '$cl_email' ";
                                            $result = $dbConn->query($querySql);
                                            $count = $result->fetch_array()[0];
                                            $result->close();

                                            return $count;

                                        }
                                        ?>
                                        <h4><?php echo pageGetClienteRichieste($row_data['cl_email']); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-primary rounded-circle">
                                        <span class="text-white"><i class="fa fa-file highlight-icon" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Omologhe</p>
                                        <?php
                                        function pageGetClienteOmologhe($cl_id) {

                                            global $dbConn;
                                            $querySql = "SELECT COUNT(om_id) FROM om_omologa WHERE om_cl_id = '$cl_id' ";
                                            $result = $dbConn->query($querySql);
                                            $count = $result->fetch_array()[0];
                                            $result->close();

                                            return $count;

                                        }
                                        ?>
                                        <h4><?php echo pageGetClienteOmologhe($get_cl_id); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-warning rounded-circle">
                                        <span class="text-white"><i class="fa fa-euro highlight-icon" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Quotazioni</p>
                                        <?php
                                        function pageGetClienteQuotazioni($cl_id) {

                                            global $dbConn;
                                            $querySql = "SELECT COUNT(qt_id) FROM qt_quotazioni INNER JOIN om_omologa ON om_qt_id = qt_id WHERE om_cl_id = '$cl_id' ";
                                            $result = $dbConn->query($querySql);
                                            $count = $result->fetch_array()[0];
                                            $result->close();

                                            return $count;

                                        }
                                        ?>
                                        <h4><?php echo pageGetClienteQuotazioni($get_cl_id); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left icon-box bg-dark rounded-circle">
                                        <span class="text-white"><i class="fa fa-truck highlight-icon" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="float-right text-right">
                                        <p class="card-text text-dark">Conferimenti</p>
                                        <?php
                                        function pageGetClienteConferimenti($cl_id) {

                                            global $dbConn;
                                            $querySql = "SELECT COUNT(cn_id) FROM cn_conferimento INNER JOIN om_omologa ON om_id = cn_om_id WHERE om_cl_id = '$cl_id' ";
                                            $result = $dbConn->query($querySql);
                                            $count = $result->fetch_array()[0];
                                            $result->close();

                                            return $count;

                                        }
                                        ?>
                                        <h4><?php echo pageGetClienteConferimenti($get_cl_id); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-10">
                        <div class="card mb-30 about-me">
                            <div class="card-body">
                                <h5 class="card-title"> Dati cliente</h5>
                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="clienti-mod.php?cl_id=<?php echo $get_cl_id; ?>"><i class="text-success ti-pencil-alt"></i> Modifica dati</a>
                                        <!--<a class="dropdown-item" href="#"><i class="text-info ti-settings"></i> Account Setting</a>-->
                                    </div>
                                </div>
                                <!--
                                <p>I have more than 9 years of experience in the field of Graphic/ E-Learning/Web Designing.</p>
                                <p>Specialized in Adobe web & graphic designing tools and also in other tools. Professional in Corporate branding, Graphic designing, Web Designing, visualization, GUI, graphics & animations for e-learning, illustrations, web icons, logos, brochures, posters etc.</p>
                                -->

                                <p><b>Referente rifiuti:</b> <?php echo strlen($row_data['cl_ref_rifiuti']) > 0 ? $row_data['cl_ref_rifiuti'] : "Non specificato"; ?></p>
                                <p><b>Referente contabilità:</b> <?php echo strlen($row_data['cl_ref_contabile']) > 0 ? $row_data['cl_ref_contabile'] : "Non specificato"; ?></p>

                                <ul class="list-unstyled">
                                    <li class="list-item"><span class="text-success fa fa-users"></span><?php echo strlen($ct_titolo) > 0 ? "Categoria $ct_titolo" : "Non categorizzato"; ?></li>
                                    <li class="list-item"><span class="text-info fa fa-envelope"></span><?php echo $row_data['cl_email']; ?></li>
                                    <li class="list-item"><span class="text-warning fa fa-phone"></span><?php echo $row_data['cl_telefono']; ?></li>
                                    <li class="list-item"><span class="text-success fa fa-id-card-o"></span>P.IVA: <?php echo $row_data['cl_partita_iva']; ?></li>
                                    <li class="list-item"><span class="text-dark fa fa-id-card-o"></span>Cod. Fiscale: <?php echo $row_data['cl_cod_fiscale']; ?></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card card-statistics mb-10">
                            <div class="card-body">
                                <h5 class="card-title"> Richieste di informazioni</h5>
                                <!-- action group -->
                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <!--
                                        <a class="dropdown-item" href="#"><i class="text-success ti-thumb-up"></i> Mark As Read</a>
                                        <a class="dropdown-item" href="#"><i class="text-danger ti-trash"></i> Delete all</a>
                                        -->
                                        <a class="dropdown-item" href="richiesta-offerta-gst.php?le_email=<?php echo $row_data['cl_email'] ?>"><i class="text-success fa fa-list"></i> Vai alla lista</a>
                                    </div>
                                </div>
                                <div class="scrollbar max-h-350">
                                    <ul class="list-unstyled">

                                        <?php
                                        pageGetRichieste($row_data['cl_email']);
                                        function pageGetRichieste($le_email) {

                                            global $dbConn;

                                            $querySql =
                                                "SELECT * FROM ro_richiesta_offerta INNER JOIN le_lead ON ro_le_id = le_id WHERE ro_id > 0 AND le_email = '$le_email' ".
                                                "ORDER BY ro_timestamp DESC ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ro_id = $row_data['ro_id'];

                                                $badge = "";
                                                switch ($row_data['ro_stato']) {

                                                    case "In attesa": $badge = "bg-warning"; break;
                                                    case "In consulenza": $badge = "bg-info"; break;
                                                    case "In omologa": $badge = "bg-success"; break;
                                                    case "Rifiutata": $badge = "bg-danger"; break;

                                                }

                                                ?>
                                                <li class="mb-15">
                                                    <div class="media">
                                                        <div class="position-relative">
                                                            <!--<img class="img-fluid mr-15 avatar-small" src="../images/team/07.jpg" alt="">-->
                                                            <i class="img-fluid mr-15 avatar-small fa fa-comment fa-3x"></i>
                                                            <i class="avatar-online <?php echo $badge; ?>" title="<?php echo $row_data['ro_stato']; ?>"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mt-0 ">
                                                                <a href="richiesta-offerta-mod.php?ro_id=<?php echo $ro_id; ?>"><?php echo $row_data['le_ragione_sociale'].", ".$row_data['le_ref_rifiuti']; ?></a>
                                                                <small class="float-right"><?php echo date("d/m/Y H:i", $row_data['ro_timestamp']); ?></small>
                                                            </h6>
                                                            <p><?php echo $row_data['ro_note']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="divider mt-15"></div>
                                                </li>
                                                <?php

                                            };

                                            if ($rows == 0) echo "<p>Non ci sono richieste presenti</p>";

                                            $result->close();

                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card card-statistics">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista attività</h5>

                                <div class="scrollbar max-h-350">
                                    <ul class="list-unstyled">

                                        <?php
                                        pageGetAttivita($row_data['cl_id']);
                                        function pageGetAttivita($cl_id) {

                                            global $dbConn;

                                            $querySql =
                                                "SELECT * FROM at_attivita INNER JOIN cl_clienti ON cl_id = at_cl_id WHERE at_cl_id = '$cl_id' ".
                                                "ORDER BY at_data_attivita, at_ora_attivita ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $at_data_ora = date("d/m/Y", $row_data['at_data_attivita'])." ".$row_data['at_ora_attivita'];

                                                $badge = "";
                                                switch ($row_data['at_esito']) {

                                                    case "In corso": $badge = "bg-warning"; break;
                                                    case "Positivo": $badge = "bg-success"; break;
                                                    case "Negativo": $badge = "bg-danger"; break;

                                                }

                                                ?>
                                                <li class="mb-15">
                                                    <div class="media">
                                                        <div class="position-relative">
                                                            <!--<img class="img-fluid mr-15 avatar-small" src="../images/team/07.jpg" alt="">-->
                                                            <i class="img-fluid mr-15 avatar-small fa fa-book fa-3x"></i>
                                                            <i class="avatar-online <?php echo $badge; ?>" title="<?php echo $row_data['at_esito']; ?>"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6 class="mt-0 ">
                                                                <?php echo $row_data['at_tipologia']; ?>
                                                                <small class="float-right"><?php echo $at_data_ora; ?></small>
                                                            </h6>
                                                            <p><?php echo $row_data['at_note']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="divider mt-15"></div>
                                                </li>
                                                <?php

                                            };

                                            if ($rows == 0) echo "<p>Non ci sono attività presenti</p>";

                                            $result->close();

                                        }
                                        ?>

                                    </ul>
                                </div>

                            </div>

                        </div>

                    </div>
                    <div class="col-xl-8 mb-30">
                        <!--
                        <div class="card mb-30">
                            <div class="card-body">
                                <div class="comment-block">
                                    <div class="form-group mb-0">
                                        <div id="summernote"><p>Hello Webmin</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Ultime 5 omologhe</h5>
                                <!-- action group -->
                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="omologa-gst.php?cl_id=<?php echo $get_cl_id; ?>"><i class="text-success fa fa-list"></i> Vedi tutte</a>
                                        <a class="dropdown-item" href="omologa-add.php?cl_id=<?php echo $get_cl_id; ?>"><i class="text-success fa fa-plus"></i> Nuova omologa</a>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th style="width: 500px;">Cliente</th>
                                            <th style="width: 120px;" class='text-center'>Stato</th>
                                            <th style="width: 150px;">Data inserimento</th>
                                            <th style="text-align: center; width: 150px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT * FROM om_omologa INNER JOIN cl_clienti ON cl_id = om_cl_id WHERE om_id > 0 AND cl_id = '$get_cl_id' ORDER BY om_id DESC LIMIT 0, 5";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $om_id = $row_data['om_id'];
                                            $om_qt_id = $row_data['om_qt_id'];

                                            echo "<tr>";
                                            echo "<td>OM-$om_id</td>";
                                            echo "<td>".$row_data['cl_ragione_sociale']."</td>";

                                            $badge = "";
                                            switch ($row_data['om_stato_text']) {

                                                case "In attesa": $badge = "badge-warning"; break;
                                                case "In consulenza": $badge = "badge-info"; break;
                                                case "Approvata": $badge = "badge-success"; break;
                                                case "Rifiutata": $badge = "badge-danger"; break;

                                            }

                                            echo "<td class='text-center'><span class='badge $badge'>".$row_data['om_stato_text']."</span></td>";
                                            echo "<td>".date("d/m/Y", $row_data['om_timestamp'])."</td>";

                                            //Gestione
                                            ?>
                                            <td class="text-center">
                                                <div class="btn-group mb-1">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">Gestione</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="allegati-gst.php?al_tab_id=<?php echo $om_id; ?>&al_tipo=Omologa">Allegati</a>
                                                        <a class="dropdown-item" href="omologa-mod.php?om_id=<?php echo $om_id; ?>">Modifica</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php

                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono omologhe presenti</td></tr>";

                                        $result->close();

                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Ultime 5 richieste di conferimento</h5>
                                <!-- action group -->
                                <div class="btn-group info-drop">
                                    <button type="button" class="dropdown-toggle-split text-muted" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ti-more"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="conferimento-gst.php?cl_id=<?php echo $get_cl_id; ?>"><i class="text-success fa fa-list"></i> Vedi tutte</a>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th style="width: 600px;">Cliente</th>
                                            <th style="width: 150px;">Data richiesta</th>
                                            <th style="text-align: center; width: 150px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT * FROM cn_conferimento INNER JOIN om_omologa ON om_id = cn_om_id ".
                                            "INNER JOIN cl_clienti ON cl_id = om_cl_id ".
                                            "WHERE cn_id > 0 AND cl_id = '$get_cl_id' ORDER BY cn_id LIMIT 0, 5";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $cn_id = $row_data['cn_id'];
                                            $om_id = $row_data['om_id'];

                                            echo "<tr>";
                                            echo "<td>CN-$cn_id</td>";
                                            echo "<td>".$row_data['cl_ragione_sociale']."</td>";
                                            echo "<td>".date("d/m/Y", $row_data['cn_timestamp'])."</td>";

                                            //Gestione
                                            ?>
                                            <td class="text-center">
                                                <div class="btn-group mb-1">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">Gestione</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="allegati-gst.php?al_tab_id=<?php echo $cn_id; ?>&al_tipo=Conferimento">Allegati</a>
                                                        <a class="dropdown-item" href="omologa-conferimento.php?om_id=<?php echo $om_id; ?>&cn_id=<?php echo $cn_id; ?>">Modifica</a>
                                                        <a class="dropdown-item" href="conferimento-programmazione.php?cn_id=<?php echo $cn_id; ?>">Pianifica</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php

                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono richieste presenti</td></tr>";

                                        $result->close();
                                        ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <h5 class="card-title">Ultime 5 quotazioni associate</h5>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th>Titolo</th>
                                            <th>Scadenza</th>
                                            <th style="text-align: center; width: 150px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT * FROM qt_quotazioni INNER JOIN om_omologa ON om_qt_id = qt_id WHERE om_cl_id = '$get_cl_id' ORDER BY qt_id LIMIT 0, 5";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $qt_id = $row_data['qt_id'];

                                            echo "<tr>";
                                            echo "<td>QT-$qt_id</td>";
                                            echo "<td>".$row_data['qt_titolo']."</td>";
                                            echo "<td>".date("d/m/Y", $row_data['qt_scadenza'])."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-orange btn-sm' href='quotazioni-view.php?qt_id=$qt_id' title='Dettaglio'>dettaglio</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono quotazioni</td></tr>";

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
