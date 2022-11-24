<?php include "inc/autoloader.php"; ?>
<?php
$st_id = (int)$_GET['st_id'];
$ct_id = (int)$_GET['ct_id'];
$ct_img_fb_1200_628 = (int)$_GET['ct_img_fb_1200_628'];
$st_img_fb_1200_628 = (int)$_GET['st_immagine_fb'];

if($ct_id>0 && $st_id==0) {

    if($ct_img_fb_1200_628==1) {
        $querySql = "SELECT ct_img_fb_1200_628 FROM ct_categorie WHERE ct_id = $ct_id ";
        $result = $dbConn->query($querySql);

        while (($row_data = $result->fetch_assoc()) !== NULL) {
            $ct_img_fb_1200_628 = $row_data['ct_img_fb_1200_628'];

            if (strlen($ct_img_fb_1200_628) > 0) {
                unlink("$upload_path_dir_categorie/$ct_img_fb_1200_628");

            }
        }

        $result->close();

        $querySql = "UPDATE ct_categorie SET ct_img_fb_1200_628 = '' WHERE ct_id = '$ct_id' ";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

        if ($rows > 0) header("Location:prodotti-categorie-gst.php?ct_id=$ct_id&update=true");
        else header("Location:prodotti-categorie-gst.php?ct_id=$ct_id&update=false");
    } else {
        $querySql = "SELECT ct_immagine FROM ct_categorie WHERE ct_id = $ct_id ";
        $result = $dbConn->query($querySql);

        while (($row_data = $result->fetch_assoc()) !== NULL) {
            $ct_immagine = $row_data['ct_immagine'];

            if (strlen($ct_immagine) > 0) {
                unlink("$upload_path_dir_categorie/$ct_immagine");

            }
        }

        $result->close();

        $querySql = "UPDATE ct_categorie SET ct_immagine = '' WHERE ct_id = '$ct_id' ";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

        if ($rows > 0) header("Location:prodotti-categorie-gst.php?ct_id=$ct_id&update=true");
        else header("Location:prodotti-categorie-gst.php?ct_id=$ct_id&update=false");
    }

}
else
{

    if($st_img_fb_1200_628==1) {
        $querySql = "SELECT st_img_fb_1200_628 FROM st_sottocategorie WHERE st_id = $st_id ";
        $result = $dbConn->query($querySql);

        while (($row_data = $result->fetch_assoc()) !== NULL) {
            $st_img_fb_1200_628 = $row_data['st_img_fb_1200_628'];

            if (strlen($st_img_fb_1200_628) > 0) {
                unlink("$upload_path_dir_sottocategorie/$st_img_fb_1200_628");

            }
        }

        $result->close();

        $querySql = "UPDATE st_sottocategorie SET st_img_fb_1200_628 = '' WHERE st_id = '$st_id' ";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

        if ($rows > 0) header("Location:sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=true");
        else header("Location:sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=false");
    }
    else {
        $querySql = "SELECT st_immagine FROM st_sottocategorie WHERE st_id = $st_id ";
        $result = $dbConn->query($querySql);

        while (($row_data = $result->fetch_assoc()) !== NULL) {
            $st_immagine = $row_data['st_immagine'];

            if (strlen($st_immagine) > 0) {
                unlink("$upload_path_dir_sottocategorie/$st_immagine");

            }
        }

        $result->close();

        $querySql = "UPDATE st_sottocategorie SET st_immagine = '' WHERE st_id = '$st_id' ";
        $result = $dbConn->query($querySql);
        $rows = $dbConn->affected_rows;

        if ($rows > 0) header("Location:sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=true");
        else header("Location:sottocategorie-mod.php?st_id=$st_id&ct_id=$ct_id&update=false");
    }
}

?>