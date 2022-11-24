<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>
            .tooltips{
                font-size: 10px;
            }
        </style>

    </head>

    <body>

    <?php
    $get_ct_id = isset($_GET['ct_id']) ? (int)$_GET['ct_id'] : 0;
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
                                <h4 class="mb-0"> Gestione categorie </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione categorie</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra categorie</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label>Titolo</label>
                                                <input type="text" name="ct_titolo" class="form-control" value="<?php echo $get_ct_titolo; ?>">
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a href="categoria-add.php" class="btn btn-success">Aggiungi categoria</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista categorie</h5>

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
                                                <th width="40">ID</th>
                                                <th width="120">Codice</th>
                                                <th>Categoria</th>
                                                <th>Descrizione</th>
                                                <th width="80">Prodotti</th>
                                                <th width="80">Sottocategorie</th>
                                                <th width="80">Pos</th>
                                                <th style="text-align: center;" width="100">Stato</th>
                                                <th style="text-align: center;" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ct_id) FROM ct_categorie WHERE ct_id > 0 ";
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

                                            $querySql = "SELECT * FROM ct_categorie WHERE ct_id > 0 ";
                                            $querySql .= " ORDER BY ct_categoria LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ct_id = $row_data['ct_id'];
                                                $ct_codice = $row_data['ct_codice'];
                                                $ct_categoria = $row_data['ct_categoria'];
                                                $ct_descrizione = $row_data['ct_descrizione'];
                                                $ct_posizione = $row_data['ct_posizione'];
                                                $count_prodotti = countProdottiCategoria($ct_id);
                                                $count_sottocategorie = countSottocategorieCategoria($ct_id);

                                                echo "<tr>";
                                                echo "<td>$ct_id</td>";
                                                echo "<td>$ct_codice</td>";
                                                echo "<td>".$ct_categoria."</td>";
                                                echo "<td>".$ct_descrizione."</td>";
                                                echo "<td>".$count_prodotti."</td>";
                                                echo "<td>".$count_sottocategorie."</td>";
                                                echo "<td>".$ct_posizione."</td>";
                                                //echo "<td>$count</td>";

                                                //Stato
                                                echo "<td align='center'>";

                                                if ($row_data['ct_stato'] == 0) {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="prodotti-categorie-stato-do.php?ct_id=<?php echo $ct_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                } else {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="prodotti-categorie-stato-do.php?ct_id=<?php echo $ct_id; ?>" checked><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-primary btn-sm' href='prodotti-sottocategorie-gst.php?ct_id=$ct_id' title='Sottocategorie'>sottocategorie</a>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='categoria-mod.php?ct_id=$ct_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo $count_prodotti > 0
                                                    ? "<button class='btn btn-danger btn-sm disabled'><i class='far fa-trash-alt'></i></button>"
                                                    : "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-categorie-del-do.php?ct_id=$ct_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono categorie presenti</td></tr>";
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