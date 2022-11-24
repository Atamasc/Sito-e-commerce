<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = $_POST["or_codice"];
$or_pagamento = $dbConn->real_escape_string(stripslashes(trim($_POST['or_pagamento'])));

$querySql = "UPDATE or_ordini SET or_pagamento = '$or_pagamento' WHERE or_codice = '$or_codice' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
