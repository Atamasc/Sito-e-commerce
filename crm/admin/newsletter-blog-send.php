<?php include "inc/autoloader.php"; ?>

<?php
$time = time();
$get_nb_id = isset($_GET["nb_id"]) ? (int)$_GET["nb_id"] : 0;

$querySql = "SELECT * FROM nb_newsletter_blog WHERE nb_id = $get_nb_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();

$nb_id = $row_data["nb_id"];
$nb_tipo = $row_data["nb_tipo"];

if($nb_tipo == "ibrida") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/ibrido.php?nb_id=$get_nb_id";
else if($nb_tipo == "lista") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/lista-blog.php?nb_id=$get_nb_id";
else if($nb_tipo == "singola") $url = "$rootBasePath_http/crm/admin/inc/newsletter-blog/post-singolo.php?nb_id=$get_nb_id";
$newsletter = file_get_contents($url);
$newsletter = convertLink($newsletter, $rootBasePath_http, 0, "");

$result->close();

?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Invio campagna blog "<?php echo $nb_tipo; ?>"</h6>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body" id="modal-body">

    <div class="hante-prima" style="all: initial!important;">
        <?php echo $newsletter; ?>
    </div>

    <hr>

    <!--<p>Seleziona una lista:</p>-->

    <div class="row">

        <div class="col-md-6">

            <select class="form-control" id="ns_id" name="ns_id" required>
                <option value="">Seleziona una lista</option>
                <option value=""></option>
                <?php selectListeEmail("", $dbConn, 1) ?>
            </select>

        </div>

        <div class="col-md-6 text-right">
            <input type="hidden" name="nb_id" id="nb_id" value="<?php echo $get_nb_id; ?>">
            <button class="btn btn-success" onclick="sendBlogEmail();">Invia</button>
        </div>

    </div>

    <p class="text-danger" id="error"></p>

</div>

<div class="modal-footer">

    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>

</div>

<?php include('../inc/db-close.php'); ?>
