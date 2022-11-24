<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_pr_titolo = isset($_GET['pr_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_titolo']))) : "";
$get_pr_codice = isset($_GET['pr_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_codice']))) : "";
$get_pr_prezzo = isset($_GET['pr_prezzo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_prezzo']))) : "";
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
                            <h4 class="mb-2"> Associa prdotto </h4>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="get" action="?" enctype="multipart/form-data">

                                    <h5 class="card-title">Filtra prodotti</h5>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="pr_titolo">Titolo</label>
                                            <input type="text" name="pr_titolo" class="form-control" value="<?php echo $get_pr_titolo; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_codice">Codice</label>
                                            <input type="text" name="pr_codice" class="form-control" value="<?php echo $get_pr_codice; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_prezzo">Prezzo</label>
                                            <input name="pr_prezzo" id="pr_prezzo" class="form-control" type="text" value="<?php echo $get_pr_prezzo; ?>">
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

                                <h5 class="card-title border-0 pb-0">Lista prodotti</h5>

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
                                            <th>Titolo</th>
                                            <th>Codice</th>
                                            <th>Prezzo</th>
                                            <th style="text-align: center; width: 100px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti WHERE pr_id > 0 ";
                                        if(strlen($get_pr_titolo) > 0) $querySql .= " AND pr_titolo LIKE '%$get_pr_titolo%' ";
                                        if(strlen($get_pr_codice) > 0) $querySql .= " AND pr_codice LIKE '%$get_pr_codice%' ";
                                        if(strlen($get_pr_prezzo) > 0) $querySql .= " AND pr_prezzo LIKE '%$get_pr_prezzo%' ";
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

                                        $querySql = "SELECT * FROM pr_prodotti WHERE pr_id > 0 ";
                                        if(strlen($get_pr_titolo) > 0) $querySql .= " AND pr_titolo LIKE '%$get_pr_titolo%' ";
                                        if(strlen($get_pr_codice) > 0) $querySql .= " AND pr_codice LIKE '%$get_pr_codice%' ";
                                        if(strlen($get_pr_prezzo) > 0) $querySql .= " AND pr_prezzo LIKE '%$get_pr_prezzo%' ";
                                        $querySql .= " ORDER BY pr_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {


                                            $pr_id = $row_data['pr_id'];
                                            $pr_titolo = $row_data['pr_titolo'];
                                            $pr_codice = $row_data['pr_codice'];

                                            echo "<tr>";
                                            echo "<td>$pr_titolo</td>";
                                            echo "<td>$pr_codice</td>";
                                            echo "<td>"."&euro; ".$row_data['pr_prezzo']."</td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-primary btn-sm' href='javascript:pageAddProdotto($pr_id, \"$pr_titolo\");' title='Conferimento'>associa</a>&nbsp;";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";

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
    function pageAddProdotto(pr_id, pr_titolo) {

        window.opener.$("#pr_id").val(pr_id);
        window.opener.$("#pr_titolo").val(pr_titolo);

        window.close();

    }
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>