<?php include "inc/autoloader.php"; ?>

<?php
header('Content-Type: text/html; charset=ISO-8859-1');

$time = time();
$get_nl_id = isset($_GET["nl_id"]) ? (int)$_GET["nl_id"] : 0;

$querySql_nl = "SELECT * FROM nl_newsletter WHERE nl_id = $get_nl_id ";
$result_nl = $dbConn->query($querySql_nl);
$row_data_nl = $result_nl->fetch_assoc();

$nl_id = $row_data_nl["nl_id"];
$nl_ns_id = $row_data_nl["nl_ns_id"];
$nl_titolo = $row_data_nl["nl_titolo"];

$nl_testo = $row_data_nl["nl_testo"];
$nl_testo = str_replace("\r\n", "<br>", $nl_testo);

$nl_immagine = $row_data_nl["nl_immagine"];
$nl_allegato = $row_data_nl["nl_allegato"];
$nl_allegato_2 = $row_data_nl["nl_allegato_2"];
$nl_link = $row_data_nl["nl_link"];

$querySql_count = "SELECT COUNT(ne_id) AS count_email FROM ne_newsletter_email WHERE ne_ns_id = '$nl_ns_id' AND ne_id > 0";
$result_count = $dbConn->query($querySql_count);
$rows_count = $dbConn->affected_rows;
$row_data_count = $result_count->fetch_assoc();
$count_email = $row_data_count['count_email'];
$result_count->close();

$corpo_newsletter = "<p>$nl_testo</p>";

if (strlen($nl_immagine) > 0) {
    if (strlen($nl_link) > 0) {
        $corpo_newsletter .= "<p><a href='$nl_link' target='_blank'><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='600' /></a></p>";
    } else {
        $corpo_newsletter .= "<p><img src='$rootBasePath_http/upload/newsletter/$nl_immagine' border='0' width='600' /></p>";
    };
};

$result_nl->close();

include "inc/mail/default.php";
?>

<div class="modal-header">
    <div class="modal-title"><div class="mb-30">
            <h6>Titolo newsletter: <?php echo $nl_titolo; ?></h6>
            <h2>ANTEPRIMA NEWSLETTER</h2>
        </div>
    </div>
    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
        <span aria-hidden="true">X</span>
    </button>
</div>

<div class="modal-body">

    <div class="hante-prima" style="all: initial!important;">
        <?php echo $body_mail; ?>
    </div>

</div>

<div class="modal-footer">
    <button class="btn btn-secondary" type="button" data-dismiss="modal">Chiudi</button>
</div>

<?php include('../inc/db-close.php'); ?>

<style>

    div.hante-prima{
        all: initial!important;
    }

</style>
