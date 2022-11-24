<?php
$vars = "pr_codice, pr_posizione, pr_codice_ean, pr_descrizione_breve, pr_descrizione_estesa, pr_formato, pr_fm_codice, pr_fm_descrizione, pr_codice_marchio, pt_descrizione_marchio, pr_codice_linea, pr_descrizione_linea, pr_codice_merceologia, pr_descrizione_merceologia, pr_codice_reparto, pr_descrizione_reparto, pr_codice_iva, pr_prezzo, pr_sconto, pr_prezzo_scontato, pr_vetrina, pr_novita, pr_promo, pr_esistenza, pr_ordinato, pr_immagine, pr_stato, pr_timestamp";
$vars = explode(",", $vars);

foreach ($vars as &$var) {

    $var = trim($var);
    //if(strlen($var) > 0) echo '$'.$var.' = $dbConn->real_escape_string(stripslashes(trim($_POST["'.$var.'"])));<br>';
    if(strlen($var) > 0) echo '\'$'.$var.'\', ';
    //if(strlen($var) > 0) echo ''.$var.' = \'$'.$var.'\', ';
    /*if(strlen($var) > 0) {

        ?>
        <div class="col-md-3 mb-3">
            <label for="<?php echo $var; ?>"><?php echo $var; ?></label>
            <input type="text" class="form-control" id="<?php echo $var; ?>" name="<?php echo $var; ?>"
                   value="<?php echo '<?php echo $row_data[\''.$var.'\']; ?>'; ?>">
        </div>
        <?php


    }*/

}
?>