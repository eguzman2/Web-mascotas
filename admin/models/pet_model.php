<?php
    require_once 'db_connection.php';

    function getPets() {
        $dbconnect = start_connection();

        $where = "";

        $query = "SELECT 
            p.id,
            p.name,
            p.race,
            p.size,
            s.id as status_id,
            s.name as status,
            p.description,
            p.observations,
            p.archived
         FROM Pet p
         INNER JOIN PetStatus s ON p.status_id = s.id
        " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getPetFromId($pet_id){
        $dbconnect = start_connection();

        $where = "WHERE p.id = {$pet_id}";

        $query = "SELECT 
            p.id,
            p.name,
            p.race,
            p.size,
            s.id as status_id,
            s.name as status,
            p.description,
            p.observations,
            p.archived
         FROM Pet p
         INNER JOIN PetStatus s ON p.status_id = s.id
        " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getPetStatuses(){
        $dbconnect = start_connection();

        $query = "SELECT id, name FROM PetStatus";
        $result = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function addPet($name, $race, $size, $status, $description, $observations){
        
        $dbconnect = start_connection();

        $query = "INSERT INTO pet (name, race, size, status_id, description, observations) 
        VALUES ('$name', '$race', '$size', '$status', '$description', '$observations')";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }

    }

    function editPet($pet_id, $name, $race, $size, $status, $description, $observations){
        
        $dbconnect = start_connection();

        $query = "UPDATE `pet` SET 
                    `name` = '$name', 
                    `race` = '$race',
                    `size` = '$size', 
                    `status_id` = '$status',
                    `description` = '$description', 
                    `observations` = '$observations' 
                    WHERE `pet`.`id` = $pet_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }

    }

    function deletePetById($pet_id){
        $dbconnect = start_connection();

        $query = "DELETE FROM pet WHERE id = $pet_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }
?>