<?php include('inc/autoloader.php'); ?>

<?php
$get_or_codice = isset($_POST["or_codice"]) ? $dbConn->real_escape_string($_POST["or_codice"]) : "";
$or_pr_codice = isset($_POST["or_pr_codice"]) ? $dbConn->real_escape_string($_POST["or_pr_codice"]) : "";

$querySql = "SELECT pr_prezzo FROM pr_prodotti WHERE pr_codice = '$or_pr_codice' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$result->close();

$pr_prezzo = $row_data['pr_prezzo'];

$rows = 0;
if($pr_prezzo > 0) {

    $querySql =
        "SELECT * FROM or_ordini WHERE or_codice = '$get_or_codice' LIMIT 0, 1";
    $result = $dbConn->query($querySql);
    $row_data = $result->fetch_assoc();
    $result->close();

    $or_sp_id = $row_data["or_sp_id"];
    $or_cl_codice = $row_data["or_cl_codice"];
    $or_pagamento = $row_data["or_pagamento"];
    $or_spedizione = $row_data["or_spedizione"];
    $or_tipo_spedizione = $row_data["or_tipo_spedizione"];
    $or_note = $row_data["or_note"];
    $or_note_admin = $row_data["or_note_admin"];
    $or_stato_conferma = $row_data["or_stato_conferma"];
    $or_stato_pagamento = $row_data["or_stato_pagamento"];
    $or_stato_spedizione = $row_data["or_stato_spedizione"];
    $or_stato_reso = $row_data["or_stato_reso"];
    $or_stato = $row_data["or_stato"];
    $or_archivio = $row_data["or_archivio"];
    $or_tracking = $row_data["or_tracking"];
    $or_sconto = $row_data["or_sconto"];
    $or_fattura = $row_data["or_fattura"];
    $or_regalo = $row_data["or_regalo"];
    $or_rapido = $row_data["or_rapido"];
    $or_eliminato = $row_data["or_eliminato"];
    $or_stato_export = $row_data["or_stato_export"];
    $or_timestamp = $row_data["or_timestamp"];
    $or_coupon_tipo = $row_data['or_coupon_tipo'];
    $or_coupon_valore = $row_data['or_coupon_valore'];
    $or_coupon = $row_data['or_coupon'];

    $querySql_up = "UPDATE pr_prodotti SET pr_giacenza = pr_giacenza - 1 WHERE pr_codice = '$or_pr_codice' ";
    $result_up = $dbConn->query($querySql_up);

    $querySqlOrdini =
        "INSERT INTO or_ordini (".
        "or_pr_codice, or_codice, or_cl_codice, or_pr_prezzo, or_pr_quantita, or_pagamento, or_spedizione, or_tipo_spedizione, or_note, or_note_admin, or_stato_conferma, or_stato_pagamento, ".
        "or_coupon_tipo, or_coupon_valore, or_coupon, or_stato_spedizione, or_stato, or_stato_reso, or_archivio, or_tracking, or_sconto, or_fattura, or_regalo , or_rapido, or_eliminato, or_stato_export, or_timestamp".
        ") VALUES (".
        " '$or_pr_codice', '$get_or_codice', '$or_cl_codice', '$pr_prezzo', 1, '$or_pagamento', '$or_spedizione', '$or_tipo_spedizione', '$or_note', '$or_note_admin', '$or_stato_conferma', '$or_stato_pagamento', ".
        "'$or_coupon_tipo', '$or_coupon_valore', '$or_coupon', '$or_stato_spedizione', '$or_stato', '$or_stato_reso', '$or_archivio', '$or_tracking', '$or_sconto', '$or_fattura', '$or_regalo', '$or_rapido', '$or_eliminato', '$or_stato_export', '$or_timestamp'".
        ") ";
    $result = $dbConn->query($querySqlOrdini);
    $rows = $dbConn->affected_rows;

}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=ordini-mod.php?or_codice=$get_or_codice&insert=true' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=ordini-mod.php?or_codice=$get_or_codice&insert=false' />";
    //header('Location:add-agente.php?insert=false');
};
?>
