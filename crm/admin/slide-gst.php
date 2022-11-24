<?php include "inc/autoloader.php"; ?>
<?php
$get_sl_id = isset($_GET['sl_id']) ? (int)$_GET['sl_id'] : 0;
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>

            #input-ordinamento{
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
                margin-bottom: 0px!important;
                width: 100%;
                max-width: 100%;
            }

            #input-ordinamento input.form-control{
                height: 27px;
                width: 70%;
                padding: 0;
                margin-right: 10px;
                padding-left: 15px;
                border: 1px solid black;
            }
        </style>

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
                                <h4 class="mb-0"> Gestione slide </h4>
                            </div>

                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item active">Gestione slide</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- main body -->
                    <div class="row">

                        <div class="col-xl-12 mb-10">

                            <div class="card card-statistics">
                                <div class="card-body">
                                    <?php
                                    if ($get_sl_id > 0) include "inc/form-slide-mod.php";
                                    else include "inc/form-slide-add.php";
                                    ?>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista slide</h5>

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
                                                <th style="text-align: center; width: 150px;">Ordinamento</th>
                                                <th>Titolo</th>
                                                <th style="text-align: center;" width="100">Stato</th>
                                                <th style="text-align: center;" width="200">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(sl_id) FROM sl_slide WHERE sl_id > 0 ";
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

                                            $querySql = "SELECT * FROM sl_slide WHERE sl_id > 0 ";
                                            $querySql .= " ORDER BY sl_id LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $sl_id = $row_data['sl_id'];
                                                $sl_posizione = $row_data['sl_posizione'];

                                                echo "<tr>";
                                                echo "<td> 
                                              <form method='get' action='slide-ordinamento-do.php'>

                                                <div id='input-ordinamento' class='col-md-8 mb-3'>
                                                     <input type='number' name='sl_posizione' class='form-control'  value='$sl_posizione' pattern='[0-100]'>
                                                     <button class='btn btn-primary btn-sm' type='submit' title='Aggiorna'><i class='fa fa-upload'></i></button>

                                                </div>
                                                <input type='hidden' name='sl_id' value='$sl_id'>
                                                </form>
                                                 </td>";

                                                echo "<td>".$row_data['sl_titolo']."</td>";

                                                //Stato
                                                $checked = $row_data['sl_stato'] > 0 ? "checked" : "";
                                                ?>
                                                <td class="text-center">
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato" title="slide-stato-do.php?sl_id=<?php echo $sl_id; ?>" <?php echo $checked; ?>>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <?php

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='slide-gst.php?sl_id=$sl_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='slide-del-do.php?sl_id=$sl_id'><i class='fa fa-trash-alt'></i></button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }
                                            ?>

                                            <?php
                                            if ($rows == 0) {
                                                echo "<tr><td colspan='99' align='center'>Non ci sono slide</td></tr>";
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