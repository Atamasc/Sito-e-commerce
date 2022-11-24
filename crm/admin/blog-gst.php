<?php include "inc/autoloader.php"; ?>

<?php
$get_bl_titolo = isset($_GET['bl_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['bl_titolo']))) : '';
$get_bc_id = isset($_GET['bc_id']) ? (int)$_GET['bc_id'] : 0;

$get_bl_data_da = isset($_GET['bl_data_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['bl_data_da']))) : '';
if(strlen($get_bl_data_da) > 0) {
    list($d, $m, $y) = explode('/', $get_bl_data_da);
    $get_bl_data_da = mktime(0, 0, 0, $m, $d, $y);
}
else $get_bl_data_da = '';

$get_bl_data_a = isset($_GET['bl_data_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['bl_data_a']))) : '';
if(strlen($get_bl_data_a) > 0) {
    list($d, $m, $y) = explode('/', $get_bl_data_a);
    $get_bl_data_a = mktime(23, 59, 59, $m, $d, $y);
}
else $get_bl_data_a = '';
?>
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
                            <h4 class="mb-0"> Gestione blog </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione blog</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <?php
                        if(@$_GET['delete'] == 'true') {

                            ?>
                            <div class="alert alert-success" role="alert">
                                Eliminazione avvenuta con successo.
                            </div>
                            <?php

                        }
                        ?>

                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title">Filtra post</h5>

                                <form action="blog-gst.php" method="get" enctype="multipart/form-data">

                                    <div class="form-row mb-3">

                                        <div class="col-md-3">
                                            <label for="bl_titolo">Titolo</label>
                                            <input type="text" name="bl_titolo" id="bl_titolo"
                                                   class="form-control" value="<?php echo $get_bl_titolo; ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="bc_id">Categoria</label>
                                            <select id="bc_id" name="bc_id" class="form-control">
                                                <option value="">Seleziona un'opzione</option>
                                                <option></option>
                                                <?php selectBlogCategorie($get_bc_id, $dbConn); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Data</label>
                                            <div class="input-group" data-date="">
                                                <input name="bl_data_da" class="form-control range-from" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_bl_data_da) > 0) echo date("d/m/Y", $get_bl_data_da); ?>">
                                                <span class="input-group-addon">A</span>
                                                <input name="bl_data_a" class="form-control range-to" type="text"
                                                       data-date-format="dd/mm/yyyy" autocomplete="off"
                                                       value="<?php if(strlen($get_bl_data_a) > 0) echo date("d/m/Y", $get_bl_data_a); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cerca</button>
                                    <a href="blog-gst.php" class="btn btn-success">Reset</a>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista post blog</h5>

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titolo</th>
                                            <th>Categoria</th>
                                            <th>Tags</th>
                                            <th style="text-align: center;" width="100">Data</th>
                                            <th style="text-align: center;" width="200">Stato</th>
                                            <th style="text-align: center;" width="250">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(bl_id) FROM bl_blog INNER JOIN bc_blog_categorie ON bl_bc_id = bc_id WHERE bl_id > 0 ";
                                        if(strlen($get_bl_titolo) > 0) $querySql .= "AND bl_titolo LIKE '%$get_bl_titolo%' ";
                                        if($get_bc_id > 0) $querySql .= "AND bc_id = $get_bc_id ";
                                        if(strlen($get_bl_data_da) > 0) $querySql .= "AND bl_data >= $get_bl_data_da ";
                                        if(strlen($get_bl_data_a) > 0) $querySql .= "AND bl_data <= $get_bl_data_a ";
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

                                        $querySql = "SELECT * FROM bl_blog INNER JOIN bc_blog_categorie ON bl_bc_id = bc_id WHERE bl_id > 0 ";
                                        if(strlen($get_bl_titolo) > 0) $querySql .= "AND bl_titolo LIKE '%$get_bl_titolo%' ";
                                        if($get_bc_id > 0) $querySql .= "AND bc_id = $get_bc_id ";
                                        if(strlen($get_bl_data_da) > 0) $querySql .= "AND bl_data >= $get_bl_data_da ";
                                        if(strlen($get_bl_data_a) > 0) $querySql .= "AND bl_data <= $get_bl_data_a ";
                                        $querySql .= "ORDER BY bl_data DESC LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $bl_id = $row_data["bl_id"];
                                            $bl_titolo = $row_data["bl_titolo"];
                                            $bl_data = date("d/m/Y", $row_data["bl_data"]);
                                            $bc_titolo = $row_data['bc_titolo'];
                                            $bl_tag = $row_data['bl_tag'];

                                            echo "<tr>";
                                            echo "<td>$bl_id</td>";
                                            echo "<td>$bl_titolo</td>";
                                            echo "<td>$bc_titolo</td>";
                                            echo "<td>$bl_tag</td>";
                                            echo "<td class='text-center'>$bl_data</td>";
                                            //Stato
                                            echo "<td align='center'>";

                                            if ($row_data['bl_stato'] == 0) {

                                                ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" title="blog-stato-do.php?bl_id=<?php echo $bl_id; ?>"><span></span>
                                                    </label>
                                                </div>
                                                <?php

                                            } else {

                                                ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" title="blog-stato-do.php?bl_id=<?php echo $bl_id; ?>" checked><span></span>
                                                    </label>
                                                </div>
                                                <?php

                                            }

                                            echo "</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-success btn-sm' href='blog-mod.php?bl_id=$bl_id' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='blog-del-do.php?bl_id=$bl_id'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono post presenti</td></tr>";
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