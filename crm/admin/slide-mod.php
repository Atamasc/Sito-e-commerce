<?php include "inc/autoloader.php"; ?>
<?php
$get_sl_id = isset($_GET['sl_id']) ? (int)$_GET['sl_id'] : 0;

$querySql = "SELECT * FROM sl_slide WHERE sl_id = '$get_sl_id' ";
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
                            <h4 class="mb-0"> Modifica slide</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="slide-gst.php" class="default-color">Gestione slide</a></li>
                                <li class="breadcrumb-item active">Modifica slide</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics">
                            <div class="card-body">
                                <?php
                                $querySql = "SELECT * FROM sl_slide WHERE sl_id = $get_sl_id";
                                $result = $dbConn->query($querySql);
                                $row_data = $result->fetch_assoc();

                                $sl_immagine = $row_data['sl_immagine'];
                                $sl_immagine_mobile = $row_data['sl_immagine_mobile'];
                                $sl_immagine_path = "$upload_path_dir_slide/$sl_immagine";
                                $sl_immagine_mobile_path = "$upload_path_dir_slide/$sl_immagine_mobile";
                                ?>

                                <form method="post" action="slide-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica slide</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Slide modificata con successo.
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

                                        <div class="col-md-3 mb-3">
                                            <label for="sl_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="sl_titolo" name="sl_titolo"
                                                   value="<?php echo $row_data['sl_titolo']; ?>" required>
                                            <span class="tooltips">Titolo Slide <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Titolo Slide" data-content="Inserisci qui il titolo della slide che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>Immagine</label>
                                            <div class="custom-file">
                                                <input type="file" name="sl_immagine" id="sl_immagine" class="custom-file-input" data-width="1200" data-height="530">

                                                <?php if(strlen($sl_immagine) > 0) { ?>
                                                    <label class="custom-file-label"><?php echo $sl_immagine; ?></label>
                                                    <a href="<?php echo "$sl_immagine_path"; ?>" target="_blank">vedi immagine</a>
                                                <?php } else { ?>
                                                    <label class="custom-file-label">Scegli un file</label>
                                                <?php } ?>
                                            </div>
                                            <p class="tooltips">Dimensioni obbligatorie: 1200 x 538 px, peso max: 2mb, formato file: jpg, png. <br>Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare <a class="popup-a" href="https://www.iloveimg.com/it/ritagliare-immagine" target="_blank">questo tool*</a></p>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label>Immagine mobile</label>
                                            <div class="custom-file">
                                                <input type="file" name="sl_immagine_mobile" id="sl_immagine_mobile" class="custom-file-input" data-width="375" data-height="300">

                                                <?php if(strlen($sl_immagine_mobile) > 0) { ?>
                                                    <label class="custom-file-label"><?php echo $sl_immagine_mobile; ?></label>
                                                    <a href="<?php echo "$sl_immagine_mobile_path"; ?>" target="_blank">vedi immagine</a>&nbsp;|&nbsp;
                                                <?php } else { ?>
                                                    <label class="custom-file-label">Scegli un file</label>
                                                <?php } ?>
                                            </div>
                                            <p class="tooltips">Dimensioni obbligatorie: 375 x 300 px, peso max: 2mb, formato file: jpg, png. <br>Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare <a class="popup-a" href="https://www.iloveimg.com/it/ritagliare-immagine" target="_blank">questo tool*</a></p>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="sl_link">Link</label>
                                            <textarea class="form-control" id="sl_link" name="sl_link" rows="3"><?php echo @$row_data['sl_link']; ?></textarea>
                                            <span class="tooltips">Link Slide <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Link Slide" data-content="Inserisci qui il link della slide che stai modificando">[aiuto]</a></span>
                                        </div>

                                        <div class="col-md-2 mb-3">
                                            <label for="sl_stato">Visibilità</label>
                                            <select class="form-control" id="sl_stato" name="sl_stato" required>
                                                <option value="">Seleziona uno stato</option>
                                                <option value=""></option>
                                                <option value="1" <?php if($row_data['sl_stato'] == '1') echo "selected"; ?>>Attivo</option>
                                                <option value="0" <?php if($row_data['sl_stato'] == '0') echo "selected"; ?>>Non attivo</option>
                                            </select>
                                            <span class="tooltips">Visibilit&agrave; Slide <a class="popup-a" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="Visibilit&agrave; Slide" data-content="Inserisci qui lo stato di visibilit&agrave; della slide che stai aggiungendo">[aiuto]</a></span>
                                        </div>
                                    </div>

                                    <input type="hidden" name="sl_id" value="<?PHP ECHO $get_sl_id; ?>">
                                    <button class="btn btn-primary" type="submit">Modifica</button>
                                    <a href="slide-add.php" class="btn btn-success">Aggiungi slide</a>

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

</body>

</html>
<?php include "../inc/db-close.php"; ?>