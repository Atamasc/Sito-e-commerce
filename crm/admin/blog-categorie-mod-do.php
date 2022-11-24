<?php include 'inc/autoloader.php'; ?>

<?php
$bc_id = (int)$_POST['bc_id'];
$bc_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['bc_titolo'])));
$bc_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['bc_descrizione'])));

$querySql = "UPDATE bc_blog_categorie SET 
             bc_titolo = '$bc_titolo', 
             bc_descrizione = '$bc_descrizione'
             WHERE bc_id = $bc_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: blog-categorie-gst.php?bc_id=$bc_id&update=true");
else header("Location: blog-categorie-gst.php?bc_id=$bc_id&update=false");
?>