<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_or_stato_conferma = isset($_GET['or_stato_conferma']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_conferma']))) : "";
$get_or_stato_pagamento = isset($_GET['or_stato_pagamento']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_pagamento']))) : "";
$get_or_stato_spedizione = isset($_GET['or_stato_spedizione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_spedizione']))) : "";
$get_or_stato = isset($_GET['or_stato']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato']))) : "";

$get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";
$get_cl_nome = isset($_GET['cl_nome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_nome']))) : "";
$get_cl_cognome = isset($_GET['cl_cognome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_cognome']))) : "";
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
                            <h4 class="mb-0"> Archivio ordini </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="ordini-gst.php" class="default-color">Gestione ordini</a></li>
                                <li class="breadcrumb-item active">Archivio</li>
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

                                    <h5 class="card-title">Filtra ordini</h5>

                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                            <label for="or_stato_conferma">Conferma</label>
                                            <select class="form-control" id="or_stato_conferma" name="or_stato_conferma">
                                                <option value="">Seleziona uno stato</option>
                                                <option value="1" <?php if($get_or_stato_conferma == '1') echo "selected"; ?>>Confermato</option>
                                                <option value="0" <?php if($get_or_stato_conferma == '0') echo "selected"; ?>>Non confermato</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="or_stato_pagamento">Pagamento</label>
                                            <select class="form-control" id="or_stato_pagamento" name="or_stato_pagamento">
                                                <option value="">Seleziona uno stato</option>
                                                <option value="1" <?php if($get_or_stato_pagamento == '1') echo "selected"; ?>>Pagato</option>
                                                <option value="0" <?php if($get_or_stato_pagamento == '0') echo "selected"; ?>>Non pagato</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="or_stato_spedizione">Spedizione</label>
                                            <select class="form-control" id="or_stato_spedizione" name="or_stato_spedizione">
                                                <option value="">Seleziona uno stato</option>
                                                <option value="1" <?php if($get_or_stato_spedizione == '1') echo "selected"; ?>>Spedito</option>
                                                <option value="0" <?php if($get_or_stato_spedizione == '0') echo "selected"; ?>>Non spedito</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="or_stato">Evasione</label>
                                            <select class="form-control" id="or_stato" name="or_stato">
                                                <option value="">Seleziona uno stato</option>
                                                <option value="1" <?php if($get_or_stato == '1') echo "selected"; ?>>Evaso</option>
                                                <option value="0" <?php if($get_or_stato == '0') echo "selected"; ?>>Non evaso</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="or_codice">Evasione</label>
                                            <input type="text" class="form-control" id="or_codice" name="or_codice" value="<?php echo $get_or_codice; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_nome">Nome</label>
                                            <input type="text" class="form-control" id="cl_nome" name="cl_nome" value="<?php echo $get_cl_nome; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="cl_cognome">Cognome</label>
                                            <input type="text" class="form-control" id="cl_cognome" name="cl_cognome" value="<?php echo $get_cl_cognome; ?>">
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

                                <h5 class="card-title border-0 pb-0">Lista ordini archiviati</h5>

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
                                            <th width="250">Codice ordine</th>
                                            <th>Denominazione</th>
                                            <th class="text-center" width="150">Importo</th>
                                            <th class="text-center" width="350">Stato di lavorazione</th>
                                            <th class="text-center" width="100">Archivio</th>
                                            <th class="text-center" width="300">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
                                        $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN cl_clienti ON cl_codice = or_cl_codice WHERE or_archivio > 0 ";
                                        if(strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                        if(strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                        if(strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                        if(strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                        if(strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                        if(strlen($get_cl_nome) > 0) $querySql .= " AND cl_nome LIKE '%$get_cl_nome%' ";
                                        if(strlen($get_cl_cognome) > 0) $querySql .= " AND cl_cognome LIKE '%$get_cl_cognome%' ";
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
                                            "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini ".
                                            "INNER JOIN cl_clienti ON or_cl_codice = cl_codice WHERE or_archivio > 0 ";
                                        if(strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                        if(strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                        if(strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                        if(strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                        if(strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                        if(strlen($get_cl_nome) > 0) $querySql .= " AND cl_nome LIKE '%$get_cl_nome%' ";
                                        if(strlen($get_cl_cognome) > 0) $querySql .= " AND cl_cognome LIKE '%$get_cl_cognome%' ";
                                        $querySql .= " GROUP BY or_codice ORDER BY or_codice LIMIT $primo, $per_page ";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $or_id = $row_data['or_id'];
                                            $or_codice = $row_data['or_codice'];

                                            echo "<tr>";
                                            echo "<td>$or_codice del ".date('d/m/Y - H:i', $or_codice)."</td>";
                                            echo "<td>".$row_data['cl_nome']." ".$row_data['cl_cognome']."</td>";
                                            echo "<td class='text-center'>&euro; ".formatPrice($row_data['or_totale_importo'])."</td>";

                                            //Stato di evasione
                                            echo "<td align='center'>";

                                            if ($row_data['or_stato_conferma'] == '0')
                                                echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non confermato</button></a>&nbsp;";
                                            else
                                                echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Confermato</button></a>&nbsp;";

                                            if ($row_data['or_stato_pagamento'] == '0')
                                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non pagato</button></a>&nbsp;";
                                            else
                                                echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Pagato</button></a>&nbsp;";

                                            if ($row_data['or_stato_spedizione'] == '0')
                                                echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' ".
                                                    "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Non spedito</button>&nbsp;";
                                            else
                                                echo "<a class='btn btn-sm btn-success alert-2' data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedito</a>&nbsp;";

                                            if ($row_data['or_stato']  == '0')
                                                echo "<a href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non evaso</button></a>&nbsp;";
                                            else
                                                echo "<a href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Evaso</button></a>&nbsp;";

                                            echo "</td>";

                                            echo "<td class='text-center'><button class='btn btn-info btn-sm alert-link' data-href='ordini-archivio-do.php?or_codice=$or_codice' title='archivio'>rimuovi dall'archivio</button></td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<a class='btn btn-success btn-sm' href='ordini-mod.php?or_codice=$or_codice' title='Modifica'>modifica</a>&nbsp;";
                                            echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'>dettaglio</button>&nbsp;";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='ordini-del-do.php?or_codice=$or_codice' title='Elimina'>elimina</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                        };

                                        if ($rows == '0') {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono ordini presenti</td></tr>";
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