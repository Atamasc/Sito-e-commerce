<?php include "inc/autoloader.php"; ?>
<?php
$nb_bl_prim = isset($_POST['nb_bl_prim']) ? (int)$_POST['nb_bl_prim'] : 0;

$nb_tipo = stripslashes($_POST["nb_tipo"]);

$nb_timestamp = time();

$nb_tipo = $dbConn->real_escape_string(trim($nb_tipo));

$nb_bl_sec = "";
if(isset($_POST['nb_bl_sec'])) {
    $i = 0;
    foreach ($_POST['nb_bl_sec'] as $k => $v) {
        if($i > 0) $nb_bl_sec .= "|$k";
        else $nb_bl_sec .= "$k";
        $i++;
    }
}

if($nb_tipo == 'singola') $nb_bl_sec = "";
if($nb_tipo == 'lista') $nb_bl_prim = 0;

$querySql = "INSERT INTO nb_newsletter_blog (nb_bl_prim, nb_bl_sec, nb_timestamp, nb_tipo) VALUES ".
    "('$nb_bl_prim', '$nb_bl_sec', '$nb_timestamp', '$nb_tipo')";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$nb_id = $dbConn->insert_id;

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-blog-add.php?insert=true' />";
} else {
    echo "<meta http-equiv='refresh' content='0;url=newsletter-blog-add.php?insert=false' />";
};
?>
