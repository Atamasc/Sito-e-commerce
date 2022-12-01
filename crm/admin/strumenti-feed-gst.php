<?php include "inc/autoloader.php"; ?>
<?php
$querySql = "SELECT lf_data, lf_tipo, lf_record FROM lf_log_feed WHERE lf_id > 0 ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $lf_tipo = $row_data['lf_tipo'];

    if ($lf_tipo == "google") {
        $data_google = date("d/m/Y H:i", $row_data['lf_data']);
        $record_google = $row_data['lf_record'];

    } elseif ($lf_tipo == "google-free") {
        $data_google_free = date("d/m/Y H:i", $row_data['lf_data']);
        $record_google_free = $row_data['lf_record'];

    } elseif ($lf_tipo == "trovaprezzi") {
        $data_trovaprezzi = date("d/m/Y H:i", $row_data['lf_data']);
        $record_trovaprezzi = $row_data['lf_record'];

    } elseif ($lf_tipo == "facebook") {
        $data_facebook = date("d/m/Y H:i", $row_data['lf_data']);
        $record_facebook = $row_data['lf_record'];

    } elseif ($lf_tipo == "bing") {
        $data_bing = date("d/m/Y H:i", $row_data['lf_data']);
        $record_bing = $row_data['lf_record'];

    }

}
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
                                <h4 class="mb-0"> Gestione Importazioni </h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestione importazioni</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Importazioni</h5>

                                    <?php
                                    if (@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Feed aggiornato com successo.
                                        </div>
                                        <?php

                                    }

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
                                                <th>Descrizione</th>
                                                <th>Ultima generazione</th>
                                                <th>Ultimi record sincronizzati</th>
                                                <th class="text-center" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <!--
                                            <tr>
                                                <td>Importa clienti</td>
                                                <td class="text-center">
                                                    <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/import-utenti-add-do.php'>
                                                        <i class="fa fa-sync"></i>sincronizza
                                                    </button>
                                                </td>
                                            </tr>
                                            -->
                                            <!--<tr>
                                            <td>
                                                TROVAPREZZI <br>
                                                <em>Feed TXT per portale Trovaprezzi - Link: https://www.moncaffe.it/ftp/trovaprezzi.txt</em>
                                            </td>
                                            <td><?php if (strlen($data_trovaprezzi) > 0) echo $data_trovaprezzi; else echo "N/D"; ?></td>
                                            <td class="text-center">
                                                <a class='btn btn-primary btn-sm' href='../funzioni/procedura-feed-trovaprezzi-do.php' title='Aggiorna feed'><i class="fa fa-sync"></i>Sincronizza</a>
                                            </td>
                                        </tr>-->

                                            <tr>
                                                <td>
                                                    GOOGLE SHOPPING <br>
                                                    <em>Feed TXT per Feed Google Shopping circuito a pagamento - Link: https://www.moncaffe.it/ftp/feed-google-shopping.txt</em>
                                                </td>
                                                <td><?php if (strlen($data_google) > 0) echo $data_google; else echo "N/D"; ?></td>
                                                <td><?php if ($record_google > 0) echo $record_google; else echo "N/D"; ?></td>

                                                <td class="text-center">
                                                    <a class='btn btn-primary btn-sm' href='../funzioni/procedura-feed-google-do.php' title='Aggiorna feed'><i class="fa fa-sync"></i>Sincronizza</a>
                                                    <!--
                                                    <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/procedura-feed-prodotti-do.php'>
                                                        <i class="fa fa-sync"></i>sincronizza
                                                    </button>
                                                    -->
                                                </td>
                                            </tr>

                                            <!--<tr>
                                            <td>
                                                GOOGLE SCHEDE GRATUITE <br>
                                                <em>Feed TXT per Feed Google schede gratuite - Link: https://www.moncaffe.it/ftp/feed-google-shopping-gratuito.txt</em>
                                            </td>
                                            <td><?php if (strlen($data_google_free) > 0) echo $data_google_free; else echo "N/D"; ?></td>
                                            <td class="text-center">
                                                <a class='btn btn-primary btn-sm' href='../funzioni/procedura-feed-google-gratuito-do.php' title='Aggiorna feed'><i class="fa fa-sync"></i>Sincronizza</a>
                                            </td>
                                        </tr>-->

                                            <tr>
                                                <td>
                                                    FACEBOOK SHOPPING <br>
                                                    <em>Feed CSV per catalogo Facebook Shopping - Link: https://www.moncaffe.it/ftp/feed-facebook-shopping.csv</em>
                                                </td>
                                                <td><?php if (strlen($data_facebook) > 0) echo $data_facebook; else echo "N/D"; ?></td>
                                                <td><?php if ($record_facebook > 0) echo $record_facebook; else echo "N/D"; ?></td>

                                                <td class="text-center">
                                                    <a class='btn btn-primary btn-sm' href='../funzioni/procedura-feed-facebook-do.php' title='Aggiorna feed'><i class="fa fa-sync"></i>Sincronizza</a>
                                                    <!--
                                                    <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/procedura-feed-prodotti-do.php'>
                                                        <i class="fa fa-sync"></i>sincronizza
                                                    </button>
                                                    -->
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    BING SHOPPING <br>
                                                    <em>Feed TXT per Bing Shopping - Link: https://www.moncaffe.it/ftp/feed-bing-shopping.txt</em>
                                                </td>
                                                <td><?php if (strlen($data_bing) > 0) echo $data_bing; else echo "N/D"; ?></td>
                                                <td><?php if ($record_bing > 0) echo $record_bing; else echo "N/D"; ?></td>

                                                <td class="text-center">
                                                    <a class='btn btn-primary btn-sm' href='../funzioni/procedura-feed-bing-do.php' title='Aggiorna feed'><i class="fa fa-sync"></i>Sincronizza</a>
                                                    <!--
                                                    <button class='btn btn-primary btn-sm alert-link' data-href='../funzioni/procedura-feed-prodotti-do.php'>
                                                        <i class="fa fa-sync"></i>sincronizza
                                                    </button>
                                                    -->
                                                </td>
                                            </tr>

                                            <!--
                                            <tr>
                                                <td>Importa lista clienti Prestashop</td>
                                                <td>N/D</td>
                                                <td class="text-center">
                                                    <a class='btn btn-primary btn-sm' href='../funzioni/import-utenti-add-do.php' title='Importa clienti'><i class="fa fa-sync"></i>Sincronizza</a>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Importa dettagli clienti Prestashop</td>
                                                <td>N/D</td>
                                                <td class="text-center">
                                                    <a class='btn btn-primary btn-sm' href='../funzioni/import-utenti-dettagli-add-do.php' title='Importa clienti'><i class="fa fa-sync"></i>Sincronizza</a>

                                                </td>
                                            </tr>
                                            -->
                                            </tbody>
                                        </table>

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