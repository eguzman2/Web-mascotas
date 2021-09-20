<?php
    require_once '../models/pet_model.php';

    $name = $race = $size = $status = "";
    $description = $observations = "";

    $pet_id = False; 
    $errors = [];

    function get_current_info(){
        GLOBAL $errors;

        GLOBAL $pet_id;
        GLOBAL $name;
        GLOBAL $race;
        GLOBAL $size;
        GLOBAL $status;
        GLOBAL $description;
        GLOBAL $observations;

        if ($pet_id == False){
            if (empty($_GET['pet_id'])){
                array_push($errors, "ERROR: No podemos obtener los detalles de la mascota, por favor intenta nuevamente.");
                return True;
            } 
            $pet_id = $_GET['pet_id'];
        }

        $pet_data = getPetFromId($pet_id);
        foreach ($pet_data as $pet){
            $name = $pet['name'];
            $race = $pet['race'];
            $size = $pet['size'];
            $status = $pet['status_id'];
            $description = $pet['description'];
            $observations = $pet['observations'];
        }

    }

    // read some error response message
    if (!empty($_GET['error'])){
        array_push($errors, $_GET['error']);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['inputPetId'])){
            array_push($errors, "ERROR: No es posible editar la mascota, identificador no encontrado.");
        } else {
            $pet_id = $_POST['inputPetId'];
        } 

        if ($pet_id == False){
            array_push($errors, "ERROR: No es posible editar la mascota, identificador no encontrado.");
        } 

        if (empty($_POST["inputName"])) {
            array_push($errors, "ERROR: No se pudo obtener el nombre de la mascota.");
        } else {
            $name = format_input($_POST["inputName"]);
        }

        if (empty($_POST["inputRace"])) {
            $race = "";
        } else {
            $race = format_input($_POST["inputRace"]);
        }

        if (empty($_POST["inputSize"])) {
            $size = "";
        } else {
            $size = format_input($_POST["inputSize"]);
        }

        if (empty($_POST["inputState"])) {
            $status = "";
        } else {
            $status = format_input($_POST["inputState"]);
        }

        if (empty($_POST["inputDescription"])) {
            $description = "";
        } else {
            $description = format_input($_POST["inputDescription"]);
        }

        if (empty($_POST["inputObservations"])) {
            $observations = "";
        } else {
            $observations = format_input($_POST["inputObservations"]);
        }

        // IF THERE IS NO ERRORS EDITING THE RECORD

        if (!sizeof($errors)) {
            $success = editPet($pet_id, $name, $race, $size, $status, $description, $observations);
    
            if ($success) {
                get_current_info();
                print_success_message();
            } else {
                array_push($errors, "ERROR: No se pudo editar la mascota, intenta nuevamente.");
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
        <strong>¡La información de la mascota se ha actualizado!</strong>
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

    // if the image was uploaded successfully
    if (!empty($_GET['success_upload'])){
        if ($_GET['success_upload']){
        echo "<div class='alert alert-success' role='alert'>
            Imágen subída satisfactoriamente!
        </div>";
        }
    } 
?>
