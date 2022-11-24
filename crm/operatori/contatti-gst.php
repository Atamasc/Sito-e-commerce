<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_co_email = isset($_GET['co_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['co_email']))) : "";

$get_co_timestamp_da = isset($_GET['co_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['co_timestamp_da']))) : "";
$get_co_timestamp_a = isset($_GET['co_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['co_timestamp_a']))) : "";

if(strlen($get_co_timestamp_da) > 0) {

    list($day, $month, $year) = explode("/", $get_co_timestamp_da);
    $get_co_timestamp_da = mktime(0, 0, 0, $month, $day, $year);

}

if(strlen($get_co_timestamp_a) > 0) {

    list($day, $month, $year) = explode("/", $get_co_timestamp_a);
    $get_co_timestamp_a = mktime(23, 59, 59, $month, $day, $year);

}
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
                            <h4 class="mb-0"> Gestione contatti</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione contatti</li>
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

                                    <h5 class="card-title">Filtra contatti</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="co_email">Email</label>
                                            <input name="co_email" id="co_email" class="form-control" type="text" autocomplete="off"
                                                   value="<?php echo $get_co_email; ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Data</label>
                                            <div class="input-group" data-date="">
                                                <input name="co_timestamp_da" class="form-control range-from" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_co_timestamp_da) > 0) echo date("d/m/Y", $get_co_timestamp_da); ?>">
                                                <span class="input-group-addon">A</span>
                                                <input name="co_timestamp_a" class="form-control range-to" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_co_timestamp_a) > 0) echo date("d/m/Y", $get_co_timestamp_a); ?>">
                                            </div>
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

                                <h5 class="card-title border-0 pb-0">Lista contatti</h5>

                                <?php
                                if(@$_GET['delete'] == 'true') { ?>

                                    <div class="alert alert-success" role="alert">
                                        Eliminazione avvenuta con successo.
                                    </div>
                                    <?php

                                }
                                else if(@$_GET['delete'] == 'false') { ?>

                                    <div class="alert alert-danger" role="alert">
                                        C'è stato un errore durante l'eliminazione
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Cognome</th>
                                            <th>Email</th>
                                            <th>Data</th>
                                            <th>Indirizzo IP</th>
                                            <th style="text-align: center;" width="350">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(co_id) FROM co_contatto 
                                                     INNER JOIN py_privacy ON co_email = py_email 
                                                     WHERE co_id > 0 AND py_attivita = 'Contatto' 
                                                     GROUP BY co_id";
                                        if(strlen($get_co_email) > 0) $querySql .= " AND co_email LIKE '%$get_co_email%' ";
                                        if(strlen($get_co_timestamp_da) > 0) $querySql .= " AND co_data >= '$get_co_timestamp_da' ";
                                        if(strlen($get_co_timestamp_a) > 0) $querySql .= " AND co_data <= '$get_co_timestamp_a' ";
                                        $result = $dbConn->query($querySql);
                                        $row = $result->fetch_row();

                                        // numero totale del count
                                        $row_cnt = $row[0];
                                        // risultati per pagina(secondo parametro di LIMIT)
                                        $per_page = 30;
                                        // numero totale di pagine
                                        $tot_pages = ceil($row_cnt / $per_page);
                                        // pagina corrente
                                        $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                        // primo parametro di LIMIT
                                        $primo = ($current_page - 1) * $per_page;

                                        $querySql = "SELECT * FROM co_contatto 
                                                     INNER JOIN py_privacy ON co_email = py_email 
                                                     WHERE co_id > 0 AND py_attivita = 'Contatto' ";
                                        if(strlen($get_co_email) > 0) $querySql .= " AND co_email LIKE '%$get_co_email%' ";
                                        if(strlen($get_co_timestamp_da) > 0) $querySql .= " AND co_data >= '$get_co_timestamp_da' ";
                                        if(strlen($get_co_timestamp_a) > 0) $querySql .= " AND co_data <= '$get_co_timestamp_a' ";
                                        $querySql .= " GROUP BY co_id ORDER BY co_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $co_id = $row_data['co_id'];

                                            $class_privacy = $row_data['py_checkbox_privacy'] > 0 ? 'btn-success' : 'btn-danger';
                                            $class_marketing = $row_data['py_checkbox_marketing'] > 0 ? 'btn-success' : 'btn-danger';
                                            $class_cessione = $row_data['py_checkbox_cessione'] > 0 ? 'btn-success' : 'btn-danger';

                                            echo "<tr>";
                                            echo "<td>$co_id</td>";
                                            echo "<td>".$row_data['co_nome']."</td>";
                                            echo "<td>".$row_data['co_cognome']."</td>";
                                            echo "<td>".$row_data['co_email']."</td>";
                                            echo "<td>".date("d/m/Y - H:i", $row_data['co_data'])."</td>";
                                            echo "<td>".$row_data['py_ip']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<div class='btn btn-primary btn-sm modale' data-href='contatti-scheda-modale.php?co_id=$co_id' title='Visualizza scheda'>scheda</div>&nbsp;";
                                            echo "<div class='btn btn-success btn-sm modale' data-href='contatti-dettaglio.php?co_id=$co_id' title='Visualizza anagrafica'>dettaglio</div>&nbsp;";
                                            echo "<div class='btn btn-danger btn-sm elimina' data-href='contatti-del-do.php?co_id=$co_id'>elimina</div>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche presenti</td></tr>";
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