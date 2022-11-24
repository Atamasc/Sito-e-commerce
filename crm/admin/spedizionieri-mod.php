<?php include "inc/autoloader.php"; ?>
<?php
$get_ci_id = isset($_GET['ci_id']) ? (int)$_GET['ci_id'] : 0;

$querySql = "SELECT * FROM ci_corrieri WHERE ci_id = '$get_ci_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
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
                            <h4 class="mb-0"> Aggiungi spedizionieri</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="spedizionieri-gst.php" class="default-color">Gestione spedizionieri</a></li>
                                <li class="breadcrumb-item active">Modifica spedizionieri</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">

                                <form method="post" action="spedizionieri-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica spedizioniere</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Spedizioniere modificato con successo.
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

                                        <div class="col-md-2 mb-3">
                                            <label for="ci_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="ci_titolo" name="ci_titolo" value="<?php echo $row_data['ci_titolo']; ?>" required>
                                            <span class="tooltips">Titolo Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Spedizioniere" data-content="Inserisci qui il titolo dello spedizioniere che stai aggiungendo">[aiuto]</a></span>
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <label for="ci_costo_standard">Costo spedizione standard </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ci_costo_standard" name="ci_costo_standard" value="<?php echo formatPrice($row_data['ci_costo_standard']); ?>"
                                                        aria-describedby="ci_costo_standard_add">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="ci_costo_standard_add">&euro;</span>
                                                </div>
                                            </div>
                                            <span class="tooltips">Spedizione Standard Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Standard Spedizioniere" data-content="Inserisci qui il costo della spedizione standard">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="ci_costo_espressa">Costo spedizione espressa </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ci_costo_espressa" name="ci_costo_espressa" value="<?php echo formatPrice($row_data['ci_costo_espressa']); ?>"
                                                        aria-describedby="ci_costo_espressa_add">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="ci_costo_espressa_add">&euro;</span>
                                                </div>
                                            </div>
                                            <span class="tooltips">Spedizione Espressa Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Espressa Spedizioniere" data-content="Inserisci qui il costo della spedizione espressa">[aiuto]</a></span>
                                        </div>

                                    </div>
                                    
                                    <div class="form-row">
                                        
                                        <div class="col-md-2 mb-3">
                                            <label for="ci_costo_estera">Costo spedizione estera </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ci_costo_estera" name="ci_costo_estera" value="<?php echo formatPrice($row_data['ci_costo_estera']); ?>"
                                                       aria-describedby="ci_costo_estera_add">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="ci_costo_estera_add">&euro;</span>
                                                </div>
                                            </div>
                                            <span class="tooltips">Spedizione Estera Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Spedizione Estera Spedizioniere" data-content="Inserisci qui il costo della spedizione estera">[aiuto]</a></span>
                                        </div>


                                        <div class="col-md-2 mb-3">
                                            <label for="ci_ordine_minimo">Prezzo ordine minimo </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="ci_ordine_minimo" name="ci_ordine_minimo" value="<?php echo formatPrice($row_data['ci_ordine_minimo']); ?>"
                                                       aria-describedby="ci_ordine_minimo_add">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="ci_ordine_minimo_add">&euro;</span>
                                                </div>
                                            </div>
                                            <span class="tooltips">Ordine Minimo Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Ordine Minimo Spedizioniere" data-content="Inserisci qui il costo dell'ordine minimo oltre il quale la spedizione &egrave; gratuita">[aiuto]</a></span>
                                        </div>
                                        
                                    </div>


                                    <div class="form-row">

                                        <div class="col-md-2 mb-3">
                                            <label for="ci_tempi_standard">Tempi di consegna standard</label>
                                            <input type="text" class="form-control" id="ci_tempi_standard" name="ci_tempi_standard" value="<?php echo $row_data['ci_tempi_standard']; ?>">
                                            <span class="tooltips">Consegna Standard Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Consegna Standard Spedizioniere" data-content="Inserisci qui i tempi di consegna standard">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="ci_tempi_espressa">Tempi di consegna espressa</label>
                                            <input type="text" class="form-control" id="ci_tempi_espressa" name="ci_tempi_espressa" value="<?php echo $row_data['ci_tempi_espressa']; ?>">
                                            <span class="tooltips">Consegna Espressa Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Consegna Espressa Spedizioniere" data-content="Inserisci qui i tempi di consegna espressa">[aiuto]</a></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                    <div class="col-md-4 mb-3">
                                        <label for="ci_descrizione">Descrizione</label>
                                        <textarea class="form-control" id="ci_descrizione" name="ci_descrizione" rows="5"><?php echo $row_data['ci_descrizione']; ?></textarea>
                                        <span class="tooltips">Descrizione Spedizioniere <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Descrizione Spedizioniere" data-content="Inserisci qui la descrizione dello spedizioniere che stai aggiungendo">[aiuto]</a></span>
                                    </div>

                                    </div>

                                    <div class="form-row">

                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input"  type="checkbox" id="ci_spedizione_estera" name="ci_spedizione_estera" <?php if ($row_data['ci_spedizione_estera']>0) echo "checked"; ?>>
                                        <label class="custom-control-label" for="ci_spedizione_estera" style="margin-bottom: 30px;">Spedizione estera</label>
                                    </div>

                                    </div>

                                    <input type="hidden" name="ci_id" value="<?PHP ECHO $get_ci_id; ?>">
                                    <button class="btn btn-primary" type="submit">Modifica</button>

                                </form>

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
    $("#ci_tipo").change(function (){
        let sym = $('#ci_tipo option:selected').data('value');
        $('#ci_valore_add').html(sym);

    });
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>