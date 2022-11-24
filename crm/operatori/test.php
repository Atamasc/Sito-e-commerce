<?php
$vars = "qc_qt_id, qc_cc_id, qc_mod_conf, qc_oneri_reg_fir, qc_oneri_gestione_rifiuti_importo, qc_oneri_gestione_rifiuti_unita, qc_allegato, qc_timestamp, qc_stato";
$vars = explode(",", $vars);

foreach ($vars as &$var) {

    $var = trim($var);
    //if(strlen($var) > 0) echo '$'.$var.' = $dbConn->real_escape_string(stripslashes(trim($_POST["'.$var.'"])));<br>';
    //if(strlen($var) > 0) echo '\'$'.$var.'\', ';
    //if(strlen($var) > 0) echo ''.$var.' = \'$'.$var.'\', ';
    if(strlen($var) > 0) {

        ?>
        <div class="col-md-3 mb-3">
            <label for="<?php echo $var; ?>"><?php echo $var; ?></label>
            <input type="text" class="form-control" id="<?php echo $var; ?>" name="<?php echo $var; ?>"
                   value="<?php echo '<?php echo $row_data[\''.$var.'\']; ?>'; ?>">
        </div>
        <?php


    }

}
?>