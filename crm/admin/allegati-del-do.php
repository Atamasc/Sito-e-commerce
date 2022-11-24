<?php include('inc/autoloader.php'); ?>
<?php
$al_id = (int)$_GET["al_id"];
$al_tab_id = (int)$_GET["al_tab_id"];
$al_tipo = $dbConn->real_escape_string(stripslashes(trim($_GET["al_tipo"])));

$querySql = "SELECT al_allegato, al_allegato_definitivo, al_allegato_approvato FROM al_allegati WHERE al_id = $al_id ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$al_allegato = $row_data['al_allegato'];
$al_allegato_definitivo = $row_data['al_allegato_definitivo'];
$al_allegato_approvato = $row_data['al_allegato_approvato'];
$result->close();

if(strlen($al_allegato) > 0) if(is_file("$upload_path_dir_allegati/$al_allegato")) unlink("$upload_path_dir_allegati/$al_allegato");
if(strlen($al_allegato_definitivo) > 0) if(is_file("$upload_path_dir_allegati/$al_allegato_definitivo")) unlink("$upload_path_dir_allegati/$al_allegato_definitivo");
if(strlen($al_allegato_approvato) > 0) if(is_file("$upload_path_dir_allegati/$al_allegato_approvato")) unlink("$upload_path_dir_allegati/$al_allegato_approvato");

$querySql = "DELETE FROM al_allegati WHERE al_id = $al_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=allegati-gst.php?al_tab_id=$al_tab_id&al_tipo=$al_tipo&delete=true' />";
    //header('Location:gst-categorie.php?delete=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=allegati-gst.php?al_tab_id=$al_tab_id&al_tipo=$al_tipo&delete=false' />";
    //header('Location:gst-categorie.php?delete=false');
};
?>
