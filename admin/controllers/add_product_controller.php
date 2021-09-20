<?php
    require_once '../models/product_model.php';

    $name = $brand = $type = $observations = "";

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["inputName"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre del producto.");
        } else {
            $name = format_input($_POST["inputName"]);
        }

        if (empty($_POST["inputBrand"])) {
            $brand = "";
        } else {
            $brand = format_input($_POST["inputBrand"]);
        }

        if (empty($_POST["inputType"])) {
            $type = "";
        } else {
            $type = format_input($_POST["inputType"]);
        }

        if (empty($_POST["inputObservations"])) {
            $observations = "";
        } else {
            $observations = format_input($_POST["inputObservations"]);
        }

        // IF NO ERRORS INSERTING THE NEW RECORD

        if (!sizeof($errors)) {
            $product_id = addProduct($name, $brand, $type, $observations);
    
            if ($product_id) {
                header("location:../views/productos.php?success=Producto creado satisfactoriamente");
            } else {
                array_push($errors, "ERROR: No se pudo crear el producto, intenta nuevamente.");
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

