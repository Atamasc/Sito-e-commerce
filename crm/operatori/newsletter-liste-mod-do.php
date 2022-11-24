<?php include "inc/autoloader.php"; ?>
<?php
$ns_id = (int)$_POST['ns_id'];

$ns_lista = $dbConn->real_escape_string(stripslashes(trim($_POST['ns_lista'])));
$ns_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['ns_descrizione'])));

$querySql = "UPDATE ns_newsletter_liste SET ".
    "ns_lista = '$ns_lista', ".
    "ns_descrizione = '$ns_descrizione' ".
    "WHERE ns_id = '$ns_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: newsletter-liste-gst.php?ns_id=$ns_id&update=true");
else header("Location: newsletter-liste-gst.php?ns_id=$ns_id&update=false");

?>