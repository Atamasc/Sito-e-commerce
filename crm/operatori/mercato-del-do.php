<?php include "inc/autoloader.php"; ?>
<?php
$mg_gi_id = (int)$_GET["mg_gi_id"];
$mg_quantita = $dbConn->real_escape_string(stripslashes(trim($_GET["mg_quantita"])));

$querySql =
    "UPDATE mg_mercato_giacenze SET mg_quantita = mg_quantita - $mg_quantita WHERE mg_gi_id = '$mg_gi_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql =
    "DELETE FROM mg_mercato_giacenze WHERE mg_quantita <= 0 ";
$result = $dbConn->query($querySql);

$querySql =
    "UPDATE gi_giacenze SET gi_quantita = gi_quantita + $mg_quantita WHERE gi_id = '$mg_gi_id' ";
$result = $dbConn->query($querySql);

createLogGiacenze($mg_gi_id, "Carico dal mercato", "$mg_quantita", time());

/*if($rows > 0) header("Location: mercato-add.php?insert=true");
else header("Location: mercato-add.php?insert=false");*/
?>
<script>
    window.opener.location.reload();
    window.close();
</script>
