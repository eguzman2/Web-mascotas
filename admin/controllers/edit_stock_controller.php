<?php
    require_once '../models/stock_model.php';

    $product_name = $status = $observations = "";
    $quantity = 0;

    $stock_id = False; 
    $errors = [];

    function get_current_info(){
        GLOBAL $errors;

        GLOBAL $stock_id;
        GLOBAL $product_name;
        GLOBAL $quantity;
        GLOBAL $status;
        GLOBAL $observations;

        if ($stock_id == False){
            if (empty($_GET['stock_id'])){
                array_push($errors, "ERROR: No podemos obtener los detalles del producto, por favor intenta nuevamente.");
                return True;
            } 
            $stock_id = $_GET['stock_id'];
        }

        $stock_data = getStockFromId($stock_id);

        foreach ($stock_data as $stock){
            $product_name = $stock['product_name'];
            $quantity = $stock['quantity'];
            $status = $stock['status'];
            $observations = $stock['observations'];
        }

    }

    // read some error response message
    if (!empty($_GET['error'])){
        array_push($errors, $_GET['error']);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['inputStockId'])){
            array_push($errors, "ERROR: No es posible editar las existencias del producto, identificador no encontrado.");
        } else {
            $stock_id = $_POST['inputStockId'];
        } 

        if ($stock_id == False){
            array_push($errors, "ERROR: No es posible editar las existencias del producto, identificador no encontrado.");
        } 

        if (empty($_POST["inputQuantity"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre de el producto.");
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

        // IF THERE IS NO ERRORS EDITING THE RECORD

        if (!sizeof($errors)) {
            $success = editProductInStock($stock_id, $quantity, $status, $observations);
    
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
