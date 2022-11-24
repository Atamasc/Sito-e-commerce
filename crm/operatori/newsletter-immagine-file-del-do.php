<?php include "inc/autoloader.php"; ?>
<?php
$nl_id = (int)$_GET['nl_id'];
$file = $dbConn->real_escape_string(trim(stripslashes($_GET['file'])));

if(strlen($file) == 0) {

    echo "<script>window.history.back();</script>";
    exit;

}

$querySql = "SELECT nl_data, $file FROM nl_newsletter WHERE nl_id = $nl_id ";
$result = $dbConn->query($querySql);

while (($row_data = $result->fetch_assoc()) !== NULL) {

    $file_del = $row_data[$file];

    if(strlen($file_del) > 0)
        unlink("$upload_path_dir_newsletter/$file_del");

}

$result->close();

$querySql = "UPDATE nl_newsletter SET $file = '' WHERE nl_id = '$nl_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: newsletter-immagine-mod.php?nl_id=$nl_id&delete=true");
else header("Location: newsletter-immagine-mod.php?nl_id=$nl_id&delete=false");

?>