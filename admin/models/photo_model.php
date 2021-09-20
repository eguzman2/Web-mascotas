<?php
    require_once 'db_connection.php';

    function getPhotosByPetId($pet_id){
        $dbconnect = start_connection();

        $where = "WHERE petphoto.pet_id = {$pet_id}";

        $query = "SELECT 
        petphoto.id,
        petphoto.photo_id,
        petphoto.pet_id,
        photo.file,
        photo.name
        FROM `petphoto` 
        INNER JOIN photo ON petphoto.photo_id = photo.id
        " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function uploadImageToPet($pet_id, $pet_file_url, $pet_file_name){
        
        $dbconnect = start_connection();

        $query = "INSERT INTO photo (file, name) 
        VALUES ('$pet_file_url', '$pet_file_name')";

        echo $query;
        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);

            $photo_added_id = addPhotoToPet($pet_id, $id);

            return $photo_added_id;
        } else {
            return False;
        }

    }

    function addPhotoToPet($pet_id, $photo_id){
        $is_a_main_photo = checkIfHasMainPhoto($pet_id);

        $dbconnect = start_connection();

        $query = "INSERT INTO petphoto (pet_id, photo_id, main)
        VALUES ('$pet_id', '$photo_id', '$is_a_main_photo')";

        echo $query;
        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }
    }

    function checkIfHasMainPhoto($pet_id){
        $dbconnect = start_connection();

        $query = "SELECT count(*) AS 'has_main' FROM petphoto WHERE pet_id = $pet_id AND main = 1";

        echo $query;
        $result = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);

        $count_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $count_str = $count_array[0]['has_main'];
        $count = (int) $count_str;
        echo "----COUNT";
        echo $count;
        if ($count > 0) {
            return 0;
        } else {
            return 1;
        }
    }

?>