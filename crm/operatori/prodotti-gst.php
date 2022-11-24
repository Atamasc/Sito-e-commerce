<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_pr_ct_id = @$_GET["pr_ct_id"];
$get_pr_descrizione = @$_GET["pr_descrizione"];
$get_pr_tipologia = @$_GET["pr_tipologia"];
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
                            <h4 class="mb-0"> Gestione prodotti </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item active">Gestione prodotti</li>
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

                                    <h5 class="card-title">Filtra prodotti</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_ct_id">Categoria</label>
                                            <select class="form-control" id="pr_ct_id" name="pr_ct_id">
                                                <option value="">Seleziona una categoria</option>
                                                <option value=""></option>
                                                <?php selectCategorie($get_pr_ct_id); ?>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_tipologia">Tipologia</label>
                                            <select class="form-control" name="pr_tipologia" id="pr_tipologia" class="medium">
                                                <option value="">[Seleziona la tipologia]</option>
                                                <option value=""></option>
                                                <option value="Rinfusa" <?php if ($get_pr_tipologia == "Rinfusa") {?>selected<?php };?>>Rinfusa</option>
                                                <option value="Semplice" <?php if ($get_pr_tipologia == "Semplice") {?>selected<?php };?>>Semplice</option>
                                                <option value="Produzione" <?php if ($get_pr_tipologia == "Produzione") {?>selected<?php };?>>Produzione</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="pr_descrizione">Descrizione</label>
                                            <input type="text" name="pr_descrizione" class="form-control" value="<?php echo $get_pr_descrizione; ?>">
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
                                            <th>Codice</th>
                                            <th>Barcode</th>
                                            <th>Descrizione</th>
                                            <th>Tipologia</th>
                                            <th>Prezzo acquisto</th>
                                            <th>Prezzo vendita</th>
                                            <th style="text-align: center;">Stato</th>
                                            <th style="text-align: center; width: 250px;">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $querySql = "SELECT COUNT(pr_id) FROM pr_prodotti INNER JOIN ct_categorie ON ct_id = pr_ct_id WHERE pr_id > 0 ";
                                        if(strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                        if(strlen($get_pr_descrizione) > 0) $querySql .= " AND pr_descrizione LIKE '%$get_pr_descrizione%' ";
                                        if(strlen($get_pr_tipologia) > 0) $querySql .= " AND pr_tipologia = '$get_pr_tipologia' ";
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

                                        $querySql = "SELECT * FROM pr_prodotti INNER JOIN ct_categorie ON pr_ct_id = ct_id  WHERE pr_id > 0 ";
                                        if(strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                        if(strlen($get_pr_descrizione) > 0) $querySql .= " AND pr_descrizione LIKE '%$get_pr_descrizione%' ";
                                        if(strlen($get_pr_tipologia) > 0) $querySql .= " AND pr_tipologia = '$get_pr_tipologia' ";
                                        $querySql .= " ORDER BY pr_id LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $pr_id = $row_data['pr_id'];

                                            echo "<tr>";
                                            echo "<td>".$row_data['pr_codice']."</td>";
                                            echo "<td>".$row_data['pr_barcode']."</td>";
                                            echo "<td>".$row_data['pr_descrizione']."</td>";
                                            echo "<td>".$row_data['pr_tipologia']."</td>";
                                            echo "<td>&euro; ".$row_data['pr_prezzo_acquisto']."</td>";
                                            echo "<td>&euro; ".$row_data['pr_prezzo_vendita']."</td>";

                                            $checked = $row_data['pr_stato'] > 0 ? "checked" : "";
                                            ?>
                                            <td align='center'>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato"
                                                               title="prodotti-stato-do.php?pr_id=<?php echo $pr_id; ?>" <?php echo $checked;?>><span></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <?php

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-success btn-sm' href='prodotti-mod.php?pr_id=$pr_id' title='Modifica'>modifica</a>&nbsp;";
                                            //echo "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-del-do.php?pr_id=$pr_id'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                        }

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

</body>

</html>
<?php include "../inc/db-close.php"; ?>