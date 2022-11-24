<?php include 'inc/autoloader.php'; ?>

<?php
$bc_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['bc_titolo'])));
$bc_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['bc_descrizione'])));

$bc_timestamp = time();

$querySql = "INSERT INTO bc_blog_categorie SET 
             bc_titolo = '$bc_titolo', 
             bc_descrizione = '$bc_descrizione', 
             bc_timestamp = $bc_timestamp, 
             bc_stato = 1";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: blog-categorie-gst.php?insert=true");
else header("Location: blog-categorie-gst.php?insert=false");
?>

