<?php
    require_once '../models/pet_model.php';

    $name = $race = $size = $status = "";
    $description = $observations = "";

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // IF NO ERRORS INSERTING THE NEW RECORD

        if (!sizeof($errors)) {
            $success = addPet($name, $race, $size, $status, $description, $observations);
    
            if ($success) {
                # TODO: redirigir a detalles de la mascota y mostrar mensaje mascota creada
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

