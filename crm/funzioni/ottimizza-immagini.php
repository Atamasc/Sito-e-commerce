<?php include('../inc/db-conn.php'); ?>
<?php include('../bin/function.php'); ?>
<?php include('../inc/config.php'); ?>
<?php include('../bin/core.php'); ?>
<?php
$querySql = "SELECT * FROM pr_prodotti WHERE pr_ottimizzato = 0 ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while ($row_data = $result->fetch_assoc()) {

    $pr_id = $row_data['pr_id'];

    if(strlen($row_data['pr_immagine']) == "") {

        echo "Impossibile ottimizzare il prodotto $pr_id. Motivo: immagine principale non associata.<br>";
        continue;

    }

    $upload_path = "../../upload/prodotti/PR-$pr_id";
    optimizeImageProdotto($row_data['pr_immagine'], $upload_path, "PR-$pr_id-1200x720.jpg", "1200x720");
    optimizeImageProdotto($row_data['pr_immagine'], $upload_path, "PR-$pr_id-300x180.jpg", "300x180");
    optimizeImageProdotto($row_data['pr_immagine'], $upload_path, "facebook.jpg", "1200x628");

    if(!file_exists("$upload_path/PR-$pr_id-1200x720.jpg")) {

        echo "Impossibile ottimizzare il prodotto $pr_id. Motivo: errore importazione immagine.<br>";
        continue;

    }

    $querySql_up = "UPDATE pr_prodotti SET pr_immagine = 'PR-$pr_id-1200x720.jpg', pr_path = '$upload_path', pr_ottimizzato = 1 WHERE pr_id = '$pr_id' ";
    $result_up = $dbConn->query($querySql_up);

    $querySql_pi = "SELECT * FROM pi_prodotti_immagini WHERE pi_pr_id = '$pr_id' ";
    $result_pi = $dbConn->query($querySql_pi);

    while ($row_data_pi = $result_pi->fetch_assoc()) {

        $pi_id = $row_data_pi['pi_id'];

        optimizeImageProdotto($row_data_pi['pi_immagine'], $upload_path, "PI-$pi_id-1200x720.jpg", "1200x720");

        if(!file_exists("$upload_path/PI-$pi_id-1200x720.jpg")) {

            echo "Impossibile ottimizzare il prodotto $pr_id. Motivo: errore importazione immagine.<br>";
            continue;

        }

        $querySql_up = "UPDATE pi_prodotti_immagini SET pi_immagine = 'PI-$pi_id-1200x720.jpg', pi_path = '$upload_path' WHERE pi_id = '$pi_id' ";
        $result_up = $dbConn->query($querySql_up);

    }

    $result_pi->close();

}

$result->close();
?>
<?php include "../inc/db-close.php"; ?>