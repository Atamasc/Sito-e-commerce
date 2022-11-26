<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";
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
                            <h4 class="mb-0"> Modifica ordine </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="ordini-gst.php" class="default-color">Gestione ordini</a></li>
                                <li class="breadcrumb-item active">Modifica ordine</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Stati ordine</h5>

                                <?php
                                $querySql = "SELECT * FROM or_ordini WHERE or_codice = '$get_or_codice' GROUP BY or_codice LIMIT 0, 1 ";
                                $result = $dbConn->query($querySql);
                                $rows = $dbConn->affected_rows;
                                $row_data = $result->fetch_assoc();

                                $or_id = $row_data['or_id'];
                                $or_codice = $row_data['or_codice'];
                                $or_pagamento = $row_data['or_pagamento'];
                                $or_op_id = $row_data['or_op_id'];

                                if ($row_data['or_stato_conferma'] < 1)
                                    echo "<a class='btn btn-danger' href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Non confermato</a>&nbsp;";
                                else
                                    echo "<a class='btn btn-success' href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Confermato</a>&nbsp;";

                                if ($row_data['or_stato_pagamento'] < 1)
                                    echo "<a class='btn btn-danger' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'>Non pagato</a>&nbsp;";
                                else
                                    echo "<a class='btn btn-success' href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'>Pagato</a>&nbsp;";

                                if ($row_data['or_stato_spedizione'] == 0)
                                    echo "<a class='btn btn-danger' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Non consegnato</a>&nbsp;";
                                else if ($row_data['or_stato_spedizione'] == 1)
                                    echo "<a class='btn btn-orange' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>In consegna</a>&nbsp;";
                                else
                                    echo "<a class='btn btn-success' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Consegnato</a>&nbsp;";

                                if ($row_data['or_stato'] < 1)
                                    echo "<button class='btn btn-danger alert-2' data-text='Continuando scalerai la giacenza dei prodotti e non potrai tornare ad uno stato precedente.' ".
                                        "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Non evaso</button>&nbsp;";
                                else
                                    echo "<a class='btn btn-success disabled' href='javascript:;' title='Attiva'>Evaso</a>&nbsp;";

                                $result->close();
                                ?>

                            </div>

                        </div>
                    </div>

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Operatore</h5>

                                <form method="post" action="ordini-mod-do.php">

                                    <input type="hidden" name="or_codice" value="<?php echo $or_codice; ?>">

                                    <div class="form-row">

                                        <div class="col-md-6 input-group mb-3">

                                            <select class="form-control" id="or_op_id" name="or_op_id" required>
                                                <option value="">Seleziona l'operatore</option>
                                                <option value=""></option>
                                                <option value="0" <?php echo $or_op_id == 0 ? "selected" : ""; ?>>Amministratore</option>
                                                <?php
                                                pageGetOperatori($or_op_id);
                                                function pageGetOperatori($get_op_id) {

                                                    global $dbConn;

                                                    $querySql =
                                                        "SELECT * FROM op_operatori ".
                                                        "WHERE op_stato > 0 ORDER BY op_cognome, op_nome DESC ";
                                                    $result = $dbConn->query($querySql);

                                                    while (($rows = $result->fetch_assoc()) !== NULL) {

                                                        $op_id = $rows['op_id'];
                                                        $selected = $get_op_id == $op_id ? "selected" : "";

                                                        echo "<option value='$op_id' $selected>".$rows['op_cognome']." ".$rows['op_nome']."</option>";

                                                    }
                                                    $result->close();


                                                }
                                                ?>
                                            </select>

                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Aggiorna</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Lista prodotti ordine #<?php echo $get_or_codice; ?></h5>

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
                                            <th>Prodotto / Codice lotto</th>
                                            <th class="text-center" width="50">Quantità</th>
                                            <th class="text-center" width="150">Prezzo</th>
                                            <th class="text-center">Importo</th>
                                            <th class="text-center" width="200">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <form method="post" action="ordini-prodotti-mod-do.php">
                                            <?php
                                            $querySql =
                                                "SELECT * FROM or_ordini ".
                                                "INNER JOIN gi_giacenze ON gi_id = or_gi_id ".
                                                "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
                                                "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
                                                "WHERE or_codice = '$get_or_codice' ORDER BY pr_descrizione";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            $totale_ordine = 0;
                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $or_id = $row_data['or_id'];
                                                $ut_codice = $row_data['ut_codice'];

                                                $or_importo_totale = $row_data['or_pr_quantita'] * $row_data['or_pr_prezzo'];

                                                $totale_ordine += $or_importo_totale;

                                                echo "<tr>";
                                                echo "<td>".$row_data['pr_descrizione']." / ".$row_data['lt_codice']."</td>";
                                                echo "<td><input type='text' class='form-control input-order pattern-number' name='or_pr_quantita[$or_id]' ".
                                                    "value='".$row_data['or_pr_quantita']."' autocomplete='off' required></td>";
                                                echo "<td><span class='oreo-span'>&euro;</span><input type='text' class='form-control input-order pattern-price' ".
                                                    "name='or_pr_prezzo[$or_id]' value='".formatPrice($row_data['or_pr_prezzo'])."' autocomplete='off' required></td>";
                                                echo "<td class='text-center'>&euro; ".formatPrice($or_importo_totale)."</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<button type='submit' class='btn btn-info btn-sm'>aggiorna</button>&nbsp;";
                                                echo "<a href='#' class='btn btn-danger btn-sm elimina' data-href='ordini-prodotti-del-do.php?or_id=$or_id' ".
                                                    "title='Elimina'><i class='fas fa-trash-alt'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";

                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";
                                            }

                                            $result->close();
                                            ?>

                                        </form>

                                        <tr>
                                            <td colspan="4"></td>

                                            <td class="text-center">
                                                <a class='btn btn-primary btn-sm popup-custom' data-pop-width='1200' data-pop-height='800' href='javascript:;'
                                                   data-href='ordini-prodotti-add.php?ut_codice=<?php echo $ut_codice; ?>&or_timestamp=<?php echo $get_or_codice; ?>&op_id=<?php echo $or_op_id; ?>'>Aggiungi prodotto</a>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table table-1 table-bordered table-striped mb-0">
                                        <tbody>

                                        <?php
                                        $or_iva = $totale_ordine * 0.22;
                                        $or_imponibile = $totale_ordine - $or_iva;
                                        ?>

                                        <!--
                                        <tr>
                                            <td class="text-right">Imponibile</td>
                                            <td width="200">&euro; <?php echo formatPrice($or_imponibile); ?></td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">IVA (22%)</td>
                                            <td width="200">&euro; <?php echo formatPrice($or_iva); ?></td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">Spese di spedizione</td>
                                            <td width="200">&euro; //</td>
                                        </tr>
                                        -->

                                        <tr>
                                            <td class="text-right">Totale ordine</td>
                                            <td width="200">&euro; <?php echo formatPrice($totale_ordine); ?></td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>

                                <!--
                                <div class="row pt-4">
                                    <div class="col-md-6">
                                        <div class="text-center text-md-left">
                                            Modalità di pagamento: <?php echo $or_pagamento; ?>
                                        </div>
                                    </div>
                                </div>
                                -->

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