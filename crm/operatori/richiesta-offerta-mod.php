<?php include "inc/autoloader.php"; ?>
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

        <script src="../ajax/regioni.js"></script>

    </head>

    <?php
    $get_ro_id = isset($_GET['ro_id']) ? (int)$_GET['ro_id'] : 0;

    $querySql =
        "SELECT * FROM ro_richiesta_offerta INNER JOIN le_lead ON le_id = ro_le_id WHERE ro_id = '$get_ro_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row_data = $result->fetch_assoc();
    $result->close();

    $get_le_id = $row_data['le_id'];
    ?>

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
                                <h4 class="mb-0"> Modifica richiesta di offerta</h4>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                    <li class="breadcrumb-item"><a href="richiesta-offerta-gst.php" class="default-color">Gestione richieste</a></li>
                                    <li class="breadcrumb-item active">Modifica richiesta di offerta</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-12 mb-30">

                            <div class="card card-statistics mb-30">
                                <div class="card-body">
                                    <form method="post" action="richiesta-offerta-mod-do.php">

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

                                        <h5 class="card-title">Lead</h5>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="le_ragione_sociale">Ragione sociale</label>
                                                <input type="text" class="form-control" id="le_ragione_sociale"
                                                       value="<?php echo $row_data['le_ragione_sociale']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_email">Partita Iva</label>
                                                <input type="text" class="form-control" id="le_partita_iva" name="le_partita_iva"
                                                       value="<?php echo $row_data['le_partita_iva']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_email">Codice Fiscale</label>
                                                <input type="text" class="form-control" id="le_cod_fiscale" name="le_cod_fiscale"
                                                       value="<?php echo $row_data['le_cod_fiscale']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_ragione_sociale">Email</label>
                                                <input type="email" class="form-control" id="le_email" name="le_email"
                                                       value="<?php echo $row_data['le_email']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                <label for="le_email">Telefono</label>
                                                <input type="text" class="form-control" id="le_telefono" name="le_telefono"
                                                       value="<?php echo $row_data['le_telefono']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_email">Cellulare</label>
                                                <input type="text" class="form-control" id="le_cellulare" name="le_cellulare"
                                                       value="<?php echo $row_data['le_cellulare']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_ragione_sociale">Referente</label>
                                                <input type="text" class="form-control" id="le_ref_rifiuti" name="le_ref_rifiuti"
                                                       value="<?php echo $row_data['le_ref_rifiuti']; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="le_settore">Settore</label>
                                                <input type="text" class="form-control" id="le_settore" name="le_settore"
                                                       value="<?php echo $row_data['le_settore']; ?>" readonly>
                                            </div>
                                        </div>

                                        <h5 class="card-title mt-30">Dati richiesta</h5>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="ro_id">Codice</label>
                                                <input type="text" class="form-control" id="ro_id"
                                                       value="RO-<?php echo $get_ro_id; ?>" readonly>
                                            </div>

                                            <div class="col-md-3 mb-30">
                                                <label for="ro_stato">Stato</label>
                                                <select class="form-control" name="ro_stato" id="ro_stato" required>
                                                    <option value="">Seleziona uno stato</option>
                                                    <option value=""></option>
                                                    <option value="In attesa" <?php echo $row_data['ro_stato'] == "In attesa" ? "selected" : "" ; ?>>In attesa</option>
                                                    <option value="In consulenza" <?php echo $row_data['ro_stato'] == "In consulenza" ? "selected" : "" ; ?>>In consulenza</option>
                                                    <option value="In omologa" <?php echo $row_data['ro_stato'] == "In omologa" ? "selected" : "" ; ?>>In omologa</option>
                                                    <option value="Rifiutata" <?php echo $row_data['ro_stato'] == "Rifiutata" ? "selected" : "" ; ?>>Rifiutata</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <label>Note di stato</label>
                                                <textarea class="form-control" id="ro_note" name="ro_note" placeholder="Note di stato" rows="5"><?php echo $row_data['ro_note']; ?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Descrizione rifiuto</label>
                                                <textarea class="form-control" id="ro_descrizione" name="ro_descrizione" placeholder="Note cliente" rows="5"><?php echo $row_data['ro_descrizione']; ?></textarea>
                                            </div>

                                        </div>


                                        <input type="hidden" name="ro_id" value="<?php echo $get_ro_id; ?>">
                                        <button class="btn btn-primary mt-2" type="submit">Modifica</button>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>

                    <?php //include "inc/datalist-richiesta-offerta.php"; ?>

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