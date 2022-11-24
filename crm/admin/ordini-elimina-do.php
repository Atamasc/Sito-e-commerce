<?php include('inc/autoloader.php'); ?>
<?php
    $or_codice = $_GET["or_codice"];
    
    $querySql = "SELECT or_eliminato FROM or_ordini WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    
    if (($row_data = $result->fetch_assoc()) !== NULL) {
    
        $or_eliminato = $row_data['or_eliminato'];
        if ($or_eliminato == 0) $or_eliminato = 1; else $or_eliminato = 0;
    
    };
    
    $result->close();
    
    $querySql = "UPDATE or_ordini SET or_eliminato = '$or_eliminato' WHERE or_codice = '$or_codice' ";
    $result = $dbConn->query($querySql);
    $rows = $dbConn->affected_rows;
    
    $dbConn->close();
    
    echo "<script>window.history.back();</script>";
?>
