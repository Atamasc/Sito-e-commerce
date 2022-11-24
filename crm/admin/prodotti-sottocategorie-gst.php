<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

    <?php
    $get_ct_id = isset($_GET['ct_id']) ? (int)$_GET['ct_id'] : 0;
    $get_st_id = isset($_GET['st_id']) ? (int)$_GET['st_id'] : 0;
    $get_st_sottocategoria = isset($_GET['st_sottocategoria']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['st_sottocategoria']))) : "";

    $querySql = "SELECT * FROM ct_categorie WHERE ct_id = '$get_ct_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();
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
                            <?php if($get_ct_id > 0) { ?>
                                <div class="col-sm-6">
                                    <h4 class="mb-0"> Categoria: <?php echo $row_data['ct_categoria']; ?> </h4>
                                </div>
                            <?php } else { ?>
                                <?php
                                $get_st_ct_id = isset($_GET['st_ct_id']) ? (int)$_GET['st_ct_id'] : 0;
                                $get_st_sottocategoria = isset($_GET['st_sottocategoria']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['st_sottocategoria']))) : "";
                                ?>
                                <div class="col-sm-6">
                                    <h4 class="mb-0"> Gestione sottocategorie </h4>
                                </div>
                            <?php } ?>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione sottocategorie</li>
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

                                            <h5 class="card-title">Filtra sottocategorie</h5>

                                            <div class="form-row">

                                                <div class="col-md-3 mb-3">
                                                    <label for="ct_id">Categoria</label>
                                                    <select class="form-control" id="ct_id" name="ct_id">
                                                        <option value="">Seleziona una categoria</option>
                                                        <option value=""></option>
                                                        <?php selectCategorieProdotti($get_ct_id, $dbConn); ?>
                                                    </select>
                                                    <span class="tooltips">Categoria Prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Categoria Prodotto" data-content="Scegli qui il tipo di categoria che stai cercando">[aiuto]</a></span>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label for="st_sottocategoria">Sottocategoria</label>
                                                    <input type="text" name="st_sottocategoria" class="form-control" value="<?php echo $get_st_sottocategoria; ?>">
                                                    <span class="tooltips">Sottocategoria Prodotto <a tabindex="0" style="color: blue; cursor: pointer;" role="button" data-toggle="popover" data-trigger="focus" title="Sottocategoria Prodotto" data-content="Scegli qui il tipo di sottocategoria che stai cercando">[aiuto]</a></span>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Cerca</button>
                                            <?php if($get_ct_id>0){ ?><a href="sottocategorie-add.php?ct_id=<?php echo $get_ct_id;?>" class="btn btn-success">Aggiungi sottocategoria</a> <?php } ?>

                                        </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista sottocategorie</h5>

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
                                                <th>
                                                    Sottocategoria <br>
                                                    <em>Descrizione</em>
                                                </th>
                                                <th width="220">Categoria</th>
                                                <th width="80">Prodotti</th>
                                                <th style="text-align: center;" width="100">Stato</th>
                                                <th style="text-align: center;" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(st_id) FROM st_sottocategorie WHERE st_id > 0 ";
                                            if($get_ct_id > 0) $querySql .= " AND st_ct_id = '$get_ct_id' ";
                                            if(strlen($get_st_sottocategoria) > 0) $querySql .= " AND st_sottocategoria LIKE '%$get_st_sottocategoria%' ";
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

                                            $querySql = "SELECT * FROM st_sottocategorie WHERE st_id > 0 ";
                                            if($get_ct_id > 0) $querySql .= " AND st_ct_id = '$get_ct_id' ";
                                            if(strlen($get_st_sottocategoria) > 0) $querySql .= " AND st_sottocategoria LIKE '%$get_st_sottocategoria%' ";
                                            $querySql .= " ORDER BY st_sottocategoria LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $st_id = $row_data['st_id'];
                                                $st_ct_id = $row_data['st_ct_id'];
                                                $st_sottocategoria = $row_data['st_sottocategoria'];
                                                $st_descrizione = $row_data['st_descrizione'];
                                                
                                                $categoria = getCategoria($st_ct_id, $dbConn);
                                                $count_prodotti = countProdottiSottocategoria($st_id);

                                                echo "<tr>";
                                                echo "<td>".$st_id."</td>";
                                                echo "<td>".$st_sottocategoria."<br><em>".$st_descrizione."</em></td>";
                                                echo "<td>".$categoria."</td>";
                                                echo "<td>".$count_prodotti."</td>";
                                                //echo "<td>$count</td>";

                                                //Stato
                                                echo "<td align='center'>";

                                                if ($row_data['st_stato'] == 0) {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="prodotti-sottocategorie-stato-do.php?st_id=<?php echo $st_id; ?>"><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                } else {

                                                    ?>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="prodotti-sottocategorie-stato-do.php?st_id=<?php echo $st_id; ?>" checked><span></span>
                                                        </label>
                                                    </div>
                                                    <?php

                                                }

                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='sottocategorie-mod.php?st_id=$st_id&ct_id=$st_ct_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo $count_prodotti > 0
                                                    ? "<button class='btn btn-danger btn-sm disabled'><i class='far fa-trash-alt'></i></button>"
                                                    : "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-sottocategorie-del-do.php?st_id=$st_id&ct_id=$st_ct_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $i += 1;
                                            };
                                            ?>

                                            <?php
                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono sottocategorie presenti</td></tr>";
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