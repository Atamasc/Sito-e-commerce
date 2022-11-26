<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_cr_fr_id = isset($_GET['cr_fr_id']) ? (int)$_GET['cr_fr_id'] : "";
$get_cr_codice = isset($_GET['cr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cr_codice']))) : "";
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

                                    <h5 class="card-title">Filtra carichi</h5>

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
                                            <label for="cr_codice">Codice</label>
                                            <input type="text" name="cr_codice" class="form-control" value="<?php echo $get_cr_codice; ?>">
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

                                <h5 class="card-title border-0 pb-0">Lista carichi</h5>

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
                                            <th>Fornitore</th>
                                            <th>Data</th>
                                            <th>Lotti collegati</th>
                                            <th style="text-align: center;">Stato</th>
                                            <th style="text-align: center; width: 250px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(cr_id) FROM cr_carichi INNER JOIN fr_fornitori ON fr_id = cr_fr_id WHERE cr_id > 0 ";
                                        if(strlen($get_cr_fr_id) > 0) $querySql .= " AND cr_fr_id = '$get_cr_fr_id' ";
                                        if(strlen($get_cr_codice) > 0) $querySql .= " AND cr_codice LIKE '%$get_cr_codice%' ";
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

                                        $querySql = "SELECT * FROM cr_carichi INNER JOIN fr_fornitori ON fr_id = cr_fr_id WHERE cr_id > 0 ";
                                        if(strlen($get_cr_fr_id) > 0) $querySql .= " AND cr_fr_id = '$get_cr_fr_id' ";
                                        if(strlen($get_cr_codice) > 0) $querySql .= " AND cr_codice LIKE '%$get_cr_codice%' ";
                                        $querySql .= " ORDER BY cr_timestamp LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $cr_id = $row_data['cr_id'];
                                            $count_lotti = countLottiByCarico($cr_id);

                                            echo "<tr>";
                                            echo "<td>".$row_data['cr_codice']."</td>";
                                            echo "<td>".$row_data['fr_ragione_sociale']."</td>";
                                            echo "<td>".date("d/m/Y", $row_data['cr_timestamp'])."</td>";
                                            echo "<td>$count_lotti</td>";

                                            //Stato
                                            $checked = $row_data['cr_stato'] > 0 ? "checked" : "";
                                            ?>
                                            <td align='center'>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato"
                                                               title="carichi-stato-do.php?cr_id=<?php echo $cr_id; ?>" <?php echo $checked;?>><span></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <?php

                                            //Gestione
                                            echo "<td align='center'>";
                                            //echo "<button class='btn btn-primary btn-sm modale' data-href='clienti-scheda-modale.php?ut_id=$ut_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                                            echo "<a class='btn btn-purple btn-sm' href='allegati-gst.php?al_tab_id=$cr_id&al_tipo=Carico' title='allegati'>allegati</a>&nbsp;";
                                            echo "<a class='btn btn-orange btn-sm' href='lotti-add.php?cr_id=$cr_id' title='Lotti'>lotti</a>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='carichi-mod.php?cr_id=$cr_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo $count_lotti > 0
                                                ? "<button class='btn btn-danger btn-sm disabled'><i class='far fa-trash-alt'></i></button>"
                                                : "<button class='btn btn-danger btn-sm elimina' data-href='carichi-del-do.php?cr_id=$cr_id'><i class='far fa-trash-alt'></i></button>";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

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