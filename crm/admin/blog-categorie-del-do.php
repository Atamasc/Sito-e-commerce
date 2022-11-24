<?php include 'inc/autoloader.php'; ?>

<?php
$get_bc_id = (int)$_GET['bc_id'];

$querySql = "DELETE FROM bc_blog_categorie WHERE bc_id = $get_bc_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: blog-categorie-gst.php?delete=true");
else header("Location: blog-categorie-gst?delete=false");
?>
