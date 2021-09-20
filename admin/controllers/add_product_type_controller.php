<?php
    require_once '../models/product_model.php';

    $name = "";

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["inputName"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre del tipo de producto.");
        } else {
            $name = format_input($_POST["inputName"]);
        }

        // IF NO ERRORS INSERTING THE NEW RECORD

        if (!sizeof($errors)) {
            $pet_id = addProductType($name);
    
            if ($pet_id) {
                header("location:../views/tipos_de_producto.php?success=Tipo de producto agregado exitosamente");
            } else {
                array_push($errors, "ERROR: No se pudo crear la mascota, intenta nuevamente.");
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

