<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_nl_id = isset($_GET['nl_id']) ? (int)$_GET['nl_id'] : 0;

$get_nl_titolo = isset($_GET['nl_titolo']) ? $dbConn->real_escape_string(trim(stripslashes($_GET['nl_titolo']))) : "";
$get_nl_ns_id = isset($_GET['nl_ns_id']) ? $dbConn->real_escape_string(trim(stripslashes($_GET['nl_ns_id']))) : "";
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
                                <li class="breadcrumb-item active">Gestione newsletter</li>
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

                                    <h5 class="card-title">Filtra newsletter</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_titolo">Filtra per titolo</label>
                                            <input type="text" class="form-control" id="nl_titolo" name="nl_titolo" placeholder="Titolo"
                                                   value="<?php echo $get_nl_titolo; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="nl_ns_id">Filtra per lista</label>
                                            <select class="form-control" id="nl_ns_id" name="nl_ns_id">
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

                                <h5 class="card-title border-0 pb-0">Elenco newsletter</h5>

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
                                            <th>Newsletter</th>
                                            <th>Lista</th>
                                            <th style="text-align: center;" width="200">Email associate</th>
                                            <th style="text-align: center;" width="250">Invio</th>
                                            <th style="text-align: center;" width="500">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(nl_id) FROM nl_newsletter WHERE nl_id > 0 ";
                                        if(strlen($get_nl_titolo) > 0) $querySql .= " AND nl_titolo = '$get_nl_titolo' ";
                                        if(strlen($get_nl_ns_id) > 0) $querySql .= " AND nl_ns_id = '$get_nl_ns_id' ";
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

                                        $querySql = "SELECT * FROM nl_newsletter INNER JOIN ns_newsletter_liste ON ns_id = nl_ns_id WHERE nl_id > 0 ";
                                        if(strlen($get_nl_titolo) > 0) $querySql .= " AND nl_titolo = '$get_nl_titolo' ";
                                        if(strlen($get_nl_ns_id) > 0) $querySql .= " AND nl_ns_id = '$get_nl_ns_id' ";
                                        $querySql .= "ORDER BY nl_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $nl_id = $row_data["nl_id"];
                                            $nl_titolo = $row_data["nl_titolo"];
                                            $nl_descrizione = $row_data["nl_descrizione"];
                                            $nl_ns_id = $row_data["nl_ns_id"];
                                            $ns_lista = $row_data["ns_lista"];

                                            $count_email = countEmailLista($nl_ns_id, $dbConn);

                                            echo "<tr>";
                                            echo "<td>$nl_titolo<br><em>$nl_descrizione</em></td>";
                                            echo "<td>$ns_lista</td>";
                                            echo "<td class='text-center'>$count_email</td>";

                                            echo "<td align='center'>";
                                            echo "<button class='btn btn-warning btn-sm modale-email' title='newsletter-immagine-test-pop.php?nl_id=$nl_id'>invio test</button>&nbsp;";

                                            include_once "../class/class.controllo-mail.php";
                                            $checkmail = new ControlloMail($dbConn);

                                            if(!$checkmail->CheckMailEx($count_email))
                                                echo "<button class='btn btn-danger btn-sm' title='Limite raggiunto'>limite raggiunto</button>&nbsp;";
                                            else
                                                echo "<button class='btn btn-success btn-sm modale-email' title='newsletter-immagine-send-pop.php?nl_id=$nl_id'>invia newsletter</button>&nbsp;";

                                            echo "</td>";

                                            //Gestione
                                            echo "<td align='center'>";

                                            echo "<a class='btn btn-primary btn-sm' href='$upload_path_dir_newsletter/".$row_data['nl_immagine']."' title='Visualizza' target='_blank'>immagine</a>&nbsp;";
                                            echo "<a class='btn btn-primary btn-sm' href='$upload_path_dir_newsletter/".$row_data['nl_allegato']."' title='Visualizza' target='_blank'>allegato 1</a>&nbsp;";
                                            echo "<a class='btn btn-primary btn-sm' href='$upload_path_dir_newsletter/".$row_data['nl_allegato_2']."' title='Visualizza' target='_blank'>allegato 2</a>&nbsp;";
                                            echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-immagine-view.php?nl_id=$nl_id'>anteprima</button>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='newsletter-immagine-mod.php?nl_id=$nl_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='newsletter-immagine-del-do.php?nl_id=$nl_id'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono newsletter presenti</td></tr>";
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