<?php include('inc/autoloader.php'); ?>
<?php
$im_pr_id = (int)$_POST["im_pr_id"];


$serial_date = time();

$limit = count($_POST["im_descrizione"]);
for ($i = 0; $i < $limit; $i++) {

    $im_descrizione = stripslashes($_POST["im_descrizione"][$i]);
    $im_descrizione = $dbConn->real_escape_string(trim($im_descrizione));

    //Recupero valori del file allegato img 2
    $tmp_im_immagine = $_FILES["im_immagine"]["tmp_name"][$i];
    $im_immagine_name = $_FILES["im_immagine"]["name"][$i];
    $im_immagine_size = $_FILES["im_immagine"]["size"][$i];

    $im_immagine_serial_name = "";
    if (strlen($tmp_im_immagine) > 0){

        $im_immagine_part = explode(".",$im_immagine_name);
        $im_immagine_ext = end($im_immagine_part);
        $im_immagine_serial_name = "$serial_date-$i.$im_immagine_ext";

        if ($im_pr_id > 0) $destination_dir_im_immagine = "$upload_path_dir_varianti_img/$im_immagine_serial_name";

        if ($_FILES['im_immagine']['error'][$i] == UPLOAD_ERR_OK) {
            if(@is_uploaded_file($tmp_im_immagine)) {
                @move_uploaded_file($tmp_im_immagine, $destination_dir_im_immagine);
            };
        };

        $querySql =
            "INSERT INTO pv_prodotti_varianti_immagini(".
            "pv_pr_id,  pv_descrizione, pv_immagine, pv_data, pv_stato".
            ") VALUES (".
            "'$im_pr_id',  '$im_descrizione', '$im_immagine_serial_name', '$serial_date', '0')";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

    }

}

$dbConn->close();

if ($rows > 0) {
    echo "<meta http-equiv='refresh' content='0;url=prodotti-varianti-immagini-add.php?pr_id=$im_pr_id&insert=true' />";
    //header('Location:add-agente.php?insert=true');
} else {
    echo "<meta http-equiv='refresh' content='0;url=prodotti-varianti-immagini-add.php?pr_id=$im_pr_id&insert=false' />";
    //header('Location:add-agente.php?insert=false');
};
?>
