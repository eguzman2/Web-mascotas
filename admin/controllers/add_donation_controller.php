<?php
    require_once '../models/donation_model.php';
    require_once '../models/stock_model.php';

    $product = $status = $donor_name = "";
    $quantity = 0;
    $add_to_stock = False;
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

        if (empty($_POST["inputDonorName"])) {
            $donor_name = "";
        } else {
            $donor_name = format_input($_POST["inputDonorName"]);
        }

        if (empty($_POST["inputAddToStock"])) {
            $add_to_stock = False;
        } else {
            $add_to_stock = format_input($_POST["inputAddToStock"]);
        }
        // IF NO ERRORS INSERTING THE NEW RECORD

        if (!sizeof($errors)) {
            $donation_id = addDonation($product, $quantity, $status, $donor_name);
    
            if ($donation_id) {
                if ($add_to_stock) {
                    $added_to_stock = addProductInStock($product, $quantity, $status, 'Donado por ' . $donor_name);
                    if ($added_to_stock) {
                        header("location:../views/donaciones.php?success=Donación agregada satisfactoriamente");
                    } else {
                        header("location:../views/donaciones.php?error=ERROR: No se pudo registrar la donación en el inventario.");
                    }
                }
                header("location:../views/donaciones.php?success=Donación agregada satisfactoriamente");
            } else {
                array_push($errors, "ERROR: No se pudo agregar la donación, intenta nuevamente.");
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

