<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>
            tr[data-capofila] td {

                background-color: #b3d7ff;

            }
        </style>

    </head>

    <body>

    <?php
    $get_pr_capofila = isset($_GET['pr_capofila']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_capofila']))) : "";

    $get_pr_ct_id = isset($_GET['pr_ct_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_ct_id']))) : "";
    $get_pr_st_id = isset($_GET['pr_st_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_st_id']))) : "";
    $get_pr_titolo = isset($_GET['pr_titolo']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_titolo']))) : "";
    $get_pr_mr_id = isset($_GET['pr_mr_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_mr_id']))) : "";
    $get_pr_si_id = isset($_GET['pr_si_id']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_si_id']))) : "";
    $get_pr_misura = isset($_GET['pr_misura']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_misura']))) : "";
    $get_pr_descrizione = isset($_GET['pr_descrizione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_descrizione']))) : "";
    $get_pr_sconto = isset($_GET['pr_sconto']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_sconto']))) : "";
    $get_pr_stato = isset($_GET['pr_stato']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_stato']))) : "";
    $get_pr_ottimizzazione = isset($_GET['pr_ottimizzazione']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_ottimizzazione']))) : "";

    $pr_codice = strlen($row_data['pr_codice']) > 0 ? $row_data['pr_codice'] : "";
    $pr_titolo = strlen($row_data['pr_titolo']) > 0 ? $row_data['pr_titolo'] : "";
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
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione prodotti</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">
                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics mb-10">
                                <div class="card-body">

                                    <form method="get" action="?" enctype="multipart/form-data">

                                        <h5 class="card-title">Filtra prodotti</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_ct_id">Categoria</label>
                                                <select class="form-control ajax-select" id="pr_ct_id" name="pr_ct_id"
                                                        data-href="../ajax/select-sottocategorie.php?ct_id=" data-target="#pr_st_id">
                                                    <option value="">Seleziona una categoria</option>
                                                    <option value=""></option>
                                                    <?php selectCategorieProdotti($get_pr_ct_id, $dbConn) ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_st_id">Sottocategoria</label>
                                                <select class="form-control" id="pr_st_id" name="pr_st_id">
                                                    <option value="">Seleziona prima una categoria</option>
                                                    <option value=""></option>
                                                    <?php if (strlen($get_pr_ct_id) > 0) selectSottocategorieProdotti($get_pr_st_id, $dbConn, $get_pr_ct_id); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_mr_id">Marca</label>
                                                <select class="form-control" id="pr_mr_id" name="pr_mr_id">
                                                    <option value="">Seleziona una marca</option>
                                                    <option value=""></option>
                                                    <?php selectMarca($get_pr_mr_id); ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_titolo">Titolo / Codice</label>
                                                <input type="text" class="form-control" id="pr_titolo" name="pr_titolo" value="<?php echo $get_pr_titolo; ?>" autocomplete="off">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="pr_si_id">Sistema</label>
                                                <select class="form-control" id="pr_si_id" name="pr_si_id">
                                                    <option value="">Seleziona un sistema</option>
                                                    <option value=""></option>
                                                    <?php selectSistema($get_pr_si_id); ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="pr_sconto">Sconto</label>
                                                <select class="form-control" id="pr_sconto" name="pr_sconto">
                                                    <option value="">Filtra per sconto</option>
                                                    <option value=""></option>
                                                    <option value="1" <?php if ($get_pr_sconto == '1') echo "selected"; ?>>Prodotti scontati</option>
                                                    <option value="0" <?php if ($get_pr_sconto == '0') echo "selected"; ?>>Prodotti non scontati</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="pr_descrizione">Descrizione</label>
                                                <input type="text" name="pr_descrizione" id="pr_descrizione" class="form-control" value="<?php echo $get_pr_descrizione; ?>">
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="pr_stato">Visibilità</label>
                                                <select class="form-control" id="pr_stato" name="pr_stato">
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value=""></option>
                                                    <option value="1" <?php if ($get_pr_stato == '1') echo "selected"; ?>>Attivo</option>
                                                    <option value="0" <?php if ($get_pr_stato == '0') echo "selected"; ?>>Non attivo</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="pr_ottimizzazione">Ottimizzazione</label>
                                                <select class="form-control" id="pr_ottimizzazione" name="pr_ottimizzazione">
                                                    <option value="">Filtra per ottimizzazione</option>
                                                    <option value=""></option>
                                                    <option value="immagine" <?php if ($get_pr_ottimizzazione == 'immagine') echo "selected"; ?>>Prodotti senza immagine</option>
                                                    <option value="bestseller" <?php if ($get_pr_ottimizzazione == 'bestseller') echo "selected"; ?>>Prodotti bestseller</option>
                                                    <option value="stato" <?php if ($get_pr_ottimizzazione == 'stato') echo "selected"; ?>>Prodotti non attivi</option>
                                                    <option value="prezzo" <?php if ($get_pr_ottimizzazione == 'prezzo') echo "selected"; ?>>Prodotti senza prezzo</option>
                                                    <option value="acquisto" <?php if ($get_pr_ottimizzazione == 'acquisto') echo "selected"; ?>>Prodotti senza costo di acquisto</option>

                                                </select>
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
                                                <th width="90">Immagine</th>
                                                <th>
                                                    Codice <br> Titolo
                                                </th>

                                                <th width="200">
                                                    Categoria <br> Sottocategoria
                                                </th>

                                                <th width="180">
                                                    Prezzo <br> Prezzo scontato (%)<br> Prezzo acquisto
                                                </th>

                                                <th width="180">
                                                    Marca<br> Sistema
                                                </th>

                                                <th width="130">
                                                    Peso KG.<br> Giacenza Qta.<br> Formato
                                                </th>

                                                <th style="width: 100px; text-align: center;">Stato</th>
                                                <th style="text-align: center; width: 370px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            function pageGetVarianti($pr_capofila)
                                            {

                                                global $dbConn, $upload_path_dir_prodotti, $i;

                                                $querySql =
                                                    "SELECT * FROM pr_prodotti " .
                                                    "LEFT JOIN st_sottocategorie ON st_id = pr_st_id " .
                                                    "LEFT JOIN ct_categorie ON ct_id = st_ct_id " .
                                                    "WHERE pr_capofila = $pr_capofila AND pr_id != $pr_capofila ORDER BY pr_id ";
                                                $result = $dbConn->query($querySql);
                                                $rows = $dbConn->affected_rows;

                                                if ($rows > 0) {

                                                    echo "<tr style='display: none;' data-capofila='$pr_capofila'><td colspan='999'></td></tr>";

                                                    while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                        $pr_id = $row_data['pr_id'];
                                                        $pr_ct_id = $row_data['pr_ct_id'];
                                                        $pr_st_id = $row_data['pr_st_id'];
                                                        $pr_codice = $row_data['pr_codice'];
                                                        $pr_capofila = $row_data['pr_capofila'];
                                                        $pr_titolo = $row_data['pr_titolo'];
                                                        $pr_giacenza = $row_data['pr_giacenza'];
                                                        $pr_peso = $row_data['pr_peso'];
                                                        $pr_formato = $row_data['pr_formato'];

                                                        $mr_marche = getMarca($row_data['pr_mr_id']);
                                                        $si_sistema = getSistema($row_data['pr_si_id']);

                                                        $pr_prezzo = formatPrice($row_data['pr_prezzo']);
                                                        $pr_sconto = $row_data['pr_sconto'];
                                                        $pr_prezzo_scontato = formatPrice($row_data['pr_prezzo_scontato']);
                                                        $pr_prezzo_acquisto = formatPrice($row_data['pr_prezzo_acquisto']);

                                                        $pr_immagine = $row_data['pr_immagine'];
                                                        if (strlen($row_data['pr_immagine']) > 0) {
                                                            $pr_immagine_src = "$upload_path_dir_prodotti/$pr_immagine";
                                                        } else {
                                                            $pr_immagine_src = "$upload_path_dir_prodotti/" . getImgCapofila($pr_capofila);
                                                        }

                                                        echo "<tr style='display: none;' data-capofila='$pr_capofila'>";
                                                        echo "<td><a class='modale-img' href='$pr_immagine_src'><img src=" . $pr_immagine_src . " width='80px'></a></td>";

                                                        echo "<td>";
                                                        echo "<span style='font-style: italic'>" . $pr_codice . "</span><br>";
                                                        echo "<span>" . $pr_titolo . "</span>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<span style='font-style: italic'>" . $row_data['ct_categoria'] . "</span><br>";
                                                        echo "<span>" . $row_data['st_sottocategoria'] . "</span>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<span style='font-style: italic'>&euro; " . $pr_prezzo . "</span><br>";
                                                        echo "<span>&euro; " . $pr_prezzo_scontato . " (" . $pr_sconto . " %)</span><br>";
                                                        echo "<span>&euro; " . $pr_prezzo_acquisto . "</span>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<span style='font-style: italic'>$mr_marche</span><br>";
                                                        echo "<span style='font-style: italic'>$si_sistema</span>";
                                                        echo "</td>";

                                                        echo "<td>";
                                                        echo "<span style='font-style: italic'>Kg. " . $pr_peso . "</span><br>";
                                                        echo "<span>Qt&agrave;: " . $pr_giacenza . "</span><br>";
                                                        echo "<span style='font-style: italic'>$pr_formato</span>";
                                                        echo "</td>";

                                                        $checked = $row_data['pr_stato'] > 0 ? "checked" : "";
                                                        ?>
                                                        <td align='center'>
                                                            <div class="checkbox checbox-switch switch-success">
                                                                <label> <input type="checkbox" class="stato"
                                                                            title="prodotti-stato-do.php?pr_id=<?php echo $pr_id; ?>" <?php echo $checked; ?>><span></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <?php

                                                        //Gestione
                                                        echo "<td align='center'>";
                                                        //echo "<a class='btn btn-primary btn-sm' href='prodotti-varianti-add.php?pr_id=$pr_id' title='Modifica'>varianti</a>&nbsp;";
                                                        echo "<a class='btn btn-sm btn-primary' style='background-color: violet; border-color: violet' href='prodotti-immagini-add.php?pr_id=$pr_id' title='Aggiungi immagine'>immagini</a>&nbsp;";
                                                        echo "<a class='btn btn-success btn-sm' href='prodotti-mod.php?pr_id=$pr_id' title='Modifica'>modifica</a>&nbsp;";
                                                        echo "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-del-do.php?pr_id=$pr_id'><i class='fa fa-trash-alt'></i></button>&nbsp;";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }

                                                    echo "<tr style='display: none;' data-capofila='$pr_capofila'><td colspan='999'></td></tr>";


                                                } //else echo "<tr id='$i' style='display: none'><td colspan='99' align='center' id='$i'>Non ci sono varianti</td></tr>";


                                                $result->close();

                                            }

                                            $querySql =
                                                "SELECT COUNT(pr_id) FROM pr_prodotti " .
                                                "LEFT JOIN st_sottocategorie ON st_id = pr_st_id " .
                                                "LEFT JOIN ct_categorie ON ct_id = st_ct_id " .
                                                "WHERE pr_id > 0 AND pr_capofila = pr_id ";
                                            if (strlen($get_pr_capofila) > 0) $querySql .= " AND (pr_capofila = '$get_pr_capofila' OR pr_codice = '$get_pr_capofila') ";
                                            if (strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                            if (strlen($get_pr_st_id) > 0) $querySql .= " AND pr_st_id = '$get_pr_st_id' ";
                                            if (strlen($get_pr_titolo) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_titolo%' OR pr_codice LIKE '%$get_pr_titolo%' ) ";
                                            if (strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
                                            if (strlen($get_pr_si_id) > 0) $querySql .= " AND pr_si_id = '$get_pr_si_id' ";
                                            if (strlen($get_pr_sconto) > 0) $querySql .= $get_pr_sconto == 0 ? " AND pr_sconto = '0' " : " AND pr_sconto != '0' ";
                                            if (strlen($get_pr_descrizione) > 0) $querySql .= " AND pr_descrizione LIKE '%$get_pr_descrizione%' ";
                                            if (strlen($get_pr_stato) > 0) $querySql .= $get_pr_stato == 0 ? " AND pr_stato = '0' " : " AND pr_stato = '1' ";
                                            if ($get_pr_ottimizzazione == 'immagine') $querySql .= " AND LENGTH(pr_immagine) = 0 ";
                                            if ($get_pr_ottimizzazione == 'stato') $querySql .= " AND pr_stato = 0 ";
                                            if ($get_pr_ottimizzazione == 'bestseller') $querySql .= " AND pr_best_seller = 1 ";
                                            if ($get_pr_ottimizzazione == 'prezzo') $querySql .= " AND pr_prezzo = '' AND pr_prezzo_scontato = '' ";
                                            if ($get_pr_ottimizzazione == 'acquisto') $querySql .= " AND pr_prezzo_acquisto = '' OR pr_prezzo_acquisto = 0 ";

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
                                                "SELECT * FROM pr_prodotti " .
                                                "LEFT JOIN st_sottocategorie ON st_id = pr_st_id " .
                                                "LEFT JOIN ct_categorie ON ct_id = st_ct_id " .
                                                "WHERE pr_id > 0 AND pr_capofila = pr_id ";
                                            if (strlen($get_pr_capofila) > 0) $querySql .= " AND (pr_capofila = '$get_pr_capofila' OR pr_codice = '$get_pr_capofila') ";
                                            if (strlen($get_pr_ct_id) > 0) $querySql .= " AND pr_ct_id = '$get_pr_ct_id' ";
                                            if (strlen($get_pr_st_id) > 0) $querySql .= " AND pr_st_id = '$get_pr_st_id' ";
                                            if (strlen($get_pr_titolo) > 0) $querySql .= " AND (pr_titolo LIKE '%$get_pr_titolo%' OR pr_codice LIKE '%$get_pr_titolo%' ) ";
                                            if (strlen($get_pr_mr_id) > 0) $querySql .= " AND pr_mr_id = '$get_pr_mr_id' ";
                                            if (strlen($get_pr_si_id) > 0) $querySql .= " AND pr_si_id = '$get_pr_si_id' ";
                                            if (strlen($get_pr_sconto) > 0) $querySql .= $get_pr_sconto == 0 ? " AND pr_sconto = '0' " : " AND pr_sconto != '0' ";
                                            if (strlen($get_pr_descrizione) > 0) $querySql .= " AND pr_descrizione LIKE '%$get_pr_descrizione%' ";
                                            if (strlen($get_pr_stato) > 0) $querySql .= $get_pr_stato == 0 ? " AND pr_stato = '0' " : " AND pr_stato = '1' ";
                                            if ($get_pr_ottimizzazione == 'immagine') $querySql .= " AND LENGTH(pr_immagine) = 0 ";
                                            if ($get_pr_ottimizzazione == 'stato') $querySql .= " AND pr_stato = 0 ";
                                            if ($get_pr_ottimizzazione == 'bestseller') $querySql .= " AND pr_best_seller = 1 ";
                                            if ($get_pr_ottimizzazione == 'prezzo') $querySql .= " AND pr_prezzo = '' AND pr_prezzo_scontato = '' ";
                                            if ($get_pr_ottimizzazione == 'acquisto') $querySql .= " AND pr_prezzo_acquisto = '' OR pr_prezzo_acquisto = 0 ";

                                            $querySql .= "ORDER BY pr_id LIMIT $primo, $per_page";
                                            echo "<br>querySql:" . $querySql;
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;


                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $pr_id = $row_data['pr_id'];
                                                $pr_ct_id = $row_data['pr_ct_id'];
                                                $pr_st_id = $row_data['pr_st_id'];
                                                $pr_codice = $row_data['pr_codice'];
                                                $pr_capofila = $row_data['pr_capofila'];
                                                $pr_titolo = $row_data['pr_titolo'];
                                                $pr_giacenza = $row_data['pr_giacenza'];
                                                $pr_peso = $row_data['pr_peso'];
                                                $pr_formato = $row_data['pr_formato'];

                                                $mr_marche = getMarca($row_data['pr_mr_id']);
                                                $si_sistema = getSistema($row_data['pr_si_id']);

                                                $pr_prezzo = formatPrice($row_data['pr_prezzo']);
                                                $pr_sconto = $row_data['pr_sconto'];
                                                $pr_prezzo_scontato = formatPrice($row_data['pr_prezzo_scontato']);
                                                $pr_prezzo_acquisto = formatPrice($row_data['pr_prezzo_acquisto']);

                                                $esistenza_varianti = getEsistenzaVarianti($pr_id, $dbConn);

                                                $pr_immagine = $row_data['pr_immagine'];
                                                if ((strlen($row_data['pr_immagine']) > 0) && is_file("$upload_path_dir_prodotti/$pr_immagine")) {
                                                    $pr_immagine_src = "$upload_path_dir_prodotti/$pr_immagine";
                                                } else {
                                                    $pr_immagine_src = "../../assets/img/prodotto-dummy.jpg";
                                                }

                                                echo "<tr>";
                                                echo "<td><a class='modale-img' href='$pr_immagine_src'><img src=" . $pr_immagine_src . " width='80px'></a></td>";

                                                echo "<td>";
                                                echo "<span style='font-style: italic'>" . $pr_codice . "</span><br>";
                                                echo "<span>" . $pr_titolo . "</span>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<span style='font-style: italic'>" . $row_data['ct_categoria'] . "</span><br>";
                                                echo "<span>" . $row_data['st_sottocategoria'] . "</span>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<span style='font-style: italic'>&euro; " . $pr_prezzo . "</span><br>";
                                                echo "<span>&euro; " . $pr_prezzo_scontato . " (" . $pr_sconto . " %)</span><br>";
                                                echo "<span>&euro; " . $pr_prezzo_acquisto . "</span>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<span style='font-style: italic'>$mr_marche</span><br>";
                                                echo "<span style='font-style: italic'>$si_sistema</span>";
                                                echo "</td>";

                                                echo "<td>";
                                                echo "<span style='font-style: italic'>Kg. " . $pr_peso . "</span><br>";
                                                echo "<span>Qt&agrave;: " . $pr_giacenza . "</span><br>";
                                                echo "<span style='font-style: italic'>$pr_formato</span>";
                                                echo "</td>";

                                                $checked = $row_data['pr_stato'] > 0 ? "checked" : "";
                                                ?>
                                                <td align='center'>
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label> <input type="checkbox" class="stato"
                                                                    title="prodotti-stato-do.php?pr_id=<?php echo $pr_id; ?>" <?php echo $checked; ?>><span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <?php
                                                //Gestione
                                                echo "<td align='center'>";
                                                echo $row_data['pr_capofila'] != $row_data['pr_id']
                                                    ? "<a class='btn btn-secondary btn-sm disabled' href='javascript:;' title='aggiungi variante'><i class='fa fa-plus'></i> variante</a>&nbsp;"
                                                    : "<a class='btn btn-primary btn-sm' href='prodotti-varianti-add.php?pr_id=$pr_id' title='aggiungi variante'><i class='fa fa-plus'></i> variante</a>&nbsp;";
                                                echo $row_data['pr_capofila'] != $row_data['pr_id'] || $esistenza_varianti < 1
                                                    ? "<a class='btn btn-secondary btn-sm disabled' href='javascript:;' title='varianti'>varianti</a>&nbsp;"
                                                    : "<button class='btn btn-orange btn-sm varianti-show' data-capofila='$pr_id' >varianti</button>&nbsp;";

                                                echo $row_data['pr_capofila'] != $row_data['pr_id']
                                                    ? "<a class='btn btn-sm btn-primary disabled' style='background-color: violet; border-color: violet' href='javascript:;' title='Aggiungi immagine'>immagini</a>&nbsp;"
                                                    : "<a class='btn btn-sm btn-primary' style='background-color: violet; border-color: violet' href='prodotti-immagini-add.php?pr_id=$pr_id' title='Aggiungi immagine'>immagini</a>&nbsp;";

                                                echo "<a class='btn btn-success btn-sm' href='prodotti-mod.php?pr_id=$pr_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo $esistenza_varianti < 1
                                                    ? "<button class='btn btn-danger btn-sm elimina' data-href='prodotti-del-do.php?pr_id=$pr_id'><i class='fa fa-trash-alt'></i></button>&nbsp;"
                                                    : "<button class='btn btn-danger btn-sm disabled'><i class='fa fa-trash-alt'></i></button>&nbsp;";
                                                //echo "<button class='btn btn-sm detail-show '><i class='fa fa-plus'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";


                                                pageGetVarianti($pr_capofila);

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono prodotti</td></tr>";

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