<?php include "inc/autoloader.php"; ?>
<?php
$ne_ns_id = (int)$_GET["ne_ns_id"];

$subQuery = "SELECT COUNT(ne_id) FROM ne_newsletter_email WHERE ne_email = cl_email AND ne_ns_id = $ne_ns_id";
$querySql = "SELECT DISTINCT cl_email, ($subQuery) AS ne_check FROM cl_clienti WHERE cl_stato > 0 HAVING ne_check = 0 ORDER BY cl_email ";
$result = $dbConn->query($querySql);

while ($row_data = $result->fetch_assoc()) {

    $ne_email = $row_data['cl_email'];

    $querySql_ins = "INSERT INTO ne_newsletter_email (ne_ns_id, ne_email, ne_stato) VALUES ('$ne_ns_id', '$ne_email', 1)";
    $result_ins = $dbConn->query($querySql_ins);
    $rows = $dbConn->affected_rows;

}

$result->close();

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&update=true' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-email.php?ns_id=$ne_ns_id&update=false' />";
    //header('Location:add-agente.php?insert=false');
};
?>
