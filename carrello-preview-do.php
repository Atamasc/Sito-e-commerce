<?php include('inc/autoloader.php'); ?>

<?php
$cr_pagamento = isset($_POST["cr_pagamento"]) ? $dbConn->real_escape_string(trim(stripslashes($_POST["cr_pagamento"]))) : "Bonifico";
$cr_spedizione = isset($_POST["cr_spedizione"]) ? $dbConn->real_escape_string(trim(stripslashes($_POST["cr_spedizione"]))) : "GLS";
$cr_punti = isset($_POST["cr_punti"]) ? $dbConn->real_escape_string(trim(stripslashes($_POST["cr_punti"]))) : 0;
$cr_note = isset($_POST["cr_note"]) ? $dbConn->real_escape_string(trim(stripslashes($_POST["cr_note"]))) : "";
$cr_coupon = isset($_POST["cr_coupon"]) ? $dbConn->real_escape_string(trim(stripslashes($_POST["cr_coupon"]))) : 0;

$querySql =
    "DELETE cr_carrello FROM cr_carrello " .
    "INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice " .
    "WHERE cr_ut_codice = '$session_cl_codice' AND pr_giacenza < 1 ";
$result = $dbConn->query($querySql);
$rows_del = $dbConn->affected_rows;

if (strlen($cr_coupon) > 0) {

    $querySql =
        "SELECT co_coupon, co_tipo, co_valore, co_spedizione, co_utilizzi, co_mr_codice FROM co_coupon WHERE co_coupon = '$cr_coupon' AND co_stato > 0 ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    list($co_coupon_codice, $co_tipo, $co_valore, $co_spedizione, $co_utilizzi, $co_mr_codice) = $result->fetch_array();
    $result->close();

    if ($rows > 0) {

        $queryCountSql = "SELECT COUNT(uc_id) FROM uc_utilizzo_coupon WHERE uc_id > 0 AND uc_coupon = '$cr_coupon' AND uc_ut_codice = '$session_cl_codice' ";
        $result_count = $dbConn->query($queryCountSql);
        $row = $result_count->fetch_row();
        $row_cnt = $row[0];

        if ($row_cnt < $co_utilizzi) {

            if (strlen($co_mr_codice) > 0) {

                $querySql = "SELECT COUNT(cr_id) FROM cr_carrello " .
                    "INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice INNER JOIN mr_marche ON mr_id = pr_mr_id " .
                    "WHERE cr_ut_codice = '$session_cl_codice' AND mr_codice = '$co_mr_codice' ";
                $result = $dbConn->query($querySql);
                list($count) = $result->fetch_array();
                $result->close();

                if ($count > 0) {

                    $querySql =
                        "UPDATE cr_carrello SET cr_coupon_codice = '$co_coupon_codice', cr_coupon = '$co_valore', cr_coupon_tipo = '$co_tipo', cr_coupon_spedizione = '$co_spedizione' WHERE cr_ut_codice = '$session_cl_codice' ";
                    $dbConn->query($querySql);

                }

            } else {
                $querySql =
                    "UPDATE cr_carrello SET cr_coupon_codice = '$co_coupon_codice', cr_coupon = '$co_valore', cr_coupon_tipo = '$co_tipo', cr_coupon_spedizione = '$co_spedizione' WHERE cr_ut_codice = '$session_cl_codice' ";
                $dbConn->query($querySql);
            }
        }
    }

} else {
    $querySql =
        "UPDATE cr_carrello SET cr_coupon_codice = '', cr_coupon = '', cr_coupon_tipo = '', cr_coupon_spedizione = 0 WHERE cr_ut_codice = '$session_cl_codice' ";
    $dbConn->query($querySql);
}

$querySql =
    "UPDATE cr_carrello SET cr_pagamento = '$cr_pagamento', cr_spedizione = '$cr_spedizione', " .
    "cr_note = '$cr_note' WHERE cr_ut_codice = '$session_cl_codice' ";
$dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows_del > 0) {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/anteprima-ordine?del=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/anteprima-ordine' />";
}
?>
