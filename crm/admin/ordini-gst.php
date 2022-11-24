<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <!-- CSS per la stampa della modale (ordini-view.php) -->
        <style type="text/css" media="print">

            .content-wrapper, .modal-header, .modal-footer, .no-note{
                display: none;
            }
            .modal-lg {
                max-width: unset;
            }
            .modal-dialog {
                max-width: unset;
                margin: unset;
            }
            .logo_stampa{
                display: unset !important;
            }

        </style>

    </head>

    <body>

    <?php
    $get_or_stato_conferma = isset($_GET['or_stato_conferma']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_conferma']))) : "";
    $get_or_stato_pagamento = isset($_GET['or_stato_pagamento']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_pagamento']))) : "";
    $get_or_stato_spedizione = isset($_GET['or_stato_spedizione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato_spedizione']))) : "";
    $get_or_stato = isset($_GET['or_stato']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_stato']))) : "";
    $get_or_gestione = isset($_GET['or_gestione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_gestione']))) : "";

    $get_or_timestamp_da = isset($_GET['or_timestamp_da']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_timestamp_da']))) : "";
    $get_or_timestamp_a = isset($_GET['or_timestamp_a']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_timestamp_a']))) : "";

    if(strlen($get_or_timestamp_da) > 0) {

        list($day, $month, $year) = explode("/", $get_or_timestamp_da);
        $get_or_timestamp_da = mktime(0, 0, 0, $month, $day, $year);

    }

    if(strlen($get_or_timestamp_a) > 0) {

        list($day, $month, $year) = explode("/", $get_or_timestamp_a);
        $get_or_timestamp_a = mktime(23, 59, 59, $month, $day, $year);

    }

    $get_or_codice = isset($_GET['or_codice']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_codice']))) : "";
    $get_cl_cognome = isset($_GET['cl_cognome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['cl_cognome']))) : "";
    $get_or_importo_min = isset($_GET['or_importo_min']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['or_importo_min']))) : "";
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
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione ordini</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra ordini</h5>

                                        <div class="form-row">
                                            <div class="col-md-1 mb-3">
                                                <label for="or_codice">Codice</label>
                                                <input type="text" class="form-control" id="or_codice" name="or_codice" value="<?php echo $get_or_codice; ?>">
                                                <span class="tooltips">Codice Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Ordine" data-content="Inserisci qui il codice dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="cl_cognome">Cognome</label>
                                                <input type="text" class="form-control" id="cl_cognome" name="cl_cognome" value="<?php echo $get_cl_cognome; ?>">
                                                <span class="tooltips">Cognome Cliente Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Cliente Ordine" data-content="Inserisci qui il cognome del cliente che ha richiesto l'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="cr_data">Data</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-addon">Da</span>
                                                    </div>
                                                    <input name="or_timestamp_da" class="form-control range-from" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_or_timestamp_da) > 0) echo date("d/m/Y", $get_or_timestamp_da); ?>">
                                                    <span class="input-group-addon">A</span>
                                                    <input name="or_timestamp_a" class="form-control range-to" type="text"
                                                           data-date-format="dd/mm/yyyy" autocomplete="off"
                                                           value="<?php if(strlen($get_or_timestamp_a) > 0) echo date("d/m/Y", $get_or_timestamp_a); ?>">
                                                </div>
                                                <span class="tooltips">Data ordini <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Data Ordine" data-content="Inserisci qui l'intervallo di tempo in cui è stato creato l'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label for="or_stato_conferma">Conferma</label>
                                                <select class="form-control" id="or_stato_conferma" name="or_stato_conferma">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if($get_or_stato_conferma == '1') echo "selected"; ?>>Confermato</option>
                                                    <option value="0" <?php if($get_or_stato_conferma == '0') echo "selected"; ?>>Non confermato</option>
                                                </select>
                                                <span class="tooltips">Stato Conferma Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Conferma Ordine" data-content="Inserisci qui lo stato di conferma dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="or_stato_pagamento">Pagamento</label>
                                                <select class="form-control" id="or_stato_pagamento" name="or_stato_pagamento">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if($get_or_stato_pagamento == '1') echo "selected"; ?>>Pagato</option>
                                                    <option value="0" <?php if($get_or_stato_pagamento == '0') echo "selected"; ?>>Non pagato</option>
                                                </select>
                                                <span class="tooltips">Stato Pagamento Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Pagamento Ordine" data-content="Inserisci qui lo stato di pagamento dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="or_stato_spedizione">Spedizione</label>
                                                <select class="form-control" id="or_stato_spedizione" name="or_stato_spedizione">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if($get_or_stato_spedizione == '1') echo "selected"; ?>>Spedito</option>
                                                    <option value="0" <?php if($get_or_stato_spedizione == '0') echo "selected"; ?>>Non spedito</option>
                                                </select>
                                                <span class="tooltips">Stato Spedizione Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Spedizione Ordine" data-content="Inserisci qui lo stato di spedizione dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="or_stato">Evasione</label>
                                                <select class="form-control" id="or_stato" name="or_stato">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="1" <?php if($get_or_stato == '1') echo "selected"; ?>>Evaso</option>
                                                    <option value="0" <?php if($get_or_stato == '0') echo "selected"; ?>>Non evaso</option>
                                                </select>
                                                <span class="tooltips">Stato Evasione Ordine <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Evasione Ordine" data-content="Inserisci qui lo stato di evasione dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="or_gestione">Gestione</label>
                                                <select class="form-control" id="or_gestione" name="or_gestione">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value="attivi" <?php if($get_or_gestione == 'attivi') echo "selected"; ?>>Attivi</option>
                                                    <option value="archiviati" <?php if($get_or_gestione == 'archiviati') echo "selected"; ?>>Archiviati</option>
                                                    <option value="tutti" <?php if($get_or_gestione == 'tutti') echo "selected"; ?>>Tutti</option>
                                                </select>
                                                <span class="tooltips">Stato di gestione <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato gestione Ordine" data-content="Inserisci qui lo stato di gestione dell'ordine che stai cercando">[aiuto]</a></span>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" type="submit">Cerca</button>
                                        <a class="btn btn-orange" href="ordini-bartolini-do.php">Genera CSV Bartolini</a>
                                        <a class="btn btn-orange" href="ordini-casa-cialde-do.php">Genera CSV Casa Cialde</a>
                                        <a class="btn btn-orange" href="ordini-corrispettivi-do.php">Genera CSV Corrispettivi</a>

                                    </form>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista ordini</h5>

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

                                        <table class="table table-1 table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th width="250">Codice ordine</th>
                                                <!--<th width="10">Tipo</th>-->
                                                <th>Denominazione</th>
                                                <th width="150">Pagamento</th>
                                                <th width="200">Importo<br>
                                                    Importo acquisto</th>
                                                <th class="text-center" width="100">Fattura</th>
                                                <th class="text-center" width="400">Stato di lavorazione</th>
                                                <th class="text-center" width="100">Reso</th>
                                                <th class="text-center" width="100">Tipo</th>
                                                <th class="text-center" width="100">BRT</th>
                                                <th class="text-center" width="100">Corrispettivi</th>
                                                <th class="text-center" width="300">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(DISTINCT or_codice) FROM or_ordini INNER JOIN cl_clienti ON cl_codice = or_cl_codice WHERE or_eliminato = 0 ";
                                            if(strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                            if(strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                            if(strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                            if(strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                            if(($get_or_gestione == 'attivi') || ($get_or_gestione == '')) $querySql .= " AND or_archivio = 0 ";
                                            if($get_or_gestione == 'archiviati') $querySql .= " AND or_archivio = 1 ";
                                            if($get_or_gestione == 'tutti') $querySql .= " AND (or_archivio = 0 OR or_archivio = 1) ";
                                            if(strlen($get_or_timestamp_da) > 0) $querySql .= " AND or_timestamp >= '$get_or_timestamp_da' ";
                                            if(strlen($get_or_timestamp_a) > 0) $querySql .= " AND or_timestamp <= '$get_or_timestamp_a' ";
                                            if(strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                            if(strlen($get_cl_cognome) > 0) $querySql .= " AND cl_cognome LIKE '%$get_cl_cognome%' ";
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
                                                "SELECT *, SUM(or_pr_prezzo * or_pr_quantita) AS or_totale_importo FROM or_ordini ".
                                                "INNER JOIN cl_clienti ON or_cl_codice = cl_codice WHERE or_eliminato = 0 ";
                                            if(strlen($get_or_stato_conferma) > 0) $querySql .= " AND or_stato_conferma = '$get_or_stato_conferma' ";
                                            if(strlen($get_or_stato_pagamento) > 0) $querySql .= " AND or_stato_pagamento = '$get_or_stato_pagamento' ";
                                            if(strlen($get_or_stato_spedizione) > 0) $querySql .= " AND or_stato_spedizione = '$get_or_stato_spedizione' ";
                                            if(strlen($get_or_stato) > 0) $querySql .= " AND or_stato = '$get_or_stato' ";
                                            if(($get_or_gestione == 'attivi') || ($get_or_gestione == '')) $querySql .= " AND or_archivio = 0 ";
                                            if($get_or_gestione == 'archiviati') $querySql .= " AND or_archivio = 1 ";
                                            if($get_or_gestione == 'tutti') $querySql .= " AND (or_archivio = 0 OR or_archivio = 1) ";
                                            if(strlen($get_or_timestamp_da) > 0) $querySql .= " AND or_timestamp >= '$get_or_timestamp_da' ";
                                            if(strlen($get_or_timestamp_a) > 0) $querySql .= " AND or_timestamp <= '$get_or_timestamp_a' ";
                                            if(strlen($get_or_codice) > 0) $querySql .= " AND or_codice LIKE '%$get_or_codice%' ";
                                            if(strlen($get_cl_cognome) > 0) $querySql .= " AND cl_cognome LIKE '%$get_cl_cognome%' ";
                                            $querySql .= " GROUP BY or_codice ORDER BY or_codice DESC LIMIT $primo, $per_page ";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            $i = 1;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $or_id = $row_data['or_id'];
                                                $or_codice = $row_data['or_codice'];
                                                $or_timestamp = $row_data['or_timestamp'];
                                                $cl_codice = $row_data['cl_codice'];

                                                $or_pagamento = $row_data['or_pagamento'];
                                                $or_spedizione = $row_data['or_tipo_spedizione'];
                                                $cl_nazione = $row_data['cl_nazione'];
                                                $or_sconto = $row_data['or_sconto'];
                                                $or_coupon_valore = $row_data['or_coupon_valore'];
                                                $or_coupon_tipo = $row_data['or_coupon_tipo'];
                                                $or_coupon = $row_data['or_coupon'];
                                                $or_rapido = $row_data['or_rapido'];

                                                $or_rapido = ($or_rapido == 1) ? "Rapido" : "Standard";

                                                $or_totale_importo = $row_data['or_totale_importo'];
                                                $or_totale_importo_acquisto = getTotAcquisti($or_codice);
                                                $art_no_importo = countArtNoImporto($or_codice);

                                                $or_pagamento_prezzo = getPrezzoPagamento($or_pagamento, $or_totale_importo);
                                                $or_spedizione_prezzo = getPrezzoSpedizione($or_spedizione, $or_totale_importo);


                                                if(strlen($or_coupon)>0) {
                                                    $or_sconto_coupon = $or_coupon_tipo == "importo" ? (float)$or_coupon_valore : ($or_totale_importo / 100) * $or_coupon_valore;
                                                } else {
                                                    $or_sconto_coupon = 0;
                                                }

                                                $or_totale = $or_totale_importo - $or_sconto_coupon + $or_pagamento_prezzo + $or_spedizione_prezzo;

                                                //Righe di colore alternato sulla tabella
                                                $stripe_tr_bg = "fff";
                                                $mod_i = $i % 2;
                                                if ($mod_i == 0) $stripe_tr_bg = "#eee";

                                                echo "<tr style='background-color: ".$stripe_tr_bg."'>";
                                                echo "<td>$or_codice<br><small>Del ".date('d/m/Y - H:i', $or_timestamp)."</small></td>";
                                                //if($row_data['cl_business']) echo "<td class='text-center'>B</td>";
                                                //else echo "<td class='text-center'>S</td>";
                                                echo "<td>".$row_data['cl_nome']." ".$row_data['cl_cognome']."</td>";
                                                echo "<td>".$row_data['or_pagamento']."</td>";
                                                echo "<td>&euro; ".formatPrice($or_totale)."<br>&euro; ".formatPrice($or_totale_importo_acquisto)." (".$art_no_importo.")</td>";

                                                //Fattura
                                                echo "<td align='center'>";
                                                
                                                    if ($row_data['or_fattura'] == '1') echo "<button class='btn btn-sm btn-info' title='Fattura richiesta'>Fattura</button>&nbsp;";
                                                    if ($row_data['or_fattura'] == '0') echo "-&nbsp;";
                                                
                                                echo "</td>";
                                                
                                                //Stato di evasione
                                                echo "<td align='center'>";

                                                if ($row_data['or_stato_conferma'] == '0') {
                                                    echo "<a href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Conferma</button></a>&nbsp;";
                                                } else {
                                                    echo "<button class='btn btn-sm btn-success alert-2' data-text=\"Continuando annullerai l'ordine\" ".
                                                        "data-href='ordini-stato-conferma-do.php?or_codice=$or_codice' title='Attiva'>Conferma</button>&nbsp;";
                                                }
                                                
                                                if ($row_data['or_stato_pagamento'] == '0') {
                                                    echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-danger'>Pagamento</button></a>&nbsp;";
                                                } else {
                                                    echo "<a href='ordini-stato-pagamento-do.php?or_codice=$or_codice' title='Attiva'><button class='btn btn-sm btn-success'>Pagamento</button></a>&nbsp;";
                                                }
                                                
                                                if ($row_data['or_stato_spedizione'] == '0') {
                                                    echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' ".
                                                        "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedizione</button>&nbsp;";
                                                } else {
                                                    echo "<button class='btn btn-sm btn-success alert-2' data-text='Continuando invierai una mail di conferma spedizione al cliente' ".
                                                        "data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedizione</button>&nbsp;";
                                                        //echo "<a class='btn btn-sm btn-success alert-2' data-href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedizione</a>&nbsp;";
                                                        //echo "<a class='btn btn-sm btn-success alert-2' href='ordini-stato-spedizione-do.php?or_codice=$or_codice' title='Attiva'>Spedizione</a>&nbsp;";
                                                }
                                                
                                                if ($row_data['or_stato'] == '0') {
                                                    echo "<button class='btn btn-sm btn-danger alert-2' data-text='Continuando invierai una mail di conferma evasione al cliente' ".
                                                        "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</button>&nbsp;";
                                                } else {
                                                    echo "<button class='btn btn-sm btn-success alert-2' data-text='Continuando invierai una mail di conferma evasione al cliente' ".
                                                        "data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</button>&nbsp;";
                                                    //echo "<a class='btn btn-sm btn-success alert-2' data-href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</a>&nbsp;";
                                                    //echo "<a class='btn btn-sm btn-success' href='ordini-stato-do.php?or_codice=$or_codice' title='Attiva'>Evasione</a>&nbsp;";
                                                }
                                                
                                                echo "</td>";

                                                echo "<td class='text-center'>";
                                                    if ($row_data['or_stato_reso'] == '0')
                                                        echo "<a href='ordini-stato-reso-do.php?or_codice=$or_codice' title='Non reso'><button class='btn btn-sm btn-danger'>Non reso</button></a>&nbsp;";
                                                    else
                                                        echo "<a href='ordini-stato-reso-do.php?or_codice=$or_codice' title='Reso'><button class='btn btn-sm btn-success'>Reso</button></a>&nbsp; ";
                                                echo "</td>";

                                                echo "<td class='text-center'><button class='btn btn-sm btn-orange'>".$or_rapido."</button></td>";

                                                $checked = $row_data['or_stato_export'] > 0 ? "checked" : "";
                                                $checked_2 = $row_data['or_stato_corrispettivi'] > 0 ? "checked" : "";
                                                ?>
                                                <td style="text-align: center;">
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label style="margin-top: 5px;">
                                                            <input type="checkbox" class="stato" title="ordini-stato-export-do.php?or_codice=<?php echo $or_codice; ?>" <?php echo $checked; ?>><span></span>
                                                        </label>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;">
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label style="margin-top: 5px;">
                                                            <input type="checkbox" class="stato" title="ordini-stato-corrispettivi-do.php?or_codice=<?php echo $or_codice; ?>" <?php echo $checked_2; ?>><span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <?php

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='ordini-mod.php?or_codice=$or_codice' title='Modifica'><i class='fa fa-edit'></i></a>&nbsp;";
                                                echo "<button class='btn btn-info btn-sm modale' data-href='ordini-view.php?or_codice=$or_codice' title='Dettaglio'><i class='fa fa-print'></i></button>&nbsp;";
                                                if ($row_data['or_archivio'] == '0')
                                                    echo "<button class='btn btn-warning btn-sm alert-link-ordini-archivio' style='font-weight: normal;' data-href='ordini-archivio-do.php?or_codice=$or_codice' title='archivio'><i class='fa fa-list'></i></button>&nbsp;";
                                                else
                                                    echo "<button class='btn btn-sm btn-sm' style='font-weight: normal;' title='archivio'><i class='fa fa-list'></i></button>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm alert-link-ordini-eliminato' style='font-weight: normal;' data-href='ordini-elimina-do.php?or_codice=$or_codice' title='elimina'><i class='fa fa-trash'></i></button>&nbsp;";
                                                echo "<a class='btn btn-orange btn-sm btn-cart-mail' href='javascript:;' data-href='ordine-mail-do.php?or_codice=$or_codice' title='Mail'>mail <i></i></a>&nbsp;";
                                                echo "<button class='btn btn-sm detail-show '><i class='fa fa-plus'></i></button>&nbsp;";
                                                //echo "<button class='btn btn-danger btn-sm elimina' data-href='ordini-del-do.php?or_codice=$or_codice' title='Elimina'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                echo "<tr class='prod-detail'>";
                                                echo "<td colspan='999'>";
                                                echo "<table class='details-table'>";
                                                echo "<tr>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Email</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Stato Invio</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Stato Lettura</th>";
                                                echo "<th colspan='1' style='background-color: #c6c8ca;'>Click</th>";
                                                echo "<th colspan='3' style='background-color: #c6c8ca;'>Data e ora invio</th>";
                                                echo "</tr>";

                                                $querySql_log = "SELECT * FROM ol_ordini_log WHERE ol_or_codice = '$or_codice' ORDER BY ol_timestamp DESC ";
                                                $result_log = $dbConn->query($querySql_log);
                                                $rows_log = $dbConn->affected_rows;

                                                while (($row_data = $result_log->fetch_assoc()) !== NULL) {

                                                    $ol_id = $row_data['ol_id'];
                                                    $ol_cr_id = $row_data['ol_cr_id'];
                                                    $ol_timestamp = $row_data['ol_timestamp'];
                                                    $ol_email = $row_data['ol_email'];
                                                    $ol_stato_invio = $row_data['ol_stato_invio'];
                                                    $ol_stato_lettura = $row_data['ol_stato_lettura'];
                                                    $ol_click = $row_data['ol_click'];

                                                    echo "<tr>";
                                                    echo "<td colspan='1'>".$ol_email." </td>";
                                                    echo "<td colspan='1'>".$ol_stato_invio."</td>";
                                                    if($ol_stato_lettura == 1) echo "<td colspan='1' style='color: green;'>Letta</td>";
                                                    else echo "<td colspan='1'>Non letta</td>";
                                                    echo "<td colspan='1'>".$ol_click."</td>";
                                                    if($ol_timestamp > 0) echo "<td colspan='1' style='color: green;'>".date("H:i d/m/Y", $ol_timestamp)."</td>";
                                                    else echo "<td colspan='1'>N/D</td>";
                                                    echo "</tr>";
                                                }

                                                if ($rows_log == '0') {
                                                    echo "<tr><td colspan='99' align='center'>Non ci sono log per questo ordine</td></tr>";
                                                }

                                                echo "</table>";
                                                echo "</td>";
                                                echo "</tr>";

                                                $result_log->close();

                                                $i++;

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