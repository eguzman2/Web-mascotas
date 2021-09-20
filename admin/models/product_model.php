<?php 
    require_once 'db_connection.php';

    function getProducts($archived=FALSE){
        $dbconnect = start_connection();

        $where = " WHERE p.archived = 0"; 
        if ($archived) {
            $where = " WHERE p.archived = 1";
        }

        $query = "SELECT 
        p.id,
        p.name,
        pt.id AS type_id,
        pt.name AS type_name,
        p.brand,
        p.observations,
        p.archived
        FROM product p
        LEFT OUTER JOIN producttype pt ON p.product_type_id = pt.id
        " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getProductTypes(){
        $dbconnect = start_connection();

        $where = "";

        $query = "SELECT id, name FROM producttype" . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function addProduct($name, $brand, $type_id, $observations){
        $dbconnect = start_connection();

        $query = "INSERT INTO product (name, brand, product_type_id, observations) 
        VALUES ('$name', '$brand', '$type_id', '$observations')";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }
    }

    function addProductType($name){
        $dbconnect = start_connection();

        $query = "INSERT INTO producttype (name) 
        VALUES ('$name')";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            $id = mysqli_insert_id($dbconnect);
            return $id;
        } else {
            return False;
        }
    }

    function getProductTypeFromId($type_id){
        $dbconnect = start_connection();

        $where = "WHERE id = {$type_id}";

        $query = "SELECT id, name FROM producttype " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function getProductFromId($product_id){
        $dbconnect = start_connection();

        $where = " WHERE p.id = {$product_id}"; 

        $query = "SELECT 
        p.id,
        p.name,
        pt.id AS type_id,
        pt.name AS type_name,
        p.brand,
        p.observations,
        p.archived
        FROM product p
        INNER JOIN producttype pt ON p.product_type_id = pt.id
        " . $where;

        $response = mysqli_query($dbconnect, $query)
        or die (mysqli_error($dbconnect));

        mysqli_close($dbconnect);
        return mysqli_fetch_all($response, MYSQLI_ASSOC);
    }

    function editProduct($product_id, $name, $brand, $type, $observations){
        $dbconnect = start_connection();

        $query = "UPDATE `product` SET 
                    `name` = '$name',
                    `brand` = '$brand',
                    `product_type_id` = '$type',
                    `observations` = '$observations'
                    WHERE `product`.`id` = $product_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    function editProductType($type_id, $name){
        $dbconnect = start_connection();

        $query = "UPDATE `producttype` SET 
                    `name` = '$name'
                    WHERE `producttype`.`id` = $type_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    function deleteProductById($product_id){
        $dbconnect = start_connection();

        // $query = "DELETE FROM product WHERE id = $product_id;";

        $query = "UPDATE `product` SET 
                    `archived` = 1
                    WHERE `product`.`id` = $product_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

    function deleteProductTypeById($type_id){
        $dbconnect = start_connection();

        $query = "DELETE FROM producttype WHERE id = $type_id;";

        $result = mysqli_query($dbconnect, $query) or die (mysqli_error($dbconnect));

        if ($result) {
            return True;
        } else {
            return False;
        }
    }

?>