<?php
    require_once 'db_connection.php';

    function getStock(){
        $dbconnect = start_connection();

        $query = "SELECT 
	        i.id, 
            p.name as product_name,
            i.quantity,
            i.status,
            i.observations
            FROM `inventory` i 
            INNER JOIN product p ON i.product_id = p.id
            WHERE 1";
        
        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getStockFromId($stock_id){
        $dbconnect = start_connection();

        $query = "SELECT 
	        i.id, 
            p.name as product_name,
            i.quantity,
            i.status,
            i.observations
            FROM `inventory` i 
            INNER JOIN product p ON i.product_id = p.id
            WHERE i.id = $stock_id";
        
        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function addProductInStock($product, $quantity, $status, $observations){
        $dbconnect = start_connection();

        $query = "INSERT INTO inventory (product_id, quantity, status, observations) 
        VALUES ('$product', '$quantity', '$status', '$observations')";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }
    }

    function editProductInStock($stock_id, $quantity, $status, $observations){
        $dbconnect = start_connection();

        $query = "UPDATE `inventory` SET 
                    `quantity` = '$quantity',
                    `status` = '$status',
                    `observations` = '$observations'
                    WHERE `inventory`.`id` = $stock_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    function deleteProductFromInventary($stock_id){
        $dbconnect = start_connection();

        $query = "DELETE FROM inventory WHERE id = $stock_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

?>