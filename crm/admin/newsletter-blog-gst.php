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
                            <h4 class="mb-0"> Gestione newsletter </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione campagne blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Elenco campagne blog</h5>

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
                                            <th>Tipo</th>
                                            <th>Articolo primario</th>
                                            <th>Articoli secondari</th>
                                            <th width="300" style="text-align: center;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(nb_id) FROM nb_newsletter_blog WHERE nb_id > 0 ";
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

                                        $querySql =  "SELECT * FROM nb_newsletter_blog WHERE nb_id > 0 ORDER BY nb_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $nb_id = $row_data['nb_id'];

                                            $bl_titolo_prim = getTitoloBlog($row_data['nb_bl_prim'], $dbConn);

                                            $bl_titolo_sec = "";
                                            if($row_data['nb_bl_sec'] > 0) {

                                                $array = explode("|", $row_data['nb_bl_sec']);
                                                $nb_bl_sec = join("','", $array);

                                                $querySql_sec = "SELECT bl_titolo FROM bl_blog WHERE bl_id IN ('$nb_bl_sec') ";
                                                $result_sec = $dbConn->query($querySql_sec);
                                                $rows_sec = $dbConn->affected_rows;

                                                while ($row_data_sec = $result_sec->fetch_assoc())
                                                    $bl_titolo_sec .= $row_data_sec['bl_titolo']."<br>";

                                                $result_sec->close();

                                            } else $bl_titolo_sec = "//";

                                            echo "<tr>";

                                            echo "<td>".$row_data['nb_tipo']."</td>";
                                            echo "<td>$bl_titolo_prim</td>";
                                            echo "<td style='font-size: x-small;'>$bl_titolo_sec</td>";

                                            //Gestione
                                            echo "<td align='center'>";

                                            echo "<button class='btn btn-warning btn-sm modale' data-href='newsletter-blog-view.php?nb_id=$nb_id'>anteprima</button>&nbsp;";
                                            echo "<button class='btn btn-info btn-sm modale' data-href='newsletter-blog-send.php?nb_id=$nb_id'>invio</button>&nbsp;";
                                            echo "<a class='btn btn-success btn-sm' href='newsletter-blog-mod.php?nb_id=$nb_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='newsletter-blog-del-do.php?nb_id=$nb_id'>elimina</button>";
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