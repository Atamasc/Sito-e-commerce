<?php include "inc/autoloader.php"; ?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

    </head>

    <body>

    <?php
    $get_ut_nome = isset($_GET['ut_nome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_nome']))) : "";
    $get_ut_cognome = isset($_GET['ut_cognome']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_cognome']))) : "";
    $get_ut_email = isset($_GET['ut_email']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_email']))) : "";
    $get_ut_telefono = isset($_GET['ut_telefono']) ? $dbConn->real_escape_string(stripslashes(trim($_GET['ut_telefono']))) : "";
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
                                <h4 class="mb-0"> Gestione clienti</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione clienti</li>
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

                                        <h5 class="card-title">Filtra clienti</h5>

                                        <div class="form-row">

                                            <div class="col-md-2 mb-3">
                                                <label>Nome</label>
                                                <input type="text" name="ut_nome" class="form-control" value="<?php echo $get_ut_nome; ?>">
                                                <span class="tooltips">Nome Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Nome Utente" data-content="Inserisci qui il nome dell'utente che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label>Cognome</label>
                                                <input type="text" name="ut_cognome" class="form-control" value="<?php echo $get_ut_cognome; ?>">
                                                <span class="tooltips">Cognome Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Cognome Utente" data-content="Inserisci qui il cognome dell'utente che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_telefono">Telefono</label>
                                                <input name="ut_telefono" id="ut_telefono" class="form-control" type="text" autocomplete="off"
                                                        value="<?php echo $get_ut_telefono; ?>"> <span class="tooltips">Telefono Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Telefono Utente" data-content="Inserisci qui il numero di telefono dell'utente che stai cercando">[aiuto]</a></span>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="ut_email">Email</label>
                                                <input name="ut_email" id="ut_email" class="form-control" type="text" autocomplete="off"
                                                        value="<?php echo $get_ut_email; ?>"> <span class="tooltips">E-mail Utente <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="E-mail Utente" data-content="Inserisci qui l'indirizzo e-mail dell'utente che stai cercando">[aiuto]</a></span>
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
                                                <th style="width: 75px;">ID</th>
                                                <th>Nome</th>
                                                <th>Cognome</th>
                                                <th>Email</th>
                                                <th style="text-align: center; width: 150px;">Stato</th>
                                                <th style="text-align: center; width: 300px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(ut_id) FROM ut_utenti WHERE ut_id > 0 ";
                                            if (strlen($get_ut_nome) > 0) $querySql .= " AND ut_nome LIKE '%$get_ut_nome%' ";
                                            if (strlen($get_ut_cognome) > 0) $querySql .= " AND ut_cognome LIKE '%$get_ut_cognome%' ";
                                            if (strlen($get_ut_email) > 0) $querySql .= " AND ut_email LIKE '%$get_ut_email%' ";
                                            if (strlen($get_ut_telefono) > 0) $querySql .= " AND ut_telefono LIKE '%$get_ut_telefono%' ";
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

                                            $querySql = "SELECT * FROM ut_utenti WHERE ut_id > 0 ";
                                            if (strlen($get_ut_nome) > 0) $querySql .= " AND ut_nome LIKE '%$get_ut_nome%' ";
                                            if (strlen($get_ut_cognome) > 0) $querySql .= " AND ut_cognome LIKE '%$get_ut_cognome%' ";
                                            if (strlen($get_ut_email) > 0) $querySql .= " AND ut_email LIKE '%$get_ut_email%' ";
                                            if (strlen($get_ut_telefono) > 0) $querySql .= " AND ut_telefono LIKE '%$get_ut_telefono%' ";
                                            $querySql .= " ORDER BY ut_id LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $ut_id = $row_data['ut_id'];

                                                echo "<tr>";
                                                echo "<td>$ut_id</td>";
                                                echo "<td>" . $row_data['ut_nome'] . "</td>";
                                                echo "<td>" . $row_data['ut_cognome'] . "</td>";
                                                echo "<td>" . $row_data['ut_email'] . "</td>";

                                                //Stato
                                                $checked = $row_data['ut_stato'] > 0 ? "checked" : "";
                                                echo "<td align='center'>";
                                                ?>
                                                <div class="checkbox checbox-switch switch-success">
                                                    <label>
                                                        <input type="checkbox" class="stato" title="utenti-stato-do.php?ut_id=<?php echo $ut_id; ?>" <?php echo $checked; ?>><span></span>
                                                    </label>
                                                </div>
                                                <?php
                                                echo "</td>";

                                                //Gestione
                                                echo "<td align='center'>";
                                                //echo "<a class='btn btn-purple btn-sm' href='utenti-sedi.php?ut_id=$ut_id' title='Sedi'>sedi</a>&nbsp;";
                                                echo "<button class='btn btn-primary btn-sm modale' data-href='utenti-scheda-modale.php?ut_id=$ut_id' title='Visualizza scheda'>scheda cliente</button>&nbsp;";
                                                echo "<a class='btn btn-success btn-sm' href='utenti-mod.php?ut_id=$ut_id' title='Modifica anagrafica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='utenti-del-do.php?ut_id=$ut_id'><i class='fas fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            };

                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono anagrafiche presenti</td></tr>";
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