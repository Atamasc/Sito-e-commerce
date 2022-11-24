<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT or_stato_pagamento, or_stato FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
list($or_stato_pagamento, $or_stato) = $result->fetch_array();
$result->close();

if ($or_stato == 0 && $or_stato_pagamento == 0) {

    $querySql = "DELETE FROM uc_utilizzo_coupon WHERE uc_ordine = '$or_codice' ";
    $result = $dbConn->query($querySql);

}

$querySql = "DELETE FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=ordini-eliminati-gst.php?delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=ordini-eliminati-gst.php?delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
