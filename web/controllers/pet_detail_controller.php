<?php
    include '../models/pet_model.php';

    $pet_id = False;
    $name = $race = $status = $size = $description = "";
    $error = [];
    $images = [];

    if ($pet_id == False){
        if (empty($_GET['pet_id'])){
            $error = "ERROR: No podemos obtener los detalles de la mascota, por favor intenta nuevamente.";
        } else {
            $pet_id = $_GET['pet_id'];
        }
    }

    if ($pet_id){
        $pet_data = getPetFromId($pet_id);
        foreach ($pet_data as $pet){
            $name = $pet['name'];
            $race = $pet['race'];
            $size = $pet['size'];
            $status = $pet['status'];
            $description = $pet['description'];
        }

        $images = getPetImagesFromId($pet_id);
    }

    if (!$images) {
        $images = [
            [
                'file' => '../src/img/pet_default.png',
                'name' => 'Imagen de ejemplo',
                'main' => 1
            ]
        ];
    }


?>