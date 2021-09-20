<?php
require_once '../models/product_model.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["product_id"])) {
        header('location:../views/productos.php?error=ERROR: No se pudo eliminar el producto, identificador no encontrado.');
    } else {
        $product_id = format_input($_POST["product_id"]);
        $success = deleteProductById($product_id);
        if ($success) {
            header('location:../views/productos.php?success=Producto eliminado exitosamente');
        } else {
            header('location:../views/productos.php?error=ERROR: No se pudo eliminar el producto.');
        }
    }
} else {
    header('location:../views/productos.php');
}

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>