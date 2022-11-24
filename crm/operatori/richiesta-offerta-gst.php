<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_le_ragione_sociale = isset($_GET['le_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['le_ragione_sociale']))) : "";
$get_le_email = isset($_GET['le_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['le_email']))) : "";
$get_ro_stato = isset($_GET['ro_stato']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ro_stato']))) : "";
?>

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
                            <h4 class="mb-0"> Gestione richieste di offerta </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione richieste di offerta</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra richieste di offerta</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="le_ragione_sociale">Ragione sociale</label>
                                            <input type="text" name="le_ragione_sociale" class="form-control" value="<?php echo $get_le_ragione_sociale; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="le_email">Email</label>
                                            <input name="le_email" id="le_email" class="form-control" type="text" autocomplete="off"
                                                   value="<?php echo $get_le_email; ?>">
                                        </div>

                                        <div class="col-md-3 mb-30">
                                            <label for="ro_stato">Stato</label>
                                            <select class="form-control" name="ro_stato" id="ro_stato" required>
                                                <option value="">Filtra per stato</option>
                                                <option value=""></option>
                                                <option value="In attesa" <?php echo $get_ro_stato == "In attesa" ? "selected" : "" ; ?>>In attesa</option>
                                                <option value="In consulenza" <?php echo $get_ro_stato == "In consulenza" ? "selected" : "" ; ?>>In consulenza</option>
                                                <option value="In omologa" <?php echo $get_ro_stato == "In omologa" ? "selected" : "" ; ?>>In omologa</option>
                                                <option value="Rifiutata" <?php echo $get_ro_stato == "Rifiutata" ? "selected" : "" ; ?>>Rifiutata</option>
                                            </select>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">Cerca</button>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista richieste di offerta</h5>

                                <?php
                                if(@$_GET['delete'] == 'true') {

                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        Eliminazione avvenuta con successo.
                                    </div>
                                    <?php

                                }
                                ?>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Codice</th>
                                            <th>Ragione sociale</th>
                                            <th>Mail</th>
                                            <th>Telefono</th>
                                            <th>Referente</th>
                                            <th class='text-center'>Stato</th>
                                            <th>Data e ora</th>
                                            <th style="text-align: center; width: 300px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(ro_id) FROM ro_richiesta_offerta INNER JOIN le_lead ON le_id = ro_le_id WHERE ro_id > 0 ";
                                        if(strlen($get_le_ragione_sociale) > 0) $querySql .= " AND le_ragione_sociale LIKE '%$get_le_ragione_sociale%' ";
                                        if(strlen($get_le_email) > 0) $querySql .= " AND le_email LIKE '%$get_le_email%' ";
                                        if(strlen($get_ro_stato) > 0) $querySql .= " AND ro_stato = '$get_ro_stato' ";
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

                                        $querySql = "SELECT * FROM ro_richiesta_offerta INNER JOIN le_lead ON ro_le_id = le_id WHERE ro_id > 0 ";
                                        if(strlen($get_le_ragione_sociale) > 0) $querySql .= " AND le_ragione_sociale LIKE '%$get_le_ragione_sociale%' ";
                                        if(strlen($get_le_email) > 0) $querySql .= " AND le_email LIKE '%$get_le_email%' ";
                                        if(strlen($get_ro_stato) > 0) $querySql .= " AND ro_stato = '$get_ro_stato' ";
                                        $querySql .= " ORDER BY ro_timestamp DESC LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $ro_id = $row_data['ro_id'];

                                            echo "<tr>";
                                            echo "<td>RO-$ro_id</td>";
                                            echo "<td>".$row_data['le_ragione_sociale']."</td>";
                                            echo "<td>".$row_data['le_email']."</td>";
                                            echo "<td>".$row_data['le_telefono']."</td>";
                                            echo "<td>".$row_data['le_ref_rifiuti']."</td>";

                                            $badge = "";
                                            switch ($row_data['ro_stato']) {

                                                case "In attesa": $badge = "badge-warning"; break;
                                                case "In consulenza": $badge = "badge-info"; break;
                                                case "In omologa": $badge = "badge-success"; break;
                                                case "Rifiutata": $badge = "badge-danger"; break;

                                            }

                                            echo "<td class='text-center'><span class='badge $badge'>".$row_data['ro_stato']."</span></td>";
                                            echo "<td>".date("d/m/Y H:i", $row_data['ro_timestamp'])."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-orange btn-sm' href='allegati-gst.php?al_tab_id=$ro_id&al_tipo=Richiesta di offerta' title='allegati'>allegati</a>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='richiesta-offerta-mod.php?ro_id=$ro_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='richiesta-offerta-del-do.php?ro_id=$ro_id'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono richieste presenti</td></tr>";

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