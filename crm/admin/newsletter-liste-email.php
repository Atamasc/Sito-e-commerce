<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>

<?php
$get_ns_id = isset($_GET['ns_id']) ? (int)$_GET['ns_id'] : 0;
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
                            <h4 class="mb-0"> Gestione newsletter </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="newsletter-gst.php" class="default-color">Gestione newsletter</a></li>
                                <li class="breadcrumb-item"><a href="newsletter-liste-gst.php?ns_id=<?php echo $get_ns_id; ?>" class="default-color">Gestione liste</a></li>
                                <li class="breadcrumb-item active">Gestione email</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-10">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="newsletter-liste-email-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica lista email</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Modifica avvenuta con successo.
                                        </div>
                                        <?php

                                    } else if(@$_GET['update'] == 'false') {

                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            Si è verificato un errore, riprova.
                                        </div>
                                        <?php

                                    }
                                    ?>

                                    <div class="form-row">

                                        <?php
                                        $querySql = "SELECT ne_email FROM ne_newsletter_email WHERE ne_ns_id = $get_ns_id AND ne_stato = 1 ";
                                        $result = $dbConn->query($querySql);

                                        $ne_email_list = '';
                                        $i = 0;
                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $ne_email = $row_data["ne_email"];
                                            $ne_email_list .= $ne_email."; \r\n";
                                            $i += 1;

                                        };

                                        $count_email = $i;

                                        $result->close();
                                        ?>

                                        <div class="col-md-6 mb-3">
                                            <label for="ne_lista_email">Lista email attive (<?php echo $count_email; ?> email)</label>
                                            <textarea class="form-control" id="ne_lista_email" name="ne_lista_email" placeholder="Inserisci qui le email attive"
                                                      rows="10"><?php echo $ne_email_list; ?></textarea>
                                            <small>Separa le email da un ";"</small>
                                        </div>

                                        <?php
                                        $querySql = "SELECT ne_email FROM ne_newsletter_email WHERE ne_ns_id = $get_ns_id AND ne_stato = 0 ";
                                        $result = $dbConn->query($querySql);

                                        $ne_email_list = '';
                                        $i = 0;
                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $ne_email = $row_data["ne_email"];
                                            $ne_email_list .= $ne_email."; \r\n";
                                            $i += 1;

                                        };

                                        $count_email = $i;

                                        $result->close();
                                        ?>

                                        <div class="col-md-6 mb-3">
                                            <label for="ne_lista_email_off">Lista email non attive (<?php echo $count_email; ?> email)</label>
                                            <textarea class="form-control" id="ne_lista_email_off" name="ne_lista_email_off" placeholder="Inserisci qui le email non attive"
                                                      rows="10"><?php echo $ne_email_list; ?></textarea>
                                            <small>Separa le email da un ";"</small>
                                        </div>

                                        <div class="col-sm-12 mb-3"><b>Attenzione!</b> Se una email è presente in entrambe le liste verrà settata come non attiva</div>

                                    </div>

                                    <input type="hidden" name="ne_ns_id" value="<?php echo $get_ns_id; ?>">
                                    <button class="btn btn-success" type="submit">Modifica</button>
                                    <a class="btn btn-orange" href="newsletter-liste-email-clienti-do.php?ne_ns_id=<?php echo $get_ns_id; ?>">Importa clienti</a>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <h5 class="card-title border-0 pb-0">Elenco email lista</h5>

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
                                            <th>Email</th>
                                            <th style="width: 100px; text-align: center;">Stato</th>
                                            <th style="text-align: center;" width="100">Gestione</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
                                        $querySql = "SELECT COUNT(ne_id) FROM ne_newsletter_email WHERE ne_id > 0 AND ne_ns_id = '$get_ns_id' ";
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

                                        $querySql = "SELECT * FROM ne_newsletter_email WHERE ne_id > 0 AND ne_ns_id = '$get_ns_id' ORDER BY ne_email LIMIT $primo, $per_page";
                                        $result = $dbConn->query($querySql);
                                        $rows = $dbConn->affected_rows;

                                        while (($row_data = $result->fetch_assoc()) !== NULL) {

                                            $ne_id = $row_data["ne_id"];
                                            $ne_email = $row_data["ne_email"];

                                            $count_email = countEmailLista($ne_id, $dbConn);

                                            echo "<tr>";
                                            echo "<td>$ne_email</td>";
                                            echo $row_data["ne_stato"] ? "<td class='text-center'><span class='badge badge-success'>Attivo</span></td>" : "<td class='text-center'><span class='badge badge-danger'>Non attivo</span></td>";

                                            //Gestione
                                            echo "<td align='center'>";
                                            echo "<button class='btn btn-danger btn-sm elimina' data-href='newsletter-liste-email-del-do.php?ne_ns_id=$get_ns_id&ne_id=$ne_id'><i class='fa fa-trash-alt'></i></button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $i += 1;
                                        };

                                        if ($rows == 0) {
                                            echo "<tr><td colspan='99' align='center'>Non ci sono email presenti</td></tr>";
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