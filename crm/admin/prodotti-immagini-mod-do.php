<?php include 'inc/autoloader.php'; ?>
<?php
$pi_id = (int)$_POST['pi_id'];
$pi_pr_id = (int)$_POST['pi_pr_id'];
$pi_descrizione = $dbConn->real_escape_string(stripslashes(trim($_POST['pi_descrizione'])));
$pi_timestamp = time();

$querySql = "SELECT pi_immagine FROM pi_prodotti_immagini WHERE pi_id = $pi_id";
$result = $dbConn->query($querySql);
$pi_immagine = $result->fetch_row()[0];
$result->close();

$pi_immagine_tmp = $_FILES['pi_immagine']['tmp_name'];
$pi_immagine_name = $_FILES['pi_immagine']['name'];
$pi_immagine_error = $_FILES['pi_immagine']['error'];

if(strlen($pi_immagine_tmp) > 0) {

    if(is_file("$upload_path_dir_prodotti_img/$pi_immagine")) unlink("$upload_path_dir_prodotti_img/$pi_immagine");

    $pi_immagine_ext = end(explode('.', $pi_immagine_name));
    $pi_immagine = "$pi_timestamp.$pi_immagine_ext";

    $destination_dir_pi_immagine = "$upload_path_dir_prodotti_img/$pi_immagine";

    if ($pi_immagine_error == UPLOAD_ERR_OK) {
        if (@is_uploaded_file($pi_immagine_tmp)) {
            @move_uploaded_file($pi_immagine_tmp, $destination_dir_pi_immagine);
            //checkImageName($destination_dir_pi_immagine, "$pi_full_path", '800x600', "IMG-$pi_timestamp-800x600.jpg");
        }
    }
}

$querySql = "UPDATE pi_prodotti_immagini SET pi_pr_id = $pi_pr_id, pi_descrizione = '$pi_descrizione', pi_data = $pi_timestamp, pi_immagine = '$pi_immagine' WHERE pi_id = $pi_id";
$result = $dbConn->query($querySql);

header("Location: prodotti-immagini-add.php?pi_id=$pi_id&pr_id=$pi_pr_id&update=true");
?>
