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

        echo $query;
        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        echo $result;
        return $result;
    }
?>