<?php include 'inc/autoloader.php'; ?>

<?php
$get_bl_id = (int)$_GET['bl_id'];
$bl_path = "BL-$get_bl_id";

// eliminazione file e directory
$files = glob("$upload_path_dir_blog/$bl_path/*");
foreach ($files as $file) if(is_file($file)) unlink($file);
rmdir("$upload_path_dir_blog/$bl_path");

//eliminazione dal db
$querySql = "DELETE FROM bl_blog WHERE bl_id = $get_bl_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: blog-gst.php?delete=true");
else header("Location: blog-gst.php?delete=false");
?>

