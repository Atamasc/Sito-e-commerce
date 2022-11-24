<?php include "inc/autoloader.php"; ?>
<?php

$ns_lista = $dbConn->real_escape_string(stripslashes(trim($_POST['ns_lista'])));
$ns_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ns_descrizione'])));

$querySql = "INSERT INTO ns_newsletter_liste (
ns_lista, ns_descrizione, ns_stato
) VALUES (
'$ns_lista', '$ns_descrizione', 1
) ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: newsletter-liste-gst.php?insert=true");
else header("Location: newsletter-liste-gst.php?insert=false");

?>