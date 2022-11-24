<?php include "inc/autoloader.php"; ?>
<?php
    $list = array (
        array(
            'NOMINATIVO',
            'INDIRIZZO',
            'CAP',
            'EMAIL', //campo statico
            'CELL', //campo statico settato su 0
            'PAGAMENTO',
            'ORDINE',
            'MARCHIO',
            'CATEGORIA',
            'SOTTOCATEGORIA',
            'SISTEMA',
            'CODICE ARTICOLO',
            'PRODOTTO',
            'QTA'
        ),
    
    );
    
    
    
    $querySql = "SELECT *, CONCAT(cl_cognome, ' ', cl_nome) AS cl_nominativo FROM or_ordini
                 INNER JOIN cl_clienti ON cl_codice = or_cl_codice
                 INNER JOIN pr_prodotti ON or_pr_codice = pr_codice
                 WHERE or_stato_export > 0
                 ORDER BY or_codice";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    
    while (($row_data = $result->fetch_assoc()) !== NULL) {
    
        $list[] = array(
            $row_data['cl_nominativo'],
            $row_data['cl_indirizzo'].', '.$row_data['cl_comune'].' ('.$row_data['cl_provincia'].')',
            $row_data['cl_cap'],
            'info@moncaffe.it', //email statica
            '0', //CELL statica impostata su 0
            $row_data['or_pagamento'],
            $row_data['or_codice'],
            getMarchio($row_data['pr_mr_id']),
            getCategoria($row_data['pr_ct_id'],$dbConn),
            getSottocategoria($row_data['pr_st_id'],$dbConn),
            getSistema($row_data['pr_si_id']),
            $row_data['pr_codice'],
            $row_data['pr_titolo'],
            $row_data['or_pr_quantita']
    
        );
        //$list[] = $result->fetch_assoc();
    
    }
    
    $result->close();
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export_casa_cialde_'.date("d_m_y_h_i").'.csv"');
    
    
    $fp = fopen('php://output',
    'wb');
    foreach ($list as $fields) {
        fputcsv($fp, $fields, ";");
    }
    
    fclose($fp);
?>