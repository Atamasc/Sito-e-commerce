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
    $get_ut_nome = isset($_GET['ut_nome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_nome']))) : "";
    $get_ut_cognome = isset($_GET['ut_cognome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_cognome']))) : "";
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
                                <h4 class="mb-0"> Gestione ordini </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione ordini</li>
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
                                                    <option value="1" <?php if ($get_or_stato_conferma == '1') echo "selected"; ?>>Confermato</option>
                                                    <option value="0" <?php if ($get_or_stato_conferma == '0') echo "selected"; ?>>Non confermato</option>
                                                </select>
                                                <span class="tooltips">Stato Conferma Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Conferma Ordine" data-content="Inserisci qui lo stato di conferma dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="or_stato_pagamento">Pagamento</label>
                                                <select class="form-control" id="or_stato_pagamento" name="or_stato_pagamento">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if ($get_or_stato_pagamento == '1') echo "selected"; ?>>Pagato</option>
                                                    <option value="0" <?php if ($get_or_stato_pagamento == '0') echo "selected"; ?>>Non pagato</option>
                                                </select>
                                                <span class="tooltips">Stato Pagamento Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Pagamento Ordine" data-content="Inserisci qui lo stato di pagamento dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="or_stato_spedizione">Spedizione</label>
                                                <select class="form-control" id="or_stato_spedizione" name="or_stato_spedizione">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if ($get_or_stato_spedizione == '1') echo "selected"; ?>>Spedito</option>
                                                    <option value="0" <?php if ($get_or_stato_spedizione == '0') echo "selected"; ?>>Non spedito</option>
                                                </select>
                                                <span class="tooltips">Stato Spedizione Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Spedizione Ordine" data-content="Inserisci qui lo stato di spedizione dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="or_stato">Evasione</label>
                                                <select class="form-control" id="or_stato" name="or_stato">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if ($get_or_stato == '1') echo "selected"; ?>>Evaso</option>
                                                    <option value="0" <?php if ($get_or_stato == '0') echo "selected"; ?>>Non evaso</option>
                                                </select>
                                                <span class="tooltips">Stato Evasione Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Evasione Ordine" data-content="Inserisci qui lo stato di evasione dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="or_codice">Codice</label>
                                                <input type="text" class="form-control" id="or_codice" name="or_codice" value="<?php echo $get_or_codice; ?>">
                                                <span class="tooltips">Codice Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Ordine" data-content="Inserisci qui il codice dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_nome">Nome</label>
                                                <input type="text" class="form-control" id="ut_nome" name="ut_nome" value="<?php echo $get_ut_nome; ?>">
                                                <span class="tooltips">Nome Utente Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Utente Ordine" data-content="Inserisci qui il nome dell'utente che ha richiesto l'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="ut_cognome">Cognome</label>
                                                <input type="text" class="form-control" id="ut_cognome" name="ut_cognome" value="<?php echo $get_ut_cognome; ?>">
                                                <span class="tooltips">Cognome Utente Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Utente Ordine" data-content="Inserisci qui il cognome dell'utente che ha richiesto l'ordine che stai cercando">[aiuto]</a></span>
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

                                    <h5 class="card-title border-0 pb-0">Lista ordini</h5>

                                    <?php
                                    if (@$_GET['delete'] == 'true') {

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
                                                <th width="300">Codice ordine</th>
                                                <!--<th width="10">Tipo</th>-->
                                                <th>Denominazione</th>
                                                <th width="150">Pagamento</th>
                                                <th width="150">Importo</th>
                                                <th class="text-center" width="500">Stato di lavorazione</th>
                                                <th class="text-center" width="100">Reso</th>
                                                <th class="text-center" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN ut_utenti ON ut_codice = or_ut_codice WHERE or_archivio = 0 ";
                                            if (strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                            if (strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                            if (strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                            if (strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                            if (strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                            if (strlen($get_ut_nome) > 0) $querySql .= " AND ut_nome LIKE '%$get_ut_nome%' ";
                                            if (strlen($get_ut_cognome) > 0) $querySql .= " AND ut_cognome LIKE '%$get_ut_cognome%' ";
                                            $result = $dbConn->query($querySql);
                                            $row = $result->fetch_row();

                                            // numero totale del count
                                            $row_cnt = $row[0];
                                            // risultati per pagina(secondo parametro di LIMIT)
                                            $per_page = 30;
                                            // numero totale di pagine
                                            $tot_pages = ceil($row_cnt / $per_page);
                                            // pagina corrente
                                            $current_page = (!@$_GET['page']) ? 1 : (int)$_GET['page'];
                                            // primo parametro di LIMIT
                                            $primo = ($current_page - 1) * $per_page;

                                            $querySql =
                                                "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini " .
                                                "INNER JOIN ut_utenti ON or_ut_codice = ut_codice WHERE or_archivio = 0 ";
                                            if (strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                            if (strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                            if (strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                            if (strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                            if (strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                            if (strlen($get_ut_nome) > 0) $querySql .= " AND ut_nome LIKE '%$get_ut_nome%' ";
                                            if (strlen($get_ut_cognome) > 0) $querySql .= " AND ut_cognome LIKE '%$get_ut_cognome%' ";
                                            $querySql .= "  ORDER BY or_codice DESC LIMIT $primo, $per_page ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $or_id = $row_data['or_id'];
                                                $or_codice = $row_data['or_codice'];
                                                $or_timestamp = $row_data['or_timestamp'];

                                                $or_pagamento = $row_data['or_pagamento'];
                                                $or_tipo_spedizione = $row_data['or_tipo_spedizione'];

                                                $or_totale_importo = $row_data['or_totale_importo'];

                                                $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale_importo);
                                                $or_spedizione_prezzo = getPrezzoSpedizione($or_tipo_spedizione, $or_totale_importo);

                                                $or_totale = $or_totale_importo + $or_pagamento_prezzo + $or_spedizione_prezzo;

                                                echo "<tr>";
                                                echo "<td>$or_codice del " . date('d/m/Y - H:i', $or_timestamp) . "</td>";
                                                //if($row_data['ut_business']) echo "<td class='text-center'>B</td>";
                                                //else echo "<td class='text-center'>S</td>";
                                                echo "<td>" . $row_data['ut_nome'] . " " . $row_data['ut_cognome'] . "</td>";
                                                echo "<td>" . $row_data['or_pagamento'] . "</td>";
                                                echo "<td>&euro; " . formatPrice($or_totale) . "</td>";

                                                //Stato di evasione
                                                echo "<td align='center'>";

                                                if ($row_data['or_stato_conferma'] == '0')
                                                    echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non confermato</button></a>&nbsp;";
                                                else
                                                    echo "<button class='btn btn-sm btn-success alert-2' data-text=\"Continuando annullerai l'ordine\" " .
                                                        "data-href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Confermato</button>&nbsp;";

                                                if ($row_data['or_stato_pagamento'] == '0')
                                                    echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Non pagato</button></a>&nbsp;";
                                                else
                                                    echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Pagato</button></a>&nbsp;";

                                                if ($row_data['or_stato_spedizione'] == '0')
                                                    echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' " .
                                                        "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Non spedito</button>&nbsp;";
                                                else
                                                    echo "<a class='btn btn-sm btn-success alert-2' style='color: #ffffff;' data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedito</a>&nbsp;";

                                                if ($row_data['or_stato'] == '0')
                                                    echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma evasione al cliente' " .
                                                        "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Non evaso</button>&nbsp;";
                                                else
                                                    echo "<a class='btn btn-sm btn-success alert-2' style='color: #ffffff;' data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evaso</a>&nbsp;";
                                                if ($row_data['or_stato'] == '0')

                                                    echo "</td>";

                                                echo "<td class='text-center'>";
                                                if ($row_data['or_stato_reso'] == '0')
                                                    echo "<a href='ordini-stato-reso-do.php?or_codice=$or_codice' title='Non reso'><button class='btn btn-sm btn-danger'>Non reso</button></a>&nbsp;";
                                                else
                                                    echo "<a href='ordini-stato-reso-do.php?or_codice=$or_codice' title='Reso'><button class='btn btn-sm btn-success'>Reso</button></a>&nbsp; ";
                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='ordini-mod.php?or_codice=$or_codice' title='Modifica'><i class='fa fa-edit'></i></a>&nbsp;";
                                                echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'><i class='fa fa-print'></i></button>&nbsp;";
                                                echo "<button class='btn btn-warning btn-sm alert-link-ordini-archivio' style='font-weight: normal;' data-href='ordini-archivio-do.php?or_codice=$or_codice' title='archivio'>archivia</button>&nbsp;";
                                                //echo "<button class='btn btn-danger btn-sm elimina' data-href='ordini-del-do.php?or_codice=$or_codice' title='Elimina'><i class='fa fa-trash-alt'></i></button>";
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
                                                if ($k != 'page') $varget .= "&$k=$v";

                                            for ($i = $current_page - 5; $i <= $current_page + 5; $i++) {

                                                if ($i < 1 || $i > $tot_pages) continue;

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