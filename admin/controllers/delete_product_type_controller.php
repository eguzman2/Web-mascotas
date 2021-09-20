<?php
require_once '../models/product_model.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["type_id"])) {
        header('location:../views/tipos_de_producto.php?error=ERROR: No se pudo eliminar el tipo de producto, identificador no encontrado.');
    } else {
        $type_id = format_input($_POST["type_id"]);
        $success = deleteProductTypeById($type_id);
        if ($success) {
            header('location:../views/tipos_de_producto.php?success=Tipo de producto eliminado exitosamente');
        } else {
            header('location:../views/tipos_de_producto.php?error=ERROR: No se pudo eliminar el tipo de producto.');
        }
    }
} else {
    header('location:../views/tipos_de_producto.php');
}

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>