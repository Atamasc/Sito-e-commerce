<?php include "inc/autoloader.php"; ?>
<?php
$get_co_id = isset($_GET['co_id']) ? (int)$_GET['co_id'] : 0;

$querySql = "SELECT * FROM co_coupon WHERE co_id = '$get_co_id' ";
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
                            <h4 class="mb-0"> Modifica coupon</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="coupon-gst.php" class="default-color">Gestione coupon</a></li>
                                <li class="breadcrumb-item active">Modifica coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">
                                <?php
                                $querySql = "SELECT * FROM co_coupon WHERE co_id = $get_co_id";
                                $result = $dbConn->query($querySql);
                                $row_data = $result->fetch_assoc();
                                ?>

                                <form method="post" action="coupon-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica coupon</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Coupon modificato con successo.
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
                                            <label for="co_coupon">Coupon *</label>
                                            <input type="text" class="form-control" id="co_coupon" name="co_coupon" value="<?php echo $row_data['co_coupon']; ?>" required>
                                            <span class="tooltips">Codice Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Codice Coupon" data-content="Inserisci qui il codice del coupon che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="co_mr_codice">Marchio</label>
                                            <select class="form-control" id="co_mr_codice" name="co_mr_codice">
                                                <option value="">Seleziona un marchio</option>
                                                <option value="" disabled></option>
                                                <option value="">Valido su tutti i marchi</option>
                                                <?php selectCodiceMarchio($row_data['co_mr_codice']); ?>
                                            </select>
                                            <span class="tooltips">Marchio Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Marchio Coupon" data-content="Inserisci qui il marchio che ha rilasciato il coupon che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="co_tipo">Tipologia *</label>
                                            <select class="form-control" id="co_tipo" name="co_tipo" required>
                                                <option value="">Seleziona un tipo</option>
                                                <option value="" disabled></option>
                                                <option data-value="%" value="percentuale" <?php echo $row_data['co_tipo'] == "percentuale" ? "selected" : ""; ?>>Percentuale</option>
                                                <option data-value="&euro;" value="importo" <?php echo $row_data['co_tipo'] == "importo" ? "selected" : ""; ?>>Importo</option>
                                            </select>
                                            <span class="tooltips">Tipologia Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Tipologia Coupon" data-content="Inserisci qui la tipologia del coupon che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="co_valore">Valore *</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="co_valore" name="co_valore" value="<?php echo $row_data['co_valore']; ?>"
                                                       required aria-describedby="co_valore_add">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="co_valore_add">&euro;</span>
                                                </div>
                                            </div>
                                            <span class="tooltips">Valore Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Valore Coupon" data-content="Inserisci qui il valore del coupon che stai modificando">[aiuto]</a></span> <small class="form-text text-muted">Inserire solo valori numerici (Es: 25.50)</small>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="co_valore">Max Utilizzi *</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="co_utilizzi" name="co_utilizzi" value="<?php echo $row_data['co_utilizzi']; ?>" required aria-describedby="co_valore_add">
                                            </div>
                                            <span class="tooltips">Utilizzi Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Valore Coupon" data-content="Inserisci qui il numero di utilizzi massimo per utente per questo coupon">[aiuto]</a></span> <small class="form-text text-muted">Inserire solo valori numerici (Es: 10)</small>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="co_stato">Stato</label>
                                            <select class="form-control" id="co_stato" name="co_stato" required>
                                                <option value="">Seleziona uno stato</option>
                                                <option value=""></option>
                                                <option value="1" <?php if($row_data['co_stato'] == '1') echo "selected"; ?>>Attivo</option>
                                                <option value="0" <?php if($row_data['co_stato'] == '0') echo "selected"; ?>>Non attivo</option>
                                            </select>
                                            <span class="tooltips">Stato Coupon <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Stato Coupon" data-content="Inserisci qui il valore del coupon che stai modificando">[aiuto]</a></span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="co_spedizione" name="co_spedizione" <?php if($row_data['co_spedizione'] > 0) echo "checked"; ?>>
                                                <label class="custom-control-label" for="co_spedizione">Spedizione gratis</label>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="co_id" value="<?PHP ECHO $get_co_id; ?>">
                                    <button class="btn btn-primary" type="submit">Modifica</button>
                                    <a href="coupon-add.php" class="btn btn-success">Aggiungi coupon</a>

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
    $("#co_tipo").change(function (){
        let sym = $('#co_tipo option:selected').data('value');
        $('#co_valore_add').html(sym);

    });
</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>