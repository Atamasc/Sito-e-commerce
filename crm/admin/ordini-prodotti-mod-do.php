<?php include "inc/autoloader.php"; ?>
<?php

foreach ($_POST['or_pr_quantita'] as $or_id => $or_pr_quantita) {

    $or_id = (int)$or_id;
    $or_pr_quantita = (int)$or_pr_quantita;
    $or_pr_prezzo = $dbConn->real_escape_string(stripslashes(trim($_POST['or_pr_prezzo'][$or_id])));
    $or_pr_prezzo = formatPriceForDB($or_pr_prezzo);

    $querySql = "SELECT or_pr_quantita, or_pr_codice FROM or_ordini WHERE or_id = '$or_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    $row = $result->fetch_row();
    $quantita_vecchia = $row[0];
    $or_pr_codice = $row[1];


    if($quantita_vecchia < $or_pr_quantita){

        $quantita = $or_pr_quantita - $quantita_vecchia;
        $querySql_up = "UPDATE pr_prodotti SET pr_giacenza = pr_giacenza - '$quantita' WHERE pr_codice = '$or_pr_codice' ";

    }else{

        $quantita = $quantita_vecchia - $or_pr_quantita;
        $querySql_up = "UPDATE pr_prodotti SET pr_giacenza = pr_giacenza + '$quantita' WHERE pr_codice = '$or_pr_codice' ";

    }
    $result_up = $dbConn->query($querySql_up);


    $querySql =
        "UPDATE or_ordini SET or_pr_quantita = '$or_pr_quantita', or_pr_prezzo = '$or_pr_prezzo' WHERE or_id = '$or_id' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

echo "<script>window.history.back();</script>"
?>