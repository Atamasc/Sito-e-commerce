<?php include "inc/autoloader.php"; ?>
<?php
$ne_ns_id = (int)$_POST["ne_ns_id"];

$ne_lista_email = $dbConn->real_escape_string(trim(stripslashes($_POST["ne_lista_email"])));
$ne_lista_email_off = $dbConn->real_escape_string(trim(stripslashes($_POST["ne_lista_email_off"])));

$querySql = "DELETE FROM ne_newsletter_email WHERE ne_ns_id = $ne_ns_id ";
$result = $dbConn->query($querySql);

$array_off = array();
$array_email = explode(";", $ne_lista_email_off);
foreach ($array_email as $value) {

    $value = trim($value);
    $value = str_replace("\r\n", "", $value);
    $value = str_replace("\\r\\n", "", $value);

    if(strlen($value) < 1) continue;
    $array_off[] = $value;

    $querySql = "INSERT INTO ne_newsletter_email (ne_ns_id, ne_email, ne_stato) VALUES ('$ne_ns_id', '$value', 0)";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

$array_email = explode(";", $ne_lista_email);
foreach ($array_email as $value) {

    $value = trim($value);
    $value = str_replace("\r\n", "", $value);
    $value = str_replace("\\r\\n", "", $value);

    if(strlen($value) < 1 || in_array($value, $array_off)) continue;

    $querySql = "INSERT INTO ne_newsletter_email (ne_ns_id, ne_email, ne_stato) VALUES ('$ne_ns_id', '$value', 1)";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;

}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&update=true' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&update=false' />";
    //header('Location:add-agente.php?insert=false');
};
?>
