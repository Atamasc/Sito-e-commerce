<?php include "inc/autoloader.php"; ?>
<!DOCTYPE html>
<html lang="it">

<head>

    <?php include "inc/head.php"; ?>

</head>

<body>
<link href="../slim-select/slimselect.css" rel="stylesheet" />


<?php
$get_bl_id = (int)$_GET['bl_id'];

$querySql = "SELECT * FROM bl_blog WHERE bl_id = $get_bl_id";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();
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
                            <h4 class="mb-0"> Gestione blog </h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                                <li class="breadcrumb-item"><a href="dashboard.php" class="default-color">Home</a></li>
                                <li class="breadcrumb-item"><a href="blog-gst.php" class="default-color">Gestione blog</a></li>
                                <li class="breadcrumb-item active">Modifica post</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- main body -->
                <div class="row">

                    <div class="col-xl-12 mb-30">

                        <div class="card card-statistics mb-30">
                            <div class="card-body">

                                <form method="post" action="blog-mod-do.php" enctype="multipart/form-data">

                                    <h5 class="card-title">Modifica post blog</h5>

                                    <?php
                                    if(@$_GET['update'] == 'true') {

                                        ?>
                                        <div class="alert alert-success" role="alert">
                                            Post modificato con successo.
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
                                            <label for="bl_titolo">Titolo *</label>
                                            <input type="text" class="form-control" id="bl_titolo" name="bl_titolo" placeholder="Titolo *"
                                                   required value="<?php echo $row_data['bl_titolo']; ?>">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="bl_bc_id">Categoria *</label>
                                            <select id="bl_bc_id" name="bl_bc_id" class="form-control" required>
                                                <option value="">Seleziona una categoria</option>
                                                <option></option>
                                                <?php selectBlogCategorie($row_data['bl_bc_id'], $dbConn); ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-8 mb-3">

                                            <label for="bl_abstract">Abstract *</label>
                                            <textarea class="form-control" name="bl_abstract" id="bl_abstract" rows="10" required><?php echo $row_data['bl_abstract']; ?></textarea>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-8 mb-3">

                                            <label for="summernote">Testo post *</label>
                                            <textarea name="bl_descrizione" id="summernote" required><?php echo $row_data['bl_descrizione']; ?></textarea>
                                            <p>Puoi inserire un immagine nel testo copiandola e incollandola</p>

                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3 input-tag">
                                            <label for="select">Tag</label>
                                            <select id="select" name="bl_tag[]" multiple>
                                                <?php selectTag($get_bl_id); ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="col-md-4 mb-3">
                                            <p>Immagine</p>

                                            <div class="custom-file">

                                                <input type="file" class="custom-file-input" id="bl_immagine" name="bl_immagine">
                                                <?php if (strlen($row_data['bl_immagine']) > 0) { ?>
                                                    <label class="custom-file-label" for="bl_immagine"><?php echo $row_data['bl_immagine']; ?></label><br>
                                                    <a class="modale-img" href="<?php echo "$upload_path_dir_blog/".$row_data['bl_immagine']; ?>" target="_blank">vedi immagine</a>&nbsp;|&nbsp;
                                                    <a class="elimina" href="javascript:;" data-href='blog-immagine-del-do.php?bl_id=<?php echo $get_bl_id; ?>'>elimina</a>
                                                <?php } else {
                                                    ?><label class="custom-file-label" for="bl_immagine">Seleziona immagine</label><?php
                                                } ?>
                                                <p style="margin-top: 10px;">Dimensioni consigliate: 1200 x 628*<br> Peso max: 2 MB*<br> Formato file: jpg, jpeg, gif, png<br> Per ritagliare la tua immagine nelle dimensioni adatte puoi utilizzare<a href="https://www.iloveimg.com/it/ritagliare-immagine" target="_blank" style="color: #28a745; text-decoration: underline;"> questo tool*</a></p>
                                            </div>

                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <p>Allegato</p>

                                            <div class="custom-file">

                                                <input type="file" class="custom-file-input" id="bl_allegato" name="bl_allegato">
                                                <?php if (strlen($row_data['bl_allegato']) > 0) { ?>
                                                    <label class="custom-file-label" for="bl_allegato"><?php echo $row_data['bl_allegato']; ?></label><br>
                                                    <a href="<?php echo "$upload_path_dir_blog/".$row_data['bl_allegato']; ?>" target="_blank">vedi allegato</a>&nbsp;|&nbsp;
                                                    <a class="elimina" href="javascript:;" data-href='blog-allegato-del-do.php?bl_id=<?php echo $get_bl_id; ?>'>elimina</a>
                                                <?php } else {
                                                    ?><label class="custom-file-label" for="bl_allegato">Seleziona allegato</label><?php
                                                } ?>
                                                <p style="margin-top: 20px;">Peso max: 2 MB*<br>Formato file: zip, pdf, doc, docx, xls, xlsx, xml, txt, csv</p>
                                            </div>

                                        </div>

                                        <div class="col-md-4 mb-3"> &nbsp; </div>

                                    </div>

                                    <input type="hidden" name="bl_id" value="<?php echo $get_bl_id; ?>">
                                    <button class="btn btn-success" type="submit">Modifica</button>

                                </form>

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

<script src="../slim-select/slimselect.js"></script>

<script>

    $(function () {

        new SlimSelect({
            select: '#select'
        });

        $('div.ss-multi-selected').addClass('form-control');

    });

</script>

</body>

</html>
<?php include "../inc/db-close.php"; ?>