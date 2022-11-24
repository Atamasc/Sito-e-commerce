<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_nl_id = isset($_GET['nl_id']) ? (int)$_GET['nl_id'] : 0;

$get_no_ns_id = isset($_GET["ns_id"]) ? $dbConn->real_escape_string($_GET["ns_id"]) : "";
$no_tipo = isset($_GET['no_tipo']) ? $dbConn->real_escape_string($_GET["no_tipo"]) : ""
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
                            <h4 class="mb-0"> Gestione newsletter </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="newsletter-gst.php" class="default-color">Gestione newsletter</a></li>
                                <li class="breadcrumb-item active">Log e report campagne</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra log</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="no_ns_id">Filtra per lista</label>
                                            <select class="form-control" id="no_ns_id" name="no_ns_id">
                                                <option value="">Seleziona una lista</option>
                                                <option value=""></option>
                                                <?php selectListeEmail($get_nl_ns_id, $dbConn) ?>
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

                                <h5 class="card-title border-0 pb-0">Elenco report campagne</h5>

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
                                            <th width="50">ID</th>
                                            <th>Newsletter</th>
                                            <th>Categorie</th>
                                            <th>Email inviate</th>
                                            <th>Email lette</th>
                                            <th>Click totali</th>
                                            <th>Tipo</th>
                                            <th width="150">Data e ora inizio</th>
                                            <th width="150">Data e ora fine</th>
                                            <th style="text-align: center;" width="200">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(DISTINCT(no_timestamp)) FROM no_newsletter_log WHERE no_id > 0 ";

                                        if($get_no_ns_id > 0) $querySql .= "AND ns_id = '$get_no_ns_id' ";
                                        if(strlen(@$_GET['no_timestamp_dal']) > 0) $querySql .= "AND no_timestamp >= '".strtotime($_GET['no_timestamp_dal'])."' ";
                                        if(strlen(@$_GET['no_timestamp_al']) > 0) $querySql .= "AND no_timestamp <= '".strtotime($_GET['no_timestamp_al'])."' ";
                                        if(strlen($no_tipo) > 0) $querySql .= " AND no_tipo = '$no_tipo' ";

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

                                        $querySql = "SELECT * FROM (";
                                        $querySql .= "SELECT 'newsletter' AS no_tipo, no_id, nl_id AS sv_id, nl_titolo, no_timestamp, MAX(no_timestamp_fine) AS no_timestamp_fine, COUNT(no_id) AS no_totale_email, ns_newsletter_liste.* FROM no_newsletter_log INNER JOIN ns_newsletter_liste ON no_ns_id = ns_id INNER JOIN nl_newsletter ON nl_id = no_nl_id GROUP BY no_timestamp ";
                                        $querySql .= "UNION ";
                                        $querySql .= "SELECT 'blog' AS no_tipo, no_id, nb_id AS sv_id, 'News dal blog' as nl_titolo, no_timestamp, MAX(no_timestamp_fine) AS no_timestamp_fine, COUNT(no_id) AS no_totale_email, ns_newsletter_liste.* FROM no_newsletter_log INNER JOIN ns_newsletter_liste ON no_ns_id = ns_id INNER JOIN nb_newsletter_blog ON nb_id = no_nb_id GROUP BY no_timestamp ";
                                        $querySql .= ") AS a WHERE no_id > 0 ";

                                        if($get_no_ns_id > 0) $querySql .= "AND ns_id = '$get_no_ns_id' ";

                                        if(strlen(@$_GET['no_timestamp_dal']) > 0) $querySql .= "AND no_timestamp >= '".strtotime($_GET['no_timestamp_dal'])."' ";
                                        if(strlen(@$_GET['no_timestamp_al']) > 0) $querySql .= "AND no_timestamp <= '".strtotime($_GET['no_timestamp_al'])."' ";

                                        if(strlen($no_tipo) > 0) $querySql .= " AND no_tipo = '$no_tipo' ";

                                        $querySql .= " GROUP BY no_timestamp ORDER BY no_timestamp DESC LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $no_id = $row_data['no_id'];
                                            $sv_id = $row_data['sv_id'];
                                            $no_ns_id = $row_data['no_ns_id'];
                                            $ns_titolo = $row_data['ns_lista'];
                                            $no_timestamp = $row_data['no_timestamp'];

                                            if(strlen($row_data['no_totale_email']) == 0) $row_data['no_totale_email'] = $row_data['no_count_email'];

                                            $querySql_count = "SELECT COUNT(no_id) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' AND no_stato_invio = 'Successo' ";
                                            $result_count = $dbConn->query($querySql_count);
                                            $row_data_count = $result_count->fetch_array();
                                            $count_email = $row_data_count[0];
                                            $result_count->close();

                                            $querySql_count = "SELECT COUNT(no_id) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' AND no_stato_lettura = 1 ";
                                            $result_count = $dbConn->query($querySql_count);
                                            $row_data_count = $result_count->fetch_array();
                                            $count_lette = $row_data_count[0];
                                            $result_count->close();

                                            $querySql_count = "SELECT SUM(no_click) FROM no_newsletter_log WHERE no_timestamp = '$no_timestamp' ";
                                            $result_count = $dbConn->query($querySql_count);
                                            $row_data_count = $result_count->fetch_array();
                                            $count_click = $row_data_count[0];
                                            $result_count->close();

                                            echo "<tr>";

                                            echo "<tr>";
                                            echo "<td>".$no_id."</td>";
                                            echo "<td>";
                                            echo $row_data['nl_titolo'];

                                            //echo "<em>".$row_data['nl_descrizione']."</em>";
                                            echo "</td>";
                                            echo "<td>".$ns_titolo."</td>";
                                            echo "<td>".$count_email." di ".$row_data['no_totale_email']."</td>";
                                            echo "<td>".$count_lette." su ".$row_data['no_totale_email']."</td>";
                                            echo "<td>$count_click</td>";
                                            echo "<td>".$row_data['no_tipo']."</td>";
                                            echo "<td>".date("H:i d/m/Y", $row_data['no_timestamp'])."</td>";
                                            if(strlen($row_data['no_timestamp_fine']) > 0) echo "<td>".date("H:i d/m/Y", $row_data['no_timestamp_fine'])."</td>";
                                            else echo "<td></td>";

                                            //Gestione
                                            echo "<td align='center'>";

                                            if($row_data['no_tipo'] == "blog")
                                                echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-blog-view.php?nb_id=$sv_id'>anteprima</button>&nbsp;";
                                            else
                                                echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-immagine-view.php?nl_id=$sv_id'>anteprima</button>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='newsletter-log-email.php?no_timestamp=$no_timestamp' title='Email'>email</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono log presenti</td></tr>";
                                        }

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