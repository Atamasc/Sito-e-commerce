<?php include "inc/autoloader.php"; ?>
<?php
$ns_id = (int)$_POST["ns_id"];

$serial_date = time();

$tmp_lista = $_FILES["file"]["tmp_name"];

$row = 1;
if(($handle = fopen($tmp_lista,"r")) !== FALSE) {
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //$num = count($data);

        if($row != 1) {
            $array = explode(";", $data[0]);

            $querySql = "INSERT INTO ne_newsletter_email (ne_ns_id, ne_email) VALUES ('$ns_id', '".$array[0]."')";
            $result = $dbConn->query($querySql);
            $rows = $dbConn->affected_rows;
        }

        $row++;
    }
    fclose($handle);
}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-gst.php?import=true&ns_id=$ns_id' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-liste-gst.php?import=false&ns_id=$ns_id' />";
    //header('Location:add-agente.php?insert=false');
};
?>
