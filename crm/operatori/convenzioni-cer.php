<?php include "inc/autoloader.php"; ?>
<?php
$get_cv_id = isset($_GET['cv_id']) ? (int)$_GET['cv_id'] : 0;
$get_cr_id = isset($_GET['cr_id']) ? (int)$_GET['cr_id'] : 0;

$querySql = "SELECT cv_titolo FROM cv_convenzioni WHERE cv_id = '$get_cv_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$cv_titolo = $result->fetch_array()[0];
$result->close();

$querySql = "SELECT * FROM cr_convenzioni_cer INNER JOIN cc_codici_cer ON cc_id = cr_cc_id WHERE cr_id = '$get_cr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();
?>
    <!DOCTYPE html>
    <html lang="it">

    <head>

        <?php include "inc/head.php"; ?>

        <style>

            .lw-ac-list {

                display: none;
                z-index: 99999;
                position: absolute;
                top: 0;
                background-color: white;
                max-height: 200px;
                width: 100%;
                overflow-y: auto;

                -webkit-box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.1);
                -moz-box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.1);
                box-shadow: 1px 1px 15px rgba(0,0,0,0.1);


            }

            .lw-ac-list > p {

                padding: 15px 15px 15px 20px;

            }

            .lw-ac-list > p:hover {

                background-color: #f6f7f8;
                cursor: pointer;

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
                                <h4 class="mb-0"> Gestione codici CER per "<?php echo $cv_titolo; ?>"</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                    <li class="breadcrumb-item"><a href="convenzioni-gst.php" class="default-color">Gestione convenzioni</a></li>
                                    <li class="breadcrumb-item active">Gestione codici CER</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">

                                    <h5 class="card-title"><?php echo $get_cr_id > 0 ? "Modifica codice CER" : "Aggiungi codice CER"; ?></h5>

                                    <?php include "../inc/alerts.php"; ?>

                                    <form method="post" action="<?php echo $get_cr_id > 0 ? "convenzioni-cer-mod-do.php" : "convenzioni-cer-add-do.php"; ?>">
                                        <input type="hidden" name="cr_cv_id" value="<?php echo $get_cv_id; ?>">
                                        <input type="hidden" name="cr_id" value="<?php echo $get_cr_id; ?>">

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="lw-ac-input">Codice CER *</label>
                                                <div class="lw-ac-input">
                                                    <input type="text" class="form-control" id="lw-ac-input" name="lw-ac-input" required autocomplete="off"
                                                           value="<?php echo $row_data['cc_codice']." ".ucfirst($row_data['cc_descrizione']); ?>">
                                                    <input type="hidden" name="cr_cc_id" required value="<?php echo $row_data['cr_cc_id']; ?>">
                                                </div>

                                                <div style="position: relative;">

                                                    <div class="lw-ac-list">

                                                        <?php
                                                        pageCerLoad();
                                                        function pageCerLoad() {

                                                            global $dbConn;

                                                            $querySql = "SELECT cc_id, cc_codice, cc_descrizione FROM cc_codici_cer ";
                                                            $result = $dbConn->query($querySql);

                                                            while ($row_data = $result->fetch_assoc()) {

                                                                $cc_id = $row_data['cc_id'];
                                                                $cc_codice = $row_data['cc_codice'];
                                                                $cc_descrizione = ucfirst($row_data['cc_descrizione']);

                                                                echo "<p data-value='$cc_id'><b>$cc_codice</b> <br>$cc_descrizione</p>";

                                                            }

                                                            $result->close();

                                                        }
                                                        ?>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="cv_cannone">Prezzo per KG *</label>
                                                <input type="text" class="form-control pattern-price" id="cr_prezzo_kg" name="cr_prezzo_kg" aria-describedby="cr_prezzo_kg_help"
                                                       value="<?php echo strlen(@$row_data['cr_prezzo_kg']) > 0 ? formatPrice(@$row_data['cr_prezzo_kg']) : ""; ?>" required>
                                                <small id="cr_prezzo_kg_help" class="form-text text-muted">Inserisci 0 se vuoi rendere il prezzo gratuito.</small>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                <label for="cr_note">Note</label>
                                                <textarea class="form-control" id="cr_note" name="cr_note"
                                                          rows="5"><?php echo @$row_data['cr_note']; ?></textarea>
                                            </div>

                                        </div>

                                        <a href="convenzioni-gst.php?cv_id=<?php echo $get_cv_id; ?>" class="btn btn-orange mt-2">Torna alla convenzione</a>
                                        <?php echo $get_cr_id > 0
                                            ? "<button class='btn btn-success mt-2' type='submit'>Modifica</button>"
                                            : "<button class='btn btn-primary mt-2' type='submit'>Aggiungi</button>";
                                        ?>

                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">

                                    <h5 class="card-title border-0 pb-0">Lista codici CER collegati</h5>

                                    <div class="table-responsive">

                                        <table class="table table-1 table-bordered table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th>Codice</th>
                                                <th>Descrizione rifuto</th>
                                                <th>Prezzo per KG</th>
                                                <th style="text-align: center;">Stato</th>
                                                <th style="text-align: center; width: 200px;">Gestione</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            $querySql = "SELECT COUNT(cr_id) FROM cr_convenzioni_cer WHERE cr_cv_id = '$get_cv_id' ";
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
                                                "SELECT * FROM cr_convenzioni_cer INNER JOIN cc_codici_cer ON cc_id = cr_cc_id ".
                                                "WHERE cr_cv_id = '$get_cv_id' ORDER BY cc_codice LIMIT $primo, $per_page";
                                            $result = $dbConn->query($querySql);
                                            $rows = $dbConn->affected_rows;

                                            while (($row_data = $result->fetch_assoc()) !== NULL) {

                                                $cr_id = $row_data['cr_id'];

                                                echo "<tr>";
                                                echo "<td>".$row_data['cc_codice']."</td>";
                                                echo "<td>".$row_data['cc_descrizione']."</td>";
                                                echo $row_data['cr_prezzo_kg'] > 0 ? "<td>&euro; ".formatPrice($row_data['cr_prezzo_kg'])."</td>" : "<td>Gratuito</td>";

                                                //Stato
                                                $checked = $row_data['cr_stato'] > 0 ? "checked" : "";
                                                ?>
                                                <td class="text-center">
                                                    <div class="checkbox checbox-switch switch-success">
                                                        <label>
                                                            <input type="checkbox" class="stato"
                                                                   title="convenzioni-cer-stato-do.php?cr_id=<?php echo $cr_id; ?>" <?php echo $checked;?>><span></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <?php

                                                //Gestione
                                                echo "<td align='center'>";
                                                echo "<a class='btn btn-success btn-sm' href='convenzioni-cer.php?cr_id=$cr_id&cv_id=$get_cv_id' title='Modifica'>modifica</a>&nbsp;";
                                                echo "<button class='btn btn-danger btn-sm elimina' data-href='convenzioni-cer-del-do.php?cr_id=$cr_id&cv_id=$get_cv_id'>elimina</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                            }

                                            if ($rows == 0) echo "<tr><td colspan='99' align='center'>Non ci sono codici CER collegati</td></tr>";

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

                    <!--================================= wrapper -->

                    <!--================================= footer -->

                    <?php include "inc/footer.php"; ?>

                </div><!-- main content wrapper end-->
            </div>
        </div>
    </div>
    <!--=================================
    footer -->

    <?php include "inc/javascript.php"; ?>

    <script>

        $.expr[":"].contains_ci = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        $(".lw-ac-input input[type='text']").on('keypress change keyup',function () {

            let searchInputValue = $(this).val();

            if(searchInputValue.length > 0) {

                $('.lw-ac-list p').hide();
                $('.lw-ac-list').show().find('p:contains_ci(' + searchInputValue + ')').show();

            } else {

                $('.lw-ac-list').hide();

            }

        });

        $('.lw-ac-list p').click(function () {

            $(".lw-ac-input input[type='text']").val($(this).text());
            $(".lw-ac-input input[type='hidden']").val($(this).data('value'));

            $('.lw-ac-list').hide();

        })

    </script>

    </body>

    </html>
<?php include "../inc/db-close.php"; ?>