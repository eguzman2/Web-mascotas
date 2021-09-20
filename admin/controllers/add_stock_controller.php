<?php
    require_once '../models/stock_model.php';

    $product = $status = $observations = "";
    $quantity = 0;

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["inputProduct"])) {
            array_push($errors, "ERROR: No se pudo obtener el producto.");
        } else {
            $product = format_input($_POST["inputProduct"]);
        }

        if (empty($_POST["inputQuantity"])) {
            $quantity = 0;
        } else {
            $quantity = format_input($_POST["inputQuantity"]);
        }

        if (empty($_POST["inputStatus"])) {
            $status = "";
        } else {
            $status = format_input($_POST["inputStatus"]);
        }

        if (empty($_POST["inputObservations"])) {
            $observations = "";
        } else {
            $observations = format_input($_POST["inputObservations"]);
        }

        // IF NO ERRORS INSERTING THE NEW RECORD

        if (!sizeof($errors)) {
            $stock_id = addProductInStock($product, $quantity, $status, $observations);
    
            if ($stock_id) {
                header("location:../views/inventario.php?success=Producto creado al inventario satisfactoriamente");
            } else {
                array_push($errors, "ERROR: No se pudo agregar el producto al inventario, intenta nuevamente.");
            }
        }        
    }

    function format_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // show errors
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger' role='alert'>
        {$error}
      </div>";
    }
?>

