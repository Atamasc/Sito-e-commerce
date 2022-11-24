<?php
include "../inc/config.php";

$tmp_file = $_FILES["file"]["tmp_name"];
$file_name = $_FILES["file"]["name"];
$file_size = $_FILES["file"]["size"];

if(@!is_array(getimagesize($tmp_file))) exit;

$file = "";
if (strlen($tmp_file) > 0){

    $file_part = explode(".",$file_name);
    $file_ext = end($file_part);
    $file = time().rand(111, 999).".$file_ext";
    $destination_dir_file = "../../upload/summernote/$file";

    if(!file_exists("../../upload/summernote")) mkdir("../../upload/summernote", 0777);
    chmod("../../upload/summernote", 0777);

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        if(@is_uploaded_file($tmp_file)) {
            echo move_uploaded_file($tmp_file, $destination_dir_file)
                ? "$rootBasePath_http/upload/summernote/$file"
                : "Error move";
        };
    };

};
?>