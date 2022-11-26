<?php include('inc/autoloader.php'); ?>

<?php
$get_or_codice = isset($_POST["or_codice"]) ? $dbConn->real_escape_string($_POST["or_codice"]) : "";
$or_coupon = isset($_POST["or_coupon"]) ? $dbConn->real_escape_string($_POST["or_coupon"]) : "";
$or_ut_codice = isset($_POST["or_ut_codice"]) ? $dbConn->real_escape_string($_POST["or_ut_codice"]) : "";

if (strlen($or_coupon) > 0) {

    $querySql =
        "SELECT co_coupon, co_tipo, co_valore, co_spedizione, co_utilizzi, co_mr_codice FROM co_coupon WHERE co_coupon = '$or_coupon' AND co_stato > 0 ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    list($co_coupon_codice, $co_tipo, $co_valore, $co_spedizione, $co_utilizzi, $co_mr_codice) = $result->fetch_array();
    $result->close();

    if ($rows > 0) {

        $queryCountSql = "SELECT COUNT(uc_id) FROM uc_utilizzo_coupon WHERE uc_id > 0 AND uc_coupon = '$or_coupon' AND uc_ut_codice = '$or_ut_codice' ";
        $result_count = $dbConn->query($queryCountSql);
        $row = $result_count->fetch_row();
        $row_cnt = $row[0];

        if ($row_cnt < $co_utilizzi) {

            $querySql =
                "UPDATE or_ordini SET or_coupon = '$or_coupon', or_coupon_valore = '$co_valore', or_coupon_tipo = '$co_tipo' WHERE or_codice = '$get_or_codice' ";
            $result = $dbConn->query($querySql);
            $rows = $dbConn->affected_rows;

            $querySql_delete =
                "DELETE FROM uc_utilizzo_coupon WHERE uc_ordine = '$get_or_codice' AND uc_ut_codice = '$or_ut_codice' ";
            $result_delete = $dbConn->query($querySql_delete);
            $rows_delete = $dbConn->affected_rows;


            $querySql_insert = "INSERT INTO uc_utilizzo_coupon (";
            $querySql_insert .= "uc_ut_codice, uc_coupon, uc_ordine, uc_data ";
            $querySql_insert .= ") VALUES (";
            $querySql_insert .= "'" . $or_ut_codice . "','" . $or_coupon . "','" . $get_or_codice . "','" . time() . "'";
            $querySql_insert .= ")";
            $result_insert = $dbConn->query($querySql_insert);
            $rows_insert = $dbConn->affected_rows;


        }else{
            //IL CLIENTE HA GIA UTILIZZATO QUESTO COUPON
            echo "<meta http-equiv='refresh' content='0;url=ordini-mod.php?or_codice=$get_or_codice&coupon=exist' />";
            exit;

        }
    }

}

$dbConn->close();

if ($rows > 0 && $rows_insert > 0) {
    echo "<meta http-equiv='refresh' content='0;url=ordini-mod.php?or_codice=$get_or_codice&coupon=true' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=ordini-mod.php?or_codice=$get_or_codice&coupon=false' />";
    //header('Location:add-agente.php?insert=false');
};
?>
