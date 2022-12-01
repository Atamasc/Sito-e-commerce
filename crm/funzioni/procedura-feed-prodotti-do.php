<?php include "../inc/db-conn.php"; ?>
<?php include "../../bin/url-rewrite.php"; ?>
<?php include "../../bin/function.php"; ?>
<?php

unlink("../../ftp/trovaprezzi.txt");

/*
$data = array(
    'Nome |Marca |Descrizione | Prezzo Originale |Prezzo Vendita |Codice Interno|Link
    all offerta |Disponibilità |Albero Categorie |Link Immagine |Spese di Spedizione
    |Codice Produttore |Codice EAN |Peso |Ulteriore Link Immagine 1 | Ulteriore Link
    Immagine 2'
);*/

$feed_trovaprezzi = fopen("../../ftp/trovaprezzi.txt", "a");
fwrite($feed_trovaprezzi, "Nome | Marca | Descrizione | Prezzo Originale | Prezzo Vendita | Codice Interno | Link all offerta | Disponibilità | Albero Categorie | Link Immagine | Spese di Spedizione | Codice Produttore | Codice EAN | Peso | Ulteriore Link Immagine 1 | Ulteriore Link Immagine 2 <endrecord> \r\n ");

$querySql = "SELECT * FROM pr_prodotti INNER JOIN mr_marche ON mr_codice = pr_codice_marche WHERE pr_stato > 0 AND pr_esistenza > 0 AND mr_riservato = 0 ORDER BY pr_timestamp ";
$result = $dbConn->query($querySql);

while ($row_data = $result->fetch_array()) {

    $pr_id = $row_data['pr_id'];
    $get_pr_codice_marche = $row_data['pr_codice_marche'];
    $get_pr_codice = $row_data['pr_codice'];
    $get_pr_esistenza = $row_data['pr_esistenza'];
    $get_pr_fm_codice = $row_data['pr_fm_codice'];
    $get_pr_prezzo_scontato = $row_data['pr_prezzo_scontato'];

    $consegna = "3/5 giorni lavorativi";
    if ($get_pr_prezzo_scontato > '50') {
        $spedizione = "0";
    } else if ($get_pr_prezzo_scontato < '50') {
        $spedizione = "5";
    }
    $minsan = "000000000";
    $vuoto = "";
    $alberatura = generateBreadFamigliaFeed($get_pr_fm_codice);
    $rewrite_link = generateProductLink($pr_id);
    $URL = "https://www.pepinoshop.com" . $rewrite_link;
    $URL_immagine = "https://www.pepinoshop.com/ftp/immagini/" . $row_data['pr_immagine'];

    $feed_trovaprezzi = fopen("../../ftp/trovaprezzi.txt", "a");
    fwrite($feed_trovaprezzi, $row_data['pr_descrizione_breve'] . "|" . $row_data['pr_descrizione_marche'] . "|" . $row_data['pr_descrizione_estesa'] . "|" . $row_data['pr_prezzo'] . "|" . $row_data['pr_prezzo_scontato'] . "|" . $row_data['pr_codice'] . "|" . $URL . "
    |" . $row_data['pr_esistenza'] . "|" . $row_data['pr_descrizione_marche'] . ";" . $row_data['pr_descrizione_linea'] . ";" . $alberatura . "|" . $URL_immagine . "|" . $spedizione . "|" . $vuoto . "|" . $row_data['pr_codice_ean'] . "|" . $vuoto . "|" . $vuoto . "|" . $vuoto . "| <endrecord> \r\n");

    /*
    $data[] = $row_data['pr_codice_ean'].";".$row_data['pr_descrizione_marche'].";".$row_data['pr_descrizione_breve'].
        ";".$row_data['pr_prezzo']. ";".$consegna.";".$URL.";".$URL_immagine;
    */

}

$result->close();

header("Location: ../admin/strumenti-importazioni-gst.php?update=true");

?>