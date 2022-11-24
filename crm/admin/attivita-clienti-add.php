<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_cl_ragione_sociale = isset($_GET['cl_ragione_sociale']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_ragione_sociale']))) : "";
$get_cl_email = isset($_GET['cl_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_email']))) : "";
?>

<div class="wrapper">
    <!--================================= preloader -->
    <div id="pre-loader">
        <img src="../images/pre-loader/loader-01.svg" alt="">
    </div>
    <!--================================= preloader -->
    <!--================================= Main content -->

    <div class="container-fluid">
        <div class="row">

            <!--================================= Main content -->
            <!--================================= wrapper -->
            <div class="content-wrapper">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="mb-2"> Associa cliente </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra clienti</h5>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="cl_ragione_sociale">Ragione sociale</label>
                                            <input type="text" name="cl_ragione_sociale" class="form-control" value="<?php echo $get_cl_ragione_sociale; ?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="cl_email">Email</label>
                                            <input name="cl_email" id="cl_email" class="form-control" type="text" autocomplete="off"
                                                   value="<?php echo $get_cl_email; ?>">
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

                                <h5 class="card-title border-0 pb-0">Lista clienti</h5>

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
                                            <th>Ragione sociale</th>
                                            <th>Email</th>
                                            <th style="text-align: center; width: 100px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(cl_id) FROM cl_clienti WHERE cl_id > 0 ";
                                        if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                        if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
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

                                        $querySql = "SELECT * FROM cl_clienti WHERE cl_id > 0 ";
                                        if(strlen($get_cl_ragione_sociale) > 0) $querySql .= " AND cl_ragione_sociale LIKE '%$get_cl_ragione_sociale%' ";
                                        if(strlen($get_cl_email) > 0) $querySql .= " AND cl_email LIKE '%$get_cl_email%' ";
                                        $querySql .= " ORDER BY cl_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $cl_id = $row_data['cl_id'];
                                            $cl_ragione_sociale = $row_data['cl_ragione_sociale'];

                                            echo "<tr>";
                                            echo "<td>$cl_ragione_sociale</td>";
                                            echo "<td>".$row_data['cl_email']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-primary btn-sm' href='javascript:pageAddCliente($cl_id, \"$cl_ragione_sociale\");' title='Conferimento'>associa</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche</td></tr>";

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

<script>
    function pageAddCliente(cl_id, cl_ragione_sociale) {

        window.opener.$("#cl_id").val(cl_id);
        window.opener.$("#cl_ragione_sociale").val(cl_ragione_sociale);
        window.close();

    }
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>