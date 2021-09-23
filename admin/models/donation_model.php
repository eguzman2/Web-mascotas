<?php
    require_once 'db_connection.php';

    function getDonations(){
        $dbconnect = start_connection();

        $query = "SELECT 
            d.id, 
            p.name as product_name,
            d.quantity,
            d.status,
            d.donor_name,
            d.timestamp_date
            FROM `donation` d 
            INNER JOIN product p ON d.product_id = p.id
            WHERE 1";
        
        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getDonationFromId($donation_id){
        $dbconnect = start_connection();

        $query = "SELECT 
            d.id, 
            p.name as product_name,
            d.quantity,
            d.status,
            d.donor_name,
            d.timestamp_date
            FROM `donation` d 
            INNER JOIN product p ON d.product_id = p.id
            WHERE d.id = $donation_id";
        
        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function addDonation($product, $quantity, $status, $donor_name){
        $dbconnect = start_connection();

        $query = "INSERT INTO donation (product_id, quantity, status, donor_name) 
        VALUES ('$product', '$quantity', '$status', '$donor_name')";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }
    }

    function editDonation($donation_id, $quantity, $status, $donor_name){
        $dbconnect = start_connection();

        $query = "UPDATE `donation` SET 
                    `quantity` = '$quantity',
                    `status` = '$status',
                    `donor_name` = '$donor_name'
                    WHERE `donation`.`id` = $donation_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    function deleteDonation($donation_id){
        $dbconnect = start_connection();

        $query = "DELETE FROM donation WHERE id = $donation_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

?>