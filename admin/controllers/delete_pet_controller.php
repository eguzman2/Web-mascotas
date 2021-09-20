<?php
require_once '../models/pet_model.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["pet_id"])) {
        header('location:../index.php?error=ERROR: No se pudo eliminar la mascota, identificador no encontrado.');
    } else {
        $pet_id = format_input($_POST["pet_id"]);
        $success = deletePetById($pet_id);
        if ($success) {
            header('location:../index.php?success=Mascota eliminada exitosamente');
        } else {
            header('location:../index.php?error=ERROR: No se pudo eliminar la mascota.');
        }
    }
} else {
    header('location:../index.php');
}

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>