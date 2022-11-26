<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_cr_fr_id = isset($_GET['cr_fr_id']) ? (int)$_GET['cr_fr_id'] : "";
$get_lt_codice = isset($_GET['lt_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['lt_codice']))) : "";
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
                            <h4 class="mb-0"> Gestione carichi </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione carichi</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-10">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra lotti</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="cr_fr_id">Fornitore</label>
                                            <select class="form-control" id="cr_fr_id" name="cr_fr_id">
                                                <option value="">Seleziona un fornitore</option>
                                                <option value=""></option>
                                                <?php selectFornitori($get_cr_fr_id); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="lt_codice">Codice</label>
                                            <input type="text" name="lt_codice" class="form-control" value="<?php echo $get_lt_codice; ?>">
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

                                <h5 class="card-title border-0 pb-0">Lista lotti</h5>

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
                                            <th>Codice lotto</th>
                                            <th>Prodotto</th>
                                            <th>Quantità</th>
                                            <th>Codice carico</th>
                                            <th>Fornitore</th>
                                            <th>Data</th>
                                            <th style="text-align: center;">Stato</th>
                                            <th style="text-align: center; width: 100px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql =
                                            "SELECT COUNT(lt_id) FROM lt_lotti ".
                                            "INNER JOIN cr_carichi ON cr_id = lt_cr_id ".
                                            "INNER JOIN pr_prodotti ON pr_id = lt_pr_id ".
                                            "INNER JOIN fr_fornitori ON fr_id = cr_fr_id ".
                                            "WHERE lt_id > 0 ";
                                        if(strlen($get_cr_fr_id) > 0) $querySql .= " AND cr_fr_id = '$get_cr_fr_id' ";
                                        if(strlen($get_lt_codice) > 0) $querySql .= " AND lt_codice LIKE '%$get_lt_codice%' ";
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
                                            "SELECT * FROM lt_lotti ".
                                            "INNER JOIN cr_carichi ON cr_id = lt_cr_id ".
                                            "INNER JOIN pr_prodotti ON pr_id = lt_pr_id ".
                                            "INNER JOIN fr_fornitori ON fr_id = cr_fr_id ".
                                            "WHERE lt_id > 0 ";
                                        if(strlen($get_cr_fr_id) > 0) $querySql .= " AND cr_fr_id = '$get_cr_fr_id' ";
                                        if(strlen($get_lt_codice) > 0) $querySql .= " AND lt_codice LIKE '%$get_lt_codice%' ";
                                        $querySql .= " ORDER BY lt_timestamp LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $lt_id = $row_data['lt_id'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['lt_codice']."</td>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>".$row_data['lt_quantita']." ".$row_data['pr_um']."</td>";
                                            echo "<td>".$row_data['cr_codice']."</td>";
                                            echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                                            echo "<td>".date("d/m/Y", $row_data['lt_timestamp'])."</td>";

                                            //Stato
                                            $checked = $row_data['lt_stato'] > 0 ? "checked" : "";
                                            ?>
                                            <td align='center'>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato"
                                                               title="carichi-stato-do.php?lt_id=<?php echo $lt_id; ?>" <?php echo $checked;?>><span></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <?php

                                            //Gestione
                                            echo "<td align='center'>";
                                            //echo "<button class='btn btn-primary btn-sm modale' data-href='clienti-scheda-modale.php?ut_id=$ut_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='lotti-mod.php?lt_id=$lt_id' title='Modifica'>modifica</a>&nbsp;";
                                            //echo "<button class='btn btn-danger btn-sm elimina' data-href='lotti-del-do.php?lt_id=$lt_id'><i class='far fa-trash-alt'></i></button>";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono lotti presenti</td></tr>";

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