<?php include "inc/autoloader.php"; ?>
<?php
$pr_id = (int)$_GET['pr_id'];
$timestamp = time();

$querySql =
    "INSERT INTO pr_prodotti( " .
    "pr_ct_id, pr_mr_id, pr_capofila, pr_codice, pr_titolo, pr_abstract, pr_descrizione, pr_prezzo, pr_prezzo_scontato, pr_sconto, pr_peso, pr_giacenza, pr_immagine, pr_allegato, pr_note, pr_timestamp, pr_stato " .
    ") SELECT " .
    "pr_ct_id, pr_mr_id, pr_id, '$timestamp', pr_titolo, pr_abstract, pr_descrizione, pr_prezzo, pr_prezzo_scontato, pr_sconto, pr_peso, pr_giacenza, '', '', pr_note, UNIX_TIMESTAMP(), 0 " .
    "FROM pr_prodotti WHERE pr_id = '$pr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$last_id = $dbConn->insert_id;

$codice_variante = $pr_id . "-" . $last_id;

$querySql =
    "UPDATE pr_prodotti SET " .
    "pr_codice = '$codice_variante' " .
    "WHERE pr_id = '$last_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if ($rows > 0) header("Location: prodotti-mod.php?pr_id=$last_id&copy=true");
else header("Location: prodotti-mod.php?pr_id=$pr_id&insert=false");
?>