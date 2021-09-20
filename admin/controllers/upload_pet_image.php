<?php
require_once '../models/photo_model.php';

$target_dir = "../../data/uploads/";
// set the file name
$date = new DateTime();
$file_name = $date->getTimestamp() . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $file_name;

$errors = [];

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    array_push($errors, "ERROR: El archivo no es una imagen.");
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
    array_push($errors, "ERROR: El archivo ya existe.");
    $uploadOk = 0;
}

// Check file size (10 MB)
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    array_push($errors, "ERROR: El archivo es demasiado grande (límite 10 MB).");
    $uploadOk = 0;
}

// Allow certain file formats (jpg, jpeg, png, gif)
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    array_push($errors, "ERROR: Solo se permiten archivos JPG, JPEG, PNG & GIF.");
    $uploadOk = 0;
}

// get the id
$pet_id = null;
if (!empty($_POST["pet_id"])){
    $pet_id = $_POST["pet_id"];
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // error
    $error_text = end($errors);
    $url = "location:../views/detalle_mascota.php?pet_id={$pet_id}&error={$error_text}";
    // echo $url;
    header($url);
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $url = "location:../views/detalle_mascota.php?pet_id={$pet_id}&success_upload=True";
        // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        $petphoto_id = uploadImageToPet($pet_id, $target_file, $_FILES["fileToUpload"]["name"]);
        if ($petphoto_id) {
            header($url);
        } else {
            $url = "location:../views/detalle_mascota.php?pet_id={$pet_id}&error=ERROR: No se pudo guardar el archivo, intentalo nuevamente.";
            header($url);
        }
    } else {
        $url = "location:../views/detalle_mascota.php?pet_id={$pet_id}&error=ERROR: No se pudo guardar el archivo, intentalo nuevamente.";
        header($url);
    }
}
?>