<?php
    require_once '../models/product_model.php';

    $name =  "";

    $type_id = False; 
    $errors = [];

    function get_current_info(){
        GLOBAL $errors;

        GLOBAL $type_id;
        GLOBAL $name;

        if ($type_id == False){
            if (empty($_GET['type_id'])){
                array_push($errors, "ERROR: No podemos obtener los detalles del tipo de producto, por favor intenta nuevamente.");
                return True;
            } 
            $type_id = $_GET['type_id'];
        }

        $type_data = getProductTypeFromId($type_id);
        foreach ($type_data as $pet){
            $name = $pet['name'];
        }

    }

    // read some error response message
    if (!empty($_GET['error'])){
        array_push($errors, $_GET['error']);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['inputTypeId'])){
            array_push($errors, "ERROR: No es posible editar el tipo de producto, identificador no encontrado.");
        } else {
            $type_id = $_POST['inputTypeId'];
        } 

        if ($type_id == False){
            array_push($errors, "ERROR: No es posible editar el tipo de producto, identificador no encontrado.");
        } 

        if (empty($_POST["inputName"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre del tipo de producto.");
        } else {
            $name = format_input($_POST["inputName"]);
        }
        // IF THERE IS NO ERRORS EDITING THE RECORD

        if (!sizeof($errors)) {
            $success = editProductType($type_id, $name);
    
            if ($success) {
                get_current_info();
                print_success_message();
            } else {
                array_push($errors, "ERROR: No se pudo editar el tipo de producto, intenta nuevamente.");
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
        <strong>¡La información del tipo de producto se ha actualizado!</strong>
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
