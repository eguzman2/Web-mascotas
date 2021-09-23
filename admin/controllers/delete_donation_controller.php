<?php
require_once '../models/donation_model.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["donation_id"])) {
        header('location:../views/donaciones.php?error=ERROR: No se pudo eliminar esta donación, identificador no encontrado.');
    } else {
        $donation_id = format_input($_POST["donation_id"]);
        $success = deleteDonation($donation_id);
        if ($success) {
            header('location:../views/donaciones.php?success=Donación eliminado exitosamente');
        } else {
            header('location:../views/donaciones.php?error=ERROR: No se pudo eliminar la donación.');
        }
    }
} else {
    header('location:../views/donaciones.php');
}

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>