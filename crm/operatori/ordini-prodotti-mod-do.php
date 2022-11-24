<?php include "inc/autoloader.php"; ?>
<?php

foreach ($_POST['or_pr_quantita'] as $or_id => $or_pr_quantita) {

    $or_id = (int)$or_id;
    $or_pr_quantita = (int)$or_pr_quantita;
    $or_pr_prezzo = $dbConn->real_escape_string(stripslashes(trim($_POST['or_pr_prezzo'][$or_id])));
    $or_pr_prezzo = formatPriceForDB($or_pr_prezzo);

    $querySql =
        "UPDATE or_ordini SET or_pr_quantita = '$or_pr_quantita', or_pr_prezzo = '$or_pr_prezzo' WHERE or_id = '$or_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

echo "<script>window.history.back();</script>"
?>