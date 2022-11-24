<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_GET["or_codice"];

$querySql = "SELECT or_stato_pagamento FROM or_ordini WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);

if (($row_data = $result->fetch_assoc()) !== NULL) {

    $or_stato_pagamento = $row_data['or_stato_pagamento'];
    if ($or_stato_pagamento == 0) $or_stato_pagamento = 1; else $or_stato_pagamento = 0;

};

$result->close();

$querySql = "UPDATE or_ordini SET or_stato_pagamento = '$or_stato_pagamento' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
