<?php
    require_once '../models/product_model.php';

    $name = $brand = $type = $observations = "";

    $product_id = False; 
    $errors = [];

    function get_current_info(){
        GLOBAL $errors;

        GLOBAL $product_id;
        GLOBAL $name;
        GLOBAL $brand;
        GLOBAL $type;
        GLOBAL $observations;

        if ($product_id == False){
            if (empty($_GET['product_id'])){
                array_push($errors, "ERROR: No podemos obtener los detalles del producto, por favor intenta nuevamente.");
                return True;
            } 
            $product_id = $_GET['product_id'];
        }

        $product_data = getProductFromId($product_id);

        foreach ($product_data as $product){
            $name = $product['name'];
            $brand = $product['brand'];
            $type = $product['type_id'];
            $observations = $product['observations'];
        }

    }

    // read some error response message
    if (!empty($_GET['error'])){
        array_push($errors, $_GET['error']);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['inputProductId'])){
            array_push($errors, "ERROR: No es posible editar el producto, identificador no encontrado.");
        } else {
            $product_id = $_POST['inputProductId'];
        } 

        if ($product_id == False){
            array_push($errors, "ERROR: No es posible editar el producto, identificador no encontrado.");
        } 

        if (empty($_POST["inputName"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre de el producto.");
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

        // IF THERE IS NO ERRORS EDITING THE RECORD

        if (!sizeof($errors)) {
            $success = editProduct($product_id, $name, $brand, $type, $observations);
    
            if ($success) {
                get_current_info();
                print_success_message();
            } else {
                array_push($errors, "ERROR: No se pudo editar el producto, intenta nuevamente.");
            }
        }        
    } else {
        get_current_info();
    }

    function format_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function print_success_message(){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡La información del producto se ha actualizado!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

    // show errors
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger' role='alert'>
        {$error}
      </div>";
    }

?>
