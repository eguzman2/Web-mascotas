<?php
require_once '../models/stock_model.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["stock_id"])) {
        header('location:../views/inventario.php?error=ERROR: No se pudo eliminar este registro del inventario, identificador no encontrado.');
    } else {
        $stock_id = format_input($_POST["stock_id"]);
        $success = deleteProductFromInventary($stock_id);
        if ($success) {
            header('location:../views/inventario.php?success=Registro del producto eliminado exitosamente');
        } else {
            header('location:../views/inventario.php?error=ERROR: No se pudo eliminar este registro del inventario.');
        }
    }
} else {
    header('location:../views/inventario.php');
}

function format_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>