<?php 
    require_once 'db_connection.php';

    function getPets($archived=FALSE){
        $dbconnect = start_connection();

        $where = " WHERE p.archived = 0"; 
        if ($archived) {
            $where = " WHERE p.archived = 1";
        }

        $query = "SELECT 
        p.id,
        p.name,
        p.race,
        p.size,
        s.id as status_id,
        s.name as status,
        p.description,
        p.observations,
        p.archived,
        (SELECT photo.file FROM petphoto INNER JOIN photo ON petphoto.photo_id = photo.id WHERE petphoto.pet_id = p.id AND petphoto.main = 1 LIMIT 1) AS image
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
    
    function getPetImagesFromId($pet_id){
        $dbconnect = start_connection();

        $query = "SELECT 
            petphoto.main,
            photo.file,
            photo.name
            FROM petphoto
            INNER JOIN photo ON petphoto.photo_id = photo.id 
            WHERE petphoto.pet_id = {$pet_id}
            ORDER BY petphoto.main DESC
        ";

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getPetImageUrl($image){
        if($image){
            return substr($image,3);
        } else {
            return "src/img/pet_default.png";
        }
    }
?>