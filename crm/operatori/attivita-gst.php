<?php include "inc/autoloader.php"; ?>
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
                            <h4 class="mb-0"> Gestione attività </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione attività</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista attività</h5>

                                <?php include "../inc/alerts.php"; ?>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Tipologia</th>
                                            <th>Luogo</th>
                                            <th>Esito</th>
                                            <th>Data e ora</th>
                                            <th style="text-align: center;">Stato</th>
                                            <th style="text-align: center; width: 200px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(at_id) FROM at_attivita INNER JOIN ut_utenti ON ut_id = at_ut_id WHERE at_id > 0 ";
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

                                        $querySql = "SELECT * FROM at_attivita INNER JOIN ut_utenti ON ut_id = at_ut_id WHERE at_id > 0 ";
                                        $querySql .= "ORDER BY at_data_attivita, at_ora_attivita LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $at_id = $row_data['at_id'];
                                            $at_data_ora = date("d/m/Y", $row_data['at_data_attivita'])." ".$row_data['at_ora_attivita'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['ut_ragione_sociale']."</td>";
                                            echo "<td>".$row_data['at_tipologia']."</td>";
                                            echo "<td>".$row_data['at_luogo']."</td>";
                                            echo "<td>".$row_data['at_esito']."</td>";
                                            echo "<td>$at_data_ora</td>";

                                            //Stato
                                            $checked = $row_data['at_stato'] > 0 ? "checked" : "";
                                            ?>
                                            <td class="text-center">
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato"
                                                               title="attivita-stato-do.php?at_id=<?php echo $at_id; ?>" <?php echo $checked;?>><span></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <?php

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-success btn-sm' href='attivita-mod.php?at_id=$at_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='attivita-del-do.php?at_id=$at_id'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                        };

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono attività</td></tr>";

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